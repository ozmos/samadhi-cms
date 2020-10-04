<?php 
// set vars:
// $page {
//    id
//    title
//    description
//    articles[
//      title
//      auth
//      date
//      id
//      content
//    ]
// }

$page = array(
	'id' => 'articles',
	'title' => 'Latest Articles',
	'description' => 'Blog feed for Samadhi Journal',
	'articles' => array(
		array(
		    'id' => 'intro',
		    'title' => 'What is mindfulness?',
			'description' => 'An introduction to mindfulness',
		    'auth' => 'Osamu Morozumi',
		    'date' => '9th June 2019',
		    'content' => file_get_contents(__DIR__ . '/../content/intro.html'),
		),
		array(
			'id' => 'sitting-meditation',
			'title' => 'How to sit meditation',
			'description' => 'Brief instructions on how to sit meditation',
			'auth' => 'Osamu Morozumi',
		    'date' => '9th June 2019',
		    'content' => file_get_contents(__DIR__ . '/../content/sitting_meditation.html'),
		    
		),
		array(
			'id' => 'guided_meditation',
			'title' => '20 Minute Guided Meditation',
			'description' => 'A twenty minute guided meditation using the breath as the basis for developing mindfulness',
			'auth' => 'Osamu Morozumi',
		    'date' => '9th June 2019',
			'content' => file_get_contents(__DIR__ . '/../content/guided_meditation.html'),
		    
		)
	),
    
);

include __DIR__ . '/../templates/feed.html.php';
 ?>