
<?php 
include $_SERVER['DOCUMENT_ROOT'] . '/admin/header.inc.html.php';
?>
	<p><a class="button button-info" href="?add">Add new author</a></p>
	<ul>
	<?php foreach ($authors as $author) : ?>
	   <li>
	   	<form action="" method="post">
	   		<div>
	   		<?php echo escape($author['name']); ?>
	   			<input type="hidden" name="id" value="<?php echo $author['id']; ?>">
	   			<input type="submit" class="submit-primary" name="action" value="Edit">
	   			<input type="submit" class="submit-warning" name="action" value="Delete">
	   		</div>
	   	</form>
	   </li>
	<?php endforeach; ?> 
	</ul> 
	<?php include '../footer.inc.html.php'; ?>

</body>
</html>