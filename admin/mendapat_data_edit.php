<?php 
include '../koneksi.php';

if(isset($_GET['dapat'])){
	$get  = $_GET['dapat'];

	if($get == 'data_pemilih'){
		$id  = $_POST['id'];
		
		$get = mysqli_query($koneksi, "SELECT * FROM tb_pemilih WHERE id=$id");
		$data = mysqli_fetch_array($get);

		echo json_encode($data);
	}elseif($get == 'data_kandidat'){
		$id  = $_POST['id'];
		
		$get = mysqli_query($koneksi, "SELECT * FROM tb_kandidat WHERE id_kandidat=$id");
		$data = mysqli_fetch_array($get);

		echo json_encode($data);
	}elseif ($get == 'data_panitia') {
		$id  = $_POST['id'];
		
		$get = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE id=$id");
		$data = mysqli_fetch_array($get);

		echo json_encode($data);
	}elseif($get == 'data_admin'){
		$id  = $_POST['id'];
		
		$get = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE id=$id");
		$data = mysqli_fetch_array($get);

		echo json_encode($data);
	}elseif($get == 'data_siswa'){
		$id  = $_POST['id'];
		
		$get = mysqli_query($koneksi, "SELECT * FROM tb_siswa WHERE id=$id");
		$data = mysqli_fetch_array($get);

		echo json_encode($data);
	}
}

?>