<?php 
	$id = $vars['id'];
	$href = $vars['href'];
	$text = $vars['text'];
	echo "<a onmouseover='showContextualMenu(\"$id\")' href='$href'><div class='contextual_menu_item'>$text</div></a>";
