<?php 
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
include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php';
$targetDir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/';

// ****************************************************************************
// *                              ADD AN IMAGE                                *
// ****************************************************************************



// image upload form
if (isset($_GET['add'])) {
	$pageTitle = 'New Image';
	$action = 'addform';
	$name = '';
	$id = '';
	$alt = '';
	$button = 'Upload';

	
	include 'form.html.php';
	exit();
}

if (isset($_GET['addform'])) {
	// form validation
	checkForm(['name', 'alt-text'], 'image');
	/* ADD FILE TO UPLOADS FOLDER */
	// TODO change echo to error check
	// @link https://www.w3schools.com/php/php_file_upload.asp
	
	$targetFile = basename($_FILES['image']['name']);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
	$allowableTypes = array('jpg', 'png', 'jpeg', 'gif', 'svg');
	$size = $_POST['MAX_FILE_SIZE'];
	$fileName = $_POST['name'] . '.' . $imageFileType;
	// change file name to the submitted name
	$targetFile = $targetDir . $fileName;

	// check if file is image
	if (isset($_POST['Upload'])) {
		if (getimagesize($_FILES['image']['tmp_name']) == FALSE) {
			$error = errorMsg('File is not an image, click "back" and try a different file');
		}
	}

	// check if file exists
	if (file_exists($targetFile)) {
		$error = errorMsg('Sorry, file exists', $e);
	}

	// check file size
	if ($_FILES['image']['size'] > 300000 ) {
		$error = errorMsg('File cannot exceed 3kb, click "back" and try a different file');
	}

	// Allow certain file formats
	if (!in_array($imageFileType, $allowableTypes)) {
		$extensions = implode(', ', $allowableTypes);
		$error = 'Sorry only ' . $extensions . ' type files are allowed.';
		$error = errorMsg($error);
	}

	// Check if upload is allowed
	if (!isset($error)) {
		if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
			$success = TRUE;
		} else {
			$error = 'Error uploading file ' . $_FILES['image']['error'];
			$error = errorMsg($error);
		}	
	}	
	else {
		errorMsg('Unable to upload file');
		
	}
	
	
	
	/* ADD IMAGE NAME TO DATEABASE */
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

	try {
		$sql = 'INSERT INTO image SET
			`name` = :name,
			`alt_text` = :alt_text';
		$result = query($pdo, $sql, array(':name' => $fileName, ':alt_text' => $_POST['alt-text']));
	} catch (PDOException $e) {
		errorMsg('Error adding submitted image', $e);
	}
	header('Location: .');
	exit();
} 

// ****************************************************************************
// *                            EDIT IMAGE DETAILS                            *
// ****************************************************************************

if (isset($_POST['action']) && $_POST['action'] == 'Edit') {
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

	try {
		$sql = 'SELECT `id`, `name`, `alt_text` AS "alt" FROM image WHERE id = :id';
		$result = query($pdo, $sql, array(':id' => $_POST['id']));
	} catch (PDOException $e) {
		errorMsg('Error fetching image details.', $e);
	}

	$row = $result->fetch();

	$pageTitle = 'Edit Image';
	$action = 'editform';
	$name = $row['name'];
	$id = $row['id'];
	$alt = $row['alt'];
	$button = 'Update Image Details';

	include 'form.html.php';
	exit();
}

if (isset($_GET['editform'])) {
 	// form validation
	checkForm(['name', 'alt-text']);
 	// rename file if necessary
 	if (isset($_POST['name'])) {
 		try {
 			$dir = $targetDir;//'../../uploads/';
 			$old = $dir . $_POST['old'];
 			$new = $dir . $_POST['name'];
 			rename($old, $new);
 		} catch (Exception $e) {
 			errorMsg('Error renaming file', $e);
 		}
 	}

 	// update details in database
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
 	try {
 		$sql = 'UPDATE `image` SET
 			`name` = :name,
 			`alt_text` = :alt_text
 			WHERE id = :id';
		$result = query($pdo, $sql, array(':id' => $_POST['id'], ':name' =>$_POST['name'], ':alt_text' => $_POST['alt-text']));
 	} catch (PDOException $e) {
 		errorMsg('Error updating submitted image.', $e);
 	}
 	header('Location: .');
	exit();
}


// ****************************************************************************
// *                               DELETE IMAGE                               *
// ****************************************************************************

if (isset($_POST['action']) && $_POST['action'] == 'Delete') {
	// Delete from database
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

	// Delete from filesystem

	try {
		$sql = 'SELECT `name` FROM `image` WHERE `id` = :id';
		$result = query($pdo, $sql, array(':id' => $_POST['id']));
		$row = $result->fetch();
		if ($row !== FALSE) {
			$fileName = $targetDir . $row['name']; 
			unlink($fileName);
		} else {
			errorMsg('Error deleting image from filesystem', $e);
		}
	} catch (PDOException $e) {
		errorMsg('Error deleting image from filesystem', $e);
	}
	try {
		$sql = 'DELETE FROM `image` WHERE `id` = :id';
		$result = query($pdo, $sql, array(':id' => $_POST['id']));
	} catch (PDOException $e) {
		errorMsg('Error deleting image from database', $e);
	}
	header('Location: .');
	exit();
}
// ****************************************************************************
// *                              DISPLAY IMAGES                              *
// ****************************************************************************



	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

	try {
		$sql = 'SELECT `id`, `name`, `alt_text` AS "alt"
				FROM `image`';
		$result = $pdo->query($sql);
		$pageTitle = 'Manage Images';
	} catch (PDOException $e) {
		errorMsg('Error getting images from database', $e);
	}

	$images = $result->fetchAll();

	include 'media.html.php';
	
	exit();


displayImages();
