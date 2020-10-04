<?php 
// set vars:
// $page {
//    id
//    title
//    description
//    content
// }

$page = array(
	'id' => 'guided_meditation',
	'title' => '20 Minute Guided Meditation',
	'description' => 'A twenty minute guided meditation using the breath as the basis for developing mindfulness',
	'content' => file_get_contents(__DIR__ . '/../content/guided_meditation.html'),
    
);

include __DIR__ . '/../templates/article.html.php';
 ?>