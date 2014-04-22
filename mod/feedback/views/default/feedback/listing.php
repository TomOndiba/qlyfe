<?php
    /**
     * Qlyfe Feedback plugin
     * Feedback for Qlyfe
     * 
     * @package Feedback
     * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
     * @author Eder Weber
     * @copyright Qlyfe
     * @link http://www.qlyfe.com
     */

	$icon = elgg_view(
			'graphics/icon', array(
			'entity' => $vars['entity'],
			'size' => 'small',
		)
	);

	// $controls .= " (<a href=\"{$vars['url']}action/feedback/delete?guid={$vars['entity']->guid}\">" . elgg_echo('delete') . "</a>)";
    $controls .= elgg_view("output/confirmlink",array('href' => $vars['url'] . "action/feedback/delete?guid=" . $vars['entity']->guid, 'text' => elgg_echo('delete'), 'confirm' => elgg_echo('deleteconfirm'),));
	
	$mood = elgg_echo ( "feedback:mood:" . $vars['entity']->mood );
	$about = elgg_echo ( "feedback:about:" . $vars['entity']->about );
	
	$page = "Unknown";
	if ( !empty($vars['entity']->page) ) {
		$page = rtrim($CONFIG->wwwroot, "/") . $vars['entity']->page;
		$page = "<a href='" . $page . "'>" . $page . "</a>";
	}

//	$info .= "<div style='float:left;width:30%'><b>".elgg_echo('feedback:list:mood').": </b>" . $mood . "</div>";
	$info .= "<div style='float:left;width:30%'><b>".elgg_echo('feedback:list:about').": </b>" . $about . "</div>";
	$info .= "<b>".elgg_echo('feedback:list:from').": </b>" . $vars['entity']->id . "<br />";
	$info .= "<div style='float:right;'>$controls</div>";// . "<br />";
	$info .= "<b>".elgg_echo('feedback:list:page').": </b>" . $page . "<br />";
	$info .= "<b>Comments:</b> " . nl2br($vars['entity']->txt);
	
	echo elgg_view_listing($icon,$info);

?>
