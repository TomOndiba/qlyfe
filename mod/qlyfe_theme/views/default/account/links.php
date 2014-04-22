<a href="<?php echo $vars['url']; ?>pg/settings/" class="usersettings"><?php echo elgg_echo("qlyfe:settings");?></a> | 
<?php
	// The administration link is for admin or site admin users only
	if ($vars['user']->admin || $vars['user']->siteadmin) { 
?>
	<a href="<?php echo $vars['url']; ?>pg/admin/" id="administration">Admin<?php //echo elgg_echo("admin"); ?></a> |
<?php
		}
?>
<a href="<?php echo $vars['url']; ?>action/logout"><?php echo elgg_echo("qlyfe:logout");?></a>

