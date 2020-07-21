<?php
	session_start();
	if( !isset($_SESSION['username']) ){
		header("location:index.php");
	}
	
	if (!isset($_GET['content'])){
		$content='beranda.php';
	} else {
		$content=$_GET['content'];
	}
?>

<html lang="en">
	<head>
	  <title>Koperasi POLBAN</title>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	  <style>
		  .fakeimg {
		    height: 200px;
		    background: #aaa;
		  }
	  </style>
	</head>
	<body>
		<div class="jumbotron text-center" style="margin-bottom:0; background-color: rgb(85,172,238);">
		  <h1>KOPERASI<b>POLBAN</b></h1>
		  <p>Maju Bersama Koperasi, Budayakan UMKM.</p> 
		</div>

		<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
		  <a class="navbar-brand" href="template.php">Beranda</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
		    <span class="navbar-toggler-icon"></span>
		  </button>
		  <div class="collapse navbar-collapse" id="collapsibleNavbar">
		    <ul class="navbar-nav">
		    	<li class="nav-item">
		        	<a class="nav-link" href="template.php?content=data_nasabah.php">INPUT DATA NASABAH</a>
		      	</li>
		      	<li class="nav-item">
		        	<a class="nav-link" href="template.php?content=user_tabungan.php">TRANSAKSI TABUNGAN</a>
		      	</li>
		      	<li class="nav-item">
		        	<a class="nav-link" href="template.php?content=user_pinjam.php">PINJAM UANG</a>
		      	</li>
		      	<li class="nav-item">
		        	<a class="nav-link" href="template.php?content=user_angsuran.php">BAYAR ANGSURAN</a>
		      	</li>
		      	<li class="nav-item">
		        	<a class="nav-link" href="template.php?content=user_laporan.php">LAPORAN PINJAMAN</a>
		      	</li>
		    </ul>
		  </div>  
		</nav>

		<div class="container" style="margin-top:30px">
		  <div class="row">
		    <div class="col-sm-4">
		      <h2>Tentang Koperasi</h2>
		      <p>Koperasi POLBAN adalah sebuah organisasi ekonomi yang dimiliki dan dioperasikan oleh orang-seorang demi kepentingan bersama. Koperasi melandaskan kegiatan berdasarkan prinsip gerakan ekonomi rakyat yang berdasarkan asas kekeluargaan.</p>
		      <h3>Kategori</h3>
		      <p>Simak berita bidang lain.</p>
		      <ul class="nav nav-pills flex-column">
		        <li class="nav-item">
		          <a class="nav-link active" href="#">Beranda</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link" href="logout.php">Logout</a>
		        </li>
		      </ul>
		      <hr class="d-sm-none">
		    </div>
		    <div class="col-sm-8">
		      <?php include $content; ?>
		    </div>
		  </div>
		</div>

		<div class="jumbotron" style="margin-bottom:0; background-color: rgb(85,172,238);">
		  <div class="row">
	    		<div class="col" style="color: white;">
	    			<p class="text-left" style="font-size: 36px; margin: 0;">KOPERASI<b>POLBAN</b></p>
	  				<p class="text-left" style="margin: 0;">Email : andi.fauzy.tif18@polban.ac.id</p>
	  				<p class="text-left">Handphone : +6285322677320</p>
	    		</div>
	    	</div>
		</div>
	</body>
</html>