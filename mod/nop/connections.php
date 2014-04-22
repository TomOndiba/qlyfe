<?php
/**
 * Elgg friends page
 *
 * @package Elgg
 * @subpackage Core
 * @author Curverider Ltd
 * @link http://elgg.org/
 */

	gatekeeper();
	global $vars;
	$user = $vars['user'];

	$area1 = elgg_view("connect/vertical_tabs");
	$area2 = list_entities_from_relationship('',$user->getGUID(),false,'user','',0,10,
										false, false, true, get_clist_from_context());
	$body = elgg_view_layout('vertical_tabs', $area1 , $area2);
	
	page_draw($friends, $body);
