<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Scrappr</title>
	<link rel="stylesheet" href="static/screen.css" />
	<link rel="stylesheet" href="static/main.css" />
	
	<script type="text/javascript" src="static/jquery.min.js"></script>
	<script type="text/javascript" src="static/main.js"></script>

</head>
<body class="container">
	<header class="append-9 prepend-9 span-6">
		<h1>Scrapp<span>r</span></h1>
		<form method="post" action="index.php">
			<label>	
				Pagination page URL <em>use %d to mark the page number</em>
				<input type="text" name="format" placeholder="http://www.zycze.pl/zyczenia,dzien-matki,30,%d,1.html"  value="<?php echo $format ?>" />
			</label>
			<label>
				Single entry selector <em>CSS3</em>
				<input type="text" name="selector" placeholder=".row_e p span" value="<?php echo $selector ?>" />
			</label>
			
			<fieldset>
				<legend>Advanced Scrapping Settings</legend>
				<label>
					Start with page
					<input type="number" name="start" tabindex="-1" value="<?php echo $start ?>" />
				</label>
				
				<label>
					Page number is increased by
					<input type="number" name="increase" tabindex="-1" value="<?php echo $increase ?>" />
				</label>
				
				<label>
					Limit scrapped pages <em>0 for no-limit</em>
					<input type="number" name="limit" tabindex="-1" value="<?php echo $limit ?>" />
				</label>
				
				<label>
					Output format:
					<select name="output" tabindex="-1">
						<option value="html">HTML</option>
						<option value="sqlite">sqlite db</option>
					</select>
				</label>
				
				
			</fieldset>
			
			<p><input type="submit" value="Scrap'em all!" /></p>
		</form>
	</header>
	
	<div id="placeholder" class="prepend-1 span-22 append-1">
		<div id="content">
		
		<?php if ($downloadId):?>
			<p class="span-4 append-10 prepend-10 download" ><a href="download/<?php echo $downloadId ?>" target="_blank">Download sqlite database</a></p>
		<?php elseif (count($entries)): ?>
				<ol>
				<?php foreach ($entries as $entry): ?>
					<li><?php echo $entry ?></li>
				<?php endforeach; ?>
				</ol>
		<?php endif ?>
		</div>
	</div>
</body>
</html>