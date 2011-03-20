<?php  //fleetshortcut.php :: Administrador de Accesos directos de coordenadas

define('INSIDE', true);
$ugamela_root_path = './';
include($ugamela_root_path . 'extension.inc');
include($ugamela_root_path . 'common.'.$phpEx);

if(!check_user()){ header("Location: login.php"); }

//
// Esta funcion permite cambiar el planeta actual.
//
include($ugamela_root_path . 'includes/planet_toggle.'.$phpEx);

$planetrow = doquery("SELECT * FROM {{table}} WHERE id={$user['current_planet']}",'planets',true);


/*
  Este script es original xD
  La funcion de este script es administrar una variable del $user
  Permite agregar y quitar arrays...
*/
//Lets start!
if(isset($mode)){
	if($_POST){
		//Pegamos el texto :P
		if($_POST["n"] == ""){$_POST["n"] = "Sin nombre";}
		
		$r = "{$_POST[n]},{$_POST[g]},{$_POST[s]},{$_POST[p]},{$_POST[t]}\r\n";
		$user['fleet_shortcut'] .= $r;
		doquery("UPDATE {{table}} SET fleet_shortcut='{$user[fleet_shortcut]}' WHERE id={$user[id]}","users");
		message("El acceso se agrego correctamente. En unos instantes seras redirigido.","Agregar","fleetshortcut.php");
	}
	$page = "<form method=POST><table border=0 cellpadding=0 cellspacing=1 width=519>
	<tr height=20>
	<td colspan=2 class=c>Agregar Acceso r�pido</td>
	</tr><tr height=\"20\"><th>
	<input type=text name=n value=\"$g\" size=32 maxlength=32 title=\"Nombre\">
	<input type=text name=g value=\"$s\" size=3 maxlength=1 title=\"Galaxia\">
	<input type=text name=s value=\"$p\" size=3 maxlength=3 title=\"Sistema\">
	<input type=text name=p value=\"$t\" size=3 maxlength=3 title=\"Posicion del planeta\">
	 <select name=t>";
	$page .= '<option value="1"'.(($c[4]==1)?" SELECTED":"").">Planeta</option>";
	$page .= '<option value="2"'.(($c[4]==2)?" SELECTED":"").">Escombros</option>";
	$page .= '<option value="3"'.(($c[4]==3)?" SELECTED":"").">Luna</option>";
	$page .= "</select>
	</th></tr><tr>
	<th><input type=reset value=Limpiar> <input type=submit value=Guardar>";
	//Muestra un (L) si el destino pertenece a luna, lo mismo para escombros
	$page .= "</th></tr>";
	$page .= '<tr><td colspan=2 class=c><a href=fleetshortcut.php>Volver</a></td></tr></tr></table></form>';
}
elseif(isset($a)){
	if($_POST){
		//Armamos el array...
		$scarray = explode("\r\n",$user['fleet_shortcut']);
		if($_POST["delete"]){
			unset($scarray[$a]);
			$user['fleet_shortcut'] =  implode("\r\n",$scarray);
			doquery("UPDATE {{table}} SET fleet_shortcut='{$user[fleet_shortcut]}' WHERE id={$user[id]}","users");
			message("El acceso se borro correctamente. En unos instantes seras redirigido.","Editar","fleetshortcut.php");
		}
		else{
			$r = explode(",",$scarray[$a]);
			$r[0] = $_POST['n'];
			$r[1] = $_POST['g'];
			$r[2] = $_POST['s'];
			$r[3] = $_POST['p'];
			$r[4] = $_POST['t'];
			$scarray[$a] = implode(",",$r);
			$user['fleet_shortcut'] =  implode("\r\n",$scarray);
			doquery("UPDATE {{table}} SET fleet_shortcut='{$user[fleet_shortcut]}' WHERE id={$user[id]}","users");
			message("El acceso se modifico correctamente. En unos instantes seras redirigido.","Editar","fleetshortcut.php");
		}
	}
	if($user['fleet_shortcut']){

		$scarray = explode("\r\n",$user['fleet_shortcut']);
		$c = explode(',',$scarray[$a]);
		
		$page = "<form method=POST><table border=0 cellpadding=0 cellspacing=1 width=519>
	<tr height=20>
	<td colspan=2 class=c>Modificar Acceso r�pido de {$c[0]} [{$c[1]}:{$c[2]}:{$c[3]}]</td>
	</tr>";
		//if($i==0){$page .= "";}
		$page .= "<tr height=\"20\"><th>
		<input type=hidden name=a value=$a>
		<input type=text name=n value=\"{$c[0]}\" size=32 maxlength=32>
		<input type=text name=g value=\"{$c[1]}\" size=3 maxlength=1>
		<input type=text name=s value=\"{$c[2]}\" size=3 maxlength=3>
		<input type=text name=p value=\"{$c[3]}\" size=3 maxlength=3>
		 <select name=t>";
		$page .= '<option value="1"'.(($c[4]==1)?" SELECTED":"").">Planeta</option>";
		$page .= '<option value="2"'.(($c[4]==2)?" SELECTED":"").">Escombros</option>";
		$page .= '<option value="3"'.(($c[4]==3)?" SELECTED":"").">Luna</option>";
		$page .= "</select>
		</th></tr><tr>
		<th><input type=reset value=Reponer> <input type=submit value=Guardar> <input type=submit name=delete value=Borrar>";
		//Muestra un (L) si el destino pertenece a luna, lo mismo para escombros
		$page .= "</th></tr>";
		
	}else{$page .= message("No hay ning&uacute;n acceso directo","Acceso directo","fleetshortcut.php");}

	$page .= '<tr><td colspan=2 class=c><a href=fleetshortcut.php>Volver</a></td></tr></tr></table></form>';


}
else{

	$page = '<table border="0" cellpadding="0" cellspacing="1" width="519">
	<tr height="20">
	<td colspan="2" class="c">Accesos r�pidos (<a href="?mode=add">Agregar</a>)</td>
	</tr>';
	  
	if($user['fleet_shortcut']){
		/*
		  Dentro de fleet_shortcut, se pueden almacenar las diferentes direcciones
		  de acceso directo, el formato es el siguiente.
		  Nombre, Galaxia,Sistema,Planeta,Tipo
		*/
		$scarray = explode("\r\n",$user['fleet_shortcut']);
		$i=$e=0;
		foreach($scarray as $a => $b){
			if($b!=""){
			$c = explode(',',$b);
			if($i==0){$page .= "<tr height=\"20\">";}
			$page .= "<th><a href=\"?a=".$e++."\">";
			$page .= "{$c[0]} {$c[1]}:{$c[2]}:{$c[3]}";
			//Muestra un (L) si el destino pertenece a luna, lo mismo para escombros
			if($c[4]==2){$page .= " (E)";}elseif($c[4]==3){$page .= " (L)";}
			$page .= "</a></th>";
			if($i==1){$page .= "</tr>";}
			if($i==1){$i=0;}else{$i=1;}
			}
			
		}
		if($i==1){$page .= "<th></th></tr>";}
	
	}else{$page .= "<th colspan=\"2\">No hay ning&uacute;n acceso directo</th>";}

	$page .= '<tr><td colspan=2 class=c><a href=fleet.php>Volver</a></td></tr></tr></table>';
}
display($page,"Administrador de Accesos directos de coordenadas");

// Created by Perberos. All rights reversed (C) 2006
?>
