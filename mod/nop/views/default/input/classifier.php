<?php 
	$name = $vars['internalname']; 
	$network = $vars['network']; 
	$classifier = $vars['classifier']; 
	$guiname = $vars['guiname'] ? $vars['guiname'] : elgg_echo("classifier:" . $network . "/" . $classifier);
	// the problem comes in with friend lists... where classifiers can be anything
	$id = $name."_".$network."_". js_friendly_classifier($classifier);
	
	echo "&nbsp;&nbsp;<label><input guiname='$guiname' network='$network' class='nop_classifier_input'" .
	 	"onclick=\"build_clist('$name')\" id='$id' type='checkbox' " . 
		"name='{$name}_clist_chooser_{$network}' value='{$network}/{$classifier}'/>";
	echo $guiname; 
	echo "</label><br/>";
?>
