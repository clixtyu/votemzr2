<?php 
include'koneksi.php';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$nama = htmlspecialchars($_POST['nama']);
	$nis = htmlspecialchars($_POST['nis']);
	$username = htmlspecialchars($_POST['username']);
	$password = sha1(htmlspecialchars($_POST['password1']));
	$email = htmlspecialchars($_POST['email']);
	$no_hp = htmlspecialchars($_POST['no_hp']);
	$jenis_kelamin = htmlspecialchars($_POST['jenis_kelamin']);
	$alamat = htmlspecialchars($_POST['alamat']);
	$satatus_aktif = 'aktif';
	$tanggal_daftar = date('Y-m-d');

	$cek_daftar = mysqli_query($koneksi, "SELECT * FROM tb_siswa WHERE nis='$nis'");
	$cek_daftar = mysqli_fetch_array($cek_daftar);

	if(empty($cek_daftar)){
		$pesan['insert'] = 'nis_blm_terdaftar';
		echo json_encode($pesan);
		die();
	}

	$cek_nis = mysqli_query($koneksi, "SELECT * FROM tb_pemilih WHERE nis='$nis'");
	$cek_nis = mysqli_fetch_array($cek_nis);

	if(!empty($cek_nis)){
		$pesan['insert'] = 'nis_ada';
		echo json_encode($pesan);
		die();
	}

	$cek_username = mysqli_query($koneksi, "SELECT * FROM tb_pemilih WHERE username='$username'");
	$cek_username = mysqli_fetch_array($cek_username);
	if(!empty($cek_username)){
		$pesan['insert'] = 'username_ada';
		echo json_encode($pesan);
		die();
	}

	$insert = mysqli_query($koneksi,"INSERT INTO tb_pemilih VALUES('','$nis','$nama','$username','$password','$email','$no_hp','$satatus_aktif','$tanggal_daftar','$jenis_kelamin','','$alamat')");

	if($insert){
		$pesan['insert'] = true;
	}else{
		$pesan['insert'] = false;
	}
	echo json_encode($pesan);
}else{
	$pesan['insert'] = false;
	echo json_encode($pesan);
}

?>