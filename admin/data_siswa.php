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
      <h3 style="float:left">Data Siswa</h3>
      <a style="float: right" type="button" class="btn btn-outline-warning mb-4" data-toggle="modal" data-target="#modal-tambah-siswa" ><i class="fas fa-user-plus"></i> Tambah Siswa</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover table-bordered table-striped" id="datatable" style="width:100%">
          <thead>
            <tr>
              <th width="5%">No</th>
              <th class="text-center">NIS</th>
              <th class="text-center">Nama</th>
              <th class="text-center">Jenis Kelamin</th>
              <th class="text-center">Kelas</th>
              <th class="text-center">Status Aktif</th>
              <th class="text-center">Email</th>
              <th class="text-center">No HP</th>
              <th width="15%">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            include '../koneksi.php';
            $no = 1;
            $query = mysqli_query($koneksi, "SELECT * FROM tb_siswa");
            while ($data = mysqli_fetch_array($query)) {
             ?>
             <tr>
               <td><?php echo $no++ ?></td>
               <td><?php echo $data['nis'] ?></td>
               <td><?php echo $data['nama'] ?></td>
               <td><?php echo $data['jenis_kelamin'] ?></td>
               <td><?php echo $data['jurusan'] ?></td>
               <td><?php echo $data['status_aktif'] ?></td>
               <td><?php echo $data['email'] ?></td>
               <td><?php echo $data['no_hp'] ?></td>
               <td>
                <a class="btn btn-danger" onclick="return confirm('Yakin mau hapus?')" href="aksi_hapus.php?id=<?php echo $data['id'] ?>&hapus=data_siswa"><i class="fa fa-trash"></i></a>
                <button data-id="<?php echo $data['id'] ?>" id="tombol-editsiswa" class="btn btn-info"><i class="fa fa-edit"></i></button>
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
    $('#datatable').on('click','#tombol-editsiswa', function(){
      let id = $(this).data('id');
      
      $.ajax({
        url : 'mendapat_data_edit.php?dapat=data_siswa',
        data : {'id': id},
        type : 'post',
        dataType : 'json',
        success: function(hasil){
          $('#modal-edit-siswa').modal('show');
          $('.penampung-edit-siswa').html(`
            <form action="aksi_edit.php?edit=data_siswa" method="post">
            <div class="form-group">
            <label for="nis">NIS</label>
            <input readonly="" required="" type="text" id="nis" name="nis" class="form-control" value="${hasil.nis}">
            </div>
            <div class="form-group">
            <label for="nama">Nama</label>
            <input required="" type="text" id="nama" name="nama" class="form-control" value="${hasil.nama}">
            </div>
            <div class="form-group">
            <label for="jurusan">Kelas</label>
            <input required="" type="text" id="jurusan" name="jurusan" class="form-control" value="${hasil.jurusan}">
            </div>
            <div class="form-group">
            <label for="jenis_Kelamin">Jenis Kelamin</label>
            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
            <option ${(hasil.jenis_kelamin == 'laki-laki')?'selected' : ''} value="laki-laki">Laki-Laki</option>
            <option ${(hasil.jenis_kelamin == 'perempuan')?'selected' : ''} value="perempuan">Perempuan</option>
            </select>
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
            <label for="email">Email</label>
            <input required="" type="email" id="email" name="email" class="form-control" value="${hasil.email}">
            </div>
            <div class="form-group">
            <label for="no_hp">No HP</label>
            <input required="" type="number" id="no_hp" name="no_hp" class="form-control" value="${hasil.no_hp}">
            </div>
            <div class="modal-footer">
            <button type="submit" class="btn btn-primary" name="edit_siswa" id="tombol-tambah-siswa">Edit</button>
            <button type="reset" class="btn btn-danger tombol-reset ml-2">Reset</button>
            <button type="button" class="btn btn-secondary tombol-close" data-dismiss="modal">Close</button>
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
$query = mysqli_query($koneksi,"SELECT max(nis) as kode from tb_siswa ");
$data  = mysqli_fetch_array($query);
$kode  = $data['kode'];

$nourut = (int) substr($kode, 3,3);
$nourut++;
$char = "SIS";
$kode = $char. sprintf("%03s", $nourut);

?>

<!-- Modal tambah-->
<div class="modal fade" id="modal-tambah-siswa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <div class="modal-header">
     <h5 class="modal-title" id="exampleModalLabel">Tambah Data Siswa</h5>
   </div>
   <div class="modal-body">
     <form action="aksi_insert.php?tambah=data_siswa" method="post">
      <div class="form-group">
        <label for="nis">NIS</label>
        <input  required="" type="text" autocomplete="off" id="nis" name="nis" class="form-control">
      </div>
      <div class="form-group">
        <label for="nama">Nama</label>
        <input required="" type="text" id="nama" autocomplete="off" name="nama" class="form-control">
      </div>
      <div class="form-group">
        <label for="jurusan">Kelas</label>
        <input required="" type="text" id="jurusan" autocomplete="off" name="jurusan" class="form-control">
      </div>
      <div class="form-group">
        <label for="jenis_Kelamin">Jenis Kelamin</label>
        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
          <option selected="" disabled="">Pilih Jenis Kelamin</option>
          <option value="laki-laki">Laki-Laki</option>
          <option value="perempuan">Perempuan</option>
        </select>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input required="" type="email" id="email" autocomplete="off" name="email" class="form-control">
      </div>
      <div class="form-group">
        <label for="no_hp">No HP</label>
        <input required="" type="number" autocomplete="off" id="no_hp" name="no_hp" class="form-control">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="tambah_siswa" id="tombol-tambah-siswa">Tambah</button>
        <button type="reset" class="btn btn-danger tombol-reset ml-2">Reset</button>
        <button type="button" class="btn btn-secondary tombol-close" data-dismiss="modal">Close</button>
      </div>
    </form>
  </div>
</div>
</div>
</div>

<!-- Modal tambah-->
<div class="modal fade" id="modal-edit-siswa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Edit Data Siswa</h5>
    </div>
    <div class="penampung-edit-siswa">

    </div>
  </div>
</div>
</div>

<?php } ?>