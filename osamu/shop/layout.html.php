<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/csp.inc.html.php'; ?>
	<title><?php echo $title; ?></title>
	<link rel="stylesheet" href="/admin/css/styles.css">
</head>
<body>
	<section class="outer">
		<header class="page-header">
			<h1 class="page-title"><?php echo $title ?></h1>
		</header>
		<main>
			
			<?php echo $output; ?>
		</main>
		
		<footer>
			<li><a class="button button-primary" href="/content/">Back to blog</a></li>
			<p>By Osamu Morozumi 2020</p>
		</footer>
	</section>
</body>
</html>