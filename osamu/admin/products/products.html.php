
<?php 
include $_SERVER['DOCUMENT_ROOT'] . '/admin/header.inc.html.php';
?>
	<p><a class="button button-info" href="?add">Add new product</a></p>
	<ul>
	<?php foreach ($products as $product) : ?>
	   <li>
	   	<form action="" method="post">
	   		<div>
	   		<?php echo escape($product['description']); ?>
	   			<input type="hidden" name="id" value="<?php echo $product['id']; ?>">
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