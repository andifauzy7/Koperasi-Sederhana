<?php  
	require 'functions.php';

	$kode = rand(100000000,999999999);

	if(isset($_POST["submit"])){
		if(tambahNasabah($_POST)>0){
			echo '
					<script>
						alert("Data Berhasil Ditambahkan");
						document.location.href= "template.php?content=beranda.php";
					</script>
				';
		} else {
			echo '
					<script>
						alert("Data Gagal Ditambahkan");
						document.location.href= "template.php?content=data_nasabah.php";
					</script>
				';
		}
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Beranda</title>
</head>
<body>
<div class="row">
  <div class="col-sm-12">
    <form action="" method="post" enctype="multipart/form-data">
		<h2>Form Data Nasabah</h2>
		<div class="form-group">
			<fieldset disabled>
			<label for="nomor_nasabah">Nomor Nasabah</label>
    		<input type="text" class="form-control" placeholder="<?=$kode;?>">
		</div>
			<input type="hidden" class="form-control" id="nomor_nasabah" name="nomor_nasabah" value="<?=$kode;?>">
		<div class="form-group">
			<label for="nama_nasabah">Nama Nasabah</label>
    		<input type="text" class="form-control" id="nama_nasabah" name="nama_nasabah" required autocomplete="off">
		</div>
		<div class="form-group">
			<label for="ktp">Nomor KTP</label>
    		<input type="text" class="form-control" id="ktp" name="ktp" required autocomplete="off">
		</div>
		<div class="form-group">
			<label for="gambar">Foto Nasabah</label>
    		<input type="file" class="form-control-file" id="gambar" name="gambar" required>
		</div>
		<div class="form-group">
			<label for="no_handphone">Nomor Handphone</label>
    		<input type="text" class="form-control" id="no_handphone" name="no_handphone" required autocomplete="off">
		</div>
		<button class="btn btn-primary" type="submit" name="submit" style="width: 100%;">Button</button>
	</form>
  </div>
</div>
</body>
</html>