<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['id'];
		$sql = "DELETE FROM employees WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Karyawan berhasil dihapus';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Pilih item untuk dihapus terlebih dahulu';
	}

	header('location: employee.php');
	
?>