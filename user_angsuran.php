
<!DOCTYPE html>
<html>
<head>
	<title>Beranda</title>
</head>
<body>
<div class="row">
  <div class="col-sm-12">
    <form action="template.php?content=form_angsuran.php" method="post" enctype="multipart/form-data">
		<h2>Masukkan Nomor Angsuran Anda</h2>
		<div class="form-group">
			<label for="nomor_nasabah">Nomor Angsuran</label>
    		<input type="text" class="form-control" id="nomor_nasabah" name="nomor_nasabah" required autocomplete="off">
		</div>
		<button class="btn btn-primary" type="submit" name="submit" style="width: 100%;">Button</button>
	</form>
  </div>
</div>
</body>
</html>