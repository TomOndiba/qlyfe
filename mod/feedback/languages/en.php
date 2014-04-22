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

	$english = array(

		'item:object:feedback' => 'Feedback',
		'feedback:label' => 'Send us your feedback',
		'feedback:title' => 'Send us your feedback',

		'feedback:message' => 'We want Qlyfe to be the ultimate online social experience for you. If you\'d like to suggest a new feature or report a bug we would love to hear from you.',
		
		'feedback:default:id' => 'Email',
		'feedback:default:txt' => 'Let us know what you think!',
		'feedback:default:txt:err' => 'No feedback message has been provided.\nWe value your suggestions and criticisms.\nPlease enter your message and press Send.',

		'feedback:captcha:blank' => 'No captcha input provided',
		
		'feedback:submit_msg' => 'Submitting...',
		'feedback:submit_err' => 'Could not submit feedback!',
		
		'feedback:submit:error' => 'Could not submit feedback!',
		'feedback:submit:success' => 'Feedback submitted successfully. Thank you!',
		
		'feedback:admin:menu' => 'Feedback',
		'feedback:admin:title' => 'Qlyfe Feedback',
		
		'feedback:delete:success' => 'Feedback was deleted successfully',
		
		'feedback:mood:' => 'None',
		'feedback:mood:label' => 'How do you feel about Qlyfe?',
		'feedback:mood:angry' => 'I totally hate it.',
		'feedback:mood:neutral' => 'Needs some work...',
		'feedback:mood:happy' => 'It\'s Great!',

		'feedback:about:' => 'None',
		'feedback:about:bug_report' => 'Bug Report',
		'feedback:about:content' => 'Content Error',
		'feedback:about:suggestions' => 'Suggestions',
		'feedback:about:compliment' => 'Compliment',
		'feedback:about:other' => 'Other',
		
		'feedback:list:mood' => 'Overall Feeling',
		'feedback:list:about' => 'Reason',
		'feedback:list:page' => 'Page',
		'feedback:list:from' => 'From',
		
		'feedback:user_1' => "Administrator 1: ",
		'feedback:user_2' => "Administrator 2: ",
		'feedback:user_3' => "Administrator 3: ",
		'feedback:user_4' => "Administrator 4: ",
		'feedback:user_5' => "Administrator 5: ",
		
		'feedback:email:subject' => 'Qlyfe - Received feedback from %s',
		'feedback:email:body' => 'Qlyfe Feedback\n\n%s',
	);
					
	add_translation("en",$english);
?>