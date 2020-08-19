<?php
include '../auth/koneksi.php';


$type = $_POST['tipe'];
$id = $_POST['id'];

// DELETE
if ($type == 'delete') {
	mysqli_query($koneksi, "DELETE FROM matakuliah WHERE KodeMK='$id'");

	// EDIT
} else if ($type == 'edit') {
	$query = mysqli_query($koneksi, "SELECT * FROM matakuliah WHERE KodeMK='$id'");
	while ($row = $query->fetch_assoc()) {
		$output[] = array(
			"id" => $row['KodeMK'],
			"nama" => $row['NamaMK'],
			"sks" => $row['SKS'],
		);
	}
	echo json_encode($output);

	// UPDATE
} else if ($type == 'update') {
	$idLama = $_POST['idLama'];
	$nama = $_POST['nama'];
	$sks = $_POST['sks'];
	mysqli_query($koneksi, "UPDATE `matakuliah` SET `KodeMK` = '$id', `NamaMK` = '$nama', `SKS` = '$sks' WHERE `matakuliah`.`KodeMK` = '$idLama';");

	// CREATE
} else if ($type == 'create') {
	$nama = $_POST['nama'];
	$sks = $_POST['sks'];
	mysqli_query($koneksi, "INSERT into matakuliah value('$id','$nama','$sks')");
}
