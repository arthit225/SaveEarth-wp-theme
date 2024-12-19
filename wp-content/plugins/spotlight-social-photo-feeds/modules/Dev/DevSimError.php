<?php

namespace RebelCode\Spotlight\Instagram\Modules\Dev;

use Exception;
use RebelCode\Spotlight\Instagram\ErrorLog;

class DevSimError
{
    public function __invoke()
    {
        $nonce = filter_input(INPUT_POST, 'sli_dev_sim_error');
        if (!$nonce) {
            return;
        }

        if (!wp_verify_nonce($nonce, 'sli_dev_sim_error')) {
            wp_die('You cannot do that!', 'Unauthorized', [
                'back_link' => true,
            ]);
        }

        $message = filter_input(INPUT_POST, 'sli_dev_error_msg', FILTER_SANITIZE_STRING);
        $message = empty(trim($message)) ? 'Simulated error' : $message;

        ErrorLog::exception(new Exception($message));
    }
}
