<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$description = $_POST['description'];
		$amount = $_POST['amount'];

		$sql = "UPDATE deductions SET description = '$description', amount = '$amount' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Potongan berhasil diperbarui';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Isi formulir terlebih dahulu';
	}

	header('location:deduction.php');

?>