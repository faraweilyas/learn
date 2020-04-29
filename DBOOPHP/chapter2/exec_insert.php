<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>PDO: Insert using exec</title>
	<link href="../css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<?php require_once '../includes/config.php'; ?>
	<h1>PDO: Insert using exec</h1>
	<?php
		$sql    	= 'INSERT INTO names (name, meaning, gender) VALUES ("Willow", "willow smith", "girl")';
	    $affected 	= $db->exec($sql);
		echo ($db->lastInsertId() >= 1) ? "Query Successful: ".$affected.' row inserted with ID: '.$db->lastInsertId() : "Query Failed!";
	?>
</body>
</html>
