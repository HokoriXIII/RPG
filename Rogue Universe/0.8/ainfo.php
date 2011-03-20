<?php

define('INSIDE'  , true);
define('INSTALL' , false);

$ugamela_root_path = './';
include($ugamela_root_path . 'extension.inc');
include($ugamela_root_path . 'common.'.$phpEx);

$dpath = (!$userrow["dpath"]) ? DEFAULT_SKINPATH : $userrow["dpath"];


if(!is_numeric($_GET["a"]) || !$_GET["a"] ){ message("Invalid Alliance ID","Error");}

$allyrow = doquery("SELECT ally_name,ally_tag,ally_description,ally_web,ally_image FROM {{table}} WHERE id=".$_GET["a"],"alliance",true);

if(!$allyrow){ message("The Alliance doesnt exist","Error");}

$count = doquery("SELECT COUNT(DISTINCT(id)) FROM {{table}} WHERE ally_id=".$_GET["a"].";","users",true);
$ally_member_scount = $count[0];

$page .="<table width=519><tr><td class=c colspan=2>Alliance Information</td></tr>";

	if($allyrow["ally_image"] != ""){
		$page .= "<tr><th colspan=2><img src=\"".$allyrow["ally_image"]."\"></td></tr>";
	}

	$page .= "<tr><th>Tag</th><th>".$allyrow["ally_tag"]."</th></tr><tr><th>Nom</th><th>".$allyrow["ally_name"]."</th></tr><tr><th>Membres</th><th>$ally_member_scount</th></tr>";

	if($allyrow["ally_description"] != ""){
		$page .= "<tr><th colspan=2 height=100>".$allyrow["ally_description"]."</th></tr>";
	}


	if($allyrow["ally_web"] != ""){
		$page .="<tr>
		<th>Site internet</th>
		<th><a href=\"".$allyrow["ally_web"]."\">".$allyrow["ally_web"]."</a></th>
		</tr>";
	}
	$page .= "</table>";

	display($page,"Information sur l'alliance [".$allyrow["ally_name"]."]",false);


?>