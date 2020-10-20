<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$title = $_POST['title'];
		$rate = $_POST['rate'];

		$sql = "INSERT INTO position (description, rate) VALUES ('$title', '$rate')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Posisi berhasil ditambahkan';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Isi formulir terlebih dahulu';
	}

	header('location: position.php');

?>
