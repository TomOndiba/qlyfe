<?php
	$current_context = get_context();
	$url = $vars['url'];
	$page = get_input('page');
	$arr = split('/',$page);
	$currentclass = "current_small_tab";
	/*
	if($current_context == "profile" && isset($arr[1]) ){
		$class = ($arr[1] == "editicon") ? "class='$currentclass'" : "";
		echo "<li ><a $class href='{$url}pg/{$current_context}/{$arr[0]}/editicon/'><span>Identity</span></a></li>";
		$class = ($arr[1] == "edit") ? "class='$currentclass'" : "";
		echo "<li ><a $class href='{$url}pg/{$current_context}/{$arr[0]}/edit/'><span>Edit Profile</span></a></li>";
		$class = ($arr[1] == "editcontact") ? "class='$currentclass'" : "";
		echo "<li ><a $class href='{$url}pg/{$current_context}/{$arr[0]}/editcontact/'><span>Edit Contact</span></a></li>";
	}else{ */
		$class = ($arr[0] != "photos") ? "class='current_small_tab'" : "";
	  echo "  <li><a href='#' $class><span>Board</span></a></li>";
		$class = ($arr[0] == "photos") ? "class='current_small_tab'" : "";
	  echo "  <li><a href='#' $class><span>Photos</span></a></li>";
	  echo "  <li><a href='#'><span>Videos</span></a></li>
	    <li><a href='#'><span>Events</span></a></li>";
	//}