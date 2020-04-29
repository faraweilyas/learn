<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <title>PDO: Anonymous Parameters</title>
	<link href="../css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<?php require_once '../includes/config.php'; ?>
	<h1>PDO Prepared Statement: Anonymous Parameters</h1>
	<?php
		$make 		= htmlentities($_GET['make'] ?? "");
		$yearmade 	= $_GET['yearmade'] ?? "";
		$price 		= $_GET['price'] ?? "";
        $sql 		= 'SELECT make, yearmade, mileage, price, description FROM cars LEFT JOIN makes USING (make_id) WHERE make LIKE ? AND yearmade >= ? AND price <= ? ORDER BY price';
        $stmt 		= $db->prepare($sql);
        $stmt->bindValue(1, '%'.$make.'%');
        $stmt->bindParam(2, $_GET['yearmade'], PDO::PARAM_INT);
        $stmt->bindParam(3, $_GET['price'], PDO::PARAM_INT);
        $stmt->execute();
		$error = $stmt->errorInfo()[2] ?? "";
		if (!empty($error)):
			echo "<p>{$error}</p>";
		else:
	?>
	<form action="" method="get">
	    <fieldset>
	        <legend>Search for Cars</legend>
		    <p>
		        <label for="make">Make: </label>
		        <input type="text" name="make" id="make" value="<?= $make; ?>" />
		        <label for="yearmade">Year (minimum): </label>
		        <select name="yearmade" id="yearmade" />
		            <?php for ($y = 1970; $y <= 2010; $y += 5): ?>
		                <option><?= $y; ?></option>
		            <?php endfor; ?>
		        </select>
		        <label for="price">Price (maximum): </label>
		        <select name="price" id="price">
		            <?php for ($price = 5000; $price <= 30000; $price += 5000): ?>
	            	<?php $selected = ($price == 30000) ? ' selected' : ''; ?>
	                <option value='<?= $price; ?>'<?= $selected; ?>>$<?= number_format($price); ?></option>
		            <?php endfor; ?>
		        </select>
		        <input type="submit" name="s" value="Search" />
		    </p>
	    </fieldset>
	</form>
	<?php if (isset($_GET['s'])): ?>
		<?php if ($row = $stmt->fetch()):  $id = 1; ?>
		<table>
		    <tr>
		        <th>#</th>
		        <th>Make</th>
		        <th>Year</th>
		        <th>Mileage</th>
		        <th>Price</th>
		        <th>Description</th>
		    </tr>
		    <?php do { ?>
		    <tr>
		        <td><?= $id; ?></td>
		        <td><?= $row['make']; ?></td>
		        <td><?= $row['yearmade']; ?></td>
		        <td><?= number_format($row['mileage']); ?></td>
		        <td>$<?= number_format($row['price'], 2); ?></td>
		        <td><?= $row['description']; ?></td>
		    </tr>
		    <?php $id++; } while ($row = $stmt->fetch()); ?>
		</table>
		<?php else: ?>
		<p>No results found.</p>
		<?php endif; ?>
	<?php endif; ?>
	<?php endif; ?>
</body>
</html>
