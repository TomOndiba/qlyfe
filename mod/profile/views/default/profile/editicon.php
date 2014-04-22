<?php

	/**
	 * Elgg profile edit form
	 * 
	 * @package Elggprofile
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Curverider Ltd <info@elgg.com>
	 * @copyright Curverider Ltd 2008-2010
	 * @link http://elgg.com/
	 * 
	 * @uses $vars['entity'] The user entity
	 * @uses $vars['profile'] profile items from $CONFIG->profile, defined in profile/start.php for now 
	 */

		$firstlogin = $vars['firstlogin'];
		
		$fullname = $vars['entity']->getDefaultName();
		$narr['family']  = array("classifier" => array());						
		$narr['friends'] = array("classifier" => array());			
		$narr['public']  = array("classifier" => array());									
		foreach($narr as $network => $nn){
			$narr[$network]['value'] = $vars['entity']->getName($network);
		}

		$user = $_SESSION['user'];
?>
<div class="contentWrapper">
<form action="<?php echo $vars['url']; ?>action/profile/editicon" method="post" id='identity_form' name='identity_form'>
<?php echo elgg_view('input/securitytoken') ?>
<?php if($firstlogin == "yes"){ ?>	
<h2><?php print sprintf(elgg_echo("firsttime:title"),$user->name); ?></h2>
<h3><?php print elgg_echo("firsttime:identity"); ?></h3>
<? } ?>
<table border="0" cellpadding="1" cellspacing="1">
<tr>
<td width='20%'>&nbsp;</td>
<td width='20%'>&nbsp;</td>
<td width='2%'>&nbsp;</td>
<td width='20%'>&nbsp;</td>
<td width='40%'>&nbsp;</td>
</tr>
<?php
$ilist = "";
foreach($narr as $network => $nn){
	$networkvalue = $nn['value'];
	if($networkvalue == "")
		$networkvalue = $fullname;
		
	$internalname = "nickname_".$network;	
	$ilist .= ",$internalname";
	
	$user_avatar = $user->getIcon('small',$network);	
?>
<tr>
<td colspan=4>
		<label>
			<?php echo elgg_echo("profile:".$network."knows") ?><br /></label>
</td></tr>			

<tr>
<td>&nbsp;</td>
<td>
			<?php echo elgg_view("input/text",array('internalname' => "$internalname",'value' => $networkvalue,"class"=>"text" )); ?>
</td>
<td>&nbsp;</td>
<td valign="top" align=center>
<a href="javascript:signupDialog.open(<?php echo $_SESSION['user']->guid ?>,'<?php echo $network?>')"><img src='<?php echo $user_avatar; ?>' border=1 id='icon_<?php echo $network?>'/></a>
<br />
<a href="javascript:signupDialog.open(<?php echo $_SESSION['user']->guid ?>,'<?php echo $network?>')">
<?php 
if(strstr($user_avatar,"icondirect")) 
	echo elgg_echo("replace_photo"); 		
else
	echo elgg_echo("upload_photo"); 
?>
</a>
</td>
<td>
<?php if($network == "public"){ ?>
shown when not connected, use picture that can be easily recogozied by people who want to connect with you. 
<? } ?>
</td>
</tr>
<tr>
<td colspan=5>&nbsp;</td>
</tr>

<?php
	$c1 = $nn['classifier'];
	if(count(c1) > 0){
?>
<tr>
<td colspan=3>
<table width='100%'>
<?php
	foreach($c1 as $classi => $pp){
		$value = $pp['value'];		
		if($value == "")
			$value = $networkvalue;

		$internalname = "nickname_".$network."_".$classi;	
		$ilist .= ",$internalname";
			
?>
<tr>
<td width='75%'><?php echo elgg_echo("profile:".$network."knows") ?></td>
<td width='5'>&nbsp;</td>
<td width='25%'>
			<?php echo elgg_view("input/text",array('internalname' => "$internalname",'value' => $value,"class"=>"text")); ?>
</td>
</tr>
<? 		} ?>
</table>
</td>
<td colspan=2>&nbsp;</td>
</tr>
<? 
	}
 } 
 
?>
			<?php echo elgg_view("input/hidden",array('internalname' => "networklist",'value' => substr($ilist,1),)); ?>
</table>
<?php if($firstlogin == "yes"){ ?>	
<script language="javascript">
	var options4 = { 
        beforeSubmit:  identityRequest,  // pre-submit callback 
        success:       identityResponse  // post-submit callback 
    }; 
	function identityRequest(formData, jqForm, options2) { 
		$("#identitysubmitbutton").hide();
		$("#identitysubmitting").show();
    	return true; 
	} 
	function identityResponse(responseText, statusText, xhr, $form)  { 
		if(statusText == "success"){
			 $("#firsttime-dialog" + '<?php echo $user->guid?>' ).dialog("close");
		}	
	} 
	function identityFormSubmit(){
		$('#identity_form').ajaxForm(options4); 
	}
</script>	
	<p align=center>
		<input type='hidden' name='firstlogin' value='yes' id='firstlogin' />
		<div id="identitysubmitting" style="display:none" align=center>
			Please wait..<img style='margin:10px;' src="<?php echo $vars['url']?>_graphics/ajax_loader.gif" />
		</div>
		<div id='identitysubmitbutton' align=center>
		<input type="submit" class="submit_button" value="<?php echo elgg_echo("update"); ?>" onclick="identityFormSubmit();" />
		&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="button" class="submit_button" value="<?php echo elgg_echo("close"); ?>"  onclick="firsttimedialogclose();" />
		</div>
	</p>		
<?php }else if($vars['actionurl'] == "signupwizard"){ ?>		
	<p>
		<input type='hidden' name='actionurl' value='<?php echo $vars['actionurl']?>' id='actionurl' />	
		<input type="submit" class="submit_button" value="<?php echo elgg_echo("Save and Continue"); ?>" />
		&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="button" class="submit_button" value="<?php echo elgg_echo("Skip this Step"); ?>" onclick="location.href='<?php echo $vars['url']; ?>pg/signupwizard/edit/'" />
	</p>
<? }else{ ?>
	<p>
		<input type="submit" class="submit_button" value="<?php echo elgg_echo("update"); ?>" />
		&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="button" class="submit_button" value="<?php echo elgg_echo("cancel"); ?>" onclick="location.href='<?php echo page_owner_entity()->getUrl()?>'" />  
	</p>
<? } ?>		


</form>
</div>

		<div id="signup-dialog<?php echo $user->guid?>" title="<?php echo elgg_echo("profile:dialog:title")?>" style='display:none;'>
			<div id="signup-dialog<?php echo $user->guid?>-contents">
			<center><img style='margin:10px;' src="<?php echo $vars['url']?>_graphics/ajax_loader.gif" /></center>
			</div>
			<center>
<!--				<input id="signup_submit_button" onclick='signupDialog.connect()' type='button' class='submit_button' value="<?php echo elgg_echo("upload")?>">
				<input id="signup_cancel_button" onclick='signupDialog.cancel()' type='button' class='cancel_button' value="<?php echo elgg_echo("cancel")?>">-->
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
					$("#signup-dialog" + user_id + "-contents").load("<?php echo $vars['url']?>connect/icondialog.php?network=" + network);			 }

			 this.connect = function() {
			 }

			 this.cancel = function() {
			    $("#signup-dialog" + this.user_id ).dialog("close");
			 }
		}
		var signupDialog = new SignupDialog();
</script>
