<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>PDO: Error Messages Exception</title>
	<link href="../css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<?php require_once '../includes/config.php'; ?>
	<h1>PDO: Getting Error Messages Exception</h1>
	<?php
		try
		{
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql    = 'SELECT name, meaning, genders FROM names ORDER BY name';
			$result = $db->query($sql);
			$error 	= "";
		} catch(Exception $e)
		{
		    $error = $e->getMessage();
		}
		if (!empty($error)):
			echo "<p>{$error}</p>";
		else:
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
	<?php endif; ?>
</body>
</html>
