<?php

    /**
	 * Family Widget
	 */

    //the page owner
	$owner = get_user($vars['entity']->owner_guid);

    //the number of files to display
	$max = (int) $vars['entity']->num_display;
	if (!$max)
		$max = 12;
		
	//get the correct size
	$size = (int) $vars['entity']->icon_size;
	if (!$size || $size == 1){
		$size_value = "small";
	}else{
    	$size_value = "tiny";
	}
	
    // Get the users close friends
	$friends = $owner->getConnectedTo("", $max, $offset = 0);
			
	// If there are any $friend to view, view them
	if (is_array($friends) && sizeof($friends) > 0) {

		echo "<div class='vertical_tabs_wrapper'>";
		echo "<div id='vertical_tabs_topline'></div>";
		echo "<div class='vertical_tab_current'>";
		echo "<div class='vertical_tab_items'>";

		echo "<h5 style='margin:5px;'>" . elgg_echo("connect:connections") . "</h5>";
	
		foreach($friends as $friend) {
			echo "<div class=\"widget_friends_singlefriend\" >";
			echo elgg_view("profile/icon",array('entity' => get_user($friend->guid), 'size' => $size_value));
			echo "</div>";
		}

		echo "</div>"; // end items

		echo "<div class='vertical_tab_links'>";				
		echo "<a href='/pg/connections/{$owner->username}'>" . elgg_echo("friends:contextlinks:list") . "</a>";
		echo "</div>";
		
		echo "</div>"; // end current
		echo "</div>"; // end wrapper
		
    }
?>