<?php 
// set vars:
// $page {
//    id
//    title
//    description
//    img
//    alt
//    content
//    actions
// }
include 'header.inc.html.php';
include 'nav.inc.html.php';  
?>
<!-- main -->
<main class="outer flex wrap">
  <!-- left column -->
    <section class="col-9">
    <!-- main content -->
      <article class="blog-article card" id="content">
      <!-- article header -->
        <header class="article-header flex wrap">
          <section>
            <h2 class="art-heading">
              <?php echo $page['title']; ?>
            </h2>
          </section>
         <!-- Featured image -->
          <section class="image">
              <img class="featured-img" src="/content/images/sitting-meditation.jpg" alt="woman sitting in meditation" height="660" width="990" />
          </section>
        </header>
        <!-- article content -->
        <!-- Blurb hard coded for simplicity-->
        <section id="article-body">
            <p>Here you will find instruction on <em>mindfulness</em> and <em>meditation</em> from my own perspective. If you are just starting your journey into meditation I recommend starting with the guided meditation.</p>
            <p>You may want to start by learning mindfulness of breathing or walking meditation. Take what you find useful or appealing from the articles here and put it to use in your own practice.</p>
          <?php 
          if (isset($page['actions'])) {
          ?>
          <div id="actions">
            <?php
              $actions = $page['actions'];
              foreach ($actions as $action): ?>
              <h3><a class="hover-green-light" href="<?php echo $action['href'];?>"><?php echo $action['content'];?></a></h3>  
              
            <?php endforeach; 
            ?>
          </div>
          <?php } ?>
        </section>
        
      </article>
    </section>
    <!-- end left column -->
    <?php include 'aside.inc.html.php'; ?>
    <!-- end outer div and main -->
    
</main>
<hr class="divider" />

<?php include 'footer.inc.html.php'; ?>