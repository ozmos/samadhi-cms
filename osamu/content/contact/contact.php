<?php 

$page = array(
	'id' => 'contact',
	'title' => 'Contact Us',
	'description' => 'Contact page for Samadhi Journal',
    'scripts' => ['form/validateForm']
);

include $_SERVER['DOCUMENT_ROOT'] . '/templates/contact.html.php';
?>