<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PDO: SELECT Loop</title>
    <link href="../css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<?php require_once '../includes/config.php'; ?>
	<h1>PDO: Looping Directly over a SELECT Query</h1>
	<?php
	    $sql = 'SELECT name, meaning, gender FROM names ORDER BY name';
	?>
	<table>
	    <tr>
	        <th>Name</th>
	        <th>Meaning</th>
	        <th>Gender</th>
	    </tr>
	    <?php foreach ($db->query($sql) as $row): ?>
	    <tr>
	        <td><?= $row['name']; ?></td>
	        <td><?= $row['meaning']; ?></td>
	        <td><?= $row['gender']; ?></td>
	    </tr>
	    <?php endforeach; ?>
	</table>
</body>
</html>
