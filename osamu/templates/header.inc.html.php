<?php 
// set vars:
// $page {
//    id
//    title
//    description
//    
// }
 ?>


<!DOCTYPE html>
<html lang="en">

<head>
    
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?=$page['title']; ?></title>
    <meta name="author" content="Osamu Morozumi" />
    <meta name="description" content="<?=$page['description']?>" />
    <meta name="keywords" content="meditation, mindfulness, blog, relaxation, samadhi, zen" />
  
    <!-- end OG data -->
    <link href="https://fonts.googleapis.com/css?family=Inconsolata%7CNoto+Sans&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="/content/css/styles.css" />
   

</head>

<body id="<?php echo $page['id']; ?>">
<!-- header -->
<header class="flex site-header">
  <a id="skip-to-content" href="#content">Skip to Content</a>
  <a class="hidden" id="skip-to-nav" href="#nav">Skip to Navigation</a>
  <a class="site-logo hover-green-dark" href="https://samadhijournal.com">
    <img src="https://samadhijournal.com/images/logo.svg" alt="Site logo cloud image">
  </a>
    <div class="headings">
      <!-- php -->
      <?php 
    $site_title = $page['id'] === 'home' ? '<h1 class="site-title">Samadhi Journal</h1>' : '<strong class="site-title">Samadhi Journal</strong>';
    echo $site_title;
    ?>
        <p class="site-description">Reflections and instructions in mindfulness meditation</p>
    </div>
</header>

   
