<?php 

/**
 * NOP access level input
 * Displays your current classifier + a link to change (reclassify) this object
 *
 * @package Elgg
 * @subpackage Core

 * @author Curverider Ltd

 * @link http://elgg.org/
 *
 * @uses $vars['value'] The current value of our access level as a Qlyfe_CList, if any
 * @uses $vars['js'] Any Javascript to enter into the input tag
 * @uses $vars['internalname'] The name of the input field
 *
 */

$label = $vars['label']; 
$name = $vars['internalname']; 
$name = str_replace("[", "_", $name);
$name = str_replace("]", "", $name);
elgg_view("input/hidden"); // array('internalname' => 'u')//should auto-populate with internal name & internal id I think
$value = $vars['value']; 

$content = "";

// get our default value from the current context if it doesn't exist
if (!($value instanceof Qlyfe_CList)) {
	$value = get_clist_from_context();
}

echo elgg_view("input/hidden", array('internalid'=>$name,'internalname'=>$vars['internalname'], 'value'=>$value));
?>

<script language="javascript">

	$(document).ready(function () {
		var name = '<?php echo $name?>';
		$("#" + name + "_classifier").click(function () {

			if ($("#" + name + "_clist_chooser").is(":hidden"))
				$("#" + name + "_clist_chooser").slideDown();
			else
				$("#" + name + "_clist_chooser").slideUp();
		});
		populate_clist(name, '<?php echo $value?>');
	});
</script>


<div class='nop_editable_clist' style='position:inline;'>
	<div id="<?php echo $name?>_holder">
		<?php echo isset($vars['desc'])?$vars['desc']:''; ?> <?php echo $label?> <a id="<?php echo $name?>_classifier"  href="javascript: void(0)"><?php echo $value?></a>
	</div>
	<div class='nop_clist_chooser' id="<?php echo $name?>_clist_chooser" style='display:none;'>
		
		<table cellpadding='0' cellspacing='0' width='100%'>

		<tr style=''>
			<?php echo elgg_view("input/classifier_list", array('internalname'=>$name)); // extend this to put in more networks?> 
			<td align="right" valign="bottom" >
				<input type="button"  class="cancel_button" onclick="hide_clist_chooser('<?php echo $name?>')" value="Hide"/>
			</td>
		</tr>
		</table>

	</div>
</div>
