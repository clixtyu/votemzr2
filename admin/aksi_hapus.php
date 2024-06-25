<?php 
include '../koneksi.php';

if(isset($_GET['hapus'])){
	$get  = $_GET['hapus'];

	if($get == 'data_pemilih'){
		$id  = $_GET['id'];
		$query = mysqli_query($koneksi, "DELETE from tb_pemilih WHERE id=$id");
		if($query){
			header('location: data_pemilih.php');
		}else{
			echo mysqli_error($koenksi);
		}
	}elseif($get === 'data_calon_osis'){
		$id = $_GET['id'];
		$foto = $_GET['foto'];
		$delete = mysqli_query($koneksi, "DELETE FROM tb_kandidat WHERE id_kandidat=$id");
		if($delete){
			header('location: data_calon_osis.php');
			unlink('../foto_kandidat/'. $foto);
		}else{
			echo mysqli_error($koneksi);
		}
	}elseif($get == 'data_panitia'){
		$id = $_GET['id'];
		$delete = mysqli_query($koneksi, "DELETE FROM tb_user WHERE id=$id");
		if($delete){
			header('location: data_panitia.php');
		}else{
			echo mysqli_error($koneksi);
		}
	}elseif($get == 'data_admin'){
		$id = $_GET['id'];
		$delete = mysqli_query($koneksi, "DELETE FROM tb_user WHERE id=$id");
		if($delete){
			header('location: data_admin.php');
		}else{
			echo mysqli_error($koneksi);
		}
	}elseif($get == 'data_siswa'){
		$id = $_GET['id'];
		$delete = mysqli_query($koneksi, "DELETE FROM tb_siswa WHERE id=$id");
		if($delete){
			header('location: data_siswa.php');
		}else{
			echo mysqli_error($koneksi);
		}
	}
}