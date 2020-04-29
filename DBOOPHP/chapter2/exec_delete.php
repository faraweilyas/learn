<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>PDO: Delete using exec</title>
	<link href="../css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<?php require_once '../includes/config.php'; ?>
	<h1>PDO: Delete using exec</h1>
	<?php
		$sql 		= 'DELETE FROM names WHERE name = "willow"';
		$affected 	= $db->exec($sql);
		echo ($affected) ? "Query Successful: ".$affected.' records deleted' : "Query Failed!";
	?>
</body>
</html>
