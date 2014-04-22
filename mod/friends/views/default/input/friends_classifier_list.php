<?php $name = $vars['internalname']; ?>

<td valign="middle" >
	<?php echo elgg_view("input/master_classifier", array('internalname'=>$name, 'network'=>'friends')); ?>
	<?php echo elgg_view("input/classifier", array('internalname'=>$name, 'network'=>'friends', 'classifier'=>'bf')); ?>
	<?php echo elgg_view("input/classifier", array('internalname'=>$name, 'network'=>'friends', 'classifier'=>'f')); ?>
	<?php echo elgg_view("input/classifier", array('internalname'=>$name, 'network'=>'friends', 'classifier'=>'a')); ?>

	<?php 
		$circles = get_user_access_collections(get_loggedin_userid());
		if ($circles) {
			foreach ($circles as $circle) {
				echo elgg_view("input/classifier", array('guiname'=>$circle->name, 'internalname'=>$name, 'network'=>'friends', 'classifier'=>$circle->name));
			}
		}			
	?>
</td>
