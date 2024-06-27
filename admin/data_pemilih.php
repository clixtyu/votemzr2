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

<title>Data Pemilih</title>

  <div class="container-fluid">
    <div class="card">
     <div class="card-header">
      <h3 style="float:left">Data Pemilih</h3>
      <a style="float: right" type="button" class="btn btn-outline-warning mb-4" data-toggle="modal" data-target="#modal-tambah-pemilih" ><i class="fas fa-user-plus"></i> Tambah Pemilih</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover table-bordered table-striped" id="datatable" style="width:100%">
          <thead>
            <tr>
              <th width="5%">No</th>
              <th class="text-center">NIS</th>
              <th class="text-center">Nama</th>
              <th class="text-center">Username</th>
              <th class="text-center">Email</th>
              <th class="text-center">No HP</th>
              <th class="text-center">Status Aktif</th>
              <th class="text-center">Tanggal Daftar</th>
              <th class="text-center">Jenis Kelamin</th>
              <th class="text-center">Alamat</th>
              <th width="15%">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            include '../koneksi.php';
            $no = 1;
            $query = mysqli_query($koneksi, "SELECT * FROM tb_pemilih");
            while ($data = mysqli_fetch_array($query)) {
             ?>
             <tr>
               <td><?php echo $no++ ?></td>
               <td><?php echo $data['nis'] ?></td>
               <td><?php echo $data['nama'] ?></td>
               <td><?php echo $data['username'] ?></td>
               <td><?php echo $data['email'] ?></td>
               <td><?php echo $data['no_hp'] ?></td>
               <td><?php echo $data['status_aktif'] ?></td>
               <td><?php echo $data['tanggal_daftar'] ?></td>
               <td><?php echo $data['jenis_kelamin'] ?></td>
               <td><?php echo $data['alamat'] ?></td>
               <td>
                <a class="btn btn-danger" onclick="return confirm('Yakin mau hapus?')" href="aksi_hapus.php?id=<?php echo $data['id'] ?>&hapus=data_pemilih"><i class="fa fa-trash"></i></a>
                <button data-id="<?php echo $data['id'] ?>" id="tombol-editpemilih" class="btn btn-info"><i class="fa fa-edit"></i></button>
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
    $('#datatable').on('click','#tombol-editpemilih', function(){
      let id = $(this).data('id');
      
      $.ajax({
        url : 'mendapat_data_edit.php?dapat=data_pemilih',
        data : {'id': id},
        type : 'post',
        dataType : 'json',
        success: function(hasil){
          $('#modal-edit-pemilih').modal('show');
          $('.penampung-edit-pemilih').html(`
            <form action="aksi_edit.php?edit=data_pemilih" method="post">
            <div class="form-group">
            <label for="nama">NIS</label>
            <input required="" type="text" hidden="" name="id" value="${hasil.id}">
            <input required="" type="text" id="nis" name="nis" class="form-control" value="${hasil.nis}">
            </div>
            <div class="form-group">
            <label for="nama">Nama Pemilih</label>
            <input required="" type="text" id="nama" name="nama" class="form-control" value="${hasil.nama}">
            </div>
            <div class="form-group">
            <label for="username">Username</label>
            <input required="" type="text" id="username" name="username" class="form-control" value="${hasil.username}" >
            </div>
            <div class="form-group">
            <label for="email">Email</label>
            <input  required="" type="email" id="email" name="email" class="form-control" value="${hasil.email}">
            </div>
            <div class="form-group">
            <label for="no_hp">No HP</label>
            <input  required="" type="number" id="no_hp" name="no_hp" class="form-control" value="${hasil.no_hp}">
            </div>
            <div class="form-group">
            <label for="status_aktif">Status Aktif</label>
            <select name="status_aktif" id="status_aktif" class="form-control">
            <option ${(hasil.status_aktif == 'aktif')?'selected' : ''} value="aktif">aktif</option>
            <option ${(hasil.status_aktif == 'tidak')?'selected' : ''} value="tidak">tidak</option>
            </select>
            </div>
            <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required="">
            <option ${(hasil.jenis_kelamin == 'laki-laki')?'selected' : ''} value="laki-laki">Laki-Laki</option>
            <option ${(hasil.jenis_kelamin == 'perempuan')?'selected' : ''} value="perempuan">Perempuan</option>
            </select>
            </div>
            <div class="alert alert-info">Jika ingin mengganti password, silhakan isi from input password atau jika tidak, kosongkan saja</div>
            <div class="form-group">
            <label for="password">Password</label>
            <input   type="text" id="password" name="password_baru" class="form-control">
            <input  required="" type="text" hidden name="password_lama" value="${hasil.password}">
            </div>
            <div style="color:red" id="validasi_pemilih"></div>
            <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea required="" id="alamat" name="alamat" rows="3" class="form-control">${hasil.alamat}</textarea>
            </div>
            <div class="modal-footer">
            <button style="width:140px" type="submit" class="btn btn-primary" name="edit_pemilih" id="tombol-tambah-pemilih">Edit</button>
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

<!-- Modal tambah-->
<div class="modal fade" id="modal-tambah-pemilih" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <div class="modal-header">
     <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pemilih</h5>
   </div>
   <div class="modal-body">
     <form action="aksi_insert.php?tambah=data_pemilih" method="post">
       <div class="form-group">
        <label for="nama">NIS</label>
        <select required="" name="nis" id="nis" class="form-control">
          <option value="">Pilih NIS</option>
          <?php 
          $query = mysqli_query($koneksi, "SELECT * FROM tb_siswa");
          while($sis  = mysqli_fetch_array($query)){ ?>
            <option value="<?php echo $sis['nis'] ?>"><?php echo $sis['nis'] ?></option>
          <?php } ?>
        </select>
      </div>
      <div class="form-group">
        <label for="nama">Nama Pemilih</label>
        <input required="" type="text" id="nama" name="nama" autocomplete="off" class="form-control">
      </div>
      <div class="form-group">
        <label for="username">Username</label>
        <input required="" type="text" id="username" autocomplete="off" name="username" class="form-control" >
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input  required="" type="email" id="email" autocomplete="off" name="email" class="form-control">
      </div>
      <div class="form-group">
        <label for="no_hp">No HP</label>
        <input  required="" type="number" autocomplete="off" id="no_hp" name="no_hp" class="form-control">
      </div>
      <div class="form-group">
        <label for="jenis_kelamin">Jenis Kelamin</label>
        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required="">
         <option selected="" disabled="">Pilih Jenis Kelamin</option>
         <option value="laki-laki">Laki-Laki</option>
         <option value="perempuan">Perempuan</option>
       </select>
     </div>
     <div class="form-group">
      <label for="password">Password</label>
      <input  required="" type="password" id="password" name="password" class="form-control">
    </div>
    <div style="color:red" id="validasi_pemilih"></div>
    <div class="form-group">
      <label for="alamat">Alamat</label>
      <textarea required="" id="alamat" name="alamat" rows="3" class="form-control"></textarea>
    </div>
    <div class="modal-footer">
      <button type="submit" class="btn btn-primary" name="tambah_pemilih" id="tombol-tambah-pemilih">Tambah</button>
      <button type="reset" class="btn btn-danger tombol-reset ml-2">Reset</button>
      <button type="button" class="btn btn-secondary tombol-close" data-dismiss="modal">Close</button>
    </div>
  </form>
</div>
</div>
</div>
</div>

<!-- Modal tambah-->
<div class="modal fade" id="modal-edit-pemilih" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Edit Data Pemilih</h5>
    </div>
    <div class="penampung-edit-pemilih">

    </div>
  </div>
</div>
</div>

<?php } ?>