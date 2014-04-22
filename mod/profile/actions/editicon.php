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
		
		$networklist = get_input('networklist');
		$firstlogin = get_input('firstlogin');
		$actionurl = get_input('actionurl');		
				
		$lists = split(",",$networklist);	
		foreach($lists as $shortname) {
			$value = get_input($shortname);
			$value = html_entity_decode($value, ENT_COMPAT, 'UTF-8');

			// limit to reasonable sizes.
			if (!is_array($value) && $valuetype != 'longtext' && elgg_strlen($value) > 250) {
				$error = sprintf(elgg_echo('profile:field_too_long'), elgg_echo("profile:{$shortname}"));
				register_error($error);
				forward($_SERVER['HTTP_REFERER']);
			}
			
			$arr = split("_",$shortname);

			if(count($arr) == 3)
				$str = $arr[1]."/".$arr[2];
			else if(count($arr) == 2)
				$str = $arr[1];

			$input[] = array("name"=>$arr[0],"value"=>$value ,"network"=>$str);
		}

		$user = $_SESSION['user'];

		if ($user->canEdit()) {
			// Save stuff
			if (sizeof($input) > 0)
				foreach($input as $kk => $arr) {
					$shortname = $arr['name'];
					$value = $arr['value'];
					if(!$delarr[$shortname]){
						remove_metadata($user->guid, $shortname);
						$delarr[$shortname] = 1;
					}	
					if (isset($arr['network'])) {
						$str = $arr['network'];
						$c1 = new Qlyfe_Classifier($str);
						$access_id = new Qlyfe_CList($c1);
					} else {
						// this should never be executed since the access level should always be set
						$access_id = ACCESS_PRIVATE;
					}
					create_metadata($user->guid, $shortname, $value, 'text', $user->guid, $access_id,true);
				}
			$user->save();

			// Forward to the user's profile
			if($firstlogin != "yes"){
				system_message(elgg_echo("profile:identitysaved"));			
				if($actionurl == "signupwizard")
					forward("/pg/signupwizard/edit/");
				else
					forward("pg/profile/".$_SESSION['user']->username."/editicon/");											
//				forward($user->getUrl());				
			}	
			
			
		} else {
	// If we can't, display an error

			system_message(elgg_echo("profile:noaccess"));
		}
?>
