	<p>Total scrapped objects: <?php echo count($entries) ?> from <?php echo $pages ?> pages.</p>
	<hr />
	<ol>
	<?php foreach ($entries as $entry): ?>
		<li><?php echo $entry ?></li>
	<?php endforeach; ?>
	</ol>