<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$empid = $_POST['id'];
		$sched_id = $_POST['schedule'];

		$sql = "UPDATE employees SET schedule_id = '$sched_id' WHERE id = '$empid'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Jadwal berhasil diperbarui';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	}
	else{
		$_SESSION['error'] = 'Pilih jadwal untuk mengedit terlebih dahulu';
	}

	header('location: schedule_employee.php');
?>
