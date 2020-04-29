<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PDO: Fetching a Row</title>
    <link href="../css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<?php require_once '../includes/config.php'; ?>
	<h1>PDO: Fetching the Next Row</h1>
	<?php
	    $sql 	= 'SELECT name, meaning, gender FROM names ORDER BY name';
		$result = $db->query($sql);
	?>
	<table>
	    <tr>
	        <th>Name</th>
	        <th>Meaning</th>
	        <th>Gender</th>
	    </tr>
	    <?php while ($row = $result->fetch()) { ?>
	    <tr>
	        <td><?= $row[0]; ?></td>
	        <td><?= $row['meaning']; ?></td>
	        <td><?= $row['gender']; ?></td>
	    </tr>
	    <?php } ?>
	</table>
</body>
</html>
