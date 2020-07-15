<?php 

session_start();

include 'functions.php';



if( $_SESSION["class"] != "Admin" ){

	echo"<script>alert('Anda Bukan ADMIN !'); document.location.href = 'index.php';</script>";

}



$id = $_GET["id"];



$result = mysqli_query($connect, "SELECT * FROM `biodata_siswa` WHERE ID = $id");



$data = mysqli_fetch_assoc($result);



$tanggal_lahir = $data["TGL_LAHIR"];

$originalDate = $tanggal_lahir;

$newDate = date("d-m-Y", strtotime($originalDate));

$tanggal_lahir = $newDate;



$result_a = mysqli_query($connect, "SELECT * FROM `ayah_siswa` WHERE ID_SISWA = $id ");

$data_a = mysqli_fetch_assoc($result_a);



$result_i = mysqli_query($connect, "SELECT * FROM `ibu_siswa` WHERE ID_SISWA = $id");

$data_i = mysqli_fetch_assoc($result_i);



$result_w = mysqli_query($connect, "SELECT * FROM `wali_siswa` WHERE ID_SISWA = $id");

$data_w = mysqli_fetch_assoc($result_w);



 ?>

<!DOCTYPE html>

<html>

<head>

	<title>Detail Siswa (ADMIN ONLY)</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">	

	<meta charset="utf-8">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="	sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<link rel="stylesheet" type="text/css" href="primary.css">

	<link rel="stylesheet" type="text/css" href="index.css">

	<link rel="stylesheet" type="text/css" href="detail.css">
	<link rel="icon" href="icon.png" type="image" sizes="16x16">

</head>

<body>



<!-- NAV -->

<nav class="navbar navbar-dark bg-dark navbar-expand-lg">

	<a href="index.php" class="navbar-brand font-weight-bolder">SIJA</a>



	<button class="navbar-toggler" data-toggle="collapse" data-target="#navMenu">

		<span class="navbar-toggler-icon"></span>	

	</button>



	 <div class="collapse navbar-collapse" id="navMenu">

	 <ul class="navbar-nav ml-auto">



	 	<?php if( !isset($_SESSION["valid"]) ) : ?>



	 	 <li class="nav-link">

			 <a href="login.php" class="nav-item text-light font-weight-bold">LOGIN</a>

		 </li>

		 <li class="nav-link">

			 <a href="daftar.php" class="nav-item font-weight-bold" id="teal">DAFTAR</a>

		 </li>



		<?php endif; ?>



		<?php if( isset($_SESSION["valid"]) ) : ?>



			<?php if( $cek = $_SESSION["class"] == "Admin" ) : ?>

			<li class="nav-link">

				<a href="list.php" class="nav-item text-light font-weight-bold">LIST</a>

			</li>	

			<?php endif; ?>





		<li class="nav-link dropdown font-weight-bold">

			<a href="#" id="navbarDropdown" role="button" data-toggle="dropdown" class="nav-item dropdown-toggle text-light">

				EDIT

			</a>

			<div class="dropdown-menu bg-dark mt-1 dropdown-menu-right border-0 rounded-0" aria-labelledby="navbarDropdown">

				<a href="edit.php" class="dropdown-item text-primary">BIODATA</a>

				<a href="edit_a.php" class="dropdown-item text-primary">PASSWORD</a>

			</div>

		</li>



		<li class="nav-link">

			<a href="logout.php" class="nav-item font-weight-bold">LOGOUT</a>

		</li>



		<?php endif; ?>

	 </ul>

	 </div>

</nav>

<!-- NAV -->



<!-- DETAIL -->



<h1 class="text-center my-3">Detail</h1>

