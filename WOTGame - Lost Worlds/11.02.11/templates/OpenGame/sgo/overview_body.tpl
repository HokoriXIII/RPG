<table>
<tr>
<td>
<script language="JavaScript" src="js/Time.class.js"></script>
<center>
<br>
<br>
<table width="519">
  <tr>
	<td class="c" colspan="4">
	  <a href="overview.php?mode=renameplanet" title="{Planet_menu}">{Planet} "{planet_name}"</a> ({user_username})
	</td>
  </tr>

  <!-- Notificacion del mensaje -->

{Have_new_message}

<tr><th>{Server_time}</th><th colspan=3>

{time}

	</th>
  </tr>
  <tr>
	<td colspan="4" class="c">{Events}</td>
  </tr>

{fleet_list}
  <tr>
	<th>

	{moon}
	</th>
	<th colspan="2">
	  <img src="{dpath}planeten/{planet_image}.jpg" height="200" width="200">
	  <br>{building}
	</th>
	<th class="s">
      <table class="s" align="top" border="0">
		<tr>
			<!-- Grupo de planetas -->
			{anothers_planets}
		</tr>
     </table>
    </th>
    </tr>
  <tr>
      <th>
    {Diameter}</th><th colspan="3">{planet_diameter} km (<a title="{Developed_fields}">{planet_field_current} </a> / <a title="{max_eveloped_fields}">{planet_field_max} </a> {fields})</th>
  </tr>
  <tr>
	<th>{Temperature}</th> <th colspan="3">{approx} {planet_temp_min}{Centigrade} {to} {planet_temp_max}{Centigrade}</th>
  </tr>
  <tr>
	<th>{Position}</th><th colspan="3"><a href="galaxy.php?g={galaxy_galaxy}&s={galaxy_system}">[{galaxy_galaxy}:{galaxy_system}:{galaxy_planet}]</a></th>
  </tr>
  <!--tr>
	<th>{Debris}</th><th colspan="3">{Metal}: {metal_debris} / {Crystal}: {crystal_debris}{get_link}</th>
  </tr-->
	<tr>
	<th>{Points}</th><th colspan="3">{user_points} ({Rank} <a href="stat.php?start={u_user_rank}">{user_rank}</a> {of} {max_users})
    <!--<br>Punkty za flote: {user_fleet}<br>Punkty za budynki {user_buili}<br>Punkty za badania {player_points_tech}</th>-->
  </tr>
  <tr>
  <td colspan="4">
  	<center>
  	<script language = "JavaScript">
function popUpAdmin() {
	popupfenster=window.open("popup_admin.htm","Support","width=400, height=450, top=0, left=0, scrollbars=no");
	}
function popUpSpenden() {
	popupfenster=window.open("popup_spenden.htm","Spenden","width=400, height=450, top=0, left=0, scrollbars=no");
	}
</script>
<!--a href="javascript:void();">
<script src="http://layer-ads.de/ia1-50214.js" type="text/javascript"></script>
</a-->
<br />
<a href="javascript:void();">


 <a href="http://85.25.136.224:8888/listen.pls">

 <img src="img/radio.gif" alt="Radio" />
 </a>


  	</center>
  </td>
  </tr>
</table>
</td>
<td>
</td>
</tr>
</table>
 <br>
</center>
<script src="http://layer-ads.de/la-50214.js" type="text/javascript"></script>
<script type="text/javascript" src="http://www.sponsorads.de/script.php?s=99934"></script>
<script type="text/javascript" src="http://www.sponsorads.de/script.php?s=99937"></script>
</body>
<!-- Tooltips: --><script language="JavaScript" src="js/wz_tooltip.js"></script>
</html>