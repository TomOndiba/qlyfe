<?php

	/**
	 * Elgg header contents 
	 * This file holds the header output that a user will see
	 * 
	 * @package Elgg
	 * @subpackage Core
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Curverider Ltd
	 * @copyright Curverider Ltd 2009
	 * @link http://elgg.org/
	 **/
	 
?>

<?php echo elgg_view("js/connect");?>

<div id="page_container">
<div id="page_topbar_bg"></div>
<div id="page_topbar2_bg"></div>
<!-- <div style='position:absolute;width:100%;'><center><div id="page_topbar3_bg"></div></center></div> -->
<div id="page_wrapper">

<div id="layout_header">
<div id="wrapper_header">
<table id="header_table">
<tr>
<td id="header_left"><div id="sitename"><a href="<?php echo $vars['url']; ?>"><?php echo $vars['config']->sitename; ?></a></div></td>
<td id="header_middle">
<div id="tabs">
<?php if (isloggedin()) { ?>
  <ul>
	<?php 
	
	$current_context = get_context();
	$url = $vars['url'];
	foreach (qlyfe_get_context_array() as $context) {
		$class = ($current_context == $context) ? "class='current_tab'" : "";
		echo "<li >";
		echo "<a $class href='{$url}pg/{$context}'><span><strong style='position:relative;top:5px;'>" . elgg_echo("context:$context") . "</strong></span></a>";
		echo "</li>";
	}
	?>
  </ul>
</div>
<?php } ?>
</td>
<td id="header_right">
<?php if (isloggedin()) { ?>
<div id="account_links">
	<?php echo elgg_view("account/links")?>	
</div>
<?php } ?>
</td>
</tr>
</table>
<table id="header_bottom_table">
<tr>
<td>
<div id="header_bottom_left">
<?php /**if (isloggedin() && (qlyfe_on_tabbed_page() || get_context() == "profile")) { ?>
<div id="identity_tab" style='border-bottom: 1px solid #ffffff;'>
    <?php echo elgg_echo("qlyfe:identity");?>
</div>
<?php } **/?>
</div>
</td>
<td>
<?php if (qlyfe_get_submenu()) { ?>
	<div id="header_bottom_middle">
		<div id="small_tabs">
		   	<ul>
			<?php echo elgg_view("submenu/" . qlyfe_get_submenu()); ?>
			</ul>
		</div>
	</div>
<?php } ?>
</td>
</tr>
</table>

</div><!-- /#wrapper_header -->
</div><!-- /#layout_header -->

