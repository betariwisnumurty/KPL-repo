<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$description = $_POST['description'];
		$amount = $_POST['amount'];

		$sql = "INSERT INTO deductions (description, amount) VALUES ('$description', '$amount')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Potongan berhasil ditambahkan';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}	
	else{
		$_SESSION['error'] = 'Isi formulir terlebih dahulu';
	}

	header('location: deduction.php');

?>