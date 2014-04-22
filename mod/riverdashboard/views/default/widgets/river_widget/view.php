<?php
	/**
	 * View the widget
	 * 
	 * @package ElggRiver
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Curverider Ltd
	 * @copyright Curverider Ltd 2008-2010
	 * @link http://elgg.com/
	 */

	$owner = page_owner_entity();
	
	//get the type - mine or friends
	$type = $vars['entity']->content_type;
	if(!$type)
		$type = "mine";
		
	//based on type grab the correct content type
	if($type == "mine")
		$content_type = '';
	else
		$content_type = 'friend';
		
	//get the number of items to display
	$limit = $vars['entity']->num_display;
	if(!$limit)
		$limit = 4;
	
	//grab the river
	$river = elgg_view_river_items($owner->getGuid(), 0, $content_type, $content[0], $content[1], '', $limit,0,0,false);
		
	$photo_png = $vars['url'] . "mod/qlyfe_theme/graphics/icons/photo.png";	
	$link_png = $vars['url'] . "mod/qlyfe_theme/graphics/icons/link.png";	
	$video_png = $vars['url'] . "mod/qlyfe_theme/graphics/icons/film.png";	
	$music_png = $vars['url'] . "mod/qlyfe_theme/graphics/icons/music.png";	
	$pico_png = $vars['url'] . "mod/qlyfe_theme/graphics/pico.png";
	$network_png = $vars['url'] . "mod/qlyfe_theme/graphics/icons/share.png";
	
	//display
	echo "<div id=\"fancyMessageBox\">
		<form>
		<input class=\"share_text\" type=\"text\" /><button type=\"button\" class=\"share_button\" onclick=\"$('#shareWithBox').slideDown('slow')\">Share</button>		
		</form>
		<table id=\"add_links_table\">
		<tr>
			<td><a href=\"#\"><img src=\"$photo_png\" /> Add Photo</a></td>
			<td><a href=\"#\"><img src=\"$link_png\" /> Add Link</a></td>
			<td><a href=\"#\"><img src=\"$video_png\" /> Add Video</a></td>
			<td><a href=\"#\"><img src=\"$music_png\" /> Add Music</a></td>	
		</tr>
		</table>
	   <div id=\"shareWithBox\">
		<table>
		<tr><td>
		<div style=\"font-weight: bold;\"><strong>Share With</strong></div>
		</td></tr>
		<tr><td>
		<div id=\"shareWithAllConnections\"><input type=\"checkbox\" /> All Connections</div>
		</td></tr>
		<tr><td>
		<div id=\"shareWithFamilyList\">
			<table>
				<tr><td><input type=\"checkbox\" /> </td><td>Family</td><tr>
				<tr><td></td><td><input type=\"checkbox\" /> My Family</td></tr>
				<tr><td></td><td><input type=\"checkbox\" /> Mom's Family</td></tr>
				<tr><td></td><td><input type=\"checkbox\" /> Dad's Family</td></tr>
				<tr><td></td><td><input type=\"checkbox\" /> Wife's Family</td></tr>
			</table>
		</div>
		<div id=\"shareWithFriendsList\">
			<table>
				<tr><td><input type=\"checkbox\" /> </td><td>Friends</td><tr>
				<tr><td></td><td><input type=\"checkbox\" /> Best Friends</td></tr>
				<tr><td></td><td><input type=\"checkbox\" /> School Friends</td></tr>
				<tr><td></td><td><input type=\"checkbox\" /> Golf Buddies</td></tr>
				<tr><td></td><td><input type=\"checkbox\" /> Acquaintances</td></tr>
			</table>
		</div>
		<div id=\"shareWithOthersList\">
			<table>
				<tr><td><input type=\"checkbox\" /> </td><td>Work</td></tr>
				<tr><td><input type=\"checkbox\" /> </td><td>Neighborhood</td></tr>
			</table>
			<button type=\"button\" id=\"postButton\" onclick=\"$('#shareWithBox').slideUp('slow')\">Post</button>
		</div>
		</td></tr>
		</table>
		</div>
	</div>
	<div>
		<img style=\"margin-top: -1px;\" src=\"$pico_png\" />	
	</div>
	<div style=\"margin-left: 20px;margin-bottom: 10px;text-align: left;\">
		<img style=\"\" src=\"$network_png\" /> Shared between you and all your Friends Network 	
	</div>
	<div style=\"margin-left: 10px;margin-bottom: 30px;\">
   <div class=\"networkSwitcher\">All Network Feed</div> <div class=\"networkSwitcher\">Me and My Friends</div>
	</div>
	<div id=\"fancyMessageBox_expanded\">
	</div>
	";	
	
	echo "<div class=\"contentWrapper\">";
	if($type != 'mine')
		echo "<div class='content_area_user_title'><h2>" . elgg_echo("friends") . "</h2></div>";
	echo $river;
	echo "</div>";
	
?>