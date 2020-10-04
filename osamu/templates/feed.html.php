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
include __DIR__ . '/../inc/header.html.php';
include __DIR__ . '/../inc/nav.html.php'; 
include __DIR__ . '/../lib/utility.php';
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
            </header>
            <!-- display all posts -->
            <?php
      foreach ($page['articles'] as $preview) {
        ?>
            <article class="card">
                <div class="article-header flex wrap">
                    <section>
                        <h2 class="art-heading">
                            <?php echo $preview['title']; ?>
                        </h2>
                        <h3 class="art-subheading">
                            <?php echo $preview['auth'] . ', ' . $preview['date']; ?>
                        </h3>
                    </section>
                    
                </div>
                <section class="blog">
                    <p>
                        <?php 
          
          echo exerpt($preview['content'], 400) . '<a class="hover-green-light" href="' . $preview['id'] . '.php"> ...Continue reading ' . $preview['title'] . '</a>'; 
          ?>
                    </p>
                </section>
            </article>
            <hr />
            <?php
      }
      ?>
        </article>
    </section>
    <!-- end left column -->
    <?php include __DIR__ . '/../inc/aside.html.php'; ?>
    <!-- end outer div and main -->
</main>
<hr class="divider" />
<?php include __DIR__ . '/../inc/footer.html.php'; ?>