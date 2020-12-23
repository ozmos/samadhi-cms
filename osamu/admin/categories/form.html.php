<?php 
include $_SERVER['DOCUMENT_ROOT'] . '/admin/header.inc.html.php';
?>
    <form action="?<?php htmlout($action); ?>" method="post">
        <div>
            <label for="name">Name: <input type="text" name="name" id="name" value="<?php htmlout($name); ?>" required></label>
        </div>
        <div>
        	<input type="hidden" name="id" value="<?php htmlout($id); ?>">
        	<input type="submit" class="submit-success" value="<?php htmlout($button);?>">
        </div>
    </form>

    <?php include '../footer.inc.html.php'; ?>
</body>

</html>