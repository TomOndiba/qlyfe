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

?>
<div class="contentWrapper">
<form action="<?php echo $vars['url']; ?>action/profile/edit" method="post">
<?php echo elgg_view('input/securitytoken') ?>
<table border="0" cellpadding="3" cellspacing="3" class='profile_info'>
<tr>
<td width='45%'>&nbsp;</td>
<td width='1'>&nbsp;</td>
<td width='55%'></td>
</tr>

<tr>
	<td colspan="3">
		<h3>Basic Information</h3>
	</td>
</tr>


<?php
	//var_export($vars['profile']);
	if (is_array($vars['config']->profile) && sizeof($vars['config']->profile) > 0)
		foreach($vars['config']->profile as $shortname => $valtype) {
			if ($metadata = get_metadata_byname($vars['entity']->guid, $shortname)) {
				if (is_array($metadata)) {
					$value = '';
					foreach($metadata as $md) {
						if (!empty($value)) $value .= ', ';
						$value .= $md->value;
						$access_id = $md->access_id;
					}
				} else {
					$value = $metadata->value;
					$access_id = $metadata->access_id;
				}
			} else {
				$value = '';
				$access_id = ACCESS_DEFAULT;
			}
			
			$basic = ($shortname == "firstname" || $shortname == "lastname" || 
					$shortname == "gender" || $shortname == "birthdate");
?>
<?php if (!$basic) {?>
<tr>
	<td colspan="3">
		<h3><?php echo elgg_echo("profile:{$shortname}") ?></h3>
	</td>
</tr>
<?php } ?>
<tr>
<td valign="top" style='padding-left:10px;'>
<?php
		if($shortname == "locationinfo" || $shortname == "hometown"	){
?>
			<?php echo elgg_view("input/{$valtype}",array(
															'internalname' => $shortname,
															'value' => $value,
															)); ?>
		<? }else{ ?>		
		<label>
			<?php echo elgg_echo("profile:{$shortname}") ?> : 
			<?php //	if (!$basic) { echo "<br/>"; } ?>
			<?php echo elgg_view("input/{$valtype}",array(
															'internalname' => $shortname,
															'value' => $value,
															)); ?>
		</label>
		<? } ?>
</td>
<td>&nbsp;</td>
	<td valign="middle">		
		<?php if($shortname == "firstname" || $shortname == "lastname"){ ?>
			<input type="hidden"  name="accesslevel[contactemail]" id="accesslevel_contactemail" value="public" />
		<? }else{ ?>	
			<?php echo elgg_view('input/access',array('label'=> elgg_echo("profile:edit:whocansee"), 'internalname' => 'accesslevel['.$shortname.']', 'value' => $access_id)); ?>
		<? } ?>	
	</td>
</tr>		

<?php

		}

?>
</table>
	<p>
		<input type="hidden" name="actionurl" value="<?php echo $vars['actionurl'] ?>" />
		<input type="hidden" name="username" value="<?php echo $_SESSION['user']->username; ?>" />
		
<?php if($vars['actionurl'] == "signupwizard"){ ?>		
		<input type="submit" class="submit_button" value="<?php echo elgg_echo("Save and Continue"); ?>" />
		
<? }else{ ?>
		<input type="submit" class="submit_button" value="<?php echo elgg_echo("Update"); ?>" />
		
		&nbsp;&nbsp;&nbsp;&nbsp;
		
		<input type="button" class="submit_button" value="<?php echo elgg_echo("cancel"); ?>" onclick="location.href='<?php echo page_owner_entity()->getUrl()?>'" />  
<? } ?>

	</p>

</form>
<script language="javascript">
		function changeCountry(c1,otherstate,state){
			if($("#" + c1+" option:selected").val() != "US" && $("#" + c1+" option:selected").val() != ""){					
				$("#" + otherstate + "_chooser").slideDown();
				$("#" + state + "_chooser").slideUp();				
				$("#"+state).val('').attr('selected', 'selected');				

			}else{
				$("#" + otherstate + "_chooser").slideUp();
				$("#" + state + "_chooser").slideDown();				
			}	
		}

</script>
</div>