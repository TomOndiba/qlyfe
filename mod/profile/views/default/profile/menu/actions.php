<?php

	/**
	 * @qlyfe addition... make this go to our connection dialog
	 * Elgg profile icon hover over: actions
	 * 
	 * @uses $vars['entity'] The user entity. If none specified, the current user is assumed. 
	 * @see views/default/js/connect.php for javascript functions
	 * @see connect/dialog.php for what gets loaded with the ajax call
	 */

	if (isloggedin() && $_SESSION['user']->getGUID() != $vars['entity']->getGUID()) {
		
		$user = $_SESSION['user'];
		$entity = $vars['entity'];
		$friend = $entity->getGUID();
		
		if ($entity->isConnected()) {
			echo "<p class=\"user_menu_removefriend\"><a href='javascript:connectDialog.disconnect({$friend})'>" . elgg_echo("connect:break") . "</a></p>";
		} else {
			echo "<p class=\"user_menu_addfriend\"><a href='javascript:connectDialog.open({$friend})'>" . elgg_echo("connect:create") . "</a></p>";
		}
?> 
		<div id="connect-dialog<?php echo $friend?>" title="<?php echo elgg_echo("connect:dialog:title")?>" style='display:none;'>
			<div id="connect-dialog<?php echo $friend?>-contents">
			<center><img style='margin:10px;' src="<?php echo $vars['url']?>_graphics/ajax_loader.gif" /></center>
			</div>
			<center>
				<input id="connection_submit_button" onclick='connectDialog.connect()' type='button' class='submit_button' value="<?php echo elgg_echo("connect")?>">
				<input id="connection_cancel_button" onclick='connectDialog.cancel()' type='button' class='cancel_button' value="<?php echo elgg_echo("cancel")?>">
			</center>
		</div><!--  end of the dialog -->
<?php 
	} // end isLoggedIn

?>