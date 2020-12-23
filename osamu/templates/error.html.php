<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Error</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<section class="outer">
		<header class="page-header">
			<h1 class="page-title">Error</h1>
		</header>
		<main>
			<p>
				
			<?php echo ($error); ?>
			</p>
		</main>
	</section>
</body>
</html>