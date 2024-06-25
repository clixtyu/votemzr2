
<?php 
include'templet/header.php' ?>
<?php include'templet/topbar.php' ?>
<?php
if(!isset($_SESSION['username'])){
 echo "<script> document.location.href='../index.php' </script>";
}else{?>

    <?php 
    include'../koneksi.php';
    $nis = $_SESSION['nis'];
    $query = mysqli_query($koneksi,"SELECT * FROM tb_pemilih WHERE nis='$nis'");
    $data = mysqli_fetch_array($query);

    if(isset($_POST['edit_pemilih'])){
      //edit data pemilih
        $nis    = $_POST['nis'];
        $nama = $_POST['nama'];
        $nis = $_POST['nis'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $no_hp = $_POST['no_hp'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $alamat = $_POST['alamat'];


        $edit = mysqli_query($koneksi, "UPDATE tb_pemilih SET 
            nama     = '$nama',
            nis      = '$nis',
            username = '$username',
            email    = '$email',
            jenis_kelamin = '$jenis_kelamin',
            no_hp    = '$no_hp',
            alamat   = '$alamat'
            WHERE nis='$nis'
            ");
        if($edit){
         ?>
         <script>
           Swal.fire({
            icon: 'success',
            title: 'Berhasil...',
            text: 'Selamat, data berhasil di edit',
        })
    </script>
    <?php
}else{
    echo mysqli_error($koneksi);
}
}

?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">

            <!-- Edit Profil -->
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Profil</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                     <form  method="post">
                        <div class="form-group">
                            <label for="nama">NIS</label>
                            <input required="" type="text" hidden="" name="id" value="${hasil.id}">
                            <input readonly="" required="" type="text" id="nis" name="nis" class="form-control" value="<?php echo $data['nis'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama Pemilih</label>
                            <input required="" type="text" id="nama" name="nama" class="form-control" value="<?php echo $data['nama'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input required="" type="text" id="username" name="username" class="form-control" value="<?php echo $data['username'] ?>" >
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input  required="" type="email" id="email" name="email" class="form-control" value="<?php echo $data['email'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="no_hp">No HP</label>
                            <input  required="" type="number" id="no_hp" name="no_hp" class="form-control" value="<?php echo $data['no_hp'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                                <option <?php if($data['jenis_kelamin'] == 'laki-laki'){echo "selected";}?> value="laki-laki">Laki-Laki</option>
                                <option  <?php if($data['jenis_kelamin'] == 'perempuan'){echo "selected";}?>  value="perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div style="color:red" id="validasi_pemilih"></div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea required="" id="alamat" name="alamat" rows="3" class="form-control"><?php echo $data['alamat'] ?></textarea>
                        </div>
                        <div class="modal-footer">
                            <button style="width:140px" type="submit" class="btn btn-primary" name="edit_pemilih">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->

    </div>
    <!-- /row -->
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include'templet/footer.php' ?>
<?php } ?>