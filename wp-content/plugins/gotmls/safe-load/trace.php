<?php 
/**
 * GOTMLS Plugin Core Functions
 * @package GOTMLS
*/

define("GOTMLS_Version", '4.23.69');
define("GOTMLS_SAFELOAD_DIR", dirname(__FILE__)."/");
define("GOTMLS_CHMOD_FILE", 0644);
define("GOTMLS_CHMOD_DIR", 0755);
define("GOTMLS_require_version", "3.3");

function GOTMLS_define($DEF, $val) {
	if (!defined($DEF))
		define($DEF, $val);
}

function GOTMLS_safe_ip($ip) {
	return substr(preg_replace('/[^0-9\.\:a-f]/i', "", $ip), 0, 40);
}

function GOTMLS_get_current_user_id($return = 0) {
	if (function_exists("wp_get_current_user") && ($current_user = @wp_get_current_user()) && (@$current_user->ID > 0))
		$return = $current_user->ID;
	return $return;
}

function GOTMLS_save_contents($file, $content) {
	$chmoded_file = false;
	$chmoded_dir = false;
	if ((is_dir(dirname($file)) || @mkdir(dirname($file), GOTMLS_CHMOD_DIR, true)) && !is_writable(dirname($file)) && ($GOTMLS_chmod_dir = @fileperms(dirname($file))))
		$chmoded_dir = @chmod(dirname($file), 0777);
	if (is_file($file) && !is_writable($file) && ($GOTMLS_chmod_file = @fileperms($file)))
		$chmoded_file = @chmod($file, 0666);
	if (function_exists("file_put_contents"))
		$return = @file_put_contents($file, $content);
	elseif ($fp = fopen($file, 'w')) {
		if (false === fwrite($fp, $content))
			$return = false;
		else
			$return = true;
		fclose($fp);
	} else
		$return = false;
	if ($chmoded_file === true)
		@chmod($file, $GOTMLS_chmod_file);
	if ($chmoded_dir === true)
		@chmod(dirname($file), $GOTMLS_chmod_dir);
	return $return;
}

function GOTMLS_create_session_file($GOTMLS_server_times = 0) {
	if (!defined("GOTMLS_SESSION_FILE"))
		define("GOTMLS_SESSION_FILE", dirname(__FILE__)."/_session/index.php");
	if (!is_dir(dirname(GOTMLS_SESSION_FILE)))
		@mkdir(dirname(GOTMLS_SESSION_FILE), GOTMLS_CHMOD_DIR);
	if (is_dir(dirname(GOTMLS_SESSION_FILE)))
		if (is_numeric($GOTMLS_server_times) && $GOTMLS_server_times)
			$GOTMLS_server_times = GOTMLS_save_contents(GOTMLS_SESSION_FILE, "<?php if (!defined('GOTMLS_INSTALL_TIME')) define('GOTMLS_INSTALL_TIME', '$GOTMLS_server_times');");
	if (is_file(GOTMLS_SESSION_FILE)) {
		if ($GOTMLS_server_times === false)
			unlink(GOTMLS_SESSION_FILE);
		else
			require_once(GOTMLS_SESSION_FILE);
	}
	return $GOTMLS_server_times;
}

define("GOTMLS_REMOTEADDR", GOTMLS_safe_ip(isset($_SERVER["HTTP_CF_CONNECTING_IP"])?$_SERVER["HTTP_CF_CONNECTING_IP"]:(isset($_SERVER["HTTP_X_FORWARDED_FOR"])?$_SERVER["HTTP_X_FORWARDED_FOR"]:(isset($_SERVER["REMOTE_ADDR"])?$_SERVER["REMOTE_ADDR"]:microtime(true)))));

