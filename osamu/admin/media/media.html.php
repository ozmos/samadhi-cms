<?php 
include $_SERVER['DOCUMENT_ROOT'] . '/admin/header.inc.html.php';
 ?>
<p><a class="button button-info" href="?add">Add New Image</a></p>
<ul>
    <?php foreach ($images as $image): ?>
    <li>
        <section class="card">
            <h3>
                <?php htmlout($image['name']); ?>
            </h3>
            <figure>
                <section class="thumb">
                    <a href="/uploads/<?php htmlout($image['name']);?>" target="_blank"><img src="<?php  echo '../../uploads/' . escape($image['name']); ?>" alt="<?php htmlout($image['alt']); ?>" width="150px"></a>
                </section>
                <figcaption><?php htmlout($image['alt']); ?></figcaption>
            </figure>
            <form action="" method="post">
                <div>
                    <input type="hidden" name="id" value="<?php echo $image['id']; ?>">
                    <input type="submit" class="submit-primary" name="action" value="Edit">
                    <input type="submit" class="submit-warning" name="action" value="Delete">
                </div>
            </form>
        </section>
    </li>
    <?php endforeach ?>
</ul>
<?php include '../footer.inc.html.php'; ?>
</body>

</html>