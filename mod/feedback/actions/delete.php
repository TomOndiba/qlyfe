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

	// Make sure we're logged in (send us to the front page if not)
		gatekeeper();

	// Get input data
		$guid = (int) get_input('guid');
		
	// Make sure we actually have permission to edit
		$feedback = get_entity($guid);
		if ($feedback->getSubtype() == "feedback" && $feedback->canEdit()) {
			// Delete it!
				$feedback->delete();
			// Success message
				system_message(elgg_echo("feedback:delete:success"));
			// Forward to the main blog page
				forward("pg/feedback");
		}
		
?>