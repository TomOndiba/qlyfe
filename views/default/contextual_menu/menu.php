<?php 
	$id = $vars['id'];
	$activator = $vars['activator'];
	$items = $vars['items'];

	echo $activator;
	echo "<div onmouseout='hideContextualMenu()' id='$id' class='contextual_menu'>";
	foreach ($items as $item) {
		echo $item;
	}
	echo "</div>";