<?php 

$page = array(
	'id' => 'home',
	'title' => 'Welcome to Samadhi Journal',
	'description' => 'Reflections and instructions in mindfulness meditation',
	'img' => 'meditation-grass.jpg',
    'alt' => 'man sitting in meditation on grass',
    'content' => file_get_contents(__DIR__ . '/../content/home.html'),
    'actions' => [
      ['href' => 'intro.php', 'content' => 'Read More about mindfulness'],
      ['href' => 'sitting-meditation.php', 'content' => 'Learn How to Meditate']
    ]
);

include __DIR__ . '/../templates/front-page.html.php';
 ?>