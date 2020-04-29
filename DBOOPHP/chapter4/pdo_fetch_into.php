<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PDO: Fetch into Class (Setting)</title>
    <link href="../css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<?php require_once '../includes/config.php'; ?>
	<h1>PDO: Fetch into Class (Setting)</h1>
	<?php
		$carID 	= 18;
		$car 	= new App\Car($carID);
		echo $car;
		echo "<br /><br />";
		$sql 	= 'SELECT * FROM cars LEFT JOIN makes USING (make_id) WHERE car_id = :car_id';
		$stmt 	= $db->prepare($sql);
		// $stmt->bindParam(":car_id", $carID);
		// $stmt->execute();
		// OR
		$stmt->execute([":car_id" => $carID]);
		// Takes fetch mode, class object as arguments
		$stmt->setFetchMode(PDO::FETCH_INTO, $car);
		$stmt->fetch();

		$error = $stmt->errorInfo()[2] ?? "";
		if (!empty($error)):
			echo "<p>{$error}</p>";
		endif;
		echo $car;
	?>
</body>
</html>
