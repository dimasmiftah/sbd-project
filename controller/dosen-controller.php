<?php
include '../auth/koneksi.php';


$type = $_POST['tipe'];
$id = $_POST['id'];

// DELETE
if ($type == 'delete') {
	mysqli_query($koneksi, "DELETE FROM dosen WHERE NIP='$id'");

	// EDIT
} else if ($type == 'edit') {
	$query = mysqli_query($koneksi, "SELECT * FROM dosen WHERE NIP='$id'");
	while ($row = $query->fetch_assoc()) {
		$output[] = array(
			"id" => $row['NIP'],
			"nama" => $row['NamaDosen'],
		);
	}
	echo json_encode($output);

	// UPDATE
} else if ($type == 'update') {
	$idLama = $_POST['idLama'];
	$nama = $_POST['nama'];
	mysqli_query($koneksi, "UPDATE `dosen` SET `NIP` = '$id', `NamaDosen` = '$nama' WHERE `dosen`.`NIP` = '$idLama';");

	// CREATE
} else if ($type == 'create') {
	$nama = $_POST['nama'];
	mysqli_query($koneksi, "INSERT into dosen value('$id','$nama')");
}
