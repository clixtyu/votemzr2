
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="kb.jpg" type="image/x-icon">
  <title>Daftar Pemilih - eVoting MPK</title>
  <!-- jquery -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <!-- chartjs -->
  <script src="assets/js/Chart.js"></script>
  <!-- Custom fonts for this template-->
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="assets/datatable/css/jquery.dataTables.css"/>
  <!-- sweetalert -->
  <script src="assets/sweetalert/sweetalert2.all.min.js" ></script>
  <style>
    body{
      background-color: #34495e;
    }

  </style>
</head>

<body>
 <div class="container">



  <div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body login-card-body p-0">
      <!-- Nested Row within Card Body -->
      <div class="login-logo" style="margin-top:40px;">
        <h3 class="text-center"><b>DAFTAR PEMILIH</b></h3>
      </div>

      <form id="form_pemilih" method="post" class="user">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <div class="p-5">
              <div class="form-group">
                <div class="input-group mb-3">
                  <input type="text" name="nama" class="form-control" autocomplete="off" placeholder="Nama Lengkap" required>
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-user"></span>
                    </div>
                  </div>
                </div>

                <div class="form-group mb-3">
                  <select class="custom-select" name="jenis_kelamin" required>
                    <option hidden>Jenis Kelamin</option>
                    <option value="laki-laki">Laki-Laki</option>
                    <option value="perempuan">Perempuan</option>
                  </select>
                </div>
                <div class="input-group mb-3">
                  <input type="email" name="email" autocomplete="off" class="form-control" placeholder="Alamat Email" required>
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-envelope"></span>
                    </div>
                  </div>
                </div>
                <div class="input-group mb-3">
                  <input type="tel" id="phone" autocomplete="off" name="no_hp" class="form-control" placeholder="Nomor Handphone"
                  required>
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-phone"></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <div class="p-5">
              <div class="input-group">
                <input type="text" name="nis" autocomplete="off" class="form-control" placeholder="NIS" required>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-key"></span>
                  </div>
                </div>
              </div>

              <br>
              <div class="input-group mb-3">
                <textarea name="alamat" class="form-control" placeholder="Alamat" rows="2"
                required></textarea>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-home"></span>
                  </div>
                </div>
              </div>
              <div class="input-group">
                <input type="text" name="username" autocomplete="off" class="form-control" placeholder="Username" required>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                  </div>
                </div>
              </div>

              <br>

              <div class="row">
                <div class="col-6">
                  <div class="input-group">
                    <input type="password" class="form-control" minlength="5" id="password1" name="password1" placeholder="Password" required>
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                      </div>
                    </div>
                  </div>
                  <br>
                </div>
                <div class="col-6">
                  <div class="input-group">
                    <input type="password" class="form-control" minlength="5" id="password2" name="password2" placeholder="Konfirmasi Password" required>
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                      </div>
                    </div>
                  </div>
                  <div style="color:red" class="validate"></div>
                  <br>
                </div>
              </div>

              <button type="submit" name="daftar" class="btn btn-primary btn-user btn-block">
                Daftar
              </button>
            </form>
            <hr>
            <div class="text-center">
              <p>Sudah mempunyai akun? <a href="index.php"> Login disini</a></p>
            </div>

          </div>
        </div>
      </div>
    </div><!-- card body -->
  </div>
</div><!-- container -->
</body>
<script>
  $(document).ready(function(){
    $('#form_pemilih').on('submit', function(e){
      e.preventDefault();
      let data = $('#form_pemilih').serialize();
      let password1 = $('#password1').val();
      let password2 = $('#password2').val();

      if(password1 != password2){
        $('.validate').html('Password tidak sama');
      }else{
        $.ajax({
          url : 'aksi_register.php',
          data : data,
          type : 'post',
          dataType : 'json',
          success: function(hasil){
            if(hasil.insert == true){
              Swal.fire({
                icon: 'success',
                title: 'Berhasil...',
                text: 'Selamat, data berhasil dimasukkan, silahkan login',
              })
              setTimeout(function(){
                document.location.href='index.php?pesan=Data berhasil dimasukkan, silahkan login';
              },1000);
            }else if(hasil.insert == 'nis_ada'){
              Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'NIS Anda sudah terdaftar!',
              })
            }else if(hasil.insert == 'username_ada'){
             Swal.fire({
              icon: 'warning',
              title: 'Oops...',
              text: 'Username sudah ada yang memakai!',
            })
           }else if(hasil.insert == 'nis_blm_terdaftar'){
             Swal.fire({
              icon: 'warning',
              title: 'Oops...',
              text: 'NIS Anda tidak terdaftar..!',
            })
           }else{
             Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Gagal insert data..!',
            })
           }
         }
       })
      }
    })
  })
</script>
</html>

