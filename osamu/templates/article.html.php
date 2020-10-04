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
include __DIR__ . '/../inc/header.html.php';
include __DIR__ . '/../inc/nav.html.php'; 
?>

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
          <?php if (isset($page['img'])): ?>
          <section class="image">
            <img class="featured-img" src="images/<?php echo $page['img'];?>" alt="<?php echo $page['alt'];?>" height="660" width="990" />
          </section>
          <?php endif ?>
        </header>
        <!-- article content -->
        <section id="article-body">
          <?php 
          echo $page['content']; 
          ?>
        </section>  
        
      </article>
    </section>
    <!-- end left column -->
    <?php include __DIR__ . '/../inc/aside.html.php'; ?>
    <!-- end outer div and main -->
    
</main>




<hr class="divider" />

<?php include __DIR__ . '/../inc/footer.html.php'; ?>