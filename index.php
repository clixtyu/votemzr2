<?php 
session_start();
include 'koneksi.php';

if(isset($_POST['check'])){
	$username   = strtolower(trim($_POST['username']));
	$password   = sha1($_POST['password']);
	$cek  = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE username ='$username' and password='$password'");
	$data = mysqli_fetch_array($cek);

	if(empty($data)){
		$cek_pemilih  = mysqli_query($koneksi, "SELECT * FROM tb_pemilih WHERE username ='$username' and password='$password'");
		$data_pemilih = mysqli_fetch_array($cek_pemilih);

		if(empty($data_pemilih)){
			header('location: index.php?pesan=gagal');
		}else{
			$_SESSION['nis'] 				= $data_pemilih['nis'];
			$_SESSION['username'] 			= $data_pemilih['username'];
			$_SESSION['nama'] 				= $data_pemilih['nama'];
			header('location: pemilih/dashboard.php');
		}
	}else{
		if($data['role'] == 'admin'){
			$_SESSION['kode_user'] 			= $data['kode_user'];
			$_SESSION['username'] 			= $data['username'];
			$_SESSION['nama'] 				= $data['nama'];
			$_SESSION['role'] 				= $data['role'];
			header('location: admin/dashboard.php');
		}elseif($data['role'] == 'panitia'){
			$_SESSION['kode_user'] 			= $data['kode_user'];
			$_SESSION['username'] 			= $data['username'];
			$_SESSION['nama'] 				= $data['nama'];
			$_SESSION['role'] 				= $data['role'];
			header('location: panitia/dashboard.php');
		}else{
			header('location: index.php?pesan=gagal');
		}
	}
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="kb.jpg" type="image/x-icon">
	<title>Login - eVoting OSIS</title>
	<!-- jquery -->
	<script src="assets/vendor/jquery/jquery.min.js"></script>
	<!-- chartjs -->
	<script src="assets/js/Chart.js"></script>
	<!-- Custom fonts for this template-->
	<link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="assets/datatable/css/jquery.dataTables.css"/>
	<style>
		body{
			background-color: #34495e;
		}


		.kotak {
			width: 500px;
			background-color: white;
			margin: auto;
			margin-top: 100px;
			padding: 20px;
			border-radius: 10px;
			box-shadow: 0px 0px 7px 8px black;
		}
		.form-login .bawah{
			display: flex;
			flex-direction:row ;

			justify-content: space-around;

		}
		.judul-login{
			text-align: center;
			font-size: 30px;
			font-family: sans-serif;
		}
		form .bawah button{
			width: 200px;
		}
		form .bawah a{
			width: 200px;
		}

	</style>
</head>

<body>
	<div class="container">
		<div class="kotak">
			<h3 class="judul-login mb-3">LOGIN</h3>
			<?php 
			if(isset($_GET['pesan'])){ 
				$pesan = $_GET['pesan'];
				if($pesan == 'gagal') {
					?>
					<div class="alert alert-danger text-center">Maaf password/username Anda salah</div>
				<?php }else{ ?>
					
					<div class="alert alert-success text-center"><?php echo $_GET['pesan'] ?></div>

				<?php }} ?>
				

				<form method="post" class="form-login">
					<div class="form-group">
						<i class="fas fa-users btn-4x"></i>
						<label for="username">Username</label>
						<input required="" type="text" name="username" class="form-control" id="username" placeholder="Masukkan username Anda" value="">
					</div>
					<div class="form-group">
						<i class="fas fa-unlock"></i>
						<label for="password">Password</label>
						<input required="" name="password" type="password" class="form-control" id="password" placeholder="Masukkan password Anda">
					</div>
					<div class="bawah">
						<button type="submit" name="check" class="btn btn-primary">Login</button>
						<a class="text-white btn btn-danger" href="register.php">Register</a>
					</div>
				</form>
			</div>
		</div>
	</body>

	</html>