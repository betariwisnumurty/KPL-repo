<?php
	include 'includes/session.php';

	if(isset($_POST['upload'])){
		$empid = $_POST['id'];
		$filename = $_FILES['photo']['name'];
		if(!empty($filename)){
			move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$filename);	
		}
		
		$sql = "UPDATE employees SET photo = '$filename' WHERE id = '$empid'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Foto karyawan berhasil diperbarui';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	}
	else{
		$_SESSION['error'] = 'Pilih karyawan untuk memperbarui foto terlebih dahulu';
	}

	header('location: employee.php');
?>