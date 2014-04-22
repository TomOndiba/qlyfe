<?php
/**
 * @uses $vars['value'] The text to display
 */

if ($vars['value'] == 'm')
	echo elgg_echo("profile:male");
else if ($vars['value'] == 'f')
	echo elgg_echo("profile:female");
else 
	echo elgg_echo("profile:unknown_gender");
