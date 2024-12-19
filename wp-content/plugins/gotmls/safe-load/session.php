<?php
/**
 * GOTMLS SESSION Start
 * @package GOTMLS
 * @since 4.23.67
*/

require_once(dirname(__FILE__)."/trace.php");

if (!defined("GOTMLS_SESSION_TIME")) {
	define("GOTMLS_SESSION_TIME", microtime(true));

	function GOTMLS_session_start($ID_sess = false) {
		if (!session_id())
			GOTMLS_define("SESS_TEST", @session_start());
		if (!($GOTMLS_LOGIN_KEY = session_id()))
			GOTMLS_define("SESS_FILE", $GOTMLS_LOGIN_KEY = GOTMLS_session_file());
		if (isset($_SESSION["GOTMLS_SESSION_TIME"]))
			$_SESSION["GOTMLS_SESSION_LAST"] = $_SESSION["GOTMLS_SESSION_TIME"];
		else
			$_SESSION["GOTMLS_SESSION_LAST"] = 0;
		$_SESSION["GOTMLS_SESSION_TIME"] = GOTMLS_SESSION_TIME;
		return md5($GOTMLS_LOGIN_KEY.GOTMLS_SESSION_TIME.serialize($_SERVER));
	}

	function GOTMLS_session_close() {
		if (defined("SESS_FILE"))
			GOTMLS_session_file();
		if (session_id())
			session_write_close();
	}

	function GOTMLS_session_die($output, $header = "Content-type: text/javascript") {
		if ($header)
			@header($header);
		GOTMLS_session_close();
		die($output);
	}

	function GOTMLS_session_init($GOTMLS_server_times = array()) {
		if (!(isset($_SESSION["GOTMLS_server_time"]) && is_array($_SESSION["GOTMLS_server_time"])))
			$_SESSION["GOTMLS_server_time"] = array();
		if (defined("GOTMLS_SESSION_TIME") && !(isset($_SESSION["GOTMLS_server_time"]["time_START"]) && is_numeric($_SESSION["GOTMLS_server_time"]["time_START"])))
			$_SESSION["GOTMLS_server_time"]["time_START"] = GOTMLS_SESSION_TIME;
		if (defined("GOTMLS_LOGIN_PROTECTION") && !(isset($_SESSION["GOTMLS_server_time"]["sess_ID"]) && strlen($_SESSION["GOTMLS_server_time"]["sess_ID"]) == 32))
			$_SESSION["GOTMLS_server_time"]["sess_ID"] = GOTMLS_LOGIN_PROTECTION;
		if (is_array($GOTMLS_server_times) && count($GOTMLS_server_times))
			$_SESSION["GOTMLS_server_time"] = array_replace_recursive($_SESSION["GOTMLS_server_time"], $GOTMLS_server_times);
	}

	function GOTMLS_session_file($GOTMLS_server_times = array()) {
		if (defined("GOTMLS_INSTALL_TIME") && defined("GOTMLS_SESSION_FILE")) {
			GOTMLS_session_init();
			$GOTMLS_server_times["GOTMLS_LOGIN_ARRAY"] = array("ADDR" => GOTMLS_REMOTEADDR, "AGENT" => (isset($_SERVER["HTTP_USER_AGENT"])?$_SERVER["HTTP_USER_AGENT"]:"HTTP_USER_AGENT"), "TIME"=>GOTMLS_INSTALL_TIME);
			$GOTMLS_LOGIN_KEY = md5(serialize($GOTMLS_server_times["GOTMLS_LOGIN_ARRAY"]));
			if (!defined("GOTMLS_LOG_FILE"))
				define("GOTMLS_LOG_FILE", dirname(GOTMLS_SESSION_FILE)."/gotmls_".GOTMLS_encode_njG(intval(GOTMLS_SESSION_TIME)).".$GOTMLS_LOGIN_KEY.php");
			if (is_file(GOTMLS_LOG_FILE))
				include(GOTMLS_LOG_FILE);
			elseif (is_file($LOG_FILE = dirname(GOTMLS_SESSION_FILE)."/gotmls_".GOTMLS_encode_njG(intval(GOTMLS_SESSION_TIME) - 3600).".$GOTMLS_LOGIN_KEY.php"))
				include($LOG_FILE);
			if (is_array($GOTMLS_server_times) && count($GOTMLS_server_times))
				$_SESSION["GOTMLS_server_time"] = array_replace_recursive($_SESSION["GOTMLS_server_time"], $GOTMLS_server_times);
			if (GOTMLS_save_contents(GOTMLS_LOG_FILE, '<?php $_SESSION["GOTMLS_server_time"] = array_replace_recursive($_SESSION["GOTMLS_server_time"], GOTMLS_uckserialize(GOTMLS_decode("'.GOTMLS_encode(serialize($_SESSION["GOTMLS_server_time"]), "D").'")));'))
				return $GOTMLS_LOGIN_KEY;
			else
				return 0;
		} else
			return false;
	}
}
