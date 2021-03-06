<?php

##############################################################################
# *																			 #
# * XG PROYECT																 #
# *  																		 #
# * @copyright Copyright (C) 2008 - 2009 By lucky from Xtreme-gameZ.com.ar	 #
# *																			 #
# *																			 #
# *  This program is free software: you can redistribute it and/or modify    #
# *  it under the terms of the GNU General Public License as published by    #
# *  the Free Software Foundation, either version 3 of the License, or       #
# *  (at your option) any later version.									 #
# *																			 #
# *  This program is distributed in the hope that it will be useful,		 #
# *  but WITHOUT ANY WARRANTY; without even the implied warranty of			 #
# *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the			 #
# *  GNU General Public License for more details.							 #
# *																			 #
##############################################################################

define('INSIDE'  , true);
define('INSTALL' , false);
define('IN_ADMIN', true);

$xgp_root = './../';
include($xgp_root . 'extension.inc.php');
include($xgp_root . 'common.' . $phpEx);


if ($user['authlevel'] < 3) die(message ($lang['not_enough_permissions']));

	if ($_POST['save'] == $lang['cs_save_changes'])
	{
		if (isset($_POST['stat']) && $_POST['stat'] != $game_config['stat'])
		{
			update_config('stat' , $_POST['stat']);
			$game_config['stat'] = $_POST['stat'];
		}
		if (isset($_POST['stat_level']) &&  is_numeric($_POST['stat_level']) && $_POST['stat_level'] != $game_config['stat_level'])
		{
			update_config('stat_level',  $_POST['stat_level']);
			$game_config['stat_level'] = $_POST['stat_level'];
		}
		if (isset($_POST['stat_flying']) && $_POST['stat_flying'] != $game_config['stat_flying'])
		{
			update_config('stat_flying',  $_POST['stat_flying']);
			$game_config['stat_flying']	= $_POST['stat_flying'];
		}
		if (isset($_POST['stat_settings']) &&  is_numeric($_POST['stat_settings']) && $_POST['stat_settings'] != $game_config['stat_settings'])
		{
			update_config('stat_settings',  $_POST['stat_settings']);
			$game_config['stat_settings'] = $_POST['stat_settings'];
		}
		if (isset($_POST['stat_amount']) &&  is_numeric($_POST['stat_amount']) && $_POST['stat_amount'] != $game_config['stat_amount'] && $_POST['stat_amount'] >= 10)
		{
			update_config('stat_amount',  $_POST['stat_amount']);
			$game_config['stat_amount']	= $_POST['stat_amount'];
		}
		if (isset($_POST['stat_update_time']) &&  is_numeric($_POST['stat_update_time']) && $_POST['stat_update_time'] != $game_config['stat_update_time'])
		{
			update_config('stat_update_time',  $_POST['stat_update_time']);
			$game_config['stat_update_time'] = $_POST['stat_update_time'];
		}
		header("location:configstats.php");
	}
	else
	{
		$selected					=	"selected=\"selected\"";
		$stat						=	(($game_config['stat'] == 1)? 'sel_sta1':'sel_sta0');
		$lang[$stat]				=	$selected;
		$stat_fly					=	(($game_config['stat_flying'] == 1)? 'sel_sf1':'sel_sf0');
		$lang[$stat_fly]			=	$selected;
		$lang['stat_level']			=	$game_config['stat_level'];
		$lang['stat_settings']		=	$game_config['stat_settings'];
		$lang['stat_amount']		=	$game_config['stat_amount'];
		$lang['stat_update_time']	=	$game_config['stat_update_time'];

		$admin_settings = parsetemplate(gettemplate('adm/configstats_body'), $lang);
		display($admin_settings, false, '', true, false);
	}
?>