<?php include'templet/header.php' ?>
<?php include'templet/topbar.php' ?>

<?php

if(!isset($_SESSION['username'])){
 echo "<script> document.location.href='../index.php'</script>";
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
      <h3 style="float:left">Data Panitia</h3>
      <a style="float: right" type="button" class="btn btn-outline-warning mb-4" data-toggle="modal" data-target="#modal-tambah-panitia" ><i class="fas fa-user-plus"></i> Tambah Panitia</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover table-bordered table-striped" id="datatable" style="width:100%">
          <thead>
            <tr>
              <th width="5%">No</th>
              <th class="text-center">Kode panitia</th>
              <th class="text-center">Nama</th>
              <th class="text-center">Username</th>
              <th class="text-center">Email</th>
              <th class="text-center">Status Aktif</th>
              <th class="text-center">Jenis Kelamin</th>
              <th class="text-center">Tanggal Buat</th>
              <th width="15%">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            include '../koneksi.php';
            $no = 1;
            $query = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE role='panitia'");
            while ($data = mysqli_fetch_array($query)) {
             ?>
             <tr>
               <td><?php echo $no++ ?></td>
               <td><?php echo $data['kode_user'] ?></td>
               <td><?php echo $data['nama'] ?></td>
               <td><?php echo $data['username'] ?></td>
               <td><?php echo $data['email'] ?></td>
               <td><?php echo $data['status_aktif'] ?></td>
               <td><?php echo $data['jenis_kelamin'] ?></td>
               <td><?php echo $data['tanggal_buat'] ?></td>
               <td>
                <a class="btn btn-danger" onclick="return confirm('Yakin mau hapus?')" href="aksi_hapus.php?id=<?php echo $data['id'] ?>&hapus=data_panitia"><i class="fa fa-trash"></i></a>
                <button data-id="<?php echo $data['id'] ?>" id="tombol-editpanitia" class="btn btn-info"><i class="fa fa-edit"></i></button>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>

<?php include'templet/footer.php' ?>

<script>
  $(document).ready(function(){
    $('#datatable').on('click','#tombol-editpanitia', function(){
      let id = $(this).data('id');
      
      $.ajax({
        url : 'mendapat_data_edit.php?dapat=data_panitia',
        data : {'id': id},
        type : 'post',
        dataType : 'json',
        success: function(hasil){
          $('#modal-edit-panitia').modal('show');
          $('.penampung-edit-panitia').html(`
            <form action="aksi_edit.php?edit=data_panitia" method="post">
            <div class="form-group">
            <label for="kode">Kode Panitia</label>
            <input readonly="" required="" type="text" id="kode" name="kode" class="form-control" value="${hasil.kode_user}">
            </div>
            <div class="form-group">
            <label for="nama">Nama Panitia</label>
            <input required="" type="text" id="nama" name="nama" class="form-control" value="${hasil.nama}">
            </div>
            <div class="form-group">
            <label for="usernmae">Username</label>
            <input required="" type="text" name="username" class="form-control" value="${hasil.username}">
            </div>
            <div class="alert alert-info btn-sm">Jika tidak ingin mengganti password, kosongkan form password dibawah</div>
            <div class="form-group">
            <label for="password">Password</label>
            <input  type="text" name="password_baru" class="form-control">
            <input required="" hidden type="text" name="password_lama" class="form-control" value="${hasil.password}">
            </div>
            <div class="form-group">
            <label for="email">Email</label>
            <input  required="" type="text" id="email" name="email" class="form-control" value="${hasil.email}">
            </div>
            <div class="form-group">
            <label for="status_aktif">Status Aktif</label>
            <select name="status_aktif" id="status_aktif" class="form-control">
            <option selected="" disabled="">Pilih Status</option>
            <option ${(hasil.status_aktif == 'aktif')?'selected' : ''} value="aktif">Aktif</option>
            <option ${(hasil.status_aktif == 'tidak')?'selected' : ''} value="tidak">Tidak</option>
            </select>
            </div>
            <div class="form-group">
            <label for="jenis_Kelamin">Jenis Kelamin</label>
            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
            <option ${(hasil.jenis_kelamin == 'laki-laki')?'selected' : ''} value="laki-laki">Laki-Laki</option>
            <option ${(hasil.jenis_kelamin == 'perempuan')?'selected' : ''} value="perempuan">Perempuan</option>
            </select>
            </div>
            <div class="modal-footer">
            <button style="width:140px" type="submit" class="btn btn-primary" name="edit_panitia">Edit</button>
            <button style="width:140px" type="reset" class="btn btn-danger tombol-reset ml-2">Reset</button>
            <button style="width:140px" type="button" class="btn btn-secondary tombol-close" data-dismiss="modal">Close</button>
            </div>
            </form>
            `);
        }

      })
    })
  })
</script>

<?php 
include'../koneksi.php';
$query = mysqli_query($koneksi,"SELECT max(kode_user) as kode from tb_user ");
$data  = mysqli_fetch_array($query);
$kode  = $data['kode'];

$nourut = (int) substr($kode, 3,3);
$nourut++;
$char = "US";
$kode = $char. sprintf("%03s", $nourut);

?>

<!-- Modal tambah-->
<div class="modal fade" id="modal-tambah-panitia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <div class="modal-header">
     <h5 class="modal-title" id="exampleModalLabel">Tambah Data Panitia</h5>
   </div>
   <div class="modal-body">
     <form action="aksi_insert.php?tambah=data_panitia" method="post">
      <div class="form-group">
        <label for="kode">Kode Panitia</label>
        <input readonly="" required="" type="text" id="kode" name="kode" class="form-control" value="<?php echo $kode ?>">
      </div>
      <div class="form-group">
        <label for="nama">Nama Panitia</label>
        <input required="" type="text" id="nama" autocomplete="off" name="nama" class="form-control">
      </div>
      <div class="form-group">
        <label for="usernmae">Username</label>
        <input required="" type="text" name="username" autocomplete="off" class="form-control">
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input required="" type="text" name="password" class="form-control" >
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input  required="" type="text" id="email" autocomplete="off" name="email" class="form-control">
      </div>
      <div class="form-group">
        <label for="jenis_Kelamin">Jenis Kelamin</label>
        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
          <option selected="" disabled="">Pilih Jenis Kelamin</option>
          <option value="laki-laki">Laki-Laki</option>
          <option value="perempuan">Perempuan</option>
        </select>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="tambah_panitia" id="tombol-tambah-panitia">Tambah</button>
        <button type="reset" class="btn btn-danger tombol-reset ml-2">Reset</button>
        <button type="button" class="btn btn-secondary tombol-close" data-dismiss="modal">Close</button>
      </div>
    </form>
  </div>
</div>
</div>
</div>



<!-- Modal tambah-->
<div class="modal fade" id="modal-edit-panitia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Edit Data Panitia</h5>
    </div>
    <div class="penampung-edit-panitia">

    </div>
  </div>
</div>
</div>

<?php } ?>