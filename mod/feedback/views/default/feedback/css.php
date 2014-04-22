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

?>

#feedbackWrapper {
	position: fixed;
	top: 113px;
	left: 0px;
	width: 450px;
	z-index:1; 
}

#feedBackToggler {
	float: left;
}

#feedBackContent {
	position:relative;
	top: -50px;
	width: 400px;
	display: none;
	overflow: hidden;
	float: left;
	border: solid #333 3px;
	background-color: #fff;
}

#feedbackError {
	color: #ff0000;
}

#feedbackSuccess {
	color: #4690D6;
}

.feedbackLabel {
}

.feedbackText {
	width:350px;  
}

.feedbackTextbox {
	width:350px;  
	height:75px;
}
 
.captcha {
	padding:10px;
}
.captcha-left {
	float:left;
	border:1px solid #0000ff;
}
.captcha-middle {
	float:left;
}
.captcha-right {
	float:left;
}
.captcha-input-text {
	width:100px;
}
