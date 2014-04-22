<?php

	/**
	 * Elgg Friends widget
	 * This plugin allows users to put a list of their friends, on their profile
	 * 
	 * @package ElggFriends
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Curverider Ltd <info@elgg.com>
	 * @copyright Curverider Ltd 2008-2010
	 * @link http://elgg.com/
	 */
	
		function friends_init() {
    		
    		// Load system configuration
				global $CONFIG;
    		
    		//add a widget
			    add_widget_type('friends',elgg_echo("friends"),elgg_echo('friends:widget:description'));
			
			   // extend our NOP plugin by adding to their classifier list
			    elgg_extend_view("input/classifier_list", "input/friends_classifier_list", 10);
			    
			    // extend the connect dialog
			    elgg_extend_view("connect/dialog", "connect/friends", 550);
			    
			    register_context_handler("friends", "friends_context_handler");
			    
			    elgg_extend_view("profile/menu/linksownpage", "profile/friendslinks");
			    
				elgg_extend_view('connect/vertical_tabs', 'connect/friends_vertical_tabs');
				
				
			    // extend our javascript includes
				// @see mod/nop/javascript/nop.js
				elgg_extend_view('metatags', 'friends/js_includes');
			    
			    
			    register_page_handler("friendscircle", "friends_circle_page_handler");
			    
			// now set up the friends context
				$widgets = 
					"profile::friends%%" .
					"messageboard%%" .
					"discovery::members"; 
	
				qlyfe_add_context("friends", $widgets);
				qlyfe_add_network("friends");
				
		}

		/**
		 * So our access input knows what to do
		 * @param string $sub_context
		 */
		function friends_context_handler($sub_context) {
			if (empty($sub_context)) return new Qlyfe_CList("friends");
			if ($sub_context == "bf") return new Qlyfe_CList("friends/bf");
			if ($sub_context == "f") return new Qlyfe_CList("friends/f");
			if ($sub_context == "a") return new Qlyfe_CList("friends/a");
			
			$circles = get_user_access_collections(get_loggedin_userid());
			if ($circles) {
				foreach ($circles as $circle) {
					if ($circle->name == $sub_context) {
						return new Qlyfe_CList("friends/$sub_context");
					}
				}
			}			
			return new Qlyfe_CList("friends");
			//return new Qlyfe_CList("friends/$sub_context");
		}
		
		/**
		 * Handle pg/friendscircle
		 */
		function friends_circle_page_handler($page) {

			$action = $page[0];
			
			gatekeeper();
			
			switch ($action) {
				case "add":
					include(dirname(__FILE__) . "/circles/add.php"); 
					return true;
				case "update":
					include(dirname(__FILE__) . "/circles/update.php"); 
					return true;
				case "delete":
					include(dirname(__FILE__) . "/circles/delete.php"); 
					return true;
				default:
					forward($vars['url'] . "pg/friends");
			}			
		}
		
		/**
		 * Delete this friends circle
		 * @param $id
		 * @param $name
		 */
		function delete_friends_circle($id, $name) {
			
			$user = get_loggedin_user();
			$classifier = "friends/$name";
			$friends = $user->getConnectedTo("", 99999, 0, $classifier);
			foreach ($friends as $friend) {
				$user->disconnectFrom($friend->guid, $classifier);
			}
			delete_access_collection($id);

		}

		register_elgg_event_handler('init','system','friends_init');
        
?>