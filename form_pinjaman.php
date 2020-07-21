<?php  
	require 'functions.php';
	if(isset($_POST["nomor_nasabah"])){
		$nomor = $_POST["nomor_nasabah"];
		$hasil = masukkanData("SELECT * FROM data_nasabah WHERE nomor_nasabah=$nomor");
		$result = query("SELECT * FROM data_nasabah WHERE nomor_nasabah=$nomor");
		$dataPengguna = $result[0];
		if($hasil!=1){
			echo '
					<script>
						alert("Nomor Tidak Terdaftar!");
						document.location.href= "template.php?content=user_pinjam.php";
					</script>
				';
		}
	}

	if(isset($_POST["submit_pinjaman"])){
		$nomor = $_POST["nomor"];
		$bunga = $_POST["bunga"];
		$besar_pinjaman = $_POST["besar_pinjaman"];
		$banyak_angsuran = $_POST["banyak_angsuran"];
		masukkanData("INSERT INTO data_pinjaman VALUES (
			'', 
			CURRENT_DATE,
			DATE_ADD(CURRENT_DATE, INTERVAL '$banyak_angsuran' MONTH), 
			'$bunga',
			'$besar_pinjaman',
			'$banyak_angsuran',
			'$nomor',
			'0')");
		echo '
					<script>
						alert("Transaksi Berhasil!");
						document.location.href= "template.php?content=user_pinjam.php";
					</script>
				';
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
    <form action="" method="post">
		<h2>Transaksi Pinjaman</h2>
		<div class="form-group">
			<fieldset disabled>
			<label for="nomor_nasabah">Nomor Nasabah</label>
    		<input type="text" class="form-control" placeholder="<?=$nomor;?>">
		</div>
			<input type="hidden" class="form-control" id="nomor" name="nomor" value="<?=$nomor;?>">
		<div class="form-group">
			<fieldset disabled>
			<label for="nama_nasabah">Nama Nasabah</label>
    		<input type="text" class="form-control" id="nama_nasabah" name="nama_nasabah" value="<?=$dataPengguna['nama_nasabah'];?>">
		</div>
		<div class="form-group">
			<fieldset disabled>
			<label for="bunga">Besar Bunga (Flat)</label>
    		<input type="text" class="form-control" id="bunga" name="bunga" required autocomplete="off" value="12% / Tahun (1% / Bulan)">
		</div>
			<input type="hidden" class="form-control" id="bunga" name="bunga" value="<?=12;?>">
		<div class="form-group">
			<label for="besar_pinjaman">Besar Pinjaman</label>
    		<input type="text" class="form-control" id="besar_pinjaman" name="besar_pinjaman" required autocomplete="off">
		</div>
		<div class="form-group">
			<label for="banyak_angsuran">Banyak Angsuran (Bulan)</label>
    		<input type="text" class="form-control" id="banyak_angsuran" name="banyak_angsuran" required autocomplete="off">
		</div>
		<button class="btn btn-primary" type="submit" name="submit_pinjaman" style="width: 100%;">Button</button>
	</form>
  </div>
</div>
</body>
</html>