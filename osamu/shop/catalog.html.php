<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php'; ?>

<?php // Use count() function to output number of items in cart ?>
<p>Your Shopping cart contains <?php echo count($_SESSION['cart']); ?> items</p>
<?php // Provide link to view cart with query value of cart ?>
<p><a class="button button-info" href="?cart">View your cart</a></p>
<table>
	<thead>
		<tr>
			<th>Item Description</th>
			<th>Price</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($items as $item): ?>
			<tr>
				<td><?php htmlout($item['desc']); ?></td>
				<?php // use number_format() function to format numbers to display with 2 decimal places ?>
				<td>$<?php echo number_format($item['price'], 2); ?></td>
				<td>
					<form action="" method="post">
						<?php // Provide buy button for each item that submits the unique item ID ?>
						<div><input type="hidden" name="id" value="<?php echo escape($item['id']); ?>"></div>
						<div><input class="submit-success" type="submit" name="action" value="Buy"></div>
					</form>
				</td>
			</tr>
			
		<?php endforeach ?>
	</tbody>
</table>
<em class="has-text-info">*All Prices are in imaginary dollars.</em>