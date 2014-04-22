<?php $name = $vars['internalname']; ?>

<td valign="middle" >
	<?php echo elgg_view("input/master_classifier", array('internalname'=>$name, 'network'=>'family')); ?>
	<?php echo elgg_view("input/classifier", array('internalname'=>$name, 'network'=>'family', 'classifier'=>'moms_side')); ?>
	<?php echo elgg_view("input/classifier", array('internalname'=>$name, 'network'=>'family', 'classifier'=>'dads_side')); ?>
	<?php echo elgg_view("input/classifier", array('internalname'=>$name, 'network'=>'family', 'classifier'=>'partners_side')); ?>
	<?php echo elgg_view("input/classifier", array('internalname'=>$name, 'network'=>'family', 'classifier'=>'immediate')); ?>
	<?php echo elgg_view("input/classifier", array('internalname'=>$name, 'network'=>'family', 'classifier'=>'children')); ?>
	<?php echo elgg_view("input/classifier", array('internalname'=>$name, 'network'=>'family', 'classifier'=>'grandchildren')); ?>
</td>
