<?php
include '../Auth/koneksi.php';

$type = $_POST['tipe'];
if ($type == 'delete') {
	$id = $_POST['id'];
	mysqli_query($koneksi,"delete from transaksi where id_transaksi='$id'");
} else if($type == 'pilih'){
	$id = $_POST['id'];
	$query = mysqli_query($koneksi,"select * from barang where id_barang='$id'");
	while($row = $query->fetch_assoc()) {
		$barang[] = array (
		"id_barang" => $row['id_barang'],
		"barang" => $row['barang'],
		"stok" => $row['stok'],
		"harga" => $row['harga']
		); 
	}
	echo json_encode($barang);
} else if($type == 'create'){
	$id_transaksi = $_POST['id_transaksi'];
	$id_user = $_POST['id_user'];
	$total = $_POST['total'];
	$list = $_POST['list'];

	foreach ($list as &$barang) {
		mysqli_query($koneksi,"insert into transaksi value('$id_transaksi','$id_user',NOW(),'$total')");
		mysqli_query($koneksi,"insert into list_transaksi value('','$id_transaksi','".$barang['id_barang']."','".$barang['qty']."', '".$barang['total']."')");
		mysqli_query($koneksi,"UPDATE barang SET stok=stok-".$barang['qty']." WHERE id_barang=".$barang['id_barang']."");
	}
	unset($value); 
} else if ($type == 'kasir') {
	$kasir = $_POST['kasir'];
	$query = mysqli_query($koneksi,"select * from user where username='$kasir'");
	while($row = $query->fetch_assoc()) {
		$id_user = $row['id_user'];
	}
	echo $id_user;
} 
else if ($type == 'detail') {
	$id_transaksi = $_POST['id_transaksi'];
	$query = mysqli_query($koneksi,"SELECT barang.barang,  barang.harga, list_transaksi.qty, list_transaksi.total 
	FROM `barang` JOIN list_transaksi ON barang.id_barang=list_transaksi.id_barang where list_transaksi.id_transaksi='$id_transaksi'");
	while($row = $query->fetch_assoc()) {
		$list_transaksi[] = array (
			"barang" => $row['barang'],
			"harga" => $row['harga'],
			"qty" => $row['qty'],
			"total" => $row['total']
			); 
	}
	echo json_encode($list_transaksi);
}
?>