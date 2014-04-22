<?php
/**
 * Elgg registration action
 *
 * @package Elgg
 * @subpackage Core
 * @author Curverider Ltd
 * @link http://elgg.org/
 */

global $CONFIG;

// Get variables
$mode = get_input('mode');
$username = get_input('username');
$password = get_input('password');
$password2 = get_input('password2');
$email = get_input('email');
$firstname = get_input('firstname');
$lastname = get_input('lastname');
$gender = get_input('gender');
$birthdate = get_input('birthdate');
$friend_guid = (int) get_input('friend_guid',0);
$invitecode = get_input('invitecode');

$admin = get_input('admin');
if (is_array($admin)) {
	$admin = $admin[0];
}

if (!$CONFIG->disable_registration) {
// For now, just try and register the user
	try {
	if($mode != "captcha"){
		$istrue = register_user_check($username, $password,$password2, $firstname, $lastname, $email, false, $friend_guid, $invitecode);
		if($istrue){
			$arr = array("username" => $username , "password" => $password , "firstname" => $firstname , "lastname" => $lastname, "email" => $email , 
					"gender" => $gender , "birthdate" => $birthdate , "friend_guid" => $friend_guid, "invitecode" => $invitecode );
			$_SESSION['user_reg_arr'] = $arr;		

			$qs = explode('?',$_SERVER['HTTP_REFERER']);
			$qs = $qs[0];
			$qs .= "?mode=register";
			forward($qs);
			exit;

		} else {
			unset($_SESSION['user_reg_arr']);		
			register_error(elgg_echo("registerbad"));
		}
	}else{
		if(count($_SESSION['user_reg_arr']) <= 0)
			register_error(elgg_echo("registerbad"));
			
		$arr = $_SESSION['user_reg_arr'];
		$username = $arr['username'];
		$password = $arr['password'];
		$email = $arr['email'];
		$firstname = $arr['firstname'];
		$lastname = $arr['lastname'];
		$gender = $arr['gender'];
		$birthdate = $arr['birthdate'];
		$friend_guid = $arr['friend_guid'];
		$invitecode = $arr['invitecode'];
		$name = "Remove: $firstname $lastname";
		
		$guid = register_user($username, $password,$password, $firstname,$lastname, $email, false, $friend_guid, $invitecode);
		if ( trim($password) != "" && ($guid) ) {
			$new_user = get_entity($guid);
			if (($guid) && ($admin)) {
				// Only admins can make someone an admin
				admin_gatekeeper();
				$new_user->makeAdmin();
			}
			create_metadata($new_user->guid, 'firstname', $firstname, 'text', $new_user->guid, 0);
			create_metadata($new_user->guid, 'lastname', $lastname, 'text', $new_user->guid, 0);
			create_metadata($new_user->guid, 'gender', $gender, 'text', $new_user->guid, 0);
			create_metadata($new_user->guid, 'birthdate', $birthdate, 'text', $new_user->guid, 0);
			
			if (is_plugin_enabled("invitefriends") && $invitecode != "" && $friend_guid != ""){
				if($metadata = get_metadata_byname($friend_guid, "invitecodes")){
					$jvalue = $metadata->value;
					$invArr = json_decode($jvalue,true);
					unset($invArr[$invitecode]);
					$jvalue = json_encode($invArr);
					$access_id9 = ACCESS_PUBLIC;
					create_metadata($friend_guid, 'invitecodes', $jvalue, 'text', $friend_guid, $access_id9);
				}		
			}
			
			unset($_SESSION['user_reg_arr']);
			
			// Send user validation request on register only
			global $registering_admin;
			if (!$registering_admin) {
				request_user_validation($guid);
			}

			if (!$new_user->isAdmin()) {
				// Now disable if not an admin
				// Don't do a recursive disable.  Any entities owned by the user at this point
				// are products of plugins that hook into create user and might need
				// access to the entities.
				$new_user->disable('new_user', false);
			}

			system_message(sprintf(elgg_echo("registerok"),$CONFIG->sitename));
			// Forward on success, assume everything else is an error...
//			forward();

			// forward to invite page
			$result = login($new_user, false);
			trigger_elgg_event("login", "user", $new_user);
			$forward_url = "pg/signupwizard";
			forward($forward_url);
			
			
		} else {
			register_error(elgg_echo("registerbad"));
		}
	  }
	} catch (RegistrationException $r) {
		register_error($r->getMessage());
	}
} else {
	register_error(elgg_echo('registerdisabled'));
}

$qs = explode('?',$_SERVER['HTTP_REFERER']);
$qs = $qs[0];
$qs .= "?u=" . urlencode($username) . "&e=" . urlencode($email) . "&fn=" . urlencode($firstname) ."&ln=" . urlencode($lastname) ."&gender=" . urlencode($gender) ."&bd=" . urlencode($birthdate) . "&friend_guid=" . $friend_guid;

forward($qs);
