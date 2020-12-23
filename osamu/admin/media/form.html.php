<?php 
include $_SERVER['DOCUMENT_ROOT'] . '/admin/header.inc.html.php';
?>
    <?php if (isset($error)): ?>
    <p><?php htmlout($error); ?></p>
    <?php endif ?>
    <form action="?<?php htmlout($action); ?>" method="post" enctype="multipart/form-data">
        <div>
            <?php if ($action == 'editform'): ?>
            <input type="hidden" name="old" value="<?php htmlout($name); ?>" >    
            <?php endif ?>
            <label for="name">Name: <input type="text" name="name" id="name" value="<?php htmlout($name); ?>" required></label>
        </div>
        <div>
            <label for="alt-text">Alternative text: <input type="text" name="alt-text" id="alt-text" value="<?php htmlout($alt); ?>" required></label>
        </div>
        <?php if ($action === 'addform'): ?>

        <div>
            <input type="hidden" name="MAX_FILE_SIZE" value=300000 />
            <label for="image">Upload file (max 300k): <input type="file" name="image" id="image" required></label>
        </div>    
        <?php endif ?>
       
        <div>
        	<input type="hidden" name="id" value="<?php htmlout($id); ?>">
        	<input type="submit" class="submit-success" value="<?php htmlout($button);?>">
        </div>
    </form>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/admin/footer.inc.html.php'; ?>
</body>

</html>