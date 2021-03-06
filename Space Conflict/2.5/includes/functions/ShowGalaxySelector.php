<?php

/******************************************
**            Oasis Rage 2.0             **
**             by darkOasis              **
**                                       **
**  special thanks to the developers of  **
**    XNova, Ugamela and RageOnline      **
**                                       **
** ShowGalaxySelector.php                **
******************************************/

function ShowGalaxySelector ( $Galaxy, $System ) {
	global $lang;

	if ($Galaxy > MAX_GALAXY_IN_WORLD) {
		$Galaxy = MAX_GALAXY_IN_WORLD;
	}
	if ($Galaxy < 1) {
		$Galaxy = 1;
	}
	if ($System > MAX_SYSTEM_IN_GALAXY) {
		$System = MAX_SYSTEM_IN_GALAXY;
	}
	if ($System < 1) {
		$System = 1;
	}

	$Result  = "<form action=\"galaxy.php?mode=1\" method=\"post\" id=\"galaxy_form\">";
	$Result .= "<input type=\"hidden\" id=\"auto\" value=\"dr\" >";
	$Result .= "<table border=\"0\">";
	$Result .= "<tbody><tr><td>";

	$Result .= "<table><tbody><tr>";
	$Result .= "<td class=\"c\" colspan=\"3\">". $lang['Galaxy'] ."</td></tr><tr>";
	$Result .= "<td class=\"k\"><input name=\"galaxyLeft\" value=\"&lt;-\" onclick=\"galaxy_submit('galaxyLeft')\" type=\"button\"></td>";
	$Result .= "<td class=\"k\"><input name=\"galaxy\" value=\"". $Galaxy ."\" size=\"5\" maxlength=\"3\" tabindex=\"1\" type=\"text\"></td>";
	$Result .= "<td class=\"k\"><input name=\"galaxyRight\" value=\"-&gt;\" onclick=\"galaxy_submit('galaxyRight')\" type=\"button\"></td>";
	$Result .= "</tr></tbody></table>";

	$Result .= "</td><td>";

	$Result .= "<table><tbody><tr>";
	$Result .= "<td class=\"c\" colspan=\"3\">". $lang['Solar_system'] ."</td></tr><tr>";
	$Result .= "<td class=\"k\"><input name=\"systemLeft\" value=\"&lt;-\" onclick=\"galaxy_submit('systemLeft')\" type=\"button\"></td>";
	$Result .= "<td class=\"k\"><input name=\"system\" value=\"". $System ."\" size=\"5\" maxlength=\"3\" tabindex=\"2\" type=\"text\"></td>";
	$Result .= "<td class=\"k\"><input name=\"systemRight\" value=\"-&gt;\" onclick=\"galaxy_submit('systemRight')\" type=\"button\"></td>";
	$Result .= "</tr></tbody></table>";

	$Result .= "</td>";
	$Result .= "</tr><tr>";
	$Result .= "<td class=\"k\" colspan=\"2\" align=\"center\"> <input value=\"". $lang['Afficher'] ."\" type=\"submit\"></td>";
	$Result .= "</tr>";
	$Result .= "</tbody></table>";
	$Result .= "</form>";

	return $Result;

}

/******************************************************************************************
**                                    Revision Notes                                     **
**  @ Official OasisRage 2.0 release - May 2009 - darkOasis                              **
**  @ (please note any changes you make to the source code)                              **
**  @                                                                                    **
**                                                                                       **
******************************************************************************************/ 

?>