$GOTMLS_mu = array('<?php
/**
 * GOTMLS Brute-Force Login Protection
 * @package GOTMLS
 * @since '.GOTMLS_Version.'
*/
', '
if (defined("ABSPATH")) {
	$GOTMLS_create_session_file = "no";
	if (is_file(ABSPATH."wp-admin/includes/plugin.php"))
		require_once(ABSPATH."wp-admin/includes/plugin.php");
	if (defined("WP_PLUGIN_DIR") && is_file(WP_PLUGIN_DIR."/gotmls/safe-load/trace.php")) {
		require_once(WP_PLUGIN_DIR."/gotmls/safe-load/trace.php");
		GOTMLS_create_session_file();
		if (function_exists("is_plugin_active") && is_plugin_active("gotmls/index.php")) {
			if (!(defined("GOTMLS_INSTALL_TIME") && is_numeric(GOTMLS_INSTALL_TIME) && GOTMLS_INSTALL_TIME > 0))
				$GOTMLS_create_session_file = GOTMLS_create_session_file(microtime(true));
		} elseif (defined("GOTMLS_INSTALL_TIME") && is_numeric(GOTMLS_INSTALL_TIME) && GOTMLS_INSTALL_TIME > 0)
			GOTMLS_create_session_file(-1 * microtime(true));
	} elseif (defined("WP_PLUGIN_DIR") && is_dir(WP_PLUGIN_DIR) && defined("GOTMLS_MU_FILE") && (__FILE__ == GOTMLS_MU_FILE) && !is_dir(WP_PLUGIN_DIR."/gotmls"))
		unlink(GOTMLS_MU_FILE);
}');

function GOTMLS_get_version($which = "") {
	global $wp_version, $cp_version;
	if (function_exists('classicpress_version'))
		$match = array("GOTMLS_wp_version", "c", preg_replace( '#[+-].*$#', '', classicpress_version()));
	elseif (isset($cp_version) && ($cp_version))
		$match = array("GOTMLS_wp_version", "c", preg_replace( '#[+-].*$#', '', $cp_version));
	elseif (isset($wp_version) && ($wp_version))
		$match = array("GOTMLS_wp_version", "w", "$wp_version");
	elseif (!(is_file($file = ABSPATH."wp-includes/version.php") && ($contents = @file_get_contents($file)) && preg_match('/\n\$(c|w)p_version\s*=\s*[\'"]([0-9\.]+)/i', $contents, $match)))
		$match = array("GOTMLS_wp_version", "w", "Unknown");
	GOTMLS_define("GOTMLS_wp_version", $match[2]);
	if ($which == "URL")
		return 'ver='.GOTMLS_Version.'&'.$match[1].'p='.GOTMLS_wp_version;
	else
		return GOTMLS_wp_version;
}

function GOTMLS_load_contents($TXT, $default_encoding = "UTF-8") {
	global $wpdb;
	$encoding = "UTF-8";
	if (!(isset($GLOBALS["GOTMLS"]["tmp"]["custom_whitelist"]) && is_array($GLOBALS["GOTMLS"]["tmp"]["custom_whitelist"]))) {
		$GLOBALS["GOTMLS"]["tmp"]["custom_whitelist"] = array();
		$get_whitelist_SQL = "SELECT CONCAT(`post_mime_type`, 'O', `comment_count`) AS `chksum`, `post_title` FROM `$wpdb->posts` WHERE `post_type` = 'GOTMLS_quarantine' AND `post_status` = 'pending'";
		if (is_array($get_whitelist_rows = $wpdb->get_results($get_whitelist_SQL, ARRAY_A)))
			foreach ($get_whitelist_rows as $get_whitelist_row)
				$GLOBALS["GOTMLS"]["tmp"]["custom_whitelist"][$get_whitelist_row["chksum"]] = GOTMLS_decode($get_whitelist_row["post_title"]);
	}
	if (count($GLOBALS["GOTMLS"]["tmp"]["custom_whitelist"]) && isset($GLOBALS["GOTMLS"]["tmp"]["custom_whitelist"][md5($TXT)."O".strlen($TXT)]))
		$GLOBALS["GOTMLS"]["tmp"]["contents_whitelist"] = md5($TXT)."O".strlen($TXT);
	else
		$GLOBALS["GOTMLS"]["tmp"]["contents_whitelist"] = false;
	if (!(function_exists("mb_detect_encoding") && isset($GLOBALS["GOTMLS"]["tmp"]["default_encodings"]) && ($encoding = mb_detect_encoding($TXT, $GLOBALS["GOTMLS"]["tmp"]["default_encodings"])) && in_array($encoding, array('UCS-4', 'UCS-4LE', 'UTF-32', 'UTF-32BE', 'UTF-32LE', 'UTF-16', 'UTF-16BE', 'UTF-16LE', 'UTF-8', 'utf8', 'ASCII', 'US-ASCII', 'EUC-JP', 'eucJP', 'x-euc-jp', 'SJIS', 'eucJP-win', 'SJIS-win', 'CP932', 'MS932', 'Windows-31J', 'ISO-8859-1', 'ISO-8859-2', 'ISO-8859-3', 'ISO-8859-4', 'ISO-8859-5', 'ISO-8859-6', 'ISO-8859-7', 'ISO-8859-8', 'ISO-8859-9', 'ISO-8859-10', 'ISO-8859-13', 'ISO-8859-14', 'ISO-8859-15', 'ISO-8859-16', 'EUC-CN', 'EUC_CN', 'eucCN', 'gb2312', 'EUC-TW', 'EUC_TW', 'eucTW', 'BIG-5', 'CN-BIG5', 'BIG-FIVE', 'BIGFIVE', 'EUC-KR', 'EUC_KR', 'eucKR', 'KOI8-R', 'KOI8R')))) {
		if (substr($encoding, 0, 7) == 'Windows')
			$encoding = 'ISO-8859-1';
		else
			$encoding = $default_encoding;
	}
	$GLOBALS["GOTMLS"]["tmp"]["file_contents"] = $TXT;
	if (function_exists("mb_internal_encoding"))
		mb_internal_encoding($encoding);
	if (function_exists("mb_regex_encoding"))
		mb_regex_encoding($encoding);
	$GLOBALS["GOTMLS"]["tmp"]["encoding"] = $encoding;
	return strlen($TXT);
}

function GOTMLS_htmlentities($TXT, $flags = ENT_COMPAT, $encoding = "ASCII") {
	$prelen = strlen($TXT);
	if ($prelen == 0)
		return "";
	if ($encoding == "ASCII")
		$encoding = "UTF-8";
	$encoded = htmlentities($TXT, $flags, $encoding);
	if (strlen($encoded) == 0) {
		$encoding = "ISO-8859-1";
		$encoded = htmlentities($TXT, $flags, $encoding);
	}
	if (!$encoded)
		$encoded = __("Failed to encode HTML entities!",'gotmls');
	return $encoded;
}

function GOTMLS_htmlspecialchars($TXT, $flags = ENT_COMPAT, $encoding = "ASCII") {
	$prelen = strlen($TXT);
	if ($prelen == 0)
		return "";
	if ($encoding == "ASCII")
		$encoding = "UTF-8";
	$encoded = htmlspecialchars($TXT, $flags, $encoding);
	if (strlen($encoded) == 0) {
		$encoding = "ISO-8859-1";
		$encoded = htmlspecialchars($TXT, $flags, $encoding);
	}
	if (!$encoded)
		$encoded = __("Failed to encode HTML special characters!",'gotmls');
	return $encoded;
}

function GOTMLS_encode_njG($timestamp = 0) {
	$month = "zjfmayulgsovdz";
	if (!(is_numeric($timestamp) && ($timestamp > 0)))
		$timestamp = time();
	if (($date = intval(date("j", $timestamp))) > 9)
		$date = chr(88+$date);
	return substr($month, intval(date("n", $timestamp)), 1).$date.chr(98+intval(date("G", $timestamp)));
}

function GOTMLS_convert_r($r_str) {
	if (function_exists("mb_ereg_replace"))
		return mb_ereg_replace("\r", "", $r_str);
	else
		return preg_replace('/\r/', "", $r_str);
}

function GOTMLS_error_div($error_str, $class = "error") {
	return GOTMLS_html_tags(array('div' => $error_str), array('div' => "class=\"$class\""));
}

function GOTMLS_uckserialize($unsafe_serialized) {
	if (!(is_array($unsafe_serialized)) && (is_array($safe_unserialized = @unserialize(preg_replace('/[oc]:\d+:".*?":(\d+):\{/is', 'a:\1:{', $unsafe_serialized)))))
		return $safe_unserialized;
	return $unsafe_serialized;
}

function GOTMLS_encode64($unencoded_string) {
	$encoding = "BASE64";
	if (function_exists(strtolower($encoding)."_encode"))
		return base64_encode($unencoded_string);
	elseif (function_exists("mb_convert_encoding"))
		return mb_convert_encoding($unencoded_string, $encoding, "UTF-8");
	else
		return "Cannot encode: $unencoded_string";
}

function GOTMLS_encode($unencoded_string, $post_encode = "") {
	$encoded_array = explode("=", GOTMLS_encode64($unencoded_string)."=");
	$encoded_string = strtr($encoded_array[0], "+/0", "-_=").(count($encoded_array)-1);
	if ($post_encode == "D")
		$encoded_string = str_rot13($encoded_string).($post_encode);
	return $encoded_string;
}

function GOTMLS_decode64($encoded_string) {
	$encoding = "BASE64";
	if (function_exists(strtolower($encoding)."_decode"))
		return base64_decode($encoded_string, true);
	elseif (function_exists("mb_convert_encoding"))
		return mb_convert_encoding($encoded_string, "UTF-8", $encoding);
	else
		return "Cannot decode: $encoded_string";
}

function GOTMLS_decode($encoded_string) {
	if (strlen($encoded_string) > 1 && substr($encoded_string, -1) == "D")
		$encoded_string = str_rot13(substr($encoded_string, 0, -1));
	$tail = 0;
	if (strlen($encoded_string) > 1 && is_numeric(substr($encoded_string, -1)) && substr($encoded_string, -1) > 0)
		$tail = substr($encoded_string, -1) - 1;
	else
		$encoded_string .= "$tail";
	$encoded_string = strtr(substr($encoded_string, 0, -1), "-_=", "+/0").str_repeat("=", $tail);
	return GOTMLS_decode64($encoded_string);
}

// Debug Tracer function by ELI at GOTMLS.NET
function GOTMLS_debug_trace($file) {
	$mt = microtime(true);
	if (!session_id())
		@session_start();
	if (!isset($_SESSION["GOTMLS_traces"]))
		$_SESSION["GOTMLS_traces"] = 0;
	if (!isset($_SESSION["GOTMLS_trace_includes"]))
		$_SESSION["GOTMLS_trace_includes"] = array();
	if (isset($_SESSION["GOTMLS_trace_includes"][$_SESSION["GOTMLS_traces"]][$file]))
		$_SESSION["GOTMLS_traces"] = $mt;
	if (!$GOTMLS_headers_sent && $GOTMLS_headers_sent = headers_sent($filename, $linenum)) {
		if (!$filename)
			$filename = __("an unknown file",'gotmls');
		if (!is_numeric($linenum))
			$linenum = __("unknown",'gotmls');
		$mt .= sprintf(__(': Headers sent by %1$s on line %2$s.','gotmls'), $filename, $linenum);
	}
	if (!(isset($_SESSION["GOTMLS_OBs"]) && is_array($_SESSION["GOTMLS_OBs"])))
		$_SESSION["GOTMLS_OBs"] = array();
	if (($OBs = ob_list_handlers()) && is_array($OBs) && (count($_SESSION["GOTMLS_OBs"]) != count($OBs))) {
		$mt .= print_r(array("ob"=>ob_list_handlers()),1);
		$_SESSION["GOTMLS_OBs"] = $OBs;
	}
	$_SESSION["GOTMLS_trace_includes"][$_SESSION["GOTMLS_traces"]][$file] = $mt;
	if (isset($_GET["GOTMLS_traces"]) && count($_SESSION["GOTMLS_trace_includes"][$_SESSION["GOTMLS_traces"]]) > $_GET["GOTMLS_includes"]) {
		$_SESSION["GOTMLS_traces"] = $mt;
		foreach ($_SESSION["GOTMLS_trace_includes"] as $trace => $array)
			if ($trace < $_GET["GOTMLS_traces"])
				unset($_SESSION["GOTMLS_trace_includes"][$trace]);
		die(print_r(array("<a href='?GOTMLS_traces=".substr($_SESSION["GOTMLS_traces"], 0, 10)."'>".substr($_SESSION["GOTMLS_traces"], 0, 10)."</a><pre>",$_SESSION["GOTMLS_trace_includes"],"</pre>"),true));
	}
}
