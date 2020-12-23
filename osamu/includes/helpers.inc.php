<?php 
// ****************************************************************************
// *                             TEXT FORMATTING                              *
// ****************************************************************************
 

/**
 * Makes text safe for output by escaping special characters
 * @param  string $str text input which may contain special characters
 * @return string      text output with special characters safely escaped as html entities
 */
function escape(string $str): string
{
	return trim(htmlspecialchars($str, ENT_HTML5, 'UTF-8'));
}

/**
 * echos escaped text
 * @param  string $str text to be escaped
 * @return null  no return statement      
 */
function htmlout(string $str): void
{
	echo escape($str);
}

// ****************************************************************************
// *                                 MARKDOWN                                 *
// ****************************************************************************

function parse(string $text): string {
	// headings
	// $text = preg_replace('/## (.+)/i', '<h2>$1</h2>', $text);
	// strong emphasis - ? modifier makes it non-greedy
	$text = preg_replace('/__(.+?)__/s', '<strong>$1</strong>', $text);
	$text = preg_replace('/\*\*(.+?)\*\*/s', '<strong>$1</strong>', $text);

	// emphasis
	$text = preg_replace('/_([^_]+)_/', '<em>$1</em>', $text);
	$text = preg_replace('/\*([^\*]+)\*/', '<em>$1</em>', $text);
		// [linked text](link URL)
	$text = preg_replace('/\[([^\]]+)]\(([-a-z0-9._~:\/?#@!$&\'()*+,;=%]+)\)/i',
'<a href="$2">$1</a>', $text);
	return $text;
}

function addBlocks(string $text): string {

	// h6
	if (preg_match('/^######\s.+$/i', $text)) {
		return preg_replace('/######\s(.+)/i', '<h6>$1</h6>', $text);
		// h5
	} elseif (preg_match('/^#####\s.+$/i', $text)) { 
		return preg_replace('/#####\s(.+)/i', '<h5>$1</h5>', $text);
		// h4
	} elseif (preg_match('/^####\s.+$/i', $text)) { //h5
		return preg_replace('/####\s(.+)/i', '<h4>$1</h4>', $text);
		// h3
	} elseif (preg_match('/^###\s.+$/i', $text)) { //h5
		return preg_replace('/###\s(.+)/i', '<h3>$1</h3>', $text);
		// h2
	} elseif (preg_match('/^##\s.+$/i', $text)) { //h5
		return preg_replace('/##\s(.+)/i', '<h2>$1</h2>', $text);
		// h1
	} elseif (preg_match('/^#\s.+$/i', $text)) { //h5
		return preg_replace('/#\s(.+)/i', '<h1>$1</h1>', $text);
		// paragraphs
	} else { 
		return '<p>' . $text . '</p>';
	}
}

function markdown(string $text): string
{
	// first escape special characters safely
	$text = escape($text);

	// Convert Windows
	$text = str_replace("\r\n", "\n", $text);
	// Convert Mac
	$text = str_replace("\r", "\n", $text);

	// split text into array at new lines
	$array = preg_split('/\n/', $text);

	$array = array_map('parse', $array);

	$array = array_map('addBlocks', $array);

	$text = implode('', $array);
	
	// Line breaks
	$text = str_replace("\n\n", '<br>', $text);

	return $text;
}


function markdownOut(string $text): void
{
	echo markdown($text);
}


function excerpt($str, $limit) {
	$str = substr($str, 0, $limit);
	$str = strip_tags($str);
	return $str;
}



// ****************************************************************************
// *                             DATABASE HELPERS                             *
// ****************************************************************************

/**
 * error handling function, gets error template and exits database connection safely
 * @param  string $msg error message
 * @param [type] $[name] [<description>]
 * @return string      error message
 */
function errorMsg(string $msg, $e = null): string
{
	$error = $msg;
	if (!is_null($e)) {
		$error .= '. <br>' . $e->getMessage() . ' in <br>'
		 . 'File: ' . $e->getFile() . ', on line: ' . $e->getLine();
	}
	include $_SERVER['DOCUMENT_ROOT'] . '/templates/error.html.php';
	exit();
	return $error; 

}

/**
 * executes query using prepared statement (from PHP N2N E6)
 * @param  PDO    $pdo        PDO Object
 * @param  string $sql        sql query
 * @param  array  $parameters values to be bound
 * @return object             query object
 */
function query(PDO $pdo, string $sql, array $parameters = [])
{
	$query = $pdo->prepare($sql);

	foreach ($parameters as $name => $value ) {
		$query->bindValue($name, $value);
	}

	$query->execute();
	return $query;
}

/**
 * grabs the server connection code
 * @return null returns nothing
 */
function connectOnce(): void
{
	include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
	return;
}

/**
 * executes try catch statement with pdo->query method 	
 * @param  string $sql query string
 * @param  string $error error message
 * @return object      query result or error message (can return void)
 */
function tryQuery(string $sql, string $error): ?object
{
	try {
		$result = $pdo->query('SELECT id, name FROM author');
	} catch (PDOException $e) {
		errorMsg($e, $error);
	}

	return $result ? $result : null;
}

/**
 * Gets all available images from database
 * @param  PDO    $pdo PDO object
 * @return array      array of image attributes
 */
function getAllImages(PDO $pdo): array {

	try {
		$result = $pdo->query('SELECT id, name, alt_text FROM image');	
	} catch (PDOException $e) {
		errorMsg('Error fetching the list of images', $e);
	}

	foreach ($result as $row) {
		$images[] = array('id' => $row['id'], 'name' => $row['name'], 'alt' => $row['alt_text']);
	}

	return $images;
}

// ****************************************************************************
// *                              FORM VALIDATION                             *
// ****************************************************************************

function checkForm(array $fields, string $file = null): void {
	$error = [];
	foreach ($fields as $field) {
		if (!isset($_POST[$field]) || $_POST[$field] == '') {
			$error[] = 'You must enter a value for "' . $field . '"';
			}
		}
		
	
	if (!is_null($file)) {
		if (!isset($_FILES) || $_FILES[$file]['name'] == '') {
			$error[] = 'You must select a file for "' . $file . '"';
		}
	}

	// callback for map
	function addLi($str) {
		return '<li>' . $str . '</li>';
	}

	if (count($error) > 0) {
		
		$error = array_map('addLi', $error);
		$error = '<ul>' . implode('', $error) . '<li class="is-action">Click "back" and try again</li>' . '</ul>';
		errorMsg($error);
	}

}




