<?php 
include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/access.inc.php';

if (!userIsLoggedIn())
{
	include '../login.html.php';
	exit();
}
if (!userHasRole('Content Editor'))
{
	$error = 'Only Content Editors may access this page.';
	include '../accessdenied.html.php';
	exit();
}

// ****************************************************************************
// *                               ADD NEW ARTICLE FORM                       *
// ****************************************************************************

if (isset($_GET['add'])) {
	// page variables
	$pageTitle = 'New Article';
	$action = 'addform';
	$text = '';
	$authorid = '';
	$id = '';
	$articleTitle = '';
	$articleDescription = '';
	$button = 'Publish Article';

	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
	// connectOnce();

	// build the list of authors
	try {
		$result = $pdo->query('SELECT id, name FROM author');
	} catch (PDOException $e) {
		errorMsg('Error fetching list of authors', $e);
	}

	foreach ($result as $row) {
		$authors[] = array('id' => $row['id'], 'name' => $row['name']);
	}

	// Build the list of categories
	try {
		$result = $pdo->query('SELECT id, name FROM category');
	} catch (PDOException $e) {
		errorMsg( 'Error fetching list of categories', $e);		
	}

	foreach ($result as $row) {
		$categories[] = array('id' => $row['id'], 'name' => $row['name'], 'selected' => FALSE);
	}

	
	$images = getAllImages($pdo);
	include 'form.html.php';
	exit();
}

// ****************************************************************************
// *                               HANDLE ADD NEW article                        *
// ****************************************************************************

