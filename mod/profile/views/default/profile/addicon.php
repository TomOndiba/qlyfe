<?php

	/**
	 * Elgg Add Icon
	 *
	 * @package ElggProfile
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Curverider Ltd <info@elgg.com>
	 * @copyright Curverider Ltd 2008-2010
	 * @link http://elgg.com/
	 *
	 * @uses $vars['entity'] The user entity
	 */

	// wrap all profile info
	
	$user = $vars['entity'];

	$actionurl = $vars['actionurl'];
		
	$user_avatar = $user->getIcon('medium',"public");	
		
	echo "<div id=\"register-box\">";

?>

<table cellspacing="0">
<tr>
<td width='5%'>&nbsp;</td>
<td>
<table cellspacing="0">
<tr>
<td>



	<h3><?php echo elgg_echo("profile:addicontitle")?></h3>
	<br />

	<br>
	
	<br />

	<table>
	<tr>
	<td valign="bottom">
	
	<img src='<?php echo $user_avatar; ?>' border=1 id='icon_public'/>

	</td>
	<td width='50'>&nbsp;</td>
	<td valign="middle" style="padding-top:30px;">

	<input type="button" class="submit_button" value="<?php echo elgg_echo("Upload Photo"); ?>" onclick="signupDialog.open('<?php echo $_SESSION['user']->guid ?>','public');" />
	
	</td>
	</tr>
	
	<tr>
	<td colspan=2>&nbsp; </td>
	</tr>
	</table>
	
	<br />
	<p>

<?php if($vars['actionurl'] == "signupwizard"){ ?>		
		<input type="button" class="submit_button" value="<?php echo elgg_echo("continue"); ?>" onclick="location.href='<?php echo $vars['url']; ?>pg/signupwizard/editicon/'" />
		&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="button" class="cancel_button" value="<?php echo elgg_echo("Skip this Step"); ?>" onclick="location.href='<?php echo $vars['url']; ?>pg/signupwizard/editicon/'" />
<? }else{ ?>
		<input type="button" class="submit_button" value="<?php echo elgg_echo("update"); ?>" onclick="location.href='<?php echo $vars['url']; ?>pg/profile/<?php echo $_SESSION['user']->username?>/editicon/'"/>
		&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="button" class="cancel_button" value="<?php echo elgg_echo("cancel"); ?>" onclick="location.href='<?php echo $user->getUrl()?>'" />  

<? } ?>		
	
	</p>
<br />
	


</td>
</tr>
</table>

</td></tr></table>

</div><!-- /#profile_info -->

		<div id="signup-dialog<?php echo $user->guid?>" title="<?php echo elgg_echo("profile:dialog:title")?>" style='display:none;'>
			<div id="signup-dialog<?php echo $user->guid?>-contents">
			<center><img style='margin:10px;' src="<?php echo $vars['url']?>_graphics/ajax_loader.gif" /></center>
			</div>
			<center>
			</center>
		</div><!--  end of the dialog -->

<script language="javascript1.2">
		function SignupDialog() {
			this.user_id = null;
			this.network = null;			
			// our open function for opening the dialog
			this.open = function(user_id,network) {
				 	this.user_id = user_id;
					this.network = network;
						$("#signup-dialog" + user_id ).dialog({
							modal: true,
							width: 700,
							position: ["center",50],
							beforeclose: function(event, ui) {
				             $('#user_avatar').imgAreaSelect({ hide:true });
							 }
							
						});
					$("#signup-dialog" + user_id + "-contents").load("<?php echo $vars['url']?>connect/icondialog.php?isall=yes&network=" + network);			 }

			 this.connect = function() {
			 }

			 this.cancel = function() {
			    $("#signup-dialog" + this.user_id ).dialog("close");
			 }
		}
		var signupDialog = new SignupDialog();
</script>
