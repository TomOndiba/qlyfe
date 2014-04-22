<?php


/**
 * This is so our connect dialog shouldu be loaded through jquery.load()
 * @see views/default/connect/friends.php
 * @see views/default/js/connect.php for the javascript that controls the dialog
 * @see mods/profile/views/default/profile/menu/actions.php for html for the connect dialog
 */
// Get the Elgg engine
require_once(dirname(dirname(__FILE__)) . "/engine/start.php");

// Ensure that only logged-in users can see this page
gatekeeper();

$user = $_SESSION['user'];
$entity = get_entity(get_input('entity'));

echo elgg_view("connect/dialog", array('user'=>$user, 'entity'=>$entity));

?>
