<?php

	/**
	 * Elgg profile edit form
	 * 
	 * @package Elgg
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Curverider Ltd <info@elgg.com>
	 * @copyright Curverider Ltd 2008-2010
	 * @link http://elgg.com/
	 * 
	 * @uses $vars['entity'] The user entity
	 * @uses $vars['signupwizard'] signupwizard items from $CONFIG->signupwizard, defined in signupwizard/start.php for now 
	 */

?>
<div class="contentWrapper">
<form action="<?php echo $vars['url']; ?>action/profile/editcontact" method="post">
<?php echo elgg_view('input/securitytoken') ?>
<table border="0" cellpadding="3" cellspacing="3">
<tr>
<td width='45%'>&nbsp;</td>
<td width='1'>&nbsp;</td>
<td width='55%'></td>
</tr>
<?php

	//var_export($vars['signupwizard']);
	if (is_array($vars['config']->profilecontact) && sizeof($vars['config']->profilecontact) > 0)
		foreach($vars['config']->profilecontact as $shortname => $valtype) {
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
?>
<tr>
<td valign="top">
<?php
		if($shortname == "description")
			print "<br><h2>".elgg_echo("About Yourself")."</h2>";

		if($shortname == "locationinfo" || $shortname == "hometown"	){
?>
		<br /><h2><?php echo elgg_echo("profilecontact:{$shortname}") ?></h2>
			<?php echo elgg_view("input/{$valtype}",array(
															'internalname' => $shortname,
															'value' => $value,
															)); ?>
		<? }else{ ?>		
		<label>
			<?php echo elgg_echo("profile:{$shortname}") ?> : <br />
			<?php echo elgg_view("input/{$valtype}",array(
															'internalname' => $shortname,
															'value' => $value,
															)); ?>
		</label>
		<? } ?>
</td>
<td>&nbsp;</td>
<td valign="middle">		
		<?php if($shortname == "website"){ ?>
			<input type="hidden"  name="accesslevel[contactemail]" id="accesslevel_contactemail" value="public" />
		<? }else{ ?>	
			<br /><?php echo elgg_view('input/access',array('label'=> elgg_echo("profile:edit:whocansee"), 'internalname' => 'accesslevel['.$shortname.']', 'value' => $access_id)); ?>
		<? } ?>	
		</td>
</tr>		

<?php

		}

?>
</table>
	<p>
		<input type="hidden" name="username" value="<?php echo page_owner_entity()->username; ?>" />
		<input type="submit" class="submit_button" value="<?php echo elgg_echo("save"); ?>" />
		
		&nbsp;&nbsp;&nbsp;&nbsp;
		
		<input type="button" class="submit_button" value="<?php echo elgg_echo("cancel"); ?>" onclick="location.href='<?php echo page_owner_entity()->getUrl()?>'" /> 

	</p>

</form>
</div>