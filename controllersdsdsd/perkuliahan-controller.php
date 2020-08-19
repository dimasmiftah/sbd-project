<?php
include '../auth/koneksi.php';


$type = $_POST['tipe'];
$id = $_POST['id'];
$idnd = $_POST['idnd'];

// DELETE
if ($type == 'delete') {
	mysqli_query($koneksi, "DELETE FROM perkuliahan WHERE NIM='$id' AND KodeMK='$idnd'");

	// EDIT
} else if ($type == 'edit') {
	$query = mysqli_query($koneksi, "SELECT * FROM perkuliahan WHERE NIM='$id' AND KodeMK='$idnd'");
	while ($row = $query->fetch_assoc()) {
		$output[] = array(
			"id" => $row['NIM'],
			"idnd" => $row['KodeMK'],
			"nip" => $row['NIP'],
			"nilai" => $row['Nilai'],
		);
	}
	echo json_encode($output);

	// UPDATE
} else if ($type == 'update') {
	$idLama = $_POST['idLama'];
	$idndLama = $_POST['idndLama'];
	$nip = $_POST['nip'];
	$nilai = $_POST['nilai'];
	$petugas = $_POST['petugas'];
	mysqli_query($koneksi, "UPDATE `perkuliahan` SET `NIM` = '$id', `KodeMK` = '$idnd', `NIP` = '$nip', `Nilai` = '$nilai', `id_user` = '$petugas' WHERE `perkuliahan`.`NIM` = '$idLama' AND `perkuliahan`.`KodeMK` = '$idndLama';");

	// CREATE
} else if ($type == 'create') {
	$nip = $_POST['nip'];
	$nilai = $_POST['nilai'];
	$petugas = $_POST['petugas'];
	mysqli_query($koneksi, "INSERT INTO perkuliahan VALUE('$id', '$idnd', '$nip', '$nilai', '$petugas')");
}