<div class="container-fluid border border-primary col-7 rounded p-2 pt-3 mb-5">



	<div class="row text-center">

		<div class="col">

			<h4 class="my-0 font-weight-bolder">NAMA LENGKAP </h4><p><?= $data["NAMA_LENGKAP"] ?></p>

		</div>

		<div class="col">

			<h4 class="my-0 font-weight-bolder">NAMA PANGGILAN</h4><p><?= $data["NAMA_PANGGILAN"] ?></p>

		</div>

	</div>



	<div class="row text-center">

		<div class="col">

			<h5 class="my-0 font-weight-bolder">JENIS KELAMIN</h5><p><?= $data["JENIS_KELAMIN"]; ?></p>

		</div>

		<div class="col">

			<h5 class="my-0 font-weight-bolder">TEMPAT, TANGGAL LAHIR</h5><p><?= $data["TEMPAT_LAHIR"].', '.$tanggal_lahir; ?></p>

		</div>

		<div class="col">

			<h5 class="my-0 font-weight-bolder">KELAS SEKARANG</h5><p><?= $data["KELAS"]; ?></p>

		</div>

	</div>



	<div class="row text-center my-1">

		<div class="col">

			<h5 class="my-0 font-weight-bolder">ALAMAT SEKARANG</h5><p><?= $data["ALAMAT_SEKARANG"].', Kode Pos '.$data["KP_AS"].', Telp. '.$data["TLP_AS"]; ?></p>

		</div>

	</div>



	<div class="row text-center my-1">

		<div class="col">

			<h5 class="my-0 font-weight-bolder">ALAMAT LIBUR</h5><p><?= $data["ALAMAT_LIBUR"].', Kode Pos '.$data["KP_AL"].', Telp. '.$data["TLP_AL"]; ?></p>

		</div>

	</div>



	<div class="row text-center">

		<div class="col">

			<h5 class="my-o font-weight-bolder">HOBBY </h5><p><?= $data["HOBBY"]; ?></p>

		</div>

		<div class="col">

			<h5 class="my-o font-weight-bolder">EKSKUL </h5><p><?= $data["EKSKUL"]; ?></p>

		</div>

		<div class="col">

			<h5 class="my-o font-weight-bolder">GOLONGAN DARAH </h5><p><?= $data["GOL_DARAH"]; ?></p>

		</div>

		<div class="col">

			<h5 class="my-o font-weight-bolder">AGAMA </h5><p><?= $data["AGAMA"]; ?></p>

		</div>

	</div>



	<div class="row text-center">

		<div class="col">

			<h5>ANAK KE <?= $data["ANAK_KE"];  ?> DARI <?= $data["DARI"]; ?> SAUDARA </h5>

		</div>

	</div>



	<div class="row text-center my-2">

		<div class="col">

			<h5 class="my-0 font-weight-bolder">ASAL SMP : </h5><?= $data["ASAL_SMP"]; ?>

		</div>

	</div>



	<div class="row text-center my-3">

		<div class="col">

			<h5 class="font-weight-bolder">FOTO</h5>

			<img src="foto/<?= $data['FOTO']; ?>" class="cursor-pointer" id="preview-img">

		</div>

	</div>



	<h3 class="font-weight-bolder text-center mt-3 mb-2">DATA AYAH</h3>



	<div class="row text-center">

		<div class="col">

			<h5 class="my-0 font-weight-bolder">NAMA AYAH</h5><p><?= $data_a["NAMA_AYAH"]; ?></p>

		</div>

		<div class="col">

			<h5 class="my-0 font-weight-bolder">UMUR AYAH</h5><p><?= $data_a["UMUR_AYAH"]; ?></p>

		</div>

		<div class="col">

			<h5 class="my-0 font-weight-bolder">PEKERJAAN AYAH</h5><p><?= $data_a["PEKERJAAN"]; ?></p>

		</div>

	</div>



	<div class="row text-center">

		<div class="col">

			<h5 class="my-0 font-weight-bolder">PENGHASILAN</h5><p>Rp.<?= $data_a["PENGHASILAN"] ?></p>

		</div>

		<div class="col">

			<h5 class="my-0 font-weight-bolder">AGAMA</h5><p><?= $data_a["AGAMA"]; ?></p>

		</div>

		<div class="col">

			<h5 class="my-0 font-weight-bolder">NO. TELP</h5><p><?= $data_a["NO_TELP"]; ?></p>

		</div>

	</div>



	<div class="row text-center">

		<div class="col">

			<h5 class="my-0 font-weight-bolder">ALAMAT AYAH</h5><p><?= $data_a["ALAMAT"] ?>, Kode Pos <?= $data_a["KODE_POS"]; ?></p>

		</div>

	</div>



	<h3 class="font-weight-bolder text-center mt-3 mb-2">DATA IBU</h3>



	<div class="row text-center">

		<div class="col">

			<h5 class="my-0 font-weight-bolder">NAMA IBU</h5><p><?= $data_i["NAMA_IBU"]; ?></p>

		</div>

		<div class="col">

			<h5 class="my-0 font-weight-bolder">UMUR IBU</h5><p><?= $data_i["UMUR_IBU"]; ?></p>

		</div>

		<div class="col">

			<h5 class="my-0 font-weight-bolder">PEKERJAAN IBU</h5><p><?= $data_i["PEKERJAAN"]; ?></p>

		</div>

	</div>



	<div class="row text-center">

		<div class="col">

			<h5 class="my-0 font-weight-bolder">PENGHASILAN</h5><p>Rp.<?= $data_i["PENGHASILAN"] ?></p>

		</div>

		<div class="col">

			<h5 class="my-0 font-weight-bolder">AGAMA</h5><p><?= $data_i["AGAMA"]; ?></p>

		</div>

		<div class="col">

			<h5 class="my-0 font-weight-bolder">NO. TELP</h5><p><?= $data_i["NO_TELP"]; ?></p>

		</div>

	</div>



	<div class="row text-center">

		<div class="col">

			<h5 class="my-0 font-weight-bolder">ALAMAT IBU</h5><p><?= $data_i["ALAMAT"] ?>, Kode Pos <?= $data_i["KODE_POS"]; ?></p>

		</div>

	</div>



<?php if( $data_w["AGAMA"] != '--' ) : ?>



	<h5 class="font-weight-bolder text-center mt-3 mb-2">DATA WALI</h5>



	<div class="row text-center">

		<div class="col">

			<h5 class="my-0 font-weight-bolder">NAMA WALI</h5><p><?= $data_w["NAMA_WALI"]; ?></p>

		</div>

		<div class="col">

			<h5 class="my-0 font-weight-bolder">UMUR WALI</h5><p><?= $data_w["UMUR_WALI"]; ?></p>

		</div>

		<div class="col">

			<h5 class="my-0 font-weight-bolder">PEKERJAAN WALI</h5><p><?= $data_w["PEKERJAAN"]; ?></p>

		</div>

	</div>



	<div class="row text-center">

		<div class="col">

			<h5 class="my-0 font-weight-bolder">PENGHASILAN</h5><p>Rp.<?= $data_w["PENGHASILAN"] ?></p>

		</div>

		<div class="col">

			<h5 class="my-0 font-weight-bolder">AGAMA</h5><p><?= $data_w["AGAMA"]; ?></p>

		</div>

		<div class="col">

			<h5 class="my-0 font-weight-bolder">NO. TELP</h5><p><?= $data_w["NO_TELP"]; ?></p>

		</div>

	</div>



	<div class="row text-center">

		<div class="col">

			<h5 class="my-0 font-weight-bolder">ALAMAT WALI</h5><p><?= $data_w["ALAMAT"] ?>, Kode Pos <?= $data_w["KODE_POS"]; ?></p>

		</div>

	</div>



<?php endif; ?>



</div>



<!-- DETAIL -->





 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>