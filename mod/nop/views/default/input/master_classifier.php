<?php 
	$name = $vars['internalname']; 
	$network = $vars['network']; 
	$checkbox_name = elgg_echo("context:". $network);
	$selection_name = elgg_echo("classifier:". $network);

	echo "<label><input guiname='$selection_name' network='$network' class='nop_classifier_input_master' onclick=\"build_clist_master('$name', '$network')\" id='{$name}_{$network}' type='checkbox' name='{$name}_clist_chooser_{$network}' value='{$network}'/>";
	echo $checkbox_name; 
	echo "</label><br/>";
?>
