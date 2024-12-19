<?php

namespace RebelCode\Spotlight\Instagram;

use Generator;
use Throwable;

/** The class that manages the error log file. */
class ErrorLog
{
    /** The path to use if the WordPress uploads directory cannot be determined */
    public const FALLBACK_FILE = SL_INSTA_DIR . '/error.log';
    /** The maximum size, in bytes, of the error log file. */
    public const MAX_SIZE = 1024 * 1024;

    /**
     * Gets the path to the error log file, prioritizing the path in the WordPress uploads directory and falls back
     * to the plugin's directory if the uploads directory cannot be determined (though that is very unlikely).
     */
    public static function getPath(string $name = 'spotlight-error-log.txt'): string
    {
        $uploadDir = wp_upload_dir();

        if ($uploadDir['error'] || empty($uploadDir['basedir'])) {
            return static::FALLBACK_FILE;
        } else {
            return $uploadDir['basedir'] . '/' . $name;
        }
    }

    /**
     * Logs a message to the error log file.
     *
     * @param string $message The message to log.
     */
    public static function message(string $message): void
    {
        static::prepend(static::entryToString($message));
    }

    /**
     * Logs an exception to the error log file.
     *
     * @param Throwable $exception The exception to log.
     */
    public static function exception(Throwable $exception): void
    {
        static::message($exception->getMessage() . PHP_EOL . $exception->getTraceAsString());
    }

    /**
     * Calls the function and logs any exceptions that are thrown.
     *
     * @param callable $fn The function to call.
     */
    public static function catch(callable $fn): void
    {
        try {
            $fn();
        } catch (Throwable $exception) {
            static::exception($exception);
        }
    }

    /** Gets the size of the error log file. */
    public static function getSize(): int
    {
        if (file_exists(static::getPath())) {
            return (int) filesize(static::getPath());
        } else {
            return 0;
        }
    }

    /**
     * Gets the last modified time of the error log file.
     *
     * @return string|null An ISO 8601 date string, or null on failure (such as if the file does not exist).
     */
    public static function getLastModified(): ?string
    {
        $path = static::getPath();
        $mTime = file_exists($path) ? filemtime($path) : false;

        return ($mTime === false) ? null : date(DATE_ATOM, $mTime);
    }

    /** Reads the entire contents of the error log file. */
    public static function read(): string
    {
        $path = static::getPath();

        if (file_exists($path)) {
            return file_get_contents(static::getPath());
        } else {
            return '';
        }
    }

    /**
     * Reads the error log file in chunks using a generator.
     *
     * @param int $chunkSize The size of each chunk to read, in bytes.
     */
    public static function readChunks(int $chunkSize): Generator
    {
        $path = static::getPath();

        if (file_exists($path)) {
            $f = fopen($path, 'r');

            if ($f !== false) {
                try {
                    while (!feof($f)) {
                        yield fread($f, $chunkSize);
                    }
                } finally {
                    fclose($f);
                }
            }
        }
    }

    /**
     * Reads the error log file as lines, using chunk-based reading.
     *
     * @param int $chunkSize The size of each chunk.
     * @return Generator
     */
    public static function readLines(int $chunkSize): Generator
    {
        // A buffer to store the previous chunk's last line (since it may be an incomplete line)
        $buffer = '';

        foreach (static::readChunks($chunkSize) as $chunk) {
            $lines = explode(PHP_EOL, $buffer . $chunk);
            $buffer = array_pop($lines);

            foreach ($lines as $line) {
                yield $line;
            }
        }
    }

    /**
     * Reads the error log file as separate log entries.
     *
     * This reads the entire error log file and splits it into an array, where each entry should be a single log entry.
     *
     * @return Generator<array{time: string,message: string}> A list of assoc arrays.
     */
    public static function readEntries(): Generator
    {
        $curr = null;

        // Read the lines in 128 Kib chunks
        foreach (static::readLines(128 * 1024) as $line) {
            $line = trim($line);
            if (empty($line)) {
                continue;
            }

            if (stripos($line, '[') === 0) {
                // If the start of a new log entry, yield the previous entry first (if any)
                if ($curr !== null) {
                    yield $curr;
                }

                // Parse the new entry, which should start with a date+time string in brackets
                preg_match('/^\[(.*?)]\s?(.*?)$/', $line, $matches);

                if (is_array($matches) && count($matches) === 3) {
                    $curr = [
                        'time' => $matches[1],
                        'message' => $matches[2],
                    ];
                }
            } elseif ($curr !== null) {
                // Add the line to the current entry's message
                $curr['message'] .= PHP_EOL . $line;
            }
        }

        if ($curr !== null) {
            yield $curr;
        }
    }

    /** Deletes the error log file. */
    public static function delete(): bool
    {
        $path = static::getPath();
        if (file_exists($path)) {
            return unlink($path);
        } else {
            return true;
        }
    }

    /** Transforms an entry into a string. */
    protected static function entryToString(string $message, ?string $time = null): string
    {
        $time = $time ?? date(DATE_ATOM);
        $tPrefix = "[" . $time . "]";
        $tLen = strlen($tPrefix) + 1;

        $lines = explode("\n", $message);
        $head = array_shift($lines);
        $message = "$tPrefix $head\n";

        if (count($lines) > 1) {
            $indented = array_map(function ($line) use ($tLen) {
                return str_repeat(' ', $tLen) . $line;
            }, $lines);

            $message .= implode(PHP_EOL, $indented) . PHP_EOL;
        }

        return $message;
    }

    /**
     * Prepends the given text to the error log file.
     *
     * @param string $text The text to prepend.
     */
    protected static function prepend(string $text): void
    {
        $logFilePath = static::getPath();
        $tmpFilePath = static::getPath(uniqid('spotlight-temp-'));

        // Write the text to a temporary file
        $success = file_put_contents($tmpFilePath, $text);
        if ($success === false) {
            return;
        }

        // Open the temporary file and copy over the contents of the actual log file
        $tmpFile = fopen($tmpFilePath, 'a');
        if ($tmpFile) {
            try {
                $numBytes = strlen($text);
                foreach (static::readEntries() as $entry) {
                    $entryStr = static::entryToString($entry['message'], $entry['time']);
                    fwrite($tmpFile, $entryStr);

                    $numBytes += strlen($entryStr);
                    if ($numBytes > static::MAX_SIZE) {
                        break;
                    }
                }
            } finally {
                fclose($tmpFile);

                if (file_exists($logFilePath) && !is_dir($logFilePath)) {
                    @unlink($logFilePath);
                }

                copy($tmpFilePath, $logFilePath);

                if (file_exists($tmpFilePath) && !is_dir($tmpFilePath)) {
                    @unlink($tmpFilePath);
                }
            }
        }
    }
}
