<?php 
include '../koneksi.php';
if(isset($_GET['tambah'])){
	$get = $_GET['tambah'];

	if($get == 'data_pemilih'){
		
		if(isset($_POST['tambah_pemilih'])){
			$nama = $_POST['nama'];
			$nis = $_POST['nis'];

			$cek_nis = mysqli_query($koneksi, "SELECT * FROM tb_pemilih WHERE nis='$nis'");
			$cek_nis = mysqli_fetch_array($cek_nis);

			if(!empty($cek_nis)){
				echo "<script>alert('NIS sudah ada yang memakai..!'); document.location.href='data_pemilih.php'</script>";
				die();
			}

			$username = $_POST['username'];
			$password = sha1($_POST['password']);
			$email = $_POST['email'];
			$no_hp = $_POST['no_hp'];
			$jenis_kelamin = $_POST['jenis_kelamin'];
			$alamat = $_POST['alamat'];
			$satatus_aktif = 'aktif';
			$tanggal_daftar = date('Y-m-d');

			// $data  = [
			// 	'nis'  => $nis,
			// 	'nama'  => $nama,
			// 	'username'  => $username,
			// 	'password'  => $password,
			// 	'email'  => $email,
			// 	'no_hp'  => $no_hp,
			// 	'jenis_kelamin'  => $jenis_kelamin,
			// 	'alamat'  => $alamat,
			// ];

			$insert = mysqli_query($koneksi,"INSERT INTO tb_pemilih VALUES('','$nis','$nama','$username','$password','$email','$no_hp','$satatus_aktif','$tanggal_daftar','$jenis_kelamin','','$alamat')");
			if($insert){
				echo "<script>alert('Data berhasil di masukkan..!'); document.location.href='data_pemilih.php'</script>";
			}else{
				echo mysqli_error($koneksi);
			}
		}else{
			echo "<script>alert('Data gagal di masukkan..!'); document.location.href='data_pemilih.php'</script>";
		}

	}elseif($get == 'data_kandidat'){
		if(isset($_POST['tambah_kandidat'])){
			$nama = $_POST['nama'];
			$visi = $_POST['visi'];
			$misi = $_POST['misi'];
			$priode = $_POST['priode'];

			$foto  = upload();

			if(!$foto){
				return false;
			}

			$insert = mysqli_query($koneksi, "INSERT INTO tb_kandidat VALUES('','$nama','$visi','$misi','$priode','','$foto')");

			if($insert){
				echo "<script>alert('Data berhasil di masukkan..!'); document.location.href='data_calon_osis.php'</script>";
			}else{
				echo "<script>alert('Data gagal di masukkan..!'); document.location.href='data_calon_osis.php'</script>";
			}

		}else{
			echo "<script>alert('Data gagal di masukkan..!'); document.location.href='data_calon_osis.php'</script>";
		}
	}elseif($get == 'data_panitia'){
		if(isset($_POST['tambah_panitia'])){
			$kode = $_POST['kode'];
			$nama = $_POST['nama'];
			$username = $_POST['username'];
			$password = sha1($_POST['password']);
			$email = $_POST['email'];
			$jenis_kelamin = $_POST['jenis_kelamin'];
			$status_aktif = 'aktif';
			$tanggal_buat = date('Y-m-d');
			$role = 'panitia';

			$insert = mysqli_query($koneksi,"INSERT INTO tb_user VALUES('','$kode','$nama','$username','$password','$email','$status_aktif','$tanggal_buat','$role','$jenis_kelamin')");
			if($insert){
				echo "<script>alert('Data berhasil di masukkan..!'); document.location.href='data_panitia.php'</script>";
			}else{
				echo "<script>alert('Data gagal di masukkan..!'); document.location.href='data_panitia.php'</script>";
			}
		}else{
			echo "<script>alert('Data gagal di masukkan..!'); document.location.href='data_panitia.php'</script>";
		}
	}elseif($get == 'data_admin'){
		if(isset($_POST['tambah_admin'])){
			$kode = $_POST['kode'];
			$nama = $_POST['nama'];
			$username = $_POST['username'];
			$password = sha1($_POST['password']);
			$email = $_POST['email'];
			$jenis_kelamin = $_POST['jenis_kelamin'];
			$status_aktif = 'aktif';
			$tanggal_buat = date('Y-m-d');
			$role = 'admin';

			$insert = mysqli_query($koneksi,"INSERT INTO tb_user VALUES('','$kode','$nama','$username','$password','$email','$status_aktif','$tanggal_buat','$role','$jenis_kelamin')");
			if($insert){
				echo "<script>alert('Data berhasil di masukkan..!'); document.location.href='data_admin.php'</script>";
			}else{
				echo "<script>alert('Data gagal di masukkan..!'); document.location.href='data_admin.php'</script>";
			}
		}else{
			echo "<script>alert('Data gagal di masukkan..!'); document.location.href='data_admin.php'</script>";
		}
	}elseif($get == 'data_siswa'){
		if(isset($_POST['tambah_siswa'])){
			$nis = $_POST['nis'];
			$nama = $_POST['nama'];
			$jenis_kelamin = $_POST['jenis_kelamin'];
			$jurusan = $_POST['jurusan'];
			$status_aktif = 'aktif';
			$email = $_POST['email'];
			$no_hp = $_POST['no_hp'];

			$insert  = mysqli_query($koneksi, "INSERT INTO tb_siswa VALUES(
				'','$nis','$nama','$jenis_kelamin','$jurusan','$status_aktif','$email','$no_hp')");
			if($insert){
				echo "<script>alert('Data berhasil di masukkan..!'); document.location.href='data_siswa.php'</script>";
			}else{
				echo "<script>alert('Data gagal di masukkan..!'); document.location.href='data_siswa.php'</script>";
			}
		}else{
			echo "<script>alert('Data gagal di masukkan..!'); document.location.href='data_siswa.php'</script>";
		}
	}
}


function upload(){
	$nama_file    = $_FILES['foto']['name'];
	$tempat 	  = $_FILES['foto']['tmp_name'];
	$error 		  = $_FILES['foto']['error'];

	if($error === 4){
		echo "<script>

		alert('Silahkan pilih gambar terlebih dahulu');

		</script>";
		return false;
	}

	$ektensigambarvalid  = ['jpg','png','gift','jpeg'];
	$ektensigambar       = explode('.', $nama_file);
	$ektensigambar       = strtolower(end($ektensigambar));

	if(!in_array($ektensigambar, $ektensigambarvalid)){
		echo "<script>

		alert('Ektensi gambar yang Anda pilih tidak sesuai');

		</script>";
		return false;
	}

	$ektensifilebaru  =  uniqid();
	$ektensifilebaru .=  '.';
	$ektensifilebaru .=  $ektensigambar;



	move_uploaded_file($tempat, '../foto_kandidat/' . $ektensifilebaru);

	return $ektensifilebaru;
}