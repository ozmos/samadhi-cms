<?php 
include $_SERVER['DOCUMENT_ROOT'] . '/admin/header.inc.html.php';
?>
    <form action="?<?php htmlout($action); ?>" method="post">
        <div>
            <label for="description">Description: <input type="text" name="description" id="description" value="<?php htmlout($description); ?>" required></label>
        </div>
        <div>
            <label for="price">Price: <input type="number" name="price" id="price" step=0.01 value="<?php htmlout($price); ?>" required></label>
        </div>
        
        <div>
        	<input type="hidden" name="id" value="<?php htmlout($id); ?>">
        	<input type="submit" class="submit-success" value="<?php htmlout($button);?>">
        </div>
    </form>
    <?php include '../footer.inc.html.php'; ?>
</body>

</html>