<?php include '../header.inc.html.php'; ?>
    <p><a class="button button-info" href="?add">Add a new Article</a></p>
    <?php // get method used to accomodate bookmarking search queries ?>
    <form action="" method="get">
        <p>View articles satisfying the following criteria:</p>
        <!-- search by author -->
        <div>
            <label for="author">By author:</label>
            <select name="author" id="author">
                <option value="">Any author</option>
                <?php foreach ($authors as $author): ?>
                <option value="<?php htmlout($author['id']); ?>">
                    <?php htmlout($author['name']); ?>
                </option>
                <?php endforeach ?>
            </select>
        </div>
        <!-- search by category -->
        <div>
        	<label for="category">By category:</label>
        	<select name="category" id="category">
        		<option value="">Any category</option>
        		<?php foreach ($categories as $category): ?>
        			<option value="<?php htmlout($category['id']); ?>"><?php htmlout($category['name']); ?></option>
        		<?php endforeach ?>
        	</select>
        </div>
        <!-- search by search term -->
        <div>
        	<label for="text">Containing text:</label>
        	<input type="text" name="text" id="text">
        </div>
        <div>
        	<input type="hidden" name="action" value="search">
        	<input class="submit-success" type="submit" value="Search">
        </div>
    </form>
    <?php include '../footer.inc.html.php'; ?>
</body>

</html>