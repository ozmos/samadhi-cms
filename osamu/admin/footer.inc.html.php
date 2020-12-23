</main>
<footer>
	<?php if ($pageId !== 'admin-home'): ?>
    <p><a class="button button-primary" href="..">Return to Admin Portal</a></p>
	<?php endif ?>
    <?php if ($_SESSION['loggedIn'] === TRUE) {
				include $_SERVER['DOCUMENT_ROOT'] . '/admin/logout.inc.html.php'; 
			} ?>
</footer>
</section>