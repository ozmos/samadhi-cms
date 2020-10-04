<?php 

$page = array(
	'id' => 'contact',
	'title' => 'Contact Us',
	'description' => 'Contact page for Samadhi Journal',
	
    'content' => file_get_contents(__DIR__ . '/../content/contact.html'),
    'scripts' => ['form/validateForm']
);

include __DIR__ . '/../templates/contact.html.php';
?>