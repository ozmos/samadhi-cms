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
include $_SERVER['DOCUMENT_ROOT'] . '/templates/header.inc.html.php';
include $_SERVER['DOCUMENT_ROOT'] . '/templates/nav.inc.html.php'; 
// include $_SERVER['DOCUMENT_ROOT'] . '/includes/markdown.inc.php';
?>

<main class="outer flex wrap">
  <!-- left column -->
    <section class="col-9">
    <!-- main content -->
      <article class="blog-article card" id="content">
      <!-- article header -->
        <header class="article-header flex wrap">
          <section>
            <h1 class="art-heading">
              <?php echo $page['title']; ?>
            </h1>
          </section>
          <?php if (isset($page['img'])): ?>
          <section class="image">
            <img class="featured-img" src="/content/images/<?php echo $page['img'];?>" alt="<?php echo $page['alt'];?>" height="660" width="990" />
          </section>
          <?php endif ?>
        </header>
        <!-- article content -->
        <section id="article-body">
          <?php 
          markdownOut($page['content']); 
          ?>
        </section>  
        
      </article>
    </section>
    <!-- end left column -->
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/aside.inc.html.php'; ?>
    <!-- end outer div and main -->
    
</main>




<hr class="divider" />

<?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.inc.html.php'; ?>