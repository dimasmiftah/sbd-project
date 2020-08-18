<?php
include '../Auth/koneksi.php';

$type = $_POST['tipe'];
$id = $_POST['id'];
if ($type == 'delete') {
	mysqli_query($koneksi,"delete from user where id_user='$id'");
} else if($type == 'edit'){
	$query = mysqli_query($koneksi,"select * from user where id_user='$id'");
	while($row = $query->fetch_assoc()) {
			$output[] = array (
			"id_user" => $row['id_user'],
			"nama" => $row['nama'],
			"username" => $row['username'],
			"password" => $row['password']
	); 
	}
	echo json_encode($output);
} else if($type == 'update'){
	$nama = $_POST['nama'];
	$username = $_POST['username'];
	mysqli_query($koneksi,"update user set nama='$nama', username='$username' where id_user='$id'");
} else if ($type == 'get_id') {
	$kode = null;
	$no = 1;
	$query = mysqli_query($koneksi,"select id_user from user where id_user like '%USER-%' order by id_user asc");
	$count =mysqli_num_rows($query);
	
		if($kode == null){
			$no = $count + 1;
			if($no < 10){
				$kode = "USER-00". $no;
			}else if($no < 100){
				$kode = "USER-0". $no;
			}else{
				$kode = "USER-" . $no;
			}
			echo $kode;
		}
} else if ($type == 'add_user') {
	$nama = $_POST['nama'];
	$username = $_POST['username'];
	$password= md5($_POST['password']);
	mysqli_query($koneksi,"insert into user value('$id','$username','$password','$nama','kasir')");
}
?>