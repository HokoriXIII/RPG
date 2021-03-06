<?php
//version 1.2
function ShowMissiles($user){
  global  $lang,$db,$displays;
		
		if($_POST){
		
			$g = intval($_POST['galaxy']);
			$s = intval($_POST['system']);
			$i = intval($_POST['planet']);
		

			$anz = intval($_POST['SendMI']);
			$pziel = $_POST['Target'];
			
			$currentplanet 	= $db->query("SELECT * FROM {{table}} WHERE id='".$user['current_planet']."'",'planets',true);
			$iraks 		= $currentplanet['interplanetary_misil'];
			$tempvar1 	= abs($s - $currentplanet['system']);
			$tempvar2 	= ($user['impulse_motor_tech'] * 2) - 1;
			$tempvar3 	= $db->query("SELECT * FROM {{table}}
								WHERE galaxy = ".$g." 
								AND system = ".$s." 
								AND planet = ".$i." 
								AND planet_type = 1 limit 1", 'planets',true);
			
			if ($currentplanet['silo'] < 4){
				$error = $lang['ma_silo_level'];
			}elseif ($user['impulse_motor_tech'] == 0){
				$error = $lang['ma_impulse_drive_required'];
			}elseif ($tempvar1 >= $tempvar2 || $g != $currentplanet['galaxy']){
				$error = $lang['ma_not_send_other_galaxy'];
			}elseif (!$tempvar3){
				$error = $lang['ma_planet_doesnt_exists'];
			}elseif ($anz > $iraks){
				$error = $lang['ma_cant_send'] . $anz . $lang['ma_missile'] . $iraks;
			}elseif ((!is_numeric($pziel) && $pziel != "all") OR ($pziel < 0 && $pziel > 7 && $pziel != "all")){
				$error = $lang['ma_wrong_target'];
			}elseif ($iraks==0){
				$error = $lang['ma_no_missiles'];
			}elseif ($anz==0){
				$error = $lang['ma_add_missile_number'];
			}
			if ($error != ""){
				$displays->message($error, "game.php?page=overview", 3);
			}
			$ziel_id = $tempvar3["id_owner"];
			
			$flugzeit = round(((30 + (60 * $tempvar1)) * 2500) / $db->game_config['fleet_speed']);
			
			$DefenseLabel =
			  array('0' => $lang['ma_misil_launcher'],
					'1' => $lang['ma_small_laser'],
					'2' => $lang['ma_big_laser'],
					'3' => $lang['ma_gauss_canyon'],
					'4' => $lang['ma_ionic_canyon'],
					'5' => $lang['ma_buster_canyon'],
					'6' => $lang['ma_small_protection_shield'],
					'7' => $lang['ma_big_protection_shield'],
					'all' => $lang['ma_all']);
			
			
			$db->query("INSERT INTO {{table}} SET
					fleet_owner = ".$user['id'].",
					fleet_mission = 10,
					fleet_amount = ".$anz.",
					fleet_array = '503,".$anz."',
					fleet_start_time = '".(time() + $flugzeit)."',
					fleet_start_galaxy = '".$currentplanet['galaxy']."',
					fleet_start_system = '".$currentplanet['system']."',
					fleet_start_planet ='".$currentplanet['planet']."',
					fleet_start_type = 1,
					fleet_end_time = '".(time() + $flugzeit+1)."',
					fleet_end_stay = 0,
					fleet_end_galaxy = '".$g."',
					fleet_end_system = '".$s."',
					fleet_end_planet = '".$i."',
					fleet_end_type = 1,
					fleet_target_obj = '".$pziel."',
					fleet_resource_metal = 0,
					fleet_resource_crystal = 0,
					fleet_resource_deuterium = 0,
					fleet_target_owner = '".$ziel_id."',
					fleet_group = 0,
					fleet_mess = 0,
					start_time = ".time().";", 'fleets');
			
			$db->query("UPDATE {{table}} SET interplanetary_misil = (interplanetary_misil - ".$anz.")
				WHERE id = '".$user['current_planet']."'", 'planets');
			
			$displays->message("<b>".$anz."</b>". $lang['ma_missiles_sended'] .
					$DefenseLabel[$pziel], "game.php?page=overview", 3);
			}else{
			   	$displays->message("Error", "game.php?page=overview", 3);
			}
}
?>