<?php 	

include'../koneksi.php';
$id  = $_POST['id'];

$get = mysqli_query($koneksi, "SELECT * FROM tb_kandidat WHERE id_kandidat=$id");
$data = mysqli_fetch_array($get);

echo json_encode($data);

?>