<?php

	/**
	 * Elgg profile plugin edit action
	 *
	 * @package Elggprofile
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Curverider Ltd <info@elgg.com>
	 * @copyright Curverider Ltd 2008-2010
	 * @link http://elgg.com/
	 */

	// Load configuration
		global $CONFIG;

		gatekeeper();

	// Get profile fields
		$input = array();
		$accesslevel = get_input('accesslevel');
		$actionurl = get_input('actionurl');		
		
		if (!is_array($accesslevel)) {
			$accesslevel = array();
		}
		
		function profile_array_decoder(&$v) {
			$v = html_entity_decode($v, ENT_COMPAT, 'UTF-8');
		}


		foreach($CONFIG->profile as $shortname => $valuetype) {
			if($shortname == "locationinfo"){
				$street1 = html_entity_decode(get_input("street1"), ENT_COMPAT, 'UTF-8');				
				$street2 = html_entity_decode(get_input("street2"), ENT_COMPAT, 'UTF-8');								
				$city = html_entity_decode(get_input("city"), ENT_COMPAT, 'UTF-8');								
				$state = html_entity_decode(get_input("state"), ENT_COMPAT, 'UTF-8');								
				$otherstate = html_entity_decode(get_input("otherstate"), ENT_COMPAT, 'UTF-8');												
				$zip = html_entity_decode(get_input("zip"), ENT_COMPAT, 'UTF-8');												
				$country = html_entity_decode(get_input("country"), ENT_COMPAT, 'UTF-8');								
				
				$arr = array ("street1" => $street1,"street2" => $street2,"city" => $city,"state" => $state,"otherstate" => $otherstate,"country" => $country,"zip" => $zip);
			
				$value = json_encode($arr);	
			}else if($shortname == "hometown"){
				$homecity = html_entity_decode(get_input("homecity"), ENT_COMPAT, 'UTF-8');								
				$homestate = html_entity_decode(get_input("homestate"), ENT_COMPAT, 'UTF-8');								
				$otherhomestate = html_entity_decode(get_input("otherhomestate"), ENT_COMPAT, 'UTF-8');												
				$homecountry = html_entity_decode(get_input("homecountry"), ENT_COMPAT, 'UTF-8');								
				
				$arr = array ("homecity" => $homecity,"homestate" => $homestate,"otherhomestate" => $otherhomestate,"homecountry" => $homecountry);
			
				$value = json_encode($arr);	
			}else{
			
			$value = get_input($shortname);
			if (is_array($value)) {
				array_walk_recursive($value, 'profile_array_decoder');
			} else {
				$value = html_entity_decode($value, ENT_COMPAT, 'UTF-8');
			}

			// limit to reasonable sizes.
			if (!is_array($value) && $valuetype != 'longtext' && elgg_strlen($value) > 250) {
				$error = sprintf(elgg_echo('profile:field_too_long'), elgg_echo("profile:{$shortname}"));
				register_error($error);
				forward($_SERVER['HTTP_REFERER']);
			}

			if ($valuetype == 'tags') {
				$value = string_to_tag_array($value);
			}
			}

			$input[$shortname] = $value;
		}

		$user = $_SESSION['user'];

		if ($user->canEdit()) {

			// Save stuff
			if (sizeof($input) > 0)
				foreach($input as $shortname => $value) {
					//$user->$shortname = $value;
					remove_metadata($user->guid, $shortname);
					if (isset($accesslevel[$shortname])) {
						$access_id = $accesslevel[$shortname];
					} else {
						// this should never be executed since the access level should always be set
						$access_id = ACCESS_PRIVATE;
					}
					if (is_array($value)) {
						$i = 0;
						foreach($value as $interval) {
							$i++;
							if ($i == 1) { $multiple = false; } else { $multiple = true; }
							create_metadata($user->guid, $shortname, $interval, 'text', $user->guid, $access_id, $multiple);
						}
					} else {
						create_metadata($user->guid, $shortname, $value, 'text', $user->guid, $access_id);
					}
				}
			$user->save();

			// Notify of profile update
			trigger_elgg_event('profileupdate',$user->type,$user);

			//add to river
			add_to_river('river/user/default/profileupdate','update',$_SESSION['user']->guid,$_SESSION['user']->guid,get_default_access($_SESSION['user']));

			system_message(elgg_echo("profile:save"));

			// Forward to the user's profile
			if($actionurl == "signupwizard")
				forward_home();
			else
				forward("pg/profile/".$_SESSION['user']->username."/edit/");							
//				forward($user->getUrl());				
				

		} else {
	// If we can't, display an error

			system_message(elgg_echo("profile:noaccess"));
		}

?>
