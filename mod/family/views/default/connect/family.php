<?php 
	$user = $vars['user'];
	$entity = $vars['entity'];
?>

<script language='javascript'>

function connectAsFamily() {
	familyRestart();
	if ($("#family_connect_cb").is(":checked")) {
		$('#connect_as_family').slideDown();
		connectDialog.showing("family");
	} else {
		$('#connect_as_family').slideUp();
		connectDialog.not_showing("family");
	}
}
function selectFamilyRelationship(type, name) {
	$('#family_label').text(name);
	$("#family_relationship").val(type);
	$("#family_relationship_div").hide();
	
	if (type == "sibling") {
		$("#family_classifier").val("family/immediate");
		$("#sibling_classifier_div").show();
	} else if (type == "parent") {
		$("#family_classifier").val("family/immediate");
		$("#parent_classifier_div").show();
	} else if (type == "child") {
		$("#family_classifier").val("family/immediate,family/children");
		$("#child_classifier_div").show();
	} else if (type == "grandchild") {
		$("#family_classifier").val("family/grandchildren");
		familyDone();
	} else if (type == "grandparent") {
		$("#family_classifier_div").show();
	} else if (type == "cousin") {
		$("#family_classifier_div").show();
	} else if (type == "niece_nephew") {
		$("#family_classifier").val("family");
		familyDone();
	} else if (type == "aunt_uncle") {
		$("#family_classifier_div").show();
	} else if (type == "partner") {
		$("#family_classifier").val("family/partners_side");
		$("#partner_classifier_div").show();
	} else if (type == "inlaw") {
		$("#family_classifier").val("family/partners_side");
		$("#inlaw_classifier_div").show();
	}
}
function setFamilyRelationship(relationship) {
	$("#family_relationship").val(relationship);
}
function addFamilyClassifiers(cls) {
	if ($("#family_classifier").val() == "")
		$("#family_classifier").val(cls);
	else
		$("#family_classifier").val($("#family_classifier").val() + "," + cls);
}
function familyRestart() {
	connectDialog.showing("family");
	$("#family_classifier").val("");
	$("#family_relationship").val("");
	$(".family_chooser_level2").hide();
	$(".family_chooser_level1").show();
}
function familyDone(relationship) {
	if (relationship)
		$('#family_label').text(relationship);
	$(".familiy_chooser_level2").hide();
	$(".familiy_chooser_level1").hide();
	$("#connect_as_family").hide();

	connectDialog.not_showing("family");
}

</script>

