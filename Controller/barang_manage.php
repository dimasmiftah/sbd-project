<?php
include '../Auth/koneksi.php';

$type = $_POST['tipe'];
$id = $_POST['id'];
if ($type == 'delete') {
	mysqli_query($koneksi,"delete from barang where id_barang='$id'");
} else if($type == 'edit'){
	$query = mysqli_query($koneksi,"select * from barang where id_barang='$id'");
	while($row = $query->fetch_assoc()) {
		$output[] = array (
			"id_barang" => $row['id_barang'],
			"barang" => $row['barang'],
			"stok" => $row['stok'],
			"harga" => $row['harga']
		); 
	}
	echo json_encode($output);
} else if($type == 'update'){
	$barang = $_POST['barang'];
	$stok = $_POST['stok'];
	$harga = $_POST['harga'];
	mysqli_query($koneksi,"update barang set barang='$barang', stok='$stok', harga='$harga' where id_barang='$id'");
} else if ($type == 'create') {
	$barang = $_POST['barang'];
	$stok = $_POST['stok'];
	$harga= $_POST['harga'];
	mysqli_query($koneksi,"insert into barang value('$id','$barang','$stok','$harga')");
}
