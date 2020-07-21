<?php  
	$string_conn	= mysqli_connect("localhost","root","","db_koperasi");

	function query($stringsql){
		global $string_conn;
		$hasil = [];
		// Menerima bentuk mentahan. (PACKED SEMUA DATA)
		$result=mysqli_query($string_conn,$stringsql);
		// PROSES MENGURAI 1 PERSATU DATA.
		while($satuan = mysqli_fetch_assoc($result)){
			$hasil[] = $satuan;
		}
		return $hasil;
	}

	function rupiah($angka){
		$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
		return $hasil_rupiah;
	}

	function konversiGambar(){
		if($_FILES["gambar"]["name"]==NULL){
		return NULL;
		}
		// Attr Foto.
		$namaFiles  = $_FILES["gambar"]["name"];
		$tipe 		= $_FILES["gambar"]["type"];
		$dir 		= $_FILES["gambar"]["tmp_name"];
		$pesan_err 	= $_FILES["gambar"]["error"];
		$ukuran 	= $_FILES["gambar"]["size"];
		$ekstensi 	= ["jpg","jpeg","png"];

		$namaFiles	= explode(".", $namaFiles);
		$namaFiles	= end($namaFiles);
		if(in_array($namaFiles, $ekstensi)){
			$chars = '0123456789abcdefghijklmnopqrstuvwxyz';
			$namaFiles = substr(str_shuffle($chars), 0, 5).'.'.$namaFiles;
			move_uploaded_file($dir, "foto_nasabah/" . $namaFiles);
			return $namaFiles;
		} else {
			echo '
					<script>
						alert("Upload Gambar dengan Ekstensi yang sesuai!");
						document.location.href= "template.php?content=data_nasabah.php";
					</script>
				';
			return NULL;
		}
	}

	function tambahNasabah($data){
		global $string_conn;

		$nomor_nasabah		= htmlspecialchars($data["nomor_nasabah"]);
		$nama_nasabah 		= htmlspecialchars($data["nama_nasabah"]);
		$ktp 				= htmlspecialchars($data["ktp"]);
		$no_handphone 		= htmlspecialchars($data["no_handphone"]);
		$gambar 			= konversiGambar();

		if($gambar!==NULL){
			mysqli_query($string_conn,"
				INSERT INTO data_nasabah 
				VALUES ('$nomor_nasabah','$nama_nasabah','$ktp', '$gambar', '$no_handphone', 0);");
		}

		return mysqli_affected_rows($string_conn);
	}

	function masukkanData($string){
		global $string_conn;
		mysqli_query($string_conn,$string);
		return mysqli_affected_rows($string_conn);
	}

	function editPengguna($data){
		global $string_conn;

		$username 			= $_SESSION["username"];
		$password 			= $_SESSION["password"];
		$namaPengguna 		= $data["nama"];
		$kodePosPengguna 	= $data["kodepos"];
		$alamatPengguna 	= 
			$data["alamat"] . ", " . 
			$data["desa"] . ", " . 
			$data["kecamatan"] . ", " . 
			$data["kotakab"] . ", " . 
			$data["kodepos"];

		$query 				= "
		UPDATE pengguna 
		SET namaPengguna='$namaPengguna', 
			kodePos='$kodePosPengguna', 
			detailAlamat='$alamatPengguna'
		WHERE username='$username' AND password='$password'";
		$result				= mysqli_query($string_conn, $query);

		return mysqli_affected_rows($string_conn);
	}

	function cekIsiChart($kode){
		for ($i=0; $i < count($_SESSION['chart']); $i++) { 
			if($_SESSION['chart'][$i]["kodeBarang"] == $kode){
				$_SESSION['chart'][$i]["kuantitasBarang"]++;
				return True;
			}
		}
		return False;
	}

	function getid($table){
		global $string_conn;
		$result			= mysqli_query($string_conn, "SELECT `AUTO_INCREMENT` FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'dbakademis' AND   TABLE_NAME   = '$table';");
		$hasil = mysqli_fetch_assoc($result);
		return $hasil["AUTO_INCREMENT"]-1;
	}

	function updateBarang($kode, $kuantitas){
		global $string_conn;
		$result			= mysqli_query($string_conn, "SELECT stokBarang from barang WHERE kodeBarang='$kode'");
		$hasil 			= mysqli_fetch_assoc($result);
		$stok 			= $hasil["stokBarang"]-$kuantitas;
		$result			= mysqli_query($string_conn, "UPDATE barang SET stokBarang='$stok' WHERE kodeBarang='$kode'");
	}

	function faktorPembulatan($angka){
		$angkaDasar		= floor($angka);
		$sisa			= $angka-$angkaDasar;
		if($sisa<=0.3){
			$angkaBaru  = floor($angka);
		} else {
			$angkaBaru  = ceil($angka);
		}
		return $angkaBaru;
	}
?>