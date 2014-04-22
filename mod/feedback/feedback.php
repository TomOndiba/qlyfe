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

	require_once(dirname(dirname(dirname(__FILE__))) . '/engine/start.php');

	admin_gatekeeper();

	// Set admin user for user block
	set_page_owner($_SESSION['guid']);
	set_context("admin");

	$area1 = '';
	$area2 = elgg_view_title(elgg_echo('feedback:admin:title'));

	$area2 .= list_entities('object','feedback',0,10,false);

	page_draw(
		elgg_echo('feedback:admin:title'),
		elgg_view_layout('two_column_left_sidebar',$area1,$area2)
	);

?>