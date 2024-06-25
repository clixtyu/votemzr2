<?php 
include'../koneksi.php';

$edit  = mysqli_query($koneksi, "UPDATE tb_kandidat SET suara=0");
$reset = mysqli_query($koneksi, "DELETE FROM tb_voting");


if($reset){
	echo "<script>alert('Data berhasil di reset..!'); document.location.href='check_voting.php'</script>";
}else{
	echo mysqli_error($koneksi);
}

?>