<?php 	
include'../koneksi.php';
date_default_timezone_set('Asia/Jakarta');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$id_kandidat = $_POST['id'];
	$nis_pemilih = $_POST['nis'];
	$nama_pemilih = $_POST['nama'];

	$cek_voting = mysqli_query($koneksi,"SELECT * FROM tb_voting WHERE nis='$nis_pemilih'");
	$get_voting = mysqli_fetch_array($cek_voting);

	if(!empty($get_voting)){
		$pesan['voting'] = 'sudah_voting';
		echo json_encode($pesan);
		die();
	}else{
		$query = mysqli_query($koneksi, "SELECT * FROM tb_kandidat WHERE id_kandidat=$id_kandidat");
		$data = mysqli_fetch_assoc($query);

		$suara = $data['suara'] + 1;
		$nama_dipilih  = $data['nama_calon'];
		$tanggal = date('Y-m-d');

		$edit = mysqli_query($koneksi, "UPDATE tb_kandidat SET suara =$suara WHERE id_kandidat=$id_kandidat");

		$insert = mysqli_query($koneksi, "INSERT INTO tb_voting VALUES('','$nis_pemilih','$id_kandidat','$nama_pemilih','$nama_dipilih','$tanggal')");



		if($insert){
			$pesan['voting'] = true;
		}else{
			$pesan['voting'] = false;
		}


		echo json_encode($pesan);
	}
}else{
	$pesan['voting'] = false;
	echo json_encode($pesan);
}
