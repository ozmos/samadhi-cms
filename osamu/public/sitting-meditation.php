<?php 
// set vars:
// $page {
//    id
//    title
//    description
//    img
//    alt
//    content
// }
// $scripts

$page = array(
	'id' => 'sitting-meditation',
	'title' => 'How to sit meditation',
	'description' => 'Brief instructions on how to sit meditation',
	'img' => 'sitting-meditation.jpg',
  	'alt' => 'woman sitting meditation in nature',
    'content' => file_get_contents(__DIR__ . '/../content/sitting_meditation.html'),
    
);

include __DIR__ . '/../templates/article.html.php';
 ?>