if (isset($_GET['addform'])) {
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

	// handle no author selected
	if ($_POST['author'] == '') {
	
		$error = errorMsg('You must choose an author for this article.
		Click "back" and try again.');

	}

	// handle no title entered
	if ($_POST['title'] == '') {
	
		$error = errorMsg('You must enter a title for this article.
		Click "back" and try again.');

	}

	// add new article
	try {
		$sql = 'INSERT INTO article SET
			`title` = :title,
			`description` = :description,
			`text` = :articletext,
			`date` = CURDATE(),
			`featured_image` = :image,
			`author_id` = :authorid';
			$image = $_POST['image'] == '' ? NULL : $_POST['image'];
			$s = query($pdo, $sql, array(':title' => $_POST['title'], ':description' => $_POST['description'], ':articletext' => $_POST['text'], 'image' => $image, ':authorid' => $_POST['author']));
	} catch (PDOException $e) {
		errorMsg( 'Error adding submitted article');
	}

	$articleid = $pdo->lastInsertId(); // see page 230 phpn2n e5 

	// handle add category(s)
	if (isset($_POST['categories'])) {
		try {
			$sql = 'INSERT INTO article_category SET
				article_id = :articleid,
				category_id = :categoryid';
			$s = $pdo->prepare($sql);

			foreach ($_POST['categories'] as $categoryid) {
				$s->bindValue(':articleid', $articleid);
				$s->bindValue(':categoryid', $categoryid);
				$s->execute();	
			}
		} catch (PDOException $e) {
			errorMsg( 'Error inserting article into the selected categories');			
		}
	}


	header('Location: .');
	exit();
}


// ****************************************************************************
// *                                EDIT ARTICLE FORM                         *
// ****************************************************************************

if (isset($_POST['action']) && $_POST['action'] == 'Edit') {
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

	try {
		$sql = 'SELECT `id`, `text`, `author_id`, `title`, `description`, `featured_image` FROM `article` WHERE id = :id';
		$s = query($pdo, $sql, array(':id' => $_POST['id']));
	} catch (PDOException $e) {
		errorMsg('Error fetching article details', $e);
	}

	$row = $s->fetch();

	// page variables
	$pageTitle = 'Edit Article';
	$action = 'editform';
	$text = $row['text'];
	$authorid = $row['author_id'];
	$articleTitle = $row['title'];
	$articleDescription = $row['description'];
	$imageid = $row['featured_image'];
	$id = $row['id'];
	$button = 'Update Article';
	$selectedCategories = array();

	// build the list of authors
	try {
		$result = $pdo->query('SELECT id, name FROM author');
	} catch (PDOException $e) {
		errorMsg('Error fetching list of authors', $e);
	}

	foreach ($result as $row) {
		$authors[] = array('id' => $row['id'], 'name' => $row['name']);
	}

	// Get a list of categories containing this article
	try {
		$sql = 'SELECT category_id FROM article_category WHERE article_id = :id';
		$s = query($pdo, $sql, array(':id' => $id));		
	} catch (PDOException $e) {
		errorMsg('Error fetching list of selected categories', $e);
	}

	foreach ($s as $row) {
		$selectedCategories[] = $row['category_id'];
	}

	// Build the list of all categories
	try {
		$result = $pdo->query('SELECT id, name FROM category');
	} catch (PDOException $e) {
		errorMsg( 'Error fetching list of categories', $e);
	}

	foreach ($result as $row) {
		$categories[] = array(
			'id' => $row['id'],
			'name' => $row['name'],
			'selected' => in_array($row['id'], $selectedCategories)
		);
	}

	// Build list of all images
	$images = getAllImages($pdo);
	
	include 'form.html.php';
	exit();
}

// ****************************************************************************
// *                           HANDLE EDIT ARTICLE                            *
// ****************************************************************************

if (isset($_GET['editform'])) {
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

	// handle no author selected
	if ($_POST['author'] == '') {
	
		$error = errorMsg('You must choose an author for this article.
		Click "back" and try again.');

	}

	// handle no title entered
	if ($_POST['title'] == '') {
	
		$error = errorMsg('You must enter a title for this article.
		Click "back" and try again.');

	}

	try {
	$sql = 'UPDATE article SET
		`title` = :title,
		`description` = :description,
		`text` = :articletext,
		`date` = CURDATE(),
		`featured_image` = :image,
		`author_id` = :authorid
		WHERE `id` = :id';
		// echo var_dump($_POST['image']);
		$image = $_POST['image'] == '' ? NULL : $_POST['image'];
		$s = query($pdo, $sql, array(':id' => $_POST['id'], ':title' => $_POST['title'], ':description' => $_POST['description'], ':articletext' => $_POST['text'], ':image' => $image, ':authorid' => $_POST['author']));
	} catch (PDOException $e) {
		errorMsg( 'Error adding submitted article', $e);
	}

	// delete associated article-category pairs
	try {
		$sql = 'DELETE FROM article_category WHERE article_id = :id';
		query($pdo, $sql, array(':id' => $_POST['id']));
	} catch (PDOException $e) {
		errorMsg('Error removing obselete article category entries', $e);
	}

	// assign new categories
	if (isset($_POST['categories'])) {
		try {
			$sql = 'INSERT INTO article_category SET
				article_id = :articleid,
				category_id = :categoryid';
			$s = $pdo->prepare($sql);

			foreach ($_POST['categories'] as $categoryid) {
				$s->bindValue(':articleid', $_POST['id']);
				$s->bindValue(':categoryid', $categoryid);
			}
			$s->execute();
		} catch (PDOException $e) {
			errorMsg('Error inserting article into selected categories', $e);
		}
	}
	header('Location: .');
	exit();
}

// ****************************************************************************
// *                         HANDLE DELETE ARTICLE BUTTON                     *
// ****************************************************************************

if (isset($_POST['action']) && $_POST['action'] == 'Delete') {
	
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

	// Delete category assignments for this article
	try {
		$sql = 'DELETE FROM article_category WHERE article_id = :id';
		$s = query($pdo, $sql, array(':id' => $_POST['id']));	
	} catch (PDOException $e) {
		errorMsg($e, 'Error removing article from categories');
	}

	// Delete article
	try {
		$sql = 'DELETE FROM article WHERE id = :id';
		$s = query($pdo, $sql, array(':id' => $_POST['id']));
 	} catch (PDOException $e) {
		errorMsg($e, 'Error deleting article');
	}

	header('Location: .');
	exit();
}

// ****************************************************************************
// *                           HANDLE SEARCH QUERIES                          *
// ****************************************************************************

if (isset($_GET['action']) && $_GET['action'] == 'search') {
	include $_SERVER['DOCUMENT_ROOT'] .  '/includes/db.inc.php';

	// The basic SELECT statement
	$select = 'SELECT `article`.`id` AS "id", `title`, `text`, 
				`image`.`name` AS "img", `image`.`alt_text` AS "alt"';
	$from = ' FROM article';
	$join = ' LEFT OUTER JOIN `image` ON `featured_image` = `image`.`id`';
	$where = ' WHERE TRUE';
	$placeholders = array();

	// build up the query parts

	if ($_GET['author'] != '') { // an author is selected
		$where .= " AND author_id = :authorid";
		$placeholders[':authorid'] = $_GET['author'];
	}

	if ($_GET['category'] != '') { // A category is selected
		$from .= ' INNER JOIN article_category ON id = article_id';
		$where .= ' AND category_id = :categoryid';
		$placeholders[':categoryid'] = $_GET['category'];
	}

	if ($_GET['text'] != '') { // Some search text was specified	
		$where .= ' AND `text` LIKE :text';
		$placeholders[':text'] = '%' . $_GET['text'] . '%';
	}

	// execute query from parts
	try {
		$sql = $select . $from . $join . $where;
		$result = query($pdo, $sql, $placeholders);
	} catch (PDOException $e) {
		errorMsg('Error fetching articles', $e);
	}

	foreach ($result as $row) {
		$articles[] = array('id' => $row['id'], 'title' => $row['title'], 'text' => $row['text'], 'img' => $row['img'], 'alt' => $row['alt']);
	}

	$pageTitle = 'Manage articles: Search Results';
	include 'articles.html.php';
	exit();
}



// ****************************************************************************
// *                            DISPLAY SEARCH FORM                           *
// ****************************************************************************

include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

// get list of authors
try {
	$result = $pdo->query('SELECT id, name FROM author');
} catch (PDOException $e) {
	errorMsg( 'Error fetching authors from database.');
}

foreach ($result as $row) {
	$authors[] = array('id' => $row['id'], 'name' => $row['name']);
}

// get list of categories
try {
	$result = $pdo->query('SELECT id, name FROM category');
} catch (PDOException $e) {
	errorMsg( 'Error fetching categories from database', $e);
}

foreach ($result as $row) {
	$categories[] = array('id' => $row['id'], 'name' => $row['name']);
}
$pageTitle = 'Manage Articles';
include 'searchform.html.php';
 ?>