<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Database Connection with PDO</title>
    <link href="css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<?php require_once 'includes/config.php'; ?>
	<h1>Connecting with PDO</h1>
	<p>Driver: <?= $config->driver; ?></p>
	<?php
		if ($db) echo "<p>Connection Successful.</p>";
	?>
</body>
</html>
