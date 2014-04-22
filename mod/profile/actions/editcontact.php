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
		global $_SESSION;

		gatekeeper();

	// Get profile fields
		$input = array();
		$accesslevel = get_input('accesslevel');
		$websites = get_input('websites');
				
		if (!is_array($accesslevel)) {
			$accesslevel = array();
		}
		
		function profile_array_decoder(&$v) {
			$v = html_entity_decode($v, ENT_COMPAT, 'UTF-8');
		}


		foreach($CONFIG->profilecontact as $shortname => $valuetype) {
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
			$input[$shortname] = $value;
		}

		$user = page_owner_entity();
		if (!$user) {
			$user = $_SESSION['user'];

			// @todo this doesn't make sense...???
			set_page_owner($user->getGUID());
		}

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

			system_message(elgg_echo("profile:contactsaved"));

			// Forward to the user's profile
				forward("pg/profile/".$_SESSION['user']->username."/editcontact/");														
//				forward($user->getUrl());				


		} else {
	// If we can't, display an error

			system_message(elgg_echo("profile:noaccess"));
		}

?>
