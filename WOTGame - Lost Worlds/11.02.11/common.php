<?php
/*
  This file is part of WOT Game.

    WOT Game is free software: you can redistribute it and/or modify
    it under the terms of the GNU Affero General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    WOT Game is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with WOT Game.  If not, see <http://www.gnu.org/licenses/>.
*/

// global locking
if(!defined('LW_DIR')) define('LW_DIR', $ugamela_root_path.'game/');
require_once(LW_DIR.'lib/util/LockUtil.class.php');

$userID = isset($_COOKIE['wcf_userID']) ? intval($_COOKIE['wcf_userID']) : 0;
for($i = 0; $userID > 0; $i++) {
	try {
		LockUtil::checkLock('global_'.$userID);
	}
	catch(SystemException $e) {
		if($i >= 3) {
			throw $e;
			exit;
		}
		sleep(1);
		continue;
	}
	break;
}


// global defines
define('VERSION','1.3');
define('DEFAULT_LANG','de');
define('DEFAULT_SKINPATH',"Eigener Skinpfad");
if(!defined('INSIDE')) define('INSIDE', true);
define('TEMPLATE_DIR',"templates/");
define('TEMPLATE_NAME',"OpenGame");
define('GALAXIES', 4);

$game_config = array();
$user = array();
$theme = array();
$images = array();
$lang = array();
$table_prefix = 'ugml_';


// include WCF
if(!defined('WCF_DIR')) define('WCF_DIR', dirname(__FILE__).'/wcf/');
require_once($ugamela_root_path.'game/global.php');
restore_error_handler();

// update account
$sql = "UPDATE ugml_users
		SET onlinetime = ".TIME_NOW.",
			klicks = klicks + 1,
			user_lastip = '".$_SERVER['REMOTE_ADDR']."'
		WHERE id = ".WCF::getUser()->userID;
WCF::getDB()->registerShutdownUpdate($sql);

// send headers
header("Cache-Control: no-cache");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
header("Cache-Control: no-cache");
header("Pragma: no-cache");
header("Powered-By: Biggerskimo, Blob, R3NT5CH3R");
error_reporting  (E_ERROR | E_WARNING | E_PARSE);

// include basic ugamela files
include($ugamela_root_path.'includes/debug.class.'.$phpEx);
$debug = new debug();
include($ugamela_root_path.'includes/constants.'.$phpEx);
include($ugamela_root_path.'includes/functions.'.$phpEx);
include($ugamela_root_path.'includes/vars.'.$phpEx);
include($ugamela_root_path.'includes/db.'.$phpEx);
if(!defined('NO_PLANET_MAKER')) include($ugamela_root_path . 'includes/planet_maker.'.$phpEx);
include($ugamela_root_path.'includes/rank_maker.'.$phpEx);
include($ugamela_root_path.'includes/strings.'.$phpEx);
include($ugamela_root_path."language/".DEFAULT_LANG."/lang_info.cfg");

// load config
$result = WCF::getDB()->sendQuery("SELECT * FROM ugml_config");
while($row = WCF::getDB()->fetchArray($result)) $game_config[$row['config_name']] = $row['config_value'];

// calc resources/check hangar production
if(WCF::getUser()->userID) {
	LWCore::getPlanet()->calculateResources();

	//auto logout if ip differs or last onlinetime 12 hours past
	/*if(WCF::getUser()->onlinetime+60*60*12 <= TIME_NOW) {
		LWCore::logout();
		die('<meta http-equiv="Refresh" content="1; URL=index.htm"><script>javascript:top.location.href="index.htm"</script>');
	}*/
}

// global locking
if($userID > 0) {
	LockUtil::removeLock('global_'.$userID);
}
?>
