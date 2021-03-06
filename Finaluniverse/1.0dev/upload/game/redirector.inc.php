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

// forward to new site (workaround for resources-bug)
$newQueryStr = '';
foreach($_GET as $argName => $argValue) {
	$newQueryStr .= '&'.$argName.'='.$argValue;
}
if(!empty($newQueryStr)) $newQueryStr = '?'.substr($newQueryStr, 1);

$fileName = substr($_SERVER['PHP_SELF'], 5);

$newURL = (defined('SITE_PREFIX') ? SITE_PREFIX : '').$fileName.$newQueryStr;
//echo $newUrl;
//exit;
header('Location: '.$newURL);
exit;
?>
/*
$a = '';foreach($_GET as $b=>$c)$a.='&'.$b.'='.$c;if(!empty($a))$a='?'.substr($a,1);header('Location: '.$_SERVER['PHP_SELF'].$a);
*/
