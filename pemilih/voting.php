
<?php 
include'templet/header.php' ?>
<?php include'templet/topbar.php' ?>
<?php
if(!isset($_SESSION['username'])){
 echo "<script> document.location.href='../index.php' </script>";
}else{?>


   <div class="container-fluid">
     <div class="row">
      <?php    
      include'../koneksi.php';
      $query = mysqli_query($koneksi, "SELECT * FROM tb_kandidat");
      $no=1;
      while($data=mysqli_fetch_array($query)):
       ?>
       <div class="col-sm-4 mt-3">
         <div class="card"> 
            <div class="card-header">  
               <h5 class="text-center">KANDIDAT OSIS KE <?php echo $no++ ?></h5>
            </div>
            <div  class="thumbnail">
              <div class="card-body">
               <div style="text-align: center">
                 <img style="height: 300px; width: 100%" src="../foto_kandidat/<?php echo $data['foto'] ?>" >
                 <button type="button" data-id="<?php echo $data['id_kandidat'] ?>"  class="btn btn-sm btn-warning mt-3 tombol-voting" style="width: 220px">Pilih</button>
                 <button type="button" data-id="<?php echo $data['id_kandidat'] ?>" class="btn btn-sm btn-primary tombol-detail" style="width: 120px">Detail</i></button>
              </div>
           </div>
        </div>
     </div>
  </div>
<?php    endwhile ?>
</div>
</div>

<?php include'templet/footer.php' ?>

<script> 

   $(document).ready(function(){
      $('.tombol-detail').on('click', function(){
         let id = $(this).data('id');

         $.ajax({
            url : 'detail_kandidat.php',
            data : {'id': id},
            type : 'post',
            dataType : 'json',
            success: function(hasil){
               $('.penampung-kandidat').html(`

                  <table class="table">
                  <tr>
                  <td>Nama</td>
                  <td>:</td>
                  <td><input readonly type="text" class="form-control" value="${hasil.nama_calon}" ></td>
                  </tr>
                  <tr>
                  <td>Visi</td>
                  <td>:</td>
                  <td><textarea readonly class="form-control" rows="5">${hasil.visi}</textarea></td>
                  </tr>
                  <tr> 
                  <td>Misi</td>
                  <td>:</td>
                  <td><textarea readonly class="form-control" rows="5">${hasil.misi}</textarea></td>
                  </tr>
                  </table>
                  `);
               $('#modal-detail-kandidat').modal('show');
            }
         })
      })

      $('.tombol-voting').on('click', function(){
         let id = $(this).data('id');
         let nis = '<?php echo $_SESSION['nis'] ?>';
         let nama = '<?php echo $_SESSION['nama'] ?>';


         Swal.fire({
            title: 'Apakah kamu yakin?',
           text: "Dengan pilihan mu!",
           icon: 'warning',
           showCancelButton: true,
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           confirmButtonText: 'Yes, pilih!'
        }).then((result) => {
           if (result.value) {

            $.ajax({
               url : 'aksi_voting.php',
               data : {'id':id, 'nis': nis, 'nama': nama},
               type : 'post',
               dataType : 'json',
               success: function(hasil){
                 if(hasil.voting == true){
                    Swal.fire({
                       icon: 'success',
                       title: 'Berhasil..!',
                       text: 'Selamat, Anda berhasil voting!',
                    })
                 }else if(hasil.voting == 'sudah_voting'){
                    Swal.fire({
                       icon: 'warning',
                       title: 'Oops...',
                       text: 'Anda sudah voting!',
                    })
                 }else{
                   Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Anda gagal voting!',
                 })
                }
             }
          })
         }
      })

     })
   })

</script>
<!-- Modal tambah-->
<div class="modal fade" id="modal-detail-kandidat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
   <div class="modal-content">
     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
       <span aria-hidden="true">&times;</span>
    </button>
    <div class="modal-header">
     <h5 class="modal-title" id="exampleModalLabel">Detail Kandidat</h5>
  </div>
  <div class="penampung-kandidat">

  </div>
</div>
</div>
</div>

<?php } ?>


