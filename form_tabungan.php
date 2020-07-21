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
						document.location.href= "template.php?content=user_tabungan.php";
					</script>
				';
		}
	}


	if(isset($_POST["submit_tabungan"])){
		$nomor = $_POST["nomor"];
		$saldo = $_POST["saldo"];
		$jenis = $_POST["jenis_transaksi"];
		$besar = $_POST["besar_transaksi"];
		if($jenis==2){
			if($saldo<$besar){
				echo '
					<script>
						alert("Saldo Tidak Mencukupi!");
						document.location.href= "template.php?content=user_tabungan.php";
					</script>
				';
				exit();
			}
			$saldo = $saldo - $besar;
		} else if($jenis==1){
			$saldo = $saldo + $besar;
		}
		masukkanData("INSERT INTO transaksi_tabungan VALUES
			('', '$jenis','$besar','$saldo', CURRENT_TIMESTAMP(),'$nomor')");
		masukkanData("UPDATE data_nasabah 
			SET jumlah_tabungan = '$saldo' 
			WHERE nomor_nasabah = '$nomor'");
		echo '
					<script>
						alert("Transaksi Berhasil!");
						document.location.href= "template.php?content=user_tabungan.php";
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
		<h2>Transaksi Tabungan</h2>
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
			<label for="saldo">Saldo</label>
    		<input type="text" class="form-control" id="saldo" name="saldo" value="<?=rupiah($dataPengguna['jumlah_tabungan']);?>">
		</div>
			<input type="hidden" class="form-control" id="saldo" name="saldo" value="<?=$dataPengguna['jumlah_tabungan'];?>">
		<div class="form-group">
			<label for="jenis_transaksi">Jenis Transaksi</label>
			<select class="form-control" id="jenis_transaksi" name="jenis_transaksi">
				<option value="1">SETOR TUNAI</option>
				<option value="2">TARIK TUNAI</option>
		    </select>
		</div>
		<div class="form-group">
			<label for="besar_transaksi">Besar Transaksi</label>
    		<input type="text" class="form-control" id="besar_transaksi" name="besar_transaksi" required autocomplete="off">
		</div>
		<button class="btn btn-primary" type="submit" name="submit_tabungan" style="width: 100%;">Button</button>
	</form>
  </div>
</div>
</body>
</html>