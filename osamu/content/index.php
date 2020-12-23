<?php 

include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php';


  $page = array(
  'id' => 'home',
  'title' => 'Welcome to Samadhi Journal',
  'description' => 'Reflections and instructions in mindfulness meditation'
  );
  


include $_SERVER['DOCUMENT_ROOT'] . '/templates/front-page.html.php';
// header('Location: .');
exit();


 ?>