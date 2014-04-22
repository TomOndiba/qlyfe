<?php 
echo elgg_view('input/radio', array('value'=>$vars['value'], 'internalname'=>$vars['internalname'], 'options'=>array(elgg_echo('profile:male')=>'m', elgg_echo('profile:female')=>'f'), 'nonewline'=>true));
?>