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
	'id' => 'intro',
	'title' => 'What is mindfulness?',
	'description' => 'An introduction to mindfulness',
	'img' => 'meditation-grass.jpg',
  	'alt' => 'man sitting in meditation on grass',
    'content' => file_get_contents(__DIR__ . '/../content/intro.html'),
    
);

include __DIR__ . '/../templates/article.html.php';
 ?>