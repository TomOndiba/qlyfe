<?php 
	global $vars;
	$username = $vars['user']->username;
	$class = (get_context() == "connections") ? "vertical_tab_current" : "vertical_tab"; 
?>
<div id='vertical_tabs_topline'></div>
<div class="<?php echo $class?>">
<a href='/pg/connections/<?php echo $username?>'><span>All Connections</span></a>
</div>

