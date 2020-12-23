<?php 
include $_SERVER['DOCUMENT_ROOT'] . '/admin/header.inc.html.php';
?>


	<?php if (isset($articles)): ?>
		<section>
			<?php foreach ($articles as $article): ?>
			<article class="card">
				<h2><?php htmlout($article['title']); ?></h2>
				<section><?php markdownOut(excerpt($article['text'], 300)); ?></section>
				<?php if (isset($article['img'])): ?>
					
				<section class="thumb">
					<img src="../../uploads/<?php htmlout($article['img']); ?>" alt="<?php htmlout($article['alt']); ?>" width="150px">
				</section>
				<?php endif ?>
				<section>
					<form action="?" method="post">
						<div>
							<input type="hidden" name="id" value="<?php htmlout($article['id']); ?>">
							<input type="submit" class="submit-primary" name="action" value="Edit">
							<input type="submit" class="submit-warning" name="action" value="Delete">
						</div>
					</form>
				</section>
			</article>	
			<?php endforeach ?>
		</section>
	<?php else: ?>
		<p>No search results for those criteria</p>
	<?php endif ?>
	<p><a class="button button-success" href="?">New search</a></p>
	<?php include '../footer.inc.html.php'; ?>
</body>
</html>

