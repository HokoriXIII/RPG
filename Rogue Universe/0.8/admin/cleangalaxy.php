<?php


define('INSIDE'  , true);
define('INSTALL' , false);
define('IN_ADMIN', true);

$ugamela_root_path = './../';
include($ugamela_root_path . 'extension.inc');
include($ugamela_root_path . 'common.' . $phpEx);

	includeLang('admin');

	doquery ("DELETE FROM {{table}} WHERE `id_owner` = '0';" , 'planets');

	$planets = doquery ("SELECT * FROM {{table}}" , 'planets');
	$galaktyka = doquery ("SELECT * FROM {{table}}" , 'galaxy');
	$usery = doquery ("SELECT * FROM {{table}}" , 'users');

	while ( $w = mysql_fetch_assoc($usery) ) {
		$u[] = $w["id"];
	}

	while ( $w = mysql_fetch_assoc($planets) ) {
		$p[] = $w["id"];
		$t = $w["id_owner"];

		if(in_array($t,$u)) {		
			} else {
				doquery ("DELETE FROM {{table}} WHERE id_owner = ".$t , 'planets');
			}
	}

	while ( $w = mysql_fetch_assoc($galaktyka) ) {
		$s = $w['id_planet'];

		if(in_array($s,$p)) {		
		} else {
		doquery ("DELETE FROM {{table}} WHERE id_planet = ".$s , 'galaxy');
		}
	}

	AdminMessage ( $lang['adm_done'], "Clean gallaxy");

?>