<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PDO: Generating an Array</title>
    <link href="../css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<?php require_once '../includes/config.php'; ?>
	<h1>PDO: Generating an Array</h1>
	<?php
	    $sql 	= 'SELECT name, meaning FROM names';
		$result = $db->query($sql);
		// PDO::FETCH_ASSOC PDO::FETCH_NUM
	    $all 	= $result->fetchAll(PDO::FETCH_KEY_PAIR);
	    dump($all);
	?>
</body>
</html>
