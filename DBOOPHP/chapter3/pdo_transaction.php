<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <title>PDO Transaction</title>
	<link href="../css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<?php require_once '../includes/config.php'; ?>
	<h1>PDO Transactions</h1>
	<?php
		// NB: Make sure database supports transactions
		// MyISAM tables silently ignores transactions commands
		// Only InnoDB Engine supports transactions in MySQL
		// MySQL automatically commits data definition language (DDL) such as CREATE TABLE, DROP TABLE there's no way of undoing such transactions
		// Set up prepared statements transfer from one account to another
	    $amount = 200;
	    $payer 	= 'John White';
	    // $payee 	= 'Jane Black';
	    $payee 	= 'Jane Brown';
	    $debit 	= 'UPDATE savings SET balance = balance - :amount WHERE name = :payer';
	    $credit = 'UPDATE savings SET balance = balance + :amount WHERE name = :payee';

	    $pay = $db->prepare($debit);
	    $pay->bindParam(':amount', $amount);
	    $pay->bindParam(':payer', $payer);

	    $receive = $db->prepare($credit);
	    $receive->bindParam(':amount', $amount);
	    $receive->bindParam(':payee', $payee);

	    // Transaction
	    $db->beginTransaction();
	    $pay->execute();
        $receive->execute();
		$errors[] = $pay->errorInfo()[2] ?? "";
		$errors[] = $receive->errorInfo()[2] ?? "";

	    if (!$pay->rowCount() || !$receive->rowCount()):
	        $db->rollBack();
	        $transactionError = "Transaction failed: $payer couldn't pay $payee.";
	    else:
	        $db->commit();
	    endif;
		if (!empty(getError($errors))):
			echo getError($errors);
		else:
	?>
	<?= ($transactionError) ? "<p>{$transactionError}</p>" : ""; ?>
	<table>
		<tr>
			<th>Name</th>
			<th>Balance</th>
		</tr>
		<?php foreach ($db->query('SELECT name, balance FROM savings') as $row): ?>
		<tr>
			<td><?= $row['name']; ?></td>
			<td>$<?= number_format($row['balance'], 2); ?></td>
		</tr>
		<?php endforeach; ?>
	</table>
	<?php endif; ?>
</body>
</html>
