<?php 
// set vars:
// $page {
//    id
//    title
//    description
//    content
//    scripts
// }

include __DIR__ . '/../inc/header.html.php';
include __DIR__ . '/../inc/nav.html.php'; 
?>

<main class="outer">
    <!-- main content -->
    <article class="blog-article card" id="content">
        <!-- article header -->
        <div class="article-header flex wrap">
            <section class="article-header">
                <h1>
                    <?php echo $page['title']; ?>
                </h1>
            </section>
        </div>
        <!-- article content -->
        <?php echo $page['content']; ?>
    </article>
</main>
<hr class="divider" />
<!-- footer -->

<?php include __DIR__ . '/../inc/footer.html.php'; ?>