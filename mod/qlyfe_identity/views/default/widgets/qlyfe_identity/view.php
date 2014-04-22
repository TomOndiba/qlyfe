<?php
$user_icon = $vars['url'] . "mod/qlyfe_theme/graphics/user_icons/defaultsmall.gif"; 
?>
<div id="identityWidget">
<table>
<tr>
	<td>
	Friends<br/><br/>
	<img src="<?php echo $user_icon; ?>" /><br/>
	<strong style="font-weight:bold; color: black;">Funny Guy</strong>	
	</td>
	<td style="border-left: 1px dashed #ccc">
	Family<br/><br/>
	<img src="<?php echo $user_icon; ?>" /><br/>
	<strong style="font-weight:bold; color: black;">Family Guy</strong>	
	</td>
</tr>
<tr>
	<td style="border-top: 1px dashed #ccc">
	Work<br/><br/>
	<img src="<?php echo $user_icon; ?>" />	<br/>
	<strong style="font-weight:bold; color: black;">Joe Worker</strong>
	</td>
	<td style="border-left: 1px dashed #ccc;border-top: 1px dashed #ccc ">
	Neighborhood<br/><br/>
	<img src="<?php echo $user_icon; ?>" /><br/>
	<strong style="font-weight:bold; color: black;">Bob Builder</strong>
	</td>
</tr>
</table>
</div>
<div id="menu">
	<ul id="toplevel">
		<li class="profilesMenuItem fly"><a href="#" style="border-top: 1px solid #ccc;">Edit Profiles</a>
			<ul>
				<li><a href="#" style="border-top: 0px;">Friends Network Profile</a></li>
				<li><a href="#">Family Network Profile</a></li>
				<li><a href="#">Work Network Profile</a></li>
				<li><a href="#">Neighborhood Network Profile</a></li>
				<li><a href="#">Add a New Network Profile</a></li>
				<li style="padding-top: 10px; font-weight: bold; color: #fff; text-align:center;">Privacy Settings</li>
  			</ul>		
		</li>
		<li class="profilesMenuItem"><a href="#" style="background-color: white;">All Network Home</a></li>
		<li class="profilesMenuItem"><a href="#">Expand +</a></li>
</div>