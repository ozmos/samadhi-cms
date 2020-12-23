<?php include '../header.inc.html.php'; ?>
    <form action="?<?php htmlout($action); ?>" method="post">
        <!-- Give the article a title -->
        <div>
            <label for="title">Article title:</label>
            <input type="text" name="title" id="title" value="<?php htmlout($articleTitle); ?>">
        </div>
        <!-- Description -->
        <div class="flex-is-column">
            <label for="description">Article description:</label>
            <textarea class="auto-resize" name="description" id="description"><?php htmlout($articleDescription); ?></textarea>
        </div>
        <!-- Article content -->
        <div class="flex-is-column">
            <label for="text">Article content:</label>
            <textarea class="auto-resize" name="text" id="text"><?php htmlout($text); ?></textarea>
        </div>
        <!-- Author -->
        <div>
            <label for="author">Author:</label>
            <select name="author" id="author">
                <option value="">Select one</option>
                <?php foreach ($authors as $author): ?>
                <option value="<?php htmlout($author['id']); ?>" <?php if ($author['id']==$authorid) { echo ' selected' ; } ?>>
                    <?php htmlout($author['name']); ?>
                </option>
                <?php endforeach ?>
            </select>
        </div>
        <!-- Categories -->
        <fieldset>
            <legend>Categories:</legend>
            <?php foreach ($categories as $category): ?>
            <div>
                <label for="category<?php htmlout($category['id']); ?>">
                    <input type="checkbox" name="categories[]" id="category<?php htmlout($category['id']); ?>" value="<?php htmlout($category['id']); ?>" <?php if ($category['selected']) { echo ' checked' ; } ?>>
                    <?php htmlout($category['name']); ?>
                </label>
            </div>
            <?php endforeach ?>
        </fieldset>
        <!-- Featured image -->
        <div>
            <label for="image">Featured Image:</label>
            <select name="image" id="image">
                <option value="">No featured image</option>
                <?php foreach ($images as $image): ?>
                <option value="<?php htmlout($image['id']); ?>" <?php if ($image['id']==$imageid) { echo ' selected' ; } ?> >
                    	<?php htmlout($image['name']); ?>
                </option>
                <?php endforeach ?>
            </select>
        </div>
        <div>
            <input type="hidden" name="id" value="<?php htmlout($id);?>">
            <input type="submit" class="submit-success" value="<?php htmlout($button);?>">
        </div>
    </form>
    <?php include '../footer.inc.html.php'; ?>
    <script src="/admin/js/autoResize.js"></script>
</body>

</html>