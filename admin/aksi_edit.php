<?php 
include '../koneksi.php';
if(isset($_GET['edit'])){
	$get = $_GET['edit'];

	if($get == 'data_pemilih'){
		
		if(isset($_POST['edit_pemilih'])){
			//edit data pemilih
			$id    = $_POST['id'];
			$nama = $_POST['nama'];
			$nis = $_POST['nis'];
			$username = $_POST['username'];
			@$password = $_POST['password_baru'];
			$password_lama = $_POST['password_lama'];
			$email = $_POST['email'];
			$no_hp = $_POST['no_hp'];
			$jenis_kelamin = $_POST['jenis_kelamin'];
			$alamat = $_POST['alamat'];
			$status_aktif = $_POST['status_aktif'];
			$tanggal_daftar = date('Y-m-d');

			if($password == ''){
				$password = $password_lama;
			}else{
				$password = sha1($password);
			}

			$edit = mysqli_query($koneksi, "UPDATE tb_pemilih SET 
				nama     = '$nama',
				nis      = '$nis',
				username = '$username',
				password = '$password',
				email    = '$email',
				status_aktif = '$status_aktif',
				jenis_kelamin = '$jenis_kelamin',
				no_hp    = '$no_hp',
				alamat   = '$alamat'
				WHERE id=$id
				");
			if($edit){
				echo "<script>alert('Data berhasil di edit..!'); document.location.href='data_pemilih.php'</script>";
			}else{
				echo mysqli_error($koneksi);
			}

		}else{
			echo "<script>alert('Data gagal di masukkan..!'); document.location.href='data_pemilih.php'</script>";
		}
	}elseif($get == 'data_kandidat'){
		//edit data kandidat
		if(isset($_POST['edit_kandidat'])){
			$id   = $_POST['id'];
			$foto_lama = $_POST['foto_lama'];
			$nama = $_POST['nama'];
			$visi = $_POST['visi'];
			$misi = $_POST['misi'];
			$priode = $_POST['priode'];

			$foto  = $_FILES['foto_baru']['name'];
			if(!$foto){
				$foto = $foto_lama;
			}else{
				$foto  = upload();
				unlink('../foto_kandidat/'. $foto_lama);
				if(!$foto){
					return error;
				}
			}


			$edit = mysqli_query($koneksi, "UPDATE tb_kandidat SET 
				nama_calon     = '$nama',
				visi      = '$visi',
				misi 	= '$misi',
				periode  = '$priode',
				foto   = '$foto'
				WHERE id_kandidat=$id
				");
			if($edit){
				echo "<script>alert('Data berhasil di edit..!'); document.location.href='data_calon_osis.php'</script>";
				// echo mysqli_error($koneksi);
			}else{
				echo mysqli_error($koneksi);
			}

		}else{
			echo "<script>alert('Data gagal di edit..!'); document.location.href='data_calon_osis.php'</script>";
		}
	}elseif($get == 'data_panitia'){
		if(isset($_POST['edit_panitia'])){
			$kode = $_POST['kode'];
			$nama = $_POST['nama'];
			$username = $_POST['username'];
			$password_baru = $_POST['password_baru'];
			$password_lama = $_POST['password_lama'];

			if($password_baru == ''){
				$password = $password_lama;
			}else{
				$password = sha1($password_baru);
			}

			$email = $_POST['email'];
			$jenis_kelamin = $_POST['jenis_kelamin'];
			$status_aktif = $_POST['status_aktif'];

			$edit = mysqli_query($koneksi, "UPDATE tb_user SET 
				nama     	= '$nama',
				username     = '$username',
				password 	= '$password',
				email  		= '$email',
				status_aktif  = '$status_aktif',
				jenis_kelamin  = '$jenis_kelamin'
				WHERE kode_user='$kode'
				");
			if($edit){
				echo "<script>alert('Data berhasil di edit..!'); document.location.href='data_panitia.php'</script>";
			}else{
				echo mysqli_error($koneksi);
			}
		}else{
			echo mysqli_error($koneksi);
		}

	}elseif($get == 'data_admin'){
		if(isset($_POST['edit_admin'])){
			$kode = $_POST['kode'];
			$nama = $_POST['nama'];
			$username = $_POST['username'];
			$password_baru = $_POST['password_baru'];
			$password_lama = $_POST['password_lama'];

			if($password_baru == ''){
				$password = $password_lama;
			}else{
				$password = sha1($password_baru);
			}

			$email = $_POST['email'];
			$jenis_kelamin = $_POST['jenis_kelamin'];
			$status_aktif = $_POST['status_aktif'];

			$edit = mysqli_query($koneksi, "UPDATE tb_user SET 
				nama     	= '$nama',
				username     = '$username',
				password 	= '$password',
				email  		= '$email',
				status_aktif  = '$status_aktif',
				jenis_kelamin  = '$jenis_kelamin'
				WHERE kode_user='$kode'
				");
			if($edit){
				echo "<script>alert('Data berhasil di edit..!'); document.location.href='data_admin.php'</script>";
			}else{
				echo mysqli_error($koneksi);
			}
		}else{
			echo mysqli_error($koneksi);
		}

	}elseif($get == 'data_siswa'){
		if(isset($_POST['edit_siswa'])){
			$nis = $_POST['nis'];
			$nama = $_POST['nama'];
			$jenis_kelamin = $_POST['jenis_kelamin'];
			$jurusan = $_POST['jurusan'];
			$status_aktif = $_POST['status_aktif'];
			$email = $_POST['email'];
			$no_hp = $_POST['no_hp'];

			$edit = mysqli_query($koneksi, "UPDATE tb_siswa SET 
				nama     	= '$nama',
				jenis_kelamin     = '$jenis_kelamin',
				jurusan 	= '$jurusan',
				status_aktif  		= '$status_aktif',
				email  = '$email',
				no_hp  = '$no_hp'
				WHERE nis='$nis'
				");
			if($edit){
				echo "<script>alert('Data berhasil di edit..!'); document.location.href='data_siswa.php'</script>";
			}else{
				echo mysqli_error($koneksi);
			}
		}else{

		}
	}
}



//function untuk edit foto
function upload(){
	$nama_file    = $_FILES['foto_baru']['name'];
	$tempat 	  = $_FILES['foto_baru']['tmp_name'];
	$error 		  = $_FILES['foto_baru']['error'];

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

		alert('Ekstensi gambar yang Anda pilih tidak sesuai');

		</script>";
		return false;
	}

	$ektensifilebaru  =  uniqid();
	$ektensifilebaru .=  '.';
	$ektensifilebaru .=  $ektensigambar;



	move_uploaded_file($tempat, '../foto_kandidat/' . $ektensifilebaru);

	return $ektensifilebaru;
}