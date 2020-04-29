<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PDO: Fetch into Class (Creating)</title>
    <link href="../css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<?php require_once '../includes/config.php'; ?>
	<h1>PDO: Fetch into Class (Creating)</h1>
	<?php
		$carID 	= 2;
		$sql 	= 'SELECT * FROM cars LEFT JOIN makes USING (make_id) WHERE car_id = :car_id';
		$stmt 	= $db->prepare($sql);
		// $stmt->bindParam(":car_id", $carID);
		// $stmt->execute();
		// OR
		$stmt->execute([":car_id" => $carID]);
		// Takes fetch mode, class name and parameters for constructor as arguments
		$stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, App\Car::class, [$carID]);

		$error = $stmt->errorInfo()[2] ?? "";
		if (!empty($error)):
			echo "<p>{$error}</p>";
		endif;

		$all = TRUE;
		if ($all):
			$cars = $stmt->fetchAll();
			dump($cars);
		else:
			$car = $stmt->fetch();
			echo $car;
		endif;
	?>
</body>
</html>
