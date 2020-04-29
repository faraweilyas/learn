<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PDO: Fetching All Rows</title>
    <link href="../css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<?php require_once '../includes/config.php'; ?>
	<h1>PDO: Fetching All Rows in a Result Set</h1>
	<?php
	    $sql 	= 'SELECT name, meaning, gender FROM names ORDER BY name';
		$result = $db->query($sql);
		// PDO::FETCH_ASSOC PDO::FETCH_NUM
	    $all 	= $result->fetchAll(PDO::FETCH_ASSOC);
	    dump($all);
	?>
</body>
</html>
