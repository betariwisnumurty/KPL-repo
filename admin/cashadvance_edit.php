<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$amount = $_POST['amount'];
		
		$sql = "UPDATE cashadvance SET amount = '$amount' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Kasbon berhasil diperbarui';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Isi formulir terlebih dahulu';
	}

	header('location:cashadvance.php');

?>