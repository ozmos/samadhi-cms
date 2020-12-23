<?php 

// ****************************************************************************
// *                               SHOPPING CART                              *
// ****************************************************************************
include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php';

try {
	include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
	$sql = 'SELECT `id`, `description` AS `desc`, `price` FROM `products`';
	$result = $pdo->query($sql);
	while ($row = $result->fetch()) {
			$items[] = $row;
	}
	session_start();
	// if session cart not set set it as empty array
	if (!isset($_SESSION['cart'])) {
		$_SESSION['cart'] = array();
		header('Location: ' . $_SERVER['PHP_SELF']);
		exit();
	}

	// process add to cart
	if (isset($_POST['action']) && $_POST['action'] == 'Buy') {
		// Add item id to the end of the session cart array
		$_SESSION['cart'][] = $_POST['id'];
		header('Location: ' . $_SERVER['PHP_SELF']);
		exit();
	}

	// handle empty cart
	if (isset($_POST['action']) && $_POST['action'] == 'Empty cart') {
		// Empty session cart array
		unset($_SESSION['cart']);
		header('Location: ?cart');
		exit();
	}

	// handle view cart link
	if (isset($_GET['cart'])) {
		$cart = array();
		$total = 0;

		foreach ($_SESSION['cart'] as $id) {
			// iterate through items array, adding the product to the cart array and the item price to the total count if the id matches one in the session cart array and breaking out of the loop
			foreach ($items as $product) {
				if ($product['id'] == $id) {
					$cart[] = $product;
					$total += $product['price'];
					break;
				}
			}
		}
		$title = 'Shopping Cart';
		ob_start();
		include  'cart.html.php';
		$output = ob_get_clean();
		include  'layout.html.php';
		exit();
	}

	// display the catalog templte
	$title = 'Product Catalog';
	ob_start();
	include 'catalog.html.php';
	$output = ob_get_clean();
	include  'layout.html.php';
	exit();
} catch (Exception $e) {
	errorMsg('Error retrieving products from database', $e);
}


 ?>