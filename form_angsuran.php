<?php  

	require 'functions.php';
	if(isset($_POST["nomor_nasabah"])){
		$nomor = $_POST["nomor_nasabah"];
		// cek apakah ada datanya.
		$hasil = masukkanData("SELECT * FROM data_pinjaman WHERE kode_pinjaman=$nomor");
		// Ambil data pinjaman dan data nasabah.
		$result = query("SELECT * FROM data_pinjaman INNER JOIN data_nasabah ON data_pinjaman.nomor_nasabah = data_nasabah.nomor_nasabah WHERE kode_pinjaman=$nomor");
		$dataPengguna = $result[0];

		// Ambil data angsuran ke.
		$angsuran = query("SELECT * FROM `data_angsuran` WHERE kode_pinjaman='$nomor' ORDER BY angsuran_ke DESC");
		if(count($angsuran)==0){
			$angsuran = 0 + 1;
		} else {
			$angsuran = $angsuran[0]["angsuran_ke"] + 1;
		}

		if($hasil!=1){
			// JIKA DATA TIDAK DITEMUKAN.
			echo '
					<script>
						alert("Nomor Tidak Terdaftar!");
						document.location.href= "template.php?content=user_angsuran.php";
					</script>
				';
		} else if($hasil==1 AND $dataPengguna["status_pinjaman"]==1){
			// JIKA ADA DATANYA DAN SUDAH LUNAS.
			echo '
					<script>
						alert("Tagihan Anda Sudah Lunas!");
						document.location.href= "template.php?content=beranda.php";
					</script>
				';
		}
	}

	if(isset($_POST["submit_angsuran"])){
		$angsuran_ke = $_POST["angsuran_ke"];
		$jumlah_angsuran = $_POST["jumlah_angsuran"];
		$sisa_pinjaman = $_POST["sisa_pinjaman"];
		$kode_pinjaman = $_POST["kode"];
		$banyak_angsuran = $_POST["banyak_angsuran"];
		if($sisa_pinjaman==0){
			masukkanData("UPDATE data_pinjaman
				SET status_pinjaman='1'
				WHERE kode_pinjaman='$kode_pinjaman'");
		}
		masukkanData("INSERT INTO data_angsuran VALUES(
				'$angsuran_ke','$jumlah_angsuran','$sisa_pinjaman', '$kode_pinjaman');");
		echo '
					<script>
						alert("Angsuran Berhasil di Bayar!");
						document.location.href= "template.php?content=beranda.php";
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
		<h2>Form Pembayaran Angsuran</h2>
		<div class="form-group">
			<fieldset disabled>
			<label for="kode">Kode Angsuran</label>
    		<input type="text" class="form-control" placeholder="<?=$nomor;?>">
		</div>
			<input type="hidden" class="form-control" id="kode" name="kode" value="<?=$nomor;?>">
		<div class="form-group">
			<fieldset disabled>
			<label for="nomor_nasabah">Nomor Nasabah</label>
    		<input type="text" class="form-control" id="nomor_nasabah" name="nomor_nasabah" value="<?=$dataPengguna['nomor_nasabah'];?>">
		</div>
		<div class="form-group">
			<fieldset disabled>
			<label for="nama_nasabah">Nama Nasabah</label>
    		<input type="text" class="form-control" id="nama_nasabah" name="nama_nasabah" value="<?=$dataPengguna['nama_nasabah'];?>">
		</div>
		<div class="form-group">
			<fieldset disabled>
			<label for="besar_pinjaman">Besar Pinjaman</label>
    		<input type="text" class="form-control" id="besar_pinjaman" name="besar_pinjaman" required autocomplete="off" value="<?=rupiah($dataPengguna['besar_pinjaman']);?>">
		</div>
		<div class="form-group">
			<fieldset disabled>
			<label for="banyak_angsuran">Banyak Angsuran (Bulan)</label>
    		<input type="text" class="form-control" id="banyak_angsuran" name="banyak_angsuran" required autocomplete="off" value="<?=$dataPengguna['banyak_angsuran'];?>">
		</div>
		<div class="form-group">
			<fieldset disabled>
			<label for="angsuran_ke">Angsuran Ke</label>
    		<input type="text" class="form-control" id="angsuran_ke" name="angsuran_ke" required autocomplete="off" value="<?=$angsuran;?>">
		</div>
			<input type="hidden" class="form-control" id="angsuran_ke" name="angsuran_ke" value="<?=$angsuran;?>">
		<div class="form-group">
			<fieldset disabled>
			<label for="jumlah_angsuran">Jumlah Angsuran</label>
			<?php  
				$total_pinjaman = $dataPengguna["besar_pinjaman"];
				$total_angsuran = $dataPengguna["banyak_angsuran"];
				$bunga			= $total_pinjaman*(1/100);
				$pinjamanpokok  = $total_pinjaman/$total_angsuran;
				$total 			= $pinjamanpokok + $bunga;
			?>
    		<input type="text" class="form-control" id="jumlah_angsuran" name="jumlah_angsuran" required autocomplete="off" value="<?=rupiah($total);?>">
		</div>
			<input type="hidden" class="form-control" id="jumlah_angsuran" name="jumlah_angsuran" value="<?=$total;?>">
			<input type="hidden" class="form-control" id="sisa_pinjaman" name="sisa_pinjaman" value="<?=$total_pinjaman-($pinjamanpokok*$angsuran);?>">
			<input type="hidden" class="form-control" id="banyak_angsuran" name="banyak_angsuran" value="$dataPengguna['banyak_angsuran']">
		<button class="btn btn-primary" type="submit" name="submit_angsuran" style="width: 100%;">Button</button>
	</form>
  </div>
</div>
</body>
</html>