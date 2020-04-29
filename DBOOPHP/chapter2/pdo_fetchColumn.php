<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PDO: Fetching a Column</title>
    <link href="../css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<?php require_once '../includes/config.php'; ?>
	<h1>PDO: Fetching a Single Column</h1>
	<?php
	    $sql 	= 'SELECT name, meaning, gender FROM names ORDER BY name';
	    $result = $db->query($sql);
	?>
	<table>
	    <tr>
	        <th>Column</th>
	    </tr>
	    <?php while($col = $result->fetchColumn(1)) { ?>
	    <tr>
	        <td><?= $col; ?></td>
	    </tr>
	    <?php } ?>
	</table>
</body>
</html>
