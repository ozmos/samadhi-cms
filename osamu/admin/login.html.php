<?php 
$pageTitle = 'Log in';
include 'header.inc.html.php'; ?>

	<p>Please log in to view the page that you requested</p>
	<?php if (isset($loginError)): ?>
		<p><?php htmlout($loginError); ?></p>
	<?php endif ?>
	<form action="" method="post">
		<div>
			<label for="email">Email: <input type="text" name="email" id="email"></label>
		</div>
		<div>
			<label for="password">Password: <input type="password" name="password" id="password"></label>
		</div>
		<div>
			<input type="hidden" name="action" value="login">
			<input type="submit" class="submit-success" value="Log in">
		</div>
		<p><a href="/admin/">Return to Admin Portal</a></p>
	</form>
</body>
</html>