<?php  

	require 'functions.php';
	if(isset($_POST["nomor_nasabah"])){
		$nomor = $_POST["nomor_nasabah"];
		$hasil = query("SELECT * FROM data_pinjaman 
			INNER JOIN data_nasabah 
			ON data_pinjaman.nomor_nasabah=data_nasabah.nomor_nasabah 
			WHERE kode_pinjaman=$nomor");
		$laporan = $hasil[0];

		$hasilAngsuran = query("SELECT * FROM data_angsuran
			WHERE kode_pinjaman=$nomor");
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
	<table class="table">
	  <thead>
	    <tr>
	      <th scope="col">Informasi</th>
	      <th scope="col">Keterangan</th>
	    </tr>
	  </thead>
	  <tbody>
	  	<tr>
	      <td>Kode Nasabah</td>
	      <td><?=$laporan["nomor_nasabah"];?></td>
	    </tr>
	    <tr>
	      <td>Nama Nasabah</td>
	      <td><?=$laporan["nama_nasabah"];?></td>
	    </tr>
	    <tr>
	      <td>Kode Pinjaman</td>
	      <td><?=$laporan["kode_pinjaman"];?></td>
	    </tr>
	    <tr>
	      <td>Status Pinjaman</td>
	      <?php 
	      	if($laporan["status_pinjaman"]==1){
	      		$status = "Lunas";
	      	} else {
	      		$status = "Belum Lunas";
	      	}
	      ?>
	      <td><b><?=$status;?></b></td>
	    </tr>
	    <tr>
	      <td>Tanggal Mulai</td>
	      <td><?=$laporan["tanggal_mulai"];?></td>
	    </tr>
	    <tr>
	      <td>Tanggal Selesai</td>
	      <td><?=$laporan["tanggal_berakhir"];?></td>
	    </tr>
	    <tr>
	      <td>Bunga</td>
	      <td><?=$laporan["bunga_pinjaman"];?>% per Tahun</td>
	    </tr>
	    <tr>
	      <td>Besar Pinjaman</td>
	      <td><?=rupiah($laporan["besar_pinjaman"]);?></td>
	    </tr>
	    <tr>
	      <td>Banyak Angsuran</td>
	      <td><?=$laporan["banyak_angsuran"];?></td>
	    </tr>
	  </tbody>
	</table>


	<table class="table">
	  <thead>
	    <tr>
	      <th scope="col">Angsuran Ke</th>
	      <th scope="col">Jumlah Angsuran</th>
	      <th scope="col">Sisa Pinjaman</th>
	    </tr>
	  </thead>
	  <tbody>
	  	<?php foreach ($hasilAngsuran as $angsuran) : ?>
	  	<tr>
	      <td><?=$angsuran["angsuran_ke"];?></td>
	      <td><?=rupiah($angsuran["jumlah_angsuran"]);?></td>
	      <td><?=rupiah($angsuran["sisa_pinjaman"]);?></td>
	    </tr>
		<?php endforeach; ?>
	  </tbody>
	</table>
  </div>
</div>
</body>
</html>