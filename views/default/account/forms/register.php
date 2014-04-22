<?php
/**
 * Elgg register form
 *
 * @package Elgg
 * @subpackage Core
 * @author Curverider Ltd
 * @link http://elgg.org/
 */

$username = get_input('u');
$email = get_input('e');
$firstname = get_input('fn');
$lastname = get_input('ln');
$birthdate = get_input('bd');
$gender = get_input('gender');

$admin_option = false;
$loggedin_user = get_loggedin_user();

if ($loggedin_user && $loggedin_user->isAdmin() && isset($vars['show_admin'])) {
	$admin_option = true;
}
$mode = get_input('mode');

if($mode == "" && get_input("username") == "" ){

$form_body = "";
$form_body .= "<label>" . elgg_echo('email') . "<br />" . elgg_view('input/text' , array('internalname' => 'email', 'class' => "general-textarea", 'value' => $email)) . "</label><br />";
$form_body .= "<label>" . elgg_echo('username') . "<br />" . elgg_view('input/text' , array('internalname' => 'username', 'class' => "general-textarea", 'value' => $username)) . "</label><br />";
$form_body .= "<label>" . elgg_echo('password') . "<br />" . elgg_view('input/password' , array('internalname' => 'password', 'class' => "general-textarea")) . "</label><br />";
$form_body .= "<label>" . elgg_echo('passwordagain') . "<br />" . elgg_view('input/password' , array('internalname' => 'password2', 'class' => "general-textarea")) . "</label><br />";

$form_body .= "<br><h3>".elgg_echo('personal_info')."</h3>";

$form_body .= "<label>" . elgg_echo('firstname') . "<br />" . elgg_view('input/text' , array('internalname' => 'firstname', 'class' => "general-textarea", 'value' => $firstname)) . "</label><br />";
$form_body .= "<label>" . elgg_echo('lastname') . "<br />" . elgg_view('input/text' , array('internalname' => 'lastname', 'class' => "general-textarea", 'value' => $lastname)) . "</label><br />";
$form_body .= "<label>" . elgg_echo('gender') . ": " .elgg_view('input/gender' , array('internalname' => "gender",'class' => "general-textarea", 'value' => $gender)). "</label><br /><br/>";
$form_body .= "<label>" . elgg_echo('birthdate') . ": " . elgg_view('input/autodate' , array('internalname' => 'birthdate', 'class' => "general-textarea", 'value' => $birthdate)) . "</label><br />";

if (is_plugin_enabled("invitefriends")){
	$form_body .= "<br><label>" . elgg_echo('invitecode') . "<br />" . elgg_view('input/text' , array('internalname' => 'invitecode', 'class' => "general-textarea", 'value' => $invitecode)) . "</label><br />";
}	

//$form_body .= elgg_view('input/hidden', array('internalname' => 'invitecode', 'value' => $vars['invitecode']));

// view to extend to add more fields to the registration form
$form_body .= elgg_view('register/extend');

// Add captcha hook
//$form_body .= elgg_view('input/captcha');

if ($admin_option) {
	$form_body .= elgg_view('input/checkboxes', array('internalname' => "admin", 'options' => array(elgg_echo('admin_option'))));
}

$form_body .= elgg_view('input/hidden', array('internalname' => 'mode', 'value' => "register"));
$form_body .= elgg_view('input/hidden', array('internalname' => 'friend_guid', 'value' => $vars['friend_guid']));
$form_body .= elgg_view('input/hidden', array('internalname' => 'action', 'value' => 'register'));
$form_body .= elgg_view('input/submit', array('internalname' => 'submit', 'value' => elgg_echo('create_qlyfe'))) . "</p>";
?>
<div id="register-box">
<h3><?php echo elgg_echo('create_account'); ?></h3>
<?php echo elgg_view('input/form', array('action' => "{$vars['url']}action/register", 'body' => $form_body)) ?>
</div>
<?
}else{

$form_body = "";

// Add captcha hook
$form_body .= elgg_view('input/captcha');

$form_body .= elgg_view('input/hidden', array('internalname' => 'mode', 'value' => "captcha"));
$form_body .= elgg_view('input/hidden', array('internalname' => 'invitecode', 'value' => $vars['invitecode']));
$form_body .= elgg_view('input/hidden', array('internalname' => 'friend_guid', 'value' => $vars['friend_guid']));
$form_body .= elgg_view('input/hidden', array('internalname' => 'action', 'value' => 'register'));
$form_body .= elgg_view('input/submit', array('internalname' => 'submit', 'value' => elgg_echo('continue'))) . "</p>";
?>

<div id="register-box">
<h3><?php echo elgg_echo('verification'); ?></h3>
<?php echo elgg_view('input/form', array('action' => "{$vars['url']}action/register", 'body' => $form_body)) ?>
</div>
<?php
}
?>