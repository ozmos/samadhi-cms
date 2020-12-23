<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php'; ?>

<!-- Shopping cart -->
<?php if (count($cart) > 0): ?>
	<table>
		<thead>
			<tr>
				<th>Item Description</th>
				<th>Price</th>
			</tr>
		</thead>
		<tfoot>
			<tr class="total">
				<td>Total:</td>
				<td><?php echo number_format($total, 2); ?></td>
			</tr>
		</tfoot>
		<tbody>
			<?php foreach ($cart as $item): ?>
				<tr>
					<td><?php echo escape($item['desc']); ?></td>
					<td><?php echo escape($item['price'], 2) ?></td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
<?php else: ?>
<p>Your Cart is empty!</p>
<?php endif; ?>
<form action="?" method="post">
	<p><a class="button button-primary" href="?">Continue shopping</a> or <input class="submit-success" type="submit" name="action" value="Empty cart"></p>
</form>