<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PDO: Counting Rows</title>
    <link href="../css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<?php require_once '../includes/config.php'; ?>
	<h1>PDO: Counting Rows in a Result Set</h1>
	<?php
	    $sql 	= 'SELECT name, meaning, gender FROM names ORDER BY name';
	    $result = $db->query($sql);
	    $count 	= ($config->driver == "sqlite")
	    		? $db->query('SELECT COUNT(*) FROM names')->fetchColumn()
	    		: $result->rowCount();
	?>
	<p>Total results found: <?= $count; ?></p>
	<table>
	    <tr>
	        <th>Name</th>
	        <th>Meaning</th>
	        <th>Gender</th>
	    </tr>
	    <?php while($row = $result->fetch()) { ?>
        <tr>
            <td><?= $row['name']; ?></td>
            <td><?= $row['meaning']; ?></td>
            <td><?= $row['gender']; ?></td>
        </tr>
	    <?php } ?>
	</table>
</body>
</html>
