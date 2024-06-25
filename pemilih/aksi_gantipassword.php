<?php 
include'../koneksi.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$pesan = array();
	$password_lama = sha1($_POST['password_lama']);
	$password_baru = sha1(htmlspecialchars(trim($_POST['password_baru'])));

	$query = mysqli_query($koneksi, "SELECT * FROM tb_pemilih WHERE password='$password_lama'");
	$cek   = mysqli_fetch_array($query);

	if(empty($cek)){
		$pesan['ganti'] = 'password_salah';
		echo json_encode($pesan);
		die();
	}else{
		$ganti = mysqli_query($koneksi, "UPDATE tb_pemilih SET password = '$password_baru' WHERE password = '$password_lama'");

		if($ganti){
			$pesan['ganti'] = true;
		}else{
			$pesan['ganti'] = false;
		}

		echo json_encode($pesan);
	}

}


 ?>