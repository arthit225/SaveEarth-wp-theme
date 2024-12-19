<?php
/**
 * GOTMLS wp-login protection
 * @package GOTMLS
 * @since 4.23.69
*/

require_once(dirname(__FILE__)."/trace.php");

if (!defined("GOTMLS_LOGIN_PROTECTION")) {
	if (!is_file($bflp_file = dirname(dirname(dirname(__DIR__)))."/mu-plugins/gotmls_safe-load.php") || (is_array($GOTMLS_mu) && count($GOTMLS_mu) > 1 && ($bflp_contents = file_get_contents($bflp_file)) && (substr($bflp_contents, -1 * strlen($GOTMLS_mu[1])) != $GOTMLS_mu[1])))
		$GOTMLS_mu = GOTMLS_save_contents($bflp_file, implode("\ndefine('GOTMLS_MU_FILE', __FILE__);\n",  $GOTMLS_mu));
	unset($GOTMLS_mu);
	if (defined("GOTMLS_SAFELOAD_DIR") && is_file(GOTMLS_SAFELOAD_DIR."session.php")) {
		require_once(GOTMLS_SAFELOAD_DIR."session.php");
		if (function_exists("GOTMLS_create_session_file"))
			GOTMLS_create_session_file();
		if (defined("GOTMLS_INSTALL_TIME") && is_numeric(GOTMLS_INSTALL_TIME) && (GOTMLS_INSTALL_TIME > 0) && !defined("GOTMLS_LOGIN_PROTECTION"))
			define("GOTMLS_LOGIN_PROTECTION", GOTMLS_session_start());
	}
}
if (defined("GOTMLS_LOGIN_PROTECTION")) {
	if (!defined("GOTMLS_REQUEST_METHOD"))
		define("GOTMLS_REQUEST_METHOD", (isset($_SERVER["REQUEST_METHOD"])?strtoupper($_SERVER["REQUEST_METHOD"]):"none"));
	if (!(isset($GLOBALS["GOTMLS"]) && is_array($GLOBALS["GOTMLS"])))
		$GLOBALS["GOTMLS"] = array();
	if (!isset($GLOBALS["GOTMLS"]["detected_attacks"]))
		$GLOBALS["GOTMLS"]["detected_attacks"] = '';
	if ((GOTMLS_REQUEST_METHOD == "POST") && (isset($_POST["log"]) && isset($_POST["pwd"])) && !(isset($GOTMLS_LOGIN_KEY) && isset($GOTMLS_logins[$GOTMLS_LOGIN_KEY]["whitelist"]))) {
		if (!(isset($_SESSION["GOTMLS_server_time"]["time_START"]) && defined("GOTMLS_SESSION_TIME") && ($_SESSION["GOTMLS_server_time"]["time_START"] != GOTMLS_SESSION_TIME)) && !defined("SESS_FILE"))
			GOTMLS_define("SESS_FILE", $GOTMLS_LOGIN_KEY = GOTMLS_session_file());
		if (!(isset($_SESSION["GOTMLS_server_time"]["time_START"]) && defined("GOTMLS_SESSION_TIME") && ($_SESSION["GOTMLS_server_time"]["time_START"] != GOTMLS_SESSION_TIME)))
			$GLOBALS["GOTMLS"]["detected_attacks"] = '&attack[]=NO_SESSION';
		elseif (isset($_POST["GOTMLS_sess_id"]) && preg_match('/^[\da-f]{32}_\d++$/', $_POST["GOTMLS_sess_id"])) {
			$GOT_sess = $_POST["GOTMLS_sess_id"];
			if (isset($_POST["GOTMLS_sess_$GOT_sess"]) && is_numeric($_POST["GOTMLS_sess_$GOT_sess"]) && isset($_SESSION["GOTMLS_server_time"]["sess_$GOT_sess"]["JS_time"])) {
				if ($_SESSION["GOTMLS_server_time"]["sess_$GOT_sess"]["JS_time"] != $_POST["GOTMLS_sess_$GOT_sess"])
					$GLOBALS["GOTMLS"]["detected_attacks"] = '&attack[]=WRONG_JS';
			} else
				$GLOBALS["GOTMLS"]["detected_attacks"] = '&attack[]=NO_JS';
		} else
			$GLOBALS["GOTMLS"]["detected_attacks"] = '&attack[]=NO_SESSION_ID';
		if (!isset($_SERVER["REMOTE_ADDR"]))
			$GLOBALS["GOTMLS"]["detected_attacks"] .= '&attack[]=NO_REMOTE_ADDR';
		if (!isset($_SERVER["HTTP_USER_AGENT"]))
			$GLOBALS["GOTMLS"]["detected_attacks"] .= '&attack[]=NO_HTTP_USER_AGENT';
		if (!isset($_SERVER["HTTP_REFERER"]) && !(isset($_SERVER["HTTP_USER_AGENT"]) && substr($_SERVER["HTTP_USER_AGENT"], 0, 18) == "Mozilla/5.0 (iPad;"))
			$GLOBALS["GOTMLS"]["detected_attacks"] .= '&attack[]=NO_HTTP_REFERER';
		if (!(isset($GLOBALS["GOTMLS"]["detected_attacks"]) && $GLOBALS["GOTMLS"]["detected_attacks"])) {
			if (isset($_SESSION["GOTMLS_server_time"]["login_attempts"]) && is_numeric($_SESSION["GOTMLS_server_time"]["login_attempts"]) && strlen($_SESSION["GOTMLS_server_time"]["login_attempts"]."") > 0)
				$_SESSION["GOTMLS_server_time"]["login_attempts"]++;
			else {
				if ($GOTMLS_LOGIN_KEY = GOTMLS_session_file()) {
					if (!(isset($GLOBALS["GOTMLS"]["logins"][$GOTMLS_LOGIN_KEY]["POST"]) && is_array($GLOBALS["GOTMLS"]["logins"][$GOTMLS_LOGIN_KEY]["POST"])))
						$GLOBALS["GOTMLS"]["detected_attacks"] .= '&attack[]=NO_LOGIN_ATTEMPTS';
					elseif (!isset($GLOBALS["GOTMLS"]["logins"][$GOTMLS_LOGIN_KEY]["GET"]))
						$GLOBALS["GOTMLS"]["detected_attacks"] .= '&attack[]=NO_LOGIN_GETS';
					else {
						$_SESSION["GOTMLS_server_time"]["login_attempts"] = 0;
						foreach ($GLOBALS["GOTMLS"]["logins"][$GOTMLS_LOGIN_KEY]["POST"] as $LOGIN_TIME=>$LOGIN_ARRAY) {
							if ($LOGIN_TIME > $GLOBALS["GOTMLS"]["logins"][$GOTMLS_LOGIN_KEY]["GET"])
								$_SESSION["GOTMLS_server_time"]["login_attempts"]++;
							else
								unset($GLOBALS["GOTMLS"]["logins"][$GOTMLS_LOGIN_KEY]["POST"][$LOGIN_TIME]);
						}
					}
				} else
					$GLOBALS["GOTMLS"]["detected_attacks"] .= '&attack[]=NO_SESSION_FILE';
			}
			if (!(isset($_SESSION["GOTMLS_server_time"]["login_attempts"]) && is_numeric($_SESSION["GOTMLS_server_time"]["login_attempts"]) && ($_SESSION["GOTMLS_server_time"]["login_attempts"] < 6) && $_SESSION["GOTMLS_server_time"]["login_attempts"]))
				$GLOBALS["GOTMLS"]["detected_attacks"] .= '&attack[]=TOO_MANY_login_attempts';
		}
		if (isset($GLOBALS["GOTMLS"]["detected_attacks"]) && $GLOBALS["GOTMLS"]["detected_attacks"])
			require(dirname(__FILE__)."/index.php");
	} else {
		if (isset($_GET["GOTMLS_sess"]) && strlen($_GET["GOTMLS_sess"]) == 32 && isset($_GET["GOTMLS_time"]) && is_numeric($_GET["GOTMLS_time"]) && isset($_GET["GOTMLS_form_id"]) && is_numeric($_GET["GOTMLS_form_id"])) {
			define("GOTMLS_FORMID", $_GET["GOTMLS_form_id"]);
			define("GOTMLS_SESS", preg_replace('/[^\da-f]++/i', "", $_GET["GOTMLS_sess"])."_".GOTMLS_FORMID);
			define("GOTMLS_TIME", preg_replace('/[^\d]/', "", $_GET["GOTMLS_time"]));
			if (!(isset($_SESSION["GOTMLS_server_time"]["time_START"]) && is_numeric($_SESSION["GOTMLS_server_time"]["time_START"])) && !defined("SESS_FILE"))
				GOTMLS_define("SESS_FILE", $GOTMLS_LOGIN_KEY = GOTMLS_session_file());
			if (!(isset($_SESSION["GOTMLS_server_time"]["time_START"]) && is_numeric($_SESSION["GOTMLS_server_time"]["time_START"])))
				define("GOTMLS_SESS_ERROR", "Login Session Lost! ");
			else {
				define("GOTMLS_logintime_JS", "if (GOTMLS_field = document.getElementById('GOTMLS_sess_id_".GOTMLS_FORMID."')) {\n\tGOTMLS_field.value = '".GOTMLS_SESS."';\n\tGOTMLS_field.name = 'GOTMLS_sess_id';\n}\nif (GOTMLS_field = document.getElementById('GOTMLS_offset_id_".GOTMLS_FORMID."'))\n\tGOTMLS_field.name = 'GOTMLS_sess_".GOTMLS_SESS."';\nif (GOTMLS_loading_gif = document.getElementById('loading_BRUTEFORCE_".GOTMLS_FORMID."')) GOTMLS_loading_gif.style.display = 'none';");
				if (floor($_SESSION["GOTMLS_server_time"]["time_START"]) <= GOTMLS_SESSION_TIME) {
					$_SESSION["GOTMLS_server_time"]["sess_".GOTMLS_SESS]["JS_time"] = GOTMLS_TIME;
					$_SESSION["GOTMLS_server_time"]["sess_".GOTMLS_SESS]["PHP_time"] = GOTMLS_SESSION_TIME;
				} else
					define("GOTMLS_SESS_ERROR", "Login Session Not Found! ");
			}
		}
		GOTMLS_session_init();
		$_SESSION["GOTMLS_server_time"]["login_attempts"] = 0;
	}
	GOTMLS_session_close();
}
