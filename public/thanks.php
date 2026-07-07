<?php
	include 'connection.php';
	$notFoundPath = '/404-not-found';

	$file = trim((string) ($_GET['file'] ?? ''));

	if ($file === '') {
		header('Location: ' . $notFoundPath, true, 302);
		exit;
	}

	$stmt = mysqli_prepare($con, 'SELECT id FROM tbl_uploads WHERE file = ? LIMIT 1');
	if (! $stmt) {
		header('Location: ' . $notFoundPath, true, 302);
		exit;
	}

	mysqli_stmt_bind_param($stmt, 's', $file);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	$row = $result ? mysqli_fetch_assoc($result) : null;
	mysqli_stmt_close($stmt);

	if (! $row || empty($row['id'])) {
		header('Location: ' . $notFoundPath, true, 302);
		exit;
	}

	$id = (int) $row['id'];
	header('Location: /whitepaper/view/' . $id, true, 302);
	exit;
?>