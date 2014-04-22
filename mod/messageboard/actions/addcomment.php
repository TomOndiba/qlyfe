<?php

if (!isloggedin()) forward();

$message_content = get_input('message_id');
$page_owner = get_input("page_owner");



