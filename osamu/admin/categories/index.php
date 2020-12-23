<?php 

include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/access.inc.php';

if (!userIsLoggedIn()) {
	include '../login.html.php';
	exit();
}

if (!userHasRole('Site Administrator')) {
	$error = 'Only Site Administrators may access this page.';
	include '../accessdenied.html.php';
	exit();
}

// ****************************************************************************
// *                              ADD A CATEGORY                              *
// ****************************************************************************

if (isset($_GET['add'])) {
	$pageTitle = 'New Category';
	$action = 'addform';
	$name = '';
	$id = '';
	$button = 'Add category';

	include 'form.html.php';
	exit();
}

if (isset($_GET['addform'])) {
	checkForm(['name']);
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
	// $pdo = connectToDb();
	try {
		$sql = 'INSERT INTO category SET
			name = :name';
		$result = query($pdo, $sql, array(':name' => $_POST['name']));
	} catch (PDOException $e) {
		errorMsg('Error adding submitted category', $e);
	}

	header('Location: .');
	exit();
}

// ****************************************************************************
// *                              EDIT A CATEGORY                             *
// ****************************************************************************

if (isset($_POST['action']) && $_POST['action'] == 'Edit') {
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

	try {
		$sql = 'SELECT id, name FROM category WHERE id = :id';
		$result = query($pdo, $sql, array(':id' => $_POST['id']));
	} catch (PDOException $e) {
		errorMsg('Error fetching category details.', $e);
	}

	$row = $result->fetch();

	$pageTitle = 'Edit Category';
	$action = 'editform';
	$name = $row['name'];
	$id = $row['id'];
	$button = 'Update category';

	include 'form.html.php';
	exit();
}

if (isset($_GET['editform'])) {
	checkForm(['name']);
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

 	try {
 		$sql = 'UPDATE category SET
 			name = :name
 			WHERE id = :id';
		$result = query($pdo, $sql, array(':id' => $_POST['id'], ':name' =>$_POST['name']));
 	} catch (PDOException $e) {
 		errorMsg('Error updating submitted category.', $e);
 	}

 	header('Location: .');
	exit();
}

// ****************************************************************************
// *                             DELETE A CATEGORY                            *
// ****************************************************************************

if (isset($_POST['action']) && $_POST['action'] == 'Delete') {
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

	// Delete article associations with this category
	try {
		$sql = 'DELETE FROM article_category WHERE category_id = :id';
		$result = query($pdo, $sql, array(':id' => $_POST['id']));
	} catch (PDOException $e) {
		errorMsg('Error removing articles from category', $e);
	}

	// Delete the category
	try {
		$sql = 'DELETE FROM category WHERE id = :id';
		$result = query($pdo, $sql, array(':id' => $_POST['id']));
	} catch (PDOException $e) {
		errorMsg('Error deleting category', $e);

	}

	header('Location: .');
	exit();
}


// ****************************************************************************
// *                           DISPLAY CATEGORY LIST                          *
// ****************************************************************************

include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

try {
	$result = $pdo->query('SELECT id, name FROM category');
	$pageTitle = 'Manage Categories';
} catch (PDOException $e) {
	errorMsg('Error fetching categories fromn database!', $e);
}

foreach ($result as $row) {
	$categories[] = array('id' => $row['id'], 'name' => $row['name']);
}

include 'categories.html.php';