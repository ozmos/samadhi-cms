<?php 
include $_SERVER['DOCUMENT_ROOT'] . '/admin/header.inc.html.php';
?>
    <form action="?<?php htmlout($action); ?>" method="post">
        <div>
            <label for="name">Name: <input type="text" name="name" id="name" value="<?php htmlout($name); ?>" required></label>
        </div>
        <div>
            <label for="email">Email: <input type="email" name="email" id="email" value="<?php htmlout($email); ?>" required></label>
        </div>
        <div>
            <label for="password">Set Password: <input type="password" name="password" id="password" <?php if ($action !== 'editform') { echo 'required';} // allow empty password if editing ?>></label>
        </div>
        <fieldset>
            <legend>Roles:</legend>
            <?php for ($i=0; $i < count($roles); $i++): ?> 
            <div>
                <label for="role<?php echo $i; ?>">
                    <input type="checkbox" name="roles[]" id="role<?php echo $i; ?>" value="<?php htmlout($roles[$i]['id']) ?>" <?php if ($roles[$i]['selected']) {
                        echo ' checked';
                    } ?>><?php htmlout($roles[$i]['id']); ?>
                </label>:
                <?php htmlout($roles[$i]['description']); ?>
            </div>    
            <?php endfor; ?>
        </fieldset>
        <div>
        	<input type="hidden" name="id" value="<?php htmlout($id); ?>">
        	<input type="submit" class="submit-success" value="<?php htmlout($button);?>">
        </div>
    </form>
    <?php include '../footer.inc.html.php'; ?>
</body>

</html>