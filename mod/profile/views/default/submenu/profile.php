<?php 
	$current_context = get_context();
	$url = $vars['url'];
	$page = get_input('page');
	$arr = split('/',$page);
	$currentclass = "current_small_tab";

	$class = ($arr[1] == "editicon" || $arr[1] == "addicon" ) ? "class='$currentclass'" : "";
	echo "<li ><a $class href='{$url}pg/{$current_context}/{$arr[0]}/editicon/'><span>Identity</span></a></li>";
	$class = ($arr[1] == "edit") ? "class='$currentclass'" : "";
	echo "<li ><a $class href='{$url}pg/{$current_context}/{$arr[0]}/edit/'><span>Edit Profile</span></a></li>";
	$class = ($arr[1] == "editcontact") ? "class='$currentclass'" : "";
	echo "<li ><a $class href='{$url}pg/{$current_context}/{$arr[0]}/editcontact/'><span>Edit Contact</span></a></li>";
?>