<div><!--  family -->
	<label><input type="checkbox" id="family_connect_cb" name="connect_as" value="family" onclick="connectAsFamily()"/><span id='family_label'><?php echo elgg_echo("family:family_member")?></span></label>
	<input id='family_relationship' type="hidden" name="family_relationship" value=""/>
	<input id='family_classifier' type="hidden" name="family_classifier" value=""/>
	<div style='margin-left:15px;display:none;' id='connect_as_family'>
		<?php if (!$user->gender) { ?>
			you need to specify your gender
		<?php } else if (!$entity->gender) { ?>
			they need to specify their
		<?php } else { 
			$my_gender = $user->gender; 
			$their_gender = $entity->gender;
		?>
		
			<div style='margin-left:15px;'>

			<div class='family_chooser_level1' id='family_relationship_div'>
			<?php echo sprintf(elgg_echo("family:connectdialog:choose_relationship"), $entity->name)?><br/>
			<a href="javascript:selectFamilyRelationship('sibling', '<?php echo elgg_echo("relationship:family:sibling:" . $their_gender)?>')"><?php echo elgg_echo("relationship:family:sibling:" . $their_gender)?> <?php echo elgg_echo("family:connectdialog:or")?> <?php echo elgg_echo("relationship:family:sibling:step:" . $their_gender)?></a><br/>				
			<a href="javascript:selectFamilyRelationship('parent', '<?php echo elgg_echo("relationship:family:parent:" . $their_gender)?>')"><?php echo elgg_echo("relationship:family:parent:" . $their_gender)?> <?php echo elgg_echo("family:connectdialog:or")?> <?php echo elgg_echo("relationship:family:parent:step:" . $their_gender)?></a><br/>		
			<a href="javascript:selectFamilyRelationship('child', '<?php echo elgg_echo("relationship:family:child:" . $their_gender)?>')"><?php echo elgg_echo("relationship:family:child:" . $their_gender)?> <?php echo elgg_echo("family:connectdialog:or")?> <?php echo elgg_echo("relationship:family:child:step:" . $their_gender)?></a><br/>		
			<a href="javascript:selectFamilyRelationship('grandparent', '<?php echo elgg_echo("relationship:family:grandparent:" . $their_gender)?>')"><?php echo elgg_echo("relationship:family:grandparent:" . $their_gender)?></a><br/>				
			<a href="javascript:selectFamilyRelationship('grandchild', '<?php echo elgg_echo("relationship:family:grandchild:" . $their_gender)?>')"><?php echo elgg_echo("relationship:family:grandchild:" . $their_gender)?></a><br/>		
			<a href="javascript:selectFamilyRelationship('aunt_uncle', '<?php echo elgg_echo("relationship:family:aunt_uncle:" . $their_gender)?>')"><?php echo elgg_echo("relationship:family:aunt_uncle:" . $their_gender)?></a><br/>		
			<a href="javascript:selectFamilyRelationship('niece_nephew', '<?php echo elgg_echo("relationship:family:niece_nephew:" . $their_gender)?>')"><?php echo elgg_echo("relationship:family:niece_nephew:" . $their_gender)?></a><br/>			
			<a href="javascript:selectFamilyRelationship('cousin', '<?php echo elgg_echo("relationship:family:cousin:" . $their_gender)?>')"><?php echo elgg_echo("relationship:family:cousin:" . $their_gender)?></a><br/>
			<a href="javascript:selectFamilyRelationship('partner', '<?php echo elgg_echo("relationship:family:partner:" . $their_gender)?>')"><?php echo elgg_echo("relationship:family:partner:" . $their_gender)?></a><br/>			
			<a href="javascript:selectFamilyRelationship('inlaw', '<?php echo elgg_echo("relationship:family:inlaw")?>')"><?php echo elgg_echo("relationship:family:inlaw")?></a><br/>		
			</div>
			
			<div class='family_chooser_level2' id='sibling_classifier_div' style='display:none;'>
				<?php echo elgg_echo("family:connectdialog:related_through")?><br/>
				<a href="javascript:addFamilyClassifiers('family/moms_side,family/dads_side');familyDone('<?php echo elgg_echo("relationship:family:sibling:" . $their_gender)?>');"><?php echo elgg_echo("family:connectdialog:our")?> <?php echo elgg_echo("relationship:family:parent:both")?></a><br/>
				<a href="javascript:setFamilyRelationship('step-sibling');addFamilyClassifiers('family/dads_side');familyDone('<?php echo elgg_echo("relationship:family:sibling:step:" . $their_gender)?>');"><?php echo elgg_echo("family:connectdialog:my")?> <?php echo elgg_echo("relationship:family:parent:m")?></a><br/>
				<a href="javascript:setFamilyRelationship('step-sibling');addFamilyClassifiers('family/moms_side');familyDone('<?php echo elgg_echo("relationship:family:sibling:step:" . $their_gender)?>');"><?php echo elgg_echo("family:connectdialog:my")?> <?php echo elgg_echo("relationship:family:parent:f")?></a><br/>
			</div>
			<div class='family_chooser_level2' id='family_classifier_div' style='display:none;'>
				<?php echo elgg_echo("family:connectdialog:related_through")?><br/>
				<a href="javascript:addFamilyClassifiers('family/dads_side');familyDone();"><?php echo elgg_echo("family:connectdialog:my")?> <?php echo elgg_echo("relationship:family:parent:m")?></a><br/>
				<a href="javascript:addFamilyClassifiers('family/moms_side');familyDone();"><?php echo elgg_echo("family:connectdialog:my")?> <?php echo elgg_echo("relationship:family:parent:f")?></a><br/>
			</div>
			<div class='family_chooser_level2' id='parent_classifier_div' style='display:none;'>
				<?php echo elgg_echo("family:connectdialog:he_is_my:" . $their_gender)?><br/>
				<?php if ($entity->gender == 'm') { ?>
				<a href="javascript:setFamilyRelationship('parent');addFamilyClassifiers('family/dads_side');familyDone('<?php echo elgg_echo("relationship:family:parent:m")?>');"><?php echo elgg_echo("relationship:family:parent:m")?></a><br/>
				<a href="javascript:setFamilyRelationship('step-parent');addFamilyClassifiers('family/moms_side');familyDone('<?php echo elgg_echo("relationship:family:parent:step:m")?>');"><?php echo elgg_echo("relationship:family:parent:step:m")?></a><br/>
				<?php } else { ?>
				<a href="javascript:setFamilyRelationship('parent');addFamilyClassifiers('family/moms_side');familyDone('<?php echo elgg_echo("relationship:family:parent:f")?>');"><?php echo elgg_echo("relationship:family:parent:f")?></a><br/>
				<a href="javascript:setFamilyRelationship('step-parent');addFamilyClassifiers('family/dads_side');familyDone('<?php echo elgg_echo("relationship:family:parent:step:f")?>');"><?php echo elgg_echo("relationship:family:parent:step:f")?></a><br/>
				<?php } ?>
			</div>

			<div class='family_chooser_level2' id='child_classifier_div' style='display:none;'>
				<?php echo elgg_echo("family:connectdialog:he_is_my:" . $their_gender)?><br/>
				<?php if ($entity->gender == 'm') { ?>
				<a href="javascript:setFamilyRelationship('child');addFamilyClassifiers('family/dads_side');familyDone('<?php echo elgg_echo("relationship:family:child:m")?>');"><?php echo elgg_echo("relationship:family:child:m")?></a><br/>
				<a href="javascript:setFamilyRelationship('step-child');addFamilyClassifiers('family/moms_side');familyDone('<?php echo elgg_echo("relationship:family:child:step:m")?>');"><?php echo elgg_echo("relationship:family:child:step:m")?></a><br/>
				<?php } else { ?>
				<a href="javascript:setFamilyRelationship('child');addFamilyClassifiers('family/moms_side');familyDone('<?php echo elgg_echo("relationship:family:child:f")?>');"><?php echo elgg_echo("relationship:family:child:f")?></a><br/>
				<a href="javascript:setFamilyRelationship('step-child');addFamilyClassifiers('family/dads_side');familyDone('<?php echo elgg_echo("relationship:family:child:step:f")?>');"><?php echo elgg_echo("relationship:family:child:step:f")?></a><br/>
				<?php } ?>
			</div>
			
			<div class='family_chooser_level2' id='partner_classifier_div' style='display:none;'>
				<a href="javascript:setFamilyRelationship('married');addFamilyClassifiers('family/immediate');familyDone('<?php echo elgg_echo("relationship:family:partner:married:" . $their_gender)?>');"><?php echo elgg_echo("relationship:family:partner:married:" . $their_gender)?></a><br/>
				<a href="javascript:setFamilyRelationship('engaged');addFamilyClassifiers('family/immediate');familyDone('<?php echo elgg_echo("relationship:family:partner:engaged:" . $their_gender)?>');"><?php echo elgg_echo("relationship:family:partner:engaged:" . $their_gender)?></a><br/>
				<a href="javascript:setFamilyRelationship('boyfriend_girlfriend');addFamilyClassifiers('family/immediate');familyDone('<?php echo elgg_echo("relationship:family:partner:boyfriend_girlfriend:" . $their_gender)?>');"><?php echo elgg_echo("relationship:family:partner:boyfriend_girlfriend:" . $their_gender)?></a><br/>
			</div>
			
			<div class='family_chooser_level2' id='inlaw_classifier_div' style='display:none;'>
				<?php echo elgg_echo("family:connectdialog:he_is_my:" . $their_gender)?><br/>
				<a href="javascript:setFamilyRelationship('child-inlaw');familyDone('<?php echo elgg_echo("relationship:family:child:inlaw:" . $their_gender)?>');"><?php echo elgg_echo("relationship:family:child:inlaw:" . $their_gender)?></a><br/>
				<a href="javascript:setFamilyRelationship('parent-inlaw');familyDone('<?php echo elgg_echo("relationship:family:parent:inlaw:" . $their_gender)?>');"><?php echo elgg_echo("relationship:family:parent:inlaw:" . $their_gender)?></a><br/>
				<a href="javascript:setFamilyRelationship('sibling-inlaw');familyDone('<?php echo elgg_echo("relationship:family:sibling:inlaw:" . $their_gender)?>');"><?php echo elgg_echo("relationship:family:sibling:inlaw:" . $their_gender)?></a><br/>
				<a href="javascript:setFamilyRelationship('other-inlaw');familyDone('<?php echo elgg_echo("relationship:family:inlaw:other")?>');"><?php echo elgg_echo("relationship:family:inlaw:other")?></a><br/>
			</div>
			
			<div style='text-align:right;'><a href="javascript:familyRestart()">restart</a></div>
			</div> <!--  end the indent div -->

		<?php } ?>
	</div>
</div>
