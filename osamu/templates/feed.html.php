<?php 

include 'header.inc.html.php';
include 'nav.inc.html.php'; 
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
            </header>
          
            <!-- display all posts -->
            <section id="article-body">
                
                <?php
            foreach ($articles as $preview) {
            ?>
                <article class="card">
                    <div class="article-header flex wrap">
                        <section>
                            <h3 class="preview-heading">
                                <?php echo $preview['title']; ?>
                            </h3>
                            <h4 class="art-subheading">
                                <?php echo $preview['author'] . ', ' . $preview['date']; ?>
                            </h4>
                        </section>
                    </div>
                    <section class="blog">
                        <p>
                            <?php 
          
          echo markdown(excerpt($preview['content'], 400)) . '<a class="hover-green-light" href="?article=' . $preview['id'] . '"> ...Continue reading ' . $preview['title'] . '</a>'; 
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
    <?php include 'aside.inc.html.php'; ?>
    <!-- end outer div and main -->
</main>
<hr class="divider">
<?php include 'footer.inc.html.php'; ?>