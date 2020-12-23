<?php 
include $_SERVER['DOCUMENT_ROOT'] . '/admin/header.inc.html.php';
?>
	<p><a class="button button-info" href="?add">Add new category</a></p>
	<ul>
		<?php foreach ($categories as $category): ?>
			<li>
				<form action="" method="post">
					<div>
						<?php htmlout($category['name']); ?>
						<input type="hidden" name="id" value="<?php echo $category['id']; ?>">
						<input type="submit" class="submit-primary" name="action" value="Edit">
						<input type="submit" class="submit-warning" name="action" value="Delete">
					</div>
				</form>
			</li>
		<?php endforeach ?>
	</ul>
	<?php include '../footer.inc.html.php'; ?>
</body>
</html>