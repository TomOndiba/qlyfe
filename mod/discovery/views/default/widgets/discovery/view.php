<!-- 
<form id="search_box" action="<?php echo $vars['url']; ?>search/" method="get">
	<input type="text" name="tag" value="Search" onclick="if (this.value=='Search') { this.value='' }" class="qlyfe_search_input" />
	<input type="submit" value="Go" class="qlyfe_search_submit_button" />
</form>
 -->
<?php
     if (isloggedin()) {
?>
	<div class="right_bar_box">
	+&nbsp;&nbsp;&nbsp;<?php echo elgg_echo("discovery:invite_contacts");?>
	</div>
	<div class="right_bar_box_connector"></div>
<?php 
    }
?>	
