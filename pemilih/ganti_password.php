<?php include'templet/header.php' ?>
<?php include'templet/topbar.php' ?>

<div class="container-fluid">
	<div class="card">
		<div class="card-header">
			<h3>Ganti Password Anda</h3>
		</div>
		<div class="card-body">
			<form id="form-gantipassword" method="post">
				<div class="form-group">
					<label for="password_lama">Password Lama</label>
					<input required="" type="password" class="form-control" name="password_lama" id="password_lama">
				</div>
				<div class="form-group">
					<label for="password_baru">Password Baru</label>
					<input required="" type="password" minlength="5" class="form-control" name="password_baru" id="password_baru">
				</div>
				<div class="form-group">
					<label for="Confirm_password">Konfirmasi Password</label>
					<input required="" type="password" minlength="5" class="form-control" name="Konfirmasi_password" id="Confirm_password">
					<div id="validate" style="color: red"></div>
				</div>
				<button type="submit" name="ganti" class="btn btn-success">Ganti</button>
			</form>
		</div>
	</div>
</div>

<?php include'templet/footer.php' ?>

<script>
	$(document).ready(function(){
		$('#form-gantipassword').on('submit', function(e){
			e.preventDefault();
			let data      = $('#form-gantipassword').serialize();
			let password1 = $('#password_baru').val();
			let password2 = $('#Confirm_password').val();

			if(password1 != password2){
				$('#validate').html('Password tidak sama...');
			}else{
				$.ajax({
					url : 'aksi_gantipassword.php',
					data : data,
					type : 'post',
					dataType : 'json',
					success: function(hasil){
						if(hasil.ganti == true){
							Swal.fire({
								icon: 'success',
								title: 'Berhasil..!',
								text: 'Selamat, password Anda berhasil di ganti..!',
							})
						}else if(hasil.ganti == 'password_salah'){
							Swal.fire({
								icon: 'warning',
								title: 'Gagal',
								text: 'Password lama Anda salah..!',
							})
						}else{
							Swal.fire({
								icon: 'error',
								title: 'Gagal',
								text: 'Anda gagal menganti password!',
							})
						}
					}
				})
			}
		})
	})
</script>