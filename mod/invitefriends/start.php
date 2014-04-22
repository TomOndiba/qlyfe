<?php

	/**
	 * Elgg invite page
	 * 
	 * @package ElggFile
	 * @author Curverider Ltd
	 * @copyright Curverider Ltd 2008-2010
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @link http://elgg.org/
	 */

		function invitefriends_init() {
    		
    		//add a widget
			    add_widget_type("invitefriends",elgg_echo("invitefriends"), "");
			
		}
		

	function invitefriends_pagesetup() {
		
		// Menu options
			global $CONFIG;
			
			if (get_context() == "friends" || 
				get_context() == "friendsof" || 
				get_context() == "collections") {
					
					add_submenu_item(elgg_echo('friends:invite'),$CONFIG->wwwroot."mod/invitefriends/",'invite');
					
				}
		
	}

	global $CONFIG;
	register_action('invitefriends/invite', false, $CONFIG->pluginspath . 'invitefriends/actions/invite.php');
	register_action('invitefriends/invitecontacts', false, $CONFIG->pluginspath . 'invitefriends/actions/invitecontacts.php');	
	register_elgg_event_handler('pagesetup','system','invitefriends_pagesetup',1000);
	register_elgg_event_handler('init','system','invitefriends_init');
?>