<?php $name = $vars['internalname']; ?>
<td valign="middle">
	<label><input guiname='<?php echo elgg_echo("classifier:public")?>' onclick="build_clist_p('<?php echo $name?>')" id="<?php echo $name?>_public" type="radio" name="<?php echo $name?>_clist_chooser_p" value="public"/>
	<?php echo elgg_echo("classifier:public")?></label><br/>

	<label><input guiname='<?php echo elgg_echo("classifier:private")?>' onclick="build_clist_p('<?php echo $name?>')" id="<?php echo $name?>_private" type="radio" name="<?php echo $name?>_clist_chooser_p" value="private"/>
	<?php echo elgg_echo("classifier:private")?></label><br/>
</td>
