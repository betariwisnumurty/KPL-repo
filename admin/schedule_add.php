<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$time_in = $_POST['time_in'];
		$time_in = date('H:i:s', strtotime($time_in));
		$time_out = $_POST['time_out'];
		$time_out = date('H:i:s', strtotime($time_out));

		$sql = "INSERT INTO schedules (time_in, time_out) VALUES ('$time_in', '$time_out')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Jadwal berhasil ditambahkan';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Isi formulir terlebih dahulu';
	}

	header('location: schedule.php');

?>
