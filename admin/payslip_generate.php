<?php
	include 'includes/session.php';

	$range = $_POST['date_range'];
	$ex = explode(' - ', $range);
	$from = date('Y-m-d', strtotime($ex[0]));
	$to = date('Y-m-d', strtotime($ex[1]));

	$sql = "SELECT *, SUM(amount) as total_amount FROM deductions";
    $query = $conn->query($sql);
   	$drow = $query->fetch_assoc();
    $deduction = $drow['total_amount'];

	$from_title = date('d M Y', strtotime($ex[0]));
	$to_title = date('d M Y', strtotime($ex[1]));

	require_once('../tcpdf/tcpdf.php');
    $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetTitle('Payslip: '.$from_title.' - '.$to_title);
    $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    $pdf->SetDefaultMonospacedFont('helvetica');
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    $pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    $pdf->SetAutoPageBreak(TRUE, 10);
		$pdf->SetFont('helvetica', '', 11);
		$pdf->AddPage("L");
    $contents = '';

	$sql = "SELECT *, SUM(num_hr) AS total_hr, attendance.employee_id AS empid, employees.employee_id AS employee FROM attendance LEFT JOIN employees ON employees.id=attendance.employee_id LEFT JOIN position ON position.id=employees.position_id WHERE date BETWEEN '$from' AND '$to' GROUP BY attendance.employee_id ORDER BY employees.lastname ASC, employees.firstname ASC";

	$query = $conn->query($sql);
	while($row = $query->fetch_assoc()){
		$empid = $row['empid'];

      	$casql = "SELECT *, SUM(amount) AS cashamount FROM cashadvance WHERE employee_id='$empid' AND date_advance BETWEEN '$from' AND '$to'";

      	$caquery = $conn->query($casql);
      	$carow = $caquery->fetch_assoc();
      	$cashadvance = $carow['cashamount'];

		$gross = $row['rate'] * $row['total_hr'];
		$total_deduction = $deduction + $cashadvance;
  		$net = $gross - $total_deduction;

		$contents .= '
		<table cellspacing="0" cellpadding="3">
					 <tr>
						<td width="44%" align="left"><b>PT. LIMA KARSA KREASI TAMA</b></td>
						<td><h1>SLIP GAJI</h1></td>
					</tr>
					<tr>
					 <td align="left">JL. DEWI SARTIKA NO. 357, RT.5/RW.12 13630</td>

				 </tr>
				 <tr>
					<td align="left">TELP. (021) 8004635</td>
				</tr>
				<br>
					 <tr>
						<td width="25%" align="left">Nama Karyawan </td>
						<td width="25%"><b>: ' .$row['firstname']." ".$row['lastname'].'</b></td>
					</tr>
					<tr>
						<td width="25%" align="left">ID Karyawan </td>
						<td width="25%">: ' .$row['employee'].'</td>
					</tr>
					<tr>
							<td width="25%" align="left">Periode </td>
							<td width="25%"><b>: '.$from_title." - ".$to_title.'</b></td>
					</tr>
					<tr>
					<td></td>
					</tr>
					<hr>
					<tr>
					<td width="75%" align="left">K E T E R A N G A N </td>
					<td width="75%" align="left">J U M L A H</td>
					</tr>
					<hr>
					<tr>
					<td width="75%" align="left">Tarif Per Jam </td>
						<td width="75%" align="left">: '.number_format($row['rate']).'</td>
					</tr>
					<tr>
				<td width="75%" align="left">Jumlah Jam </td>
				<td width="75%" align="left">: '.number_format($row['total_hr']).'</td>
					</tr>
					<tr>
				<td width="75%" align="left"><b>Gaji Kotor: </b></td>
				<td width="75%" align="left"><b>: '.number_format(($row['rate']*$row['total_hr'])).'</b></td>
					</tr>
					<hr>
					<tr>
				<td width="75%" align="left">Potongan </td>
				<td width="75%" align="left">: '.number_format($deduction).'</td>
					</tr>
					<tr>
				<td width="75%" align="left">Kas Bon </td>
				<td width="75%" align="left">: '.number_format($cashadvance).'</td>
					</tr>
					<tr>
				<td width="75%" align="left">Jumlah Potongan</td>
				<td width="75%" align="left">: '.number_format($total_deduction).'</td>
					</tr>
					<tr>
				<td width="75%" align="left"><b>Gaji Bersih</b></td>
				<td width="75%" align="left"><b>: '.number_format($net).'</b></td>
					</tr>
				<hr>
				<tr>
				<td width="75%" align="right"><b>TOTAL DITERIMA</b></td>
				<td width="75%" align="left"><b>: '.number_format($net).'</b></td>
				</tr>
				<hr>
				<tr>
				<td></td>
				</tr>
				<tr>
				<td></td>
				</tr>
				<tr>
				<td></td>
				</tr>
				<tr>
				<td></td>
				</tr>
				<tr>
				<td width="25%" align="left">Penerima,</td>
				<td width="75%" align="right">'.$from_title.'</td>
				</tr>
				<tr>
				<td></td>
				</tr>
				<tr>
				<td></td>
				</tr>
				<tr>
				<td></td>
				</tr>
				<tr>
				<td align="left"><b>' .$row['firstname']." ".$row['lastname'].'</b></td>
				<td width="75%" align="RIGHT"><b>PT. LIMA KARSA KREASI TAMA</b></td>
				</tr>
				</table>
				<br><br>
		';
	}
    $pdf->writeHTML($contents);
    $pdf->Output('slipgaji.pdf', 'I');

?>
