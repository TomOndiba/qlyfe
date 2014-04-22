<?php
	 $user = $_SESSION['user'];
     if (isloggedin() && $user->isAdmin()) {
?>
	<div class="right_bar_box">
	<a href='#' onclick="invitefriendsbox();">+&nbsp;&nbsp;<?php echo elgg_echo("invitefriends:invite_by_code");?></a>
	</div>
	<div class="right_bar_box_connector"></div>

	<div id="invitefriends-dialog<?php echo $user->guid?>" title="<?php echo elgg_echo("invitefriends:invite")?>" style='display:none;'>
		<div id="invitefriends-dialog<?php echo $user->guid?>-contents">
		<?php echo elgg_view("invitefriends/invitecontacts", array('entity' => $user));?>
		</div>
	</div><!--  end of the dialog -->
<script language='javascript'>
	function invitefriendsbox() {
		$("#invitefriends-dialog" + '<?php echo $user->guid?>' ).dialog({modal: true,width: 600,autoOpen:false});		
		$("#invitefriends-dialog" + '<?php echo $user->guid?>' ).dialog('open');
	}
</script>	
	
<?php 
    }
?>	
