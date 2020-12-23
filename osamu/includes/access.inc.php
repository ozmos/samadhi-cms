<?php 
// include_once 'helpers.inc.php';

/**
 * handles login, logout and invalid login
 * @return boolean or void 
 */
function userIsLoggedIn()
{
	if (isset($_POST['action']) and $_POST['action'] == 'login')
	{
		// echo (/*$_POST['password'] . ': ' . */$_POST['email']);
		if (!isset($_POST['email']) or $_POST['email'] == '' or
		!isset($_POST['password']) or $_POST['password'] == '')
		{
			$GLOBALS['loginError'] = 'Please fill in both fields';
			return FALSE;
		}
		// $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
		// $password = $_POST['password'];
		$password = md5($_POST['password'] . 'ijdb');
		
		if (databaseContainsAuthor($_POST['email'], $password))
		{
			session_start();
			$_SESSION['loggedIn'] = TRUE;
			$_SESSION['email'] = $_POST['email'];
			$_SESSION['password'] = $password;
			return TRUE;
		}
		else
		{
			session_start();
			unset($_SESSION['loggedIn']);
			unset($_SESSION['email']);
			unset($_SESSION['password']);
			$GLOBALS['loginError'] =
			'The specified email address or password was incorrect.';
			return FALSE;
			// echo "No dice";
		}
	} elseif (isset($_POST['action']) and $_POST['action'] == 'logout')
	{

		session_start();
		unset($_SESSION['loggedIn']);
		unset($_SESSION['email']);
		unset($_SESSION['password']);
		header('Location: ' . $_POST['goto']);
		exit();
	} else {
		session_start();
		if (isset($_SESSION['loggedIn']))
		{
			return databaseContainsAuthor($_SESSION['email'],
			$_SESSION['password']);
		}
	}
	
}

function databaseContainsAuthor($email, $password)
{
	include 'db.inc.php';

	// echo $email . '<br>' . $password;
	try
	{
		$sql = 'SELECT COUNT(*) FROM author
		WHERE email = :email AND password = :password';
		$s = $pdo->prepare($sql);
		$s->bindValue(':email', $email);
		$s->bindValue(':password', $password);
		$s->execute();
	}
	catch (PDOException $e)
	{
		errorMsg('Error searching for Author', $e);
	}
		$row = $s->fetch();
		if ($row[0] > 0)
	{
		return TRUE;
	}
	else
	{
		return FALSE;

	}
}

function userHasRole($role)
{
include 'db.inc.php';
try
{
$sql = "SELECT COUNT(*) FROM author
INNER JOIN author_role ON author.id = author_id
INNER JOIN role ON role_id = role.id
WHERE email = :email AND role.id = :roleId";
$s = $pdo->prepare($sql);
$s->bindValue(':email', $_SESSION['email']);
$s->bindValue(':roleId', $role);
$s->execute();
}
catch (PDOException $e)
{
errorMsg('Error searching for author roles', $e);
}
$row = $s->fetch();
if ($row[0] > 0)
{
return TRUE;
}
else
{
return FALSE;
}
}













 ?>