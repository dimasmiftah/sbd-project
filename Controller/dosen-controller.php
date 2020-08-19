<?php
include '../auth/koneksi.php';


$type = $_POST['tipe'];
$id = $_POST['id'];

// DELETE
if ($type == 'delete') {
	mysqli_query($koneksi, "DELETE from dosen where nim='$id'");

	// EDIT
} else if ($type == 'edit') {
	$query = mysqli_query($koneksi, "SELECT * from dosen where nim='$id'");
	while ($row = $query->fetch_assoc()) {
		$output[] = array(
			"nim" => $row['NIM'],
			"nama" => $row['NamaMahasiswa'],
			"tanggallahir" => $row['TanggalLahir'],
			"alamat" => $row['Alamat'],
			"jeniskelamin" => $row['JenisKelamin'],
		);
	}
	echo json_encode($output);

	// UPDATE
} else if ($type == 'update') {
	$idLama = $_POST['idLama'];
	$nama = $_POST['nama'];
	$tanggallahir = $_POST['tanggallahir'];
	$alamat = $_POST['alamat'];
	$jeniskelamin = $_POST['jeniskelamin'];
	mysqli_query($koneksi, "UPDATE `dosen` SET `NIM` = '$id', `NamaMahasiswa` = '$nama', `TanggalLahir` = '$tanggallahir', `Alamat` = '$alamat', `JenisKelamin` = '$jeniskelamin' WHERE `dosen`.`NIM` = '$idLama';");

	// CREATE
} else if ($type == 'create') {
	$nama = $_POST['nama'];
	$tanggallahir = $_POST['tanggallahir'];
	$alamat = $_POST['alamat'];
	$jeniskelamin = $_POST['jeniskelamin'];
	mysqli_query($koneksi, "INSERT into dosen value('$id','$nama','$tanggallahir','$alamat','$jeniskelamin')");
}
