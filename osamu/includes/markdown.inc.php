<?php 

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

 ?>