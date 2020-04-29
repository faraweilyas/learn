<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <title>PDO: Insert using query</title>
	<link href="../css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<?php require_once '../includes/config.php'; ?>
	<h1>PDO: Insert using query</h1>
	<?php
		$sql    = 'INSERT INTO names (name, meaning, gender) VALUES ("Willow", "willow smith", "girl")';
	    $result = $db->query($sql);
	    echo ($result) ? "Query Successful: ".$result->queryString : "Query Failed!";
	?>
</body>
</html>
