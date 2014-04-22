<?php

    /**
	 * Member widget
	 */

    //the page owner

    //the number of files to display
	$num = (int) $vars['entity']->num_display;
	if (!$num)
		$num = 40;
		
		$members = elgg_get_entities(array(
		'offset' => 0,
		'limit' => 20,
		'full_view' => TRUE,
		'view_type_toggle' => FALSE,
		'types' => 'user',
		'pagination' => TRUE
	));
	
	//get the correct size
	/*$size = (int) $vars['entity']->icon_size;
	if ((!$size || $size == 1) && sizeof($members) < 20){
		$size_value = "small";
	}else{
    	$size_value = "tiny";
	}
	*/
    	$size_value = "tiny";
	
		//$members = $owner->getConnectedTo("", $num, $offset = 0, $classifier);
	
	    // Get the users close members
				
		// If there are any $member to view, view them
		if (is_array($members) && sizeof($members) > 0) {
	
			echo "<div id='vertical_tabs_wrapper_right'>";
			echo "<div class='vertical_tab_current' style='border:none;'>";
			echo "<h5 style='margin:5px;'>" . elgg_echo("members:members") . "</h5>";
	
			foreach($members as $member) {
				echo "<div class='widget_friends_singlefriend' >";
				echo elgg_view("profile/icon",array('entity' => get_user($member->guid), 'size' => $size_value));
				echo "</div>";
			}
	
			echo "</div>";
			echo "</div>";
			
	    }
?>