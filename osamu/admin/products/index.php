<?php 

include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/access.inc.php';

if (!userIsLoggedIn()) {
	include '../login.html.php';
	exit();
}

if (!userHasRole('Account Administrator')) {
	$error = 'Only Account Administrators may access this page.';
	include '../accessdenied.html.php';
	exit();
}

// ****************************************************************************
// *                                Add Product                                *
// ****************************************************************************

// display the new product form
if (isset($_GET['add'])) {

	$pageTitle = 'New Product';
	$action = 'addform';
	$description = '';
	$price = '';
	$id = '';
	$button = 'Add Product';

	include 'form.html.php';
	exit();
}

// Add new product details
if (isset($_GET['addform'])) {
	// form validation
	checkForm(['description', 'price']);
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
	try {
		$sql = 'INSERT INTO products SET
			description = :description,
			price = :price';
		$s = $pdo->prepare($sql);
		$s->bindValue(':description', $_POST['description']);
		$s->bindValue(':price', $_POST['price']);
		$s->execute();	
	} catch (PDOException $e) {
		errorMsg('Error adding product', $e);
	}

	header('Location: .');
	exit();
}

// ****************************************************************************
// *                                Edit product                               *
// ****************************************************************************

if (isset($_POST['action']) && $_POST['action'] == 'Edit') {
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
	// $pdo = connectToDb();
	try {
		$sql = 'SELECT id, description, price FROM products WHERE id = :id';
		$s = $pdo->prepare($sql);
		$s->bindValue(':id', $_POST['id']);
		$s->execute();
	} catch (PDOException $e) {
		errorMsg('Error fetching product details.', $e);
	}

	$row = $s->fetch();

	$pageTitle = 'Edit product';
	$action = 'editform';
	$description = $row['description'];
	$price = $row['price'];
	$id = $row['id'];
	$button = 'Update product';


	include 'form.html.php';
	exit();
}

if (isset($_GET['editform'])) {
	checkForm(['description', 'price']);
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

	try {
		$sql = 'UPDATE products SET
			description = :description,
			price = :price
			WHERE id = :id';
		$s = $pdo->prepare($sql);
		$s->execute(array(
			':id' => $_POST['id'],
			':description' => $_POST['description'],
			':price' => $_POST['price']
		));
	} catch (PDOException $e) {
		errorMsg('Error updating submitted product.', $e);
	}

	header('Location: .');
	exit();
}

// ****************************************************************************
// *                                  Delete                                  *
// ****************************************************************************

if (isset($_POST['action']) && $_POST['action'] == 'Delete') {
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

	// Delete the product
	try {
		$sql = 'DELETE FROM products WHERE id = :id';
		$s = $pdo->prepare($sql);
		$s->bindValue(':id', $_POST['id']);
		$s->execute();
	} catch (PDOException $e) {
		errorMsg('Error deleting product.', $e);
	}
	header('Location: .');
	exit();
}


// ****************************************************************************
// *                          Display the product list                         *
// ****************************************************************************
include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

try {
	$result = $pdo->query('SELECT id, description FROM products');
	$pageTitle = 'Manage products';
} catch (PDOException $e) {
	$error = errorMsg( 'Error fetching products from database', $e);
}

foreach ($result as $row) {
	$products[] = array('id' => $row['id'], 'description'=> $row['description']);
}

include 'products.html.php';

?>