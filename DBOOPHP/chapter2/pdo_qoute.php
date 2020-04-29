<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>PDO: Using quote()</title>
	<link href="../css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<?php require_once '../includes/config.php'; ?>
	<h1>PDO: Escaping input with quote() method to sanitize</h1>
	<?php
		$searchTerm = $_GET['s'] ?? "";
		$sql    	= 'SELECT name, meaning FROM names WHERE name LIKE '.$db->quote('%'.$searchTerm.'%').' ORDER BY name';
		$result 	= $db->query($sql);
		$error 		= $db->errorInfo()[2] ?? "";
		if (!empty($error)):
			echo "<p>{$error}</p>";
		else:
	?>
	<form action="" method="get">
		Enter a name or part of one: <input type="search" name="s" value="<?= $searchTerm; ?>" />
		<input type="submit" value="Serch" />
	</form>
	<ul>
	<?php while ($row = $result->fetch()) { ?>
		<li>The meaning of <?= $row[0]; ?> is: <?= $row['meaning']; ?></li>
	<?php } ?>
	</ul>
	<?php endif; ?>
</body>
</html>
