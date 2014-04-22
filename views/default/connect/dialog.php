<?php 
	// extend this view with your networks connect dialog options
	// @see connect/dialog.php for the ajax page that loads this view
	// @see mod/friends/views/default/connect/friends.php
	// @see mod/family/views/default/connect/family.php
	$entity = $vars['entity'];
	echo sprintf(elgg_echo("connect:dialog:text"), $entity->name);
?>


