<?php include'templet/header.php' ?>
<?php include'templet/topbar.php' ?>
<?php

if(!isset($_SESSION['username'])){
  echo "<script> document.location.href='../index.php' </script>";
}else{

  ?>
  <style>
    table .aksi{
      display: flex;
      justify-content: center;
    }
    form{
      margin: 10px;
    }
    #tombol-tambah-pelatih{
      width: 140px;
    }
    .modal-footer{
      justify-content: space-around;
    }
    .tombol-reset{
      width: 140px;
    }
    .tombol-close{
      width: 140px;
    }
  </style>


  <div class="container-fluid">
    <div class="card">
     <div class="card-header">
      <h3 style="float:left">Data Voting</h3>
      <a style="float: right" type="button" class="btn btn-warning mb-4 text-white" href="reset_voting.php">Reset Voting</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover table-bordered table-striped" id="datatable" style="width:100%">
          <thead>
            <tr>
              <th width="5%">No</th>
              <th class="text-center">NIS Pemilih</th>
              <th class="text-center">ID Kandidat</th>
              <th class="text-center">Nama Pemilih</th>
              <th class="text-center">Pilihan</th>
              <th class="text-center">Tanggal Voting</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            include '../koneksi.php';
            $no = 1;
            $query = mysqli_query($koneksi, "SELECT * FROM tb_voting");
            while ($data = mysqli_fetch_array($query)) {
             ?>
             <tr>
               <td><?php echo $no++ ?></td>
               <td><?php echo $data['nis'] ?></td>
               <td><?php echo $data['id_kandidat'] ?></td>
               <td><?php echo $data['nama_pemilih'] ?></td>
               <td><?php echo $data['pilihan'] ?></td>
               <td><?php echo $data['tanggal_milih'] ?></td>
             </tr>
           <?php } ?>
         </tbody>
       </table>
     </div>
   </div>
 </div>
 <hr>
 <br>
 <br>
 <br>

 <hr>


 <div class="card">
  <div class="card-header">
   <h2 style="float:left">Total suara yang di dapatkan</h2>
   <a href="cetak_pdf.php" style="float:right" class="btn btn-info inline"><i class="fa fa-print mr-2"> Cetak</i></a>
 </div>
 <div class="card-body">
   <table class="table" style="width : 400px;">
     <?php 
     $no = 1;
     $query = mysqli_query($koneksi, "SELECT * FROM tb_kandidat");
     while ($data = mysqli_fetch_array($query)) {
       ?>
       <tr>
        <th><?php echo $data['nama_calon'] ?></th>
        <td>:</td>
        <td><?php echo $data['suara'] ?> Suara</td>
      </tr>
    <?php } ?>
  </table>
</div>
</div>


</div>

<?php include'templet/footer.php' ?>

<?php } ?>