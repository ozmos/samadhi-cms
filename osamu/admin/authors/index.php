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
// *                                Add Author                                *
// ****************************************************************************

// display the new author form
if (isset($_GET['add'])) {
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

	$pageTitle = 'New Author';
	$action = 'addform';
	$name = '';
	$email = '';
	$id = '';
	$button = 'Add author';

	// build the list of roles
	try {
		$result = $pdo->query('SELECT id, description FROM role');
	} catch (PDOException $e) {
		errorMsg( 'Error fetching list of roles');
	}

	foreach ($result as $row) {
		$roles[] = array(
			'id' => $row['id'],
			'description' => $row['description'],
			'selected' => FALSE);
		
	}
	include 'form.html.php';
	exit();
}

// Add new author details
if (isset($_GET['addform'])) {
	// form validation
	checkForm(['name', 'email', 'password']);
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
	// $pdo = connectToDb();
	try {
		$sql = 'INSERT INTO author SET
			name = :name,
			email = :email';
		$s = $pdo->prepare($sql);
		$s->bindValue(':name', $_POST['name']);
		$s->bindValue(':email', $_POST['email']);
		$s->execute();	
	} catch (PDOException $e) {
		errorMsg('Error adding author', $e);
	}

	$authorid = $pdo->lastInsertId();

	if ($_POST['password'] != '') {
		$password = md5($_POST['password'] . 'ijdb');

		try {
			$sql = 'UPDATE author SET
					password = :password
					WHERE id = :id';
			$s = $pdo->prepare($sql);
			$s->bindValue(':password', $password);
			$s->bindValue(':id', $authorid);
			$s->execute();	
		} catch (PDOException $e) {
			errorMsg('Error setting author password', $e);
		}
	}

	if (isset($_POST['roles'])) {
		foreach ($_POST['roles'] as $role) {
			try {
				$sql = 'INSERT INTO author_role SET
					author_id = :authorid,
					role_id = :roleid';
				$s = query($pdo, $sql, array(':authorid'=>$authorid, ':roleid'=>$role));
			} catch (PDOException $e) {
				errorMsg('Error assigning selected role to author', $e);
			}
		}
	}
	header('Location: .');
	exit();
}

// ****************************************************************************
// *                                Edit Author                               *
// ****************************************************************************

if (isset($_POST['action']) && $_POST['action'] == 'Edit') {
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
	// $pdo = connectToDb();
	try {
		$sql = 'SELECT id, name, email FROM author WHERE id = :id';
		$s = $pdo->prepare($sql);
		$s->bindValue(':id', $_POST['id']);
		$s->execute();
	} catch (PDOException $e) {
		errorMsg('Error fetching author details.', $e);
	}

	$row = $s->fetch();

	$pageTitle = 'Edit Author';
	$action = 'editform';
	$name = $row['name'];
	$email = $row['email'];
	$id = $row['id'];
	$button = 'Update author';

	// Get list of roles assigned to this author
	try {
		$sql = 'SELECT role_id FROM author_role WHERE author_id = :id';
		$s = query($pdo, $sql, array(':id' => $id));
	} catch (PDOException $e) {
		errorMsg('Error fetching list of assigned roles', $e);
	}

	$selectedRoles = array();
	foreach ($s as $row) {
		$selectedRoles[] = $row['role_id'];
	}

	// build the list of all roles
	try {
		$result = $pdo->query('SELECT id, description FROM role');
	} catch (PDOException $e) {
		errorMsg('Error fetching list of roles', $e);
	}

	foreach ($result as $row) {
		$roles[] = array(
			'id' => $row['id'],
			'description' => $row['description'],
			'selected' => in_array($row['id'], $selectedRoles)
		);
	}

	include 'form.html.php';
	exit();
}

if (isset($_GET['editform'])) {
	checkForm(['name', 'email']);
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

	try {
		$sql = 'UPDATE author SET
			name = :name,
			email = :email
			WHERE id = :id';
		$s = $pdo->prepare($sql);
		$s->execute(array(
			':id' => $_POST['id'],
			':name' => $_POST['name'],
			':email' => $_POST['email']
		));
	} catch (PDOException $e) {
		errorMsg('Error updating submitted author.', $e);
	}

	// set new password
	if ($_POST['password'] != '') {
		$password = md5($_POST['password'] . 'ijdb');

		try {
			$sql = 'UPDATE author SET
					password = :password
					WHERE id = :id';
			$s = query($pdo, $sql, array(':password' => $password, ':id' => $_POST['id']));
		} catch (PDOException $e) {
			errorMsg('Error setting author password', $e);
		}
	}

	// delete obsolete role entries
	try {
		$sql = 'DELETE FROM author_role WHERE author_id = :id';
		$s = query($pdo, $sql, array(':id' => $_POST['id']));
	} catch (PDOException $e) {
		errorMsg('Error removing obsolete author role entries', $e);
	}

	// set new author roles
	if (isset($_POST['roles'])) {
		foreach ($_POST['roles'] as $role) {
			try {
				$sql = 'INSERT INTO author_role SET
						author_id = :authorid,
						role_id = :roleid';
				$s = query($pdo, $sql, array(':authorid' => $_POST['id'], ':roleid' => $role));
			} catch (PDOException $e) {
				errorMsg( 'Error assigning selected role to author');
			}
		}
	}
	header('Location: .');
	exit();
}

// ****************************************************************************
// *                                  Delete                                  *
// ****************************************************************************

if (isset($_POST['action']) && $_POST['action'] == 'Delete') {
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

	// Delete role assignments to author
	try {
		$sql = 'DELETE FROM author_role WHERE author_id = :id';
		$s = query($pdo, $sql, array(':id' => $_POST['id']));
	} catch (PDOException $e) {
		errorMsg('Error removing author from roles', $e);
	}

	// get articles belonging to author
	try {
		$sql = 'SELECT id FROM article WHERE author_id = :id';
		$s = $pdo->prepare($sql);
		$s->bindValue(':id', $_POST['id']);
		$s->execute();
	} catch (PDOException $e) {
		errorMsg('Error getting articles to delete', $e);
	}

	$result = $s->fetchAll();

	// Delete article category entries
	try {
		$sql = 'DELETE FROM article_category WHERE article_id = :id';
		$s = $pdo->prepare($sql);

		// For each article
		foreach ($result as $row) {
			$articleId = $row['id'];
			$s->bindValue(':id', $articleId);
			$s->execute();
		}		
	} catch (PDOException $e) {
		errorMsg('Error deleting category entries for article.', $e);
	}

	// Delete articles belonging to author
	try {
		$sql = 'DELETE FROM article WHERE author_id = :id';
		$s = $pdo->prepare($sql);
		$s->bindValue(':id', $_POST['id']);
		$s->execute();
	} catch (PDOException $e) {
		errorMsg('Error deleting article from author', $e);
	}

	// Delete the author
	try {
		$sql = 'DELETE FROM author WHERE id = :id';
		$s = $pdo->prepare($sql);
		$s->bindValue(':id', $_POST['id']);
		$s->execute();
	} catch (PDOException $e) {
		errorMsg('Error deleting author.', $e);
	}
	header('Location: .');
	exit();
}


// ****************************************************************************
// *                          Display the author list                         *
// ****************************************************************************
include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

try {
	$result = $pdo->query('SELECT id, name FROM author');
	$pageTitle = 'Manage Authors';
} catch (PDOException $e) {
	$error = errorMsg( 'Error fetching authors from database', $e);
}

foreach ($result as $row) {
	$authors[] = array('id' => $row['id'], 'name'=> $row['name']);
}

include 'authors.html.php';

?>