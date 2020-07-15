 <?php 

include 'functions.php';

session_start();



if( !isset($_SESSION["id"]) && !isset($_SESSION["valid"]) ) {

	header("Location: index.php");

} 



$id = $_SESSION["id"];



$query_siswa = mysqli_query($connect, "SELECT * FROM `biodata_siswa` WHERE ID = $id");

$query_ayah = mysqli_query($connect, "SELECT * FROM `ayah_siswa` WHERE ID_SISWA = $id");

$query_ibu = mysqli_query($connect, "SELECT * FROM `ibu_siswa` WHERE ID_SISWA = $id");

$query_wali = mysqli_query($connect, "SELECT * FROM `wali_siswa` WHERE ID_SISWA = $id");



$data_siswa = mysqli_fetch_assoc($query_siswa);

$data_ayah = mysqli_fetch_assoc($query_ayah);

$data_ibu = mysqli_fetch_assoc($query_ibu);

$data_wali = mysqli_fetch_assoc($query_wali);



$originalDate = $data_siswa["TGL_LAHIR"];

$newDate = date("d-m-Y", strtotime($data_siswa["TGL_LAHIR"]));

$data_siswa["TGL_LAHIR"] = $newDate;



$date_default = str_replace("-","/", $data_siswa["TGL_LAHIR"]);



if ( $data_wali["AGAMA"] == '--' ) {

	$cek = 1;

} else {

	$nocek = 0;

} 



if( isset($_POST["submit"]) ){



	if( edit() > 0 ){

		echo"<script>alert('Edit Berhasil !'); document.location.href = 'index.php';</script>";

	} else {

		echo"<script>alert('Edit Gagal !'); document.location.href = 'edit.php?id=$id';</script>";

	}



}





 ?>

<!DOCTYPE html>

<html>

<head>

	<title>Edit Data Siswa</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">	

	<meta charset="utf-8">

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="	sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

		<link rel="stylesheet" type="text/css" href="primary.css">

		<link rel="stylesheet" type="text/css" href="daftar.css">

    	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

    	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
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









<!-- FORM -->



<div class="container" id="form-box">

	<h1 class="text-center font-weight-bold mb-3" id="head">EDIT</h1>

</div>



<form  method="post" class="container" id="forms" enctype="multipart/form-data">

	<h5 class="text-center my-3">A. IDENTITAS SISWA</h5>

	<input type="hidden" name="id" value="<?= $data_siswa["ID"] ?>">

	<input type="hidden" name="foto_lama" value="<?= $data_siswa["FOTO"] ?>">



	<!-- NAMA -->

	<div class="row">

		<div class="col-5">

			<div class="form-group">

				<label for="nama-lengkap">Nama Lengkap</label>

				<input type="text" name="nama-lengkap" id="nama-lengkap" class="form-control" autocomplete="off" value="<?= $data_siswa["NAMA_LENGKAP"];  ?>" maxlength="36">

			</div>		

		</div>

		<div class="col-4">

			<div class="form-group">

				<label for="nama-panggilan">Nama Panggilan</label>

				<input type="text" name="nama-panggilan" id="nama-panggilan" class="form-control" autocomplete="off" value="<?= $data_siswa["NAMA_PANGGILAN"];  ?>" maxlength="12">

			</div>

		</div>

		<div class="col-3">

			<div class="form-group">

				<label for="kelas">Kelas</label>

				<select name="kelas" id="kelas" class="form-control">

					<option <?= ($data_siswa["KELAS"] == 'X-SIJA A') ? "selected value='X-SIJA A'" : "" ?> >X-SIJA A</option>

					<option <?= ($data_siswa["KELAS"] == 'X-SIJA B') ? "selected value='X-SIJA B'" : "" ?> >X-SIJA B</option>

					<option <?= ($data_siswa["KELAS"] == 'XI-SIJA A') ? "selected value='XI-SIJA A'" : "" ?> >XI-SIJA A</option>

					<option <?= ($data_siswa["KELAS"] == 'XI-SIJA B') ? "selected value='XI-SIJA B'" : "" ?> >XI-SIJA B</option>

					<option <?= ($data_siswa["KELAS"] == 'XII-SIJA A') ? "selected value='XII-SIJA A'" : "" ?> >XII-SIJA A</option>

					<option <?= ($data_siswa["KELAS"] == 'XII-SIJA B') ? "selected value='XII-SIJA B'" : "" ?> >XII-SIJA B</option>

				</select>

			</div>

		</div>

	</div>



	<!-- TTL JK -->

	<div class="row">

		<div class="col-5">

			<div class="form-group">

				<label for="jenis_kelamin">Jenis Kelamin</label>

				<select name="jenis_kelamin" id="jenis_kelamin" class="form-control">

					<option <?= ($data_siswa["JENIS_KELAMIN"] == 'Laki - Laki') ? "selected value='Laki - Laki'" : "" ?> >Laki - Laki</option>

					<option <?= ($data_siswa["JENIS_KELAMIN"] == 'Perempuan') ? "selected value='Perempuan'" : "" ?>>Perempuan</option>

				</select>

			</div>

		</div>

		<div class="col-4">

			<div class="form-group">

				<label for="tempat-lahir">Tempat Lahir</label>

				<input type="text" name="tempat-lahir" id="tempat-lahir" class="form-control" autocomplete="off" value="<?= $data_siswa["TEMPAT_LAHIR"]; ?>" maxlength="24">

			</div>

		</div>

		<div class="col">

			<!-- <div class="form-group col-sm-12"> -->

			<div class="form-group" id="datetimepicker2">

				<label for="tgl">Tanggal Lahir</label>

				<div class="input-group-prepend">

					<span class="input-group-text" for="tgl"><i class="fas fa-calendar-alt"></i></span>

					<input type="text" name="tanggal-lahir" id="tgl" class="form-control col-sm-10 datepicker datetimepicker-input" data-toggle="datetimepicker" data-target=".datepicker" readonly="readonly"   style="background:white;"> 

				</div>

				<!-- <input type="text" class="form-control datepicker datetimepicker-input col-sm-10" data-toggle="datetimepicker" data-target=".datepicker" name="tanggal-lahir" id="tgl" /> -->

			</div>

		</div>

	</div>

	

	<!-- ALAMAT SEKARANG -->

	<div class="row">

		<div class="col-6">

			<div class="form-group">

				<label for="alamat-sekarang">Alamat Sekarang</label>

				<input type="text" name="alamat-sekarang" id="alamat-sekarang" class="form-control" autocomplete="off" value="<?= $data_siswa["ALAMAT_SEKARANG"]; ?>" maxlength="128">

			</div>

		</div>

		<div class="col-3">

			<div class="form-group">

				<label for="kode-pos-as">Kode Pos <i class="fas fa-info-circle" data-toggle="tooltip" title="Kode Pos Alamat Sekarang"></i></label>

				<input type="text" name="kode-pos-as" id="kode-pos-as" class="form-control" onkeypress="isInputNumber(event);" maxlength="5" autocomplete="off" value="<?= $data_siswa["KP_AS"]; ?>" maxlength="5">

			</div>

		</div>

		<div class="col-3">

			<div class="form-group">

				<label for="telepon-as">Telepon <i class="fas fa-info-circle" data-toggle="tooltip" title="No. Telepon Alamat Sekarang"></i></label>

				<input type="text" name="telepon-as" id="telepon-as" class="form-control" onkeypress="isInputNumber(event);" maxlength="12" autocomplete="off" value="<?= $data_siswa["TLP_AS"]; ?>" maxlength="12">

			</div>

		</div>

	</div>



	<!-- ALAMAT LIBUR -->

	<div class="row">

		<div class="col-6">

			<div class="form-group">

				<label for="alamat-libur">Alamat Libur</label>

				<input type="text" name="alamat-libur" id="alamat-libur" class="form-control" autocomplete="off" value="<?= $data_siswa["ALAMAT_LIBUR"]; ?>" maxlength="128">

			</div>

		</div>

		<div class="col-3">

			<div class="form-group">

				<label for="kode-pos-al">Kode Pos <i class="fas fa-info-circle" data-toggle="tooltip" title="Kode Pos Alamat Libur"></i></label>

				<input type="text" name="kode-pos-al" id="kode-pos-al" class="form-control" onkeypress="isInputNumber(event);" maxlength="5" autocomplete="off" value="<?= $data_siswa["KP_AL"]; ?>" maxlength="5">

			</div>

		</div>

		<div class="col-3">

			<div class="form-group">

				<label for="telepon-al">Telepon <i class="fas fa-info-circle" data-toggle="tooltip" title="No. Telepon Alamat Libur"></i></label>

				<input type="tel" name="telepon-al" id="telepon-al" class="form-control" onkeypress="isInputNumber(event);" maxlength="12" autocomplete="off" value="<?= $data_siswa["TLP_AL"]; ?>" maxlength="12">

			</div>

		</div>

	</div>



	<!-- HOBBY -->

	<div class="row">

		<div class="col-6">

			<div class="form-group">

				<label for="hobby">Hobby</label>

				<input type="name" name="hobby" id="hobby" class="form-control" autocomplete="off" value="<?= $data_siswa["HOBBY"]; ?>" maxlength="24">

			</div>

		</div>

		<div class="col-6">

			<div class="form-group">

				<label for="ekskul">Ekskul</label>

				<input type="name" name="ekskul" id="ekskul" class="form-control" autocomplete="off" value="<?= $data_siswa["EKSKUL"]; ?>" maxlength="24">

			</div>

		</div>		

	</div>



	<!-- GOL DARAH -->

	<div class="row">

		<div class="col-6 text-center">

			

			<div class="form-group">

			<label for="gol-darah">Golongan Darah</label>

			<select name="gol-darah" class="form-control" id="gol-darah">

				<option <?= ($data_siswa["GOL_DARAH"] == 'A') ? "selected value='A'" : "" ?>>A</option>

				<option <?= ($data_siswa["GOL_DARAH"] == 'B') ? "selected value='B'" : "" ?>>B</option>

				<option <?= ($data_siswa["GOL_DARAH"] == 'AB') ? "selected value='AB'" : "" ?>">AB</option>

				<option <?= ($data_siswa["GOL_DARAH"] == 'O') ? "selected value='O'" : "" ?>">O</option>

			</select>

			</div>



		</div>	



	<!-- AGAMA -->

		<div class="col-6">



			<div class="form-group text-center">

				<label for="agama">Agama</label>

				<select class="form-control" name="agama" id="agama">

					<option <?= ($data_siswa["AGAMA"] == 'Islam') ? "selected value='Islam'" : "" ?> >Islam</option>

					<option <?= ($data_siswa["AGAMA"] == 'Protestan') ? "selected value='Protestan'" : "" ?> >Protestan</option>

					<option <?= ($data_siswa["AGAMA"] == 'Hindu') ? "selected value='Hindu'" : "" ?>>Hindu</option>

					<option <?= ($data_siswa["AGAMA"] == 'Budha') ? "selected value='Budha'" : "" ?>>Budha</option>

					<option <?= ($data_siswa["AGAMA"] == 'Katolik') ? "selected value='Katolik'" : "" ?>>Katolik</option>

				</select>

			</div>



		</div>



	</div>



	<!-- ANAK KE & ASAL SMP -->

	<div class="row">

		

		<div class="col-4">

			<div class="form-group">

			<label class="anak-ke">Anak Ke</label>

			<input type="text" name="anak-ke" id="anak-ke" class="form-control" onkeypress="isInputNumber(event);" maxlength="2" autocomplete="off" value="<?= $data_siswa["ANAK_KE"]; ?>" maxlength="2"> 

			</div>

		</div>



		<div class="col-4">

			<div class="form-group">

				<label class="dari">Dari</label>

				<input type="text" name="dari" class="form-control" id="dari" onkeypress="isInputNumber(event);" maxlength="2" autocomplete="off" value="<?= $data_siswa["DARI"]; ?>" maxlength="2">

			</div>

		</div>



		<div class="col-4">

			<div class="form-group">

				<label class="asal-smp">Asal SMP</label>

				<input type="text" name="asal-smp" class="form-control" id="asal-smp" autocomplete value="<?= $data_siswa["ASAL_SMP"]; ?>" maxlength="24">

			</div>

		</div>



	</div>



	<!-- FOTO -->

	<div class="row">

		

		<div class="col">

			<div class="form-group text-center font-weight-bolder">

				<img src="foto/<?= $data_siswa['FOTO']; ?>" id="preview-img" onclick="triggerClick();" class="cursor-pointer">

				<label for="foto" class="cursor-pointer">Foto</label>

				<input type="file" name="foto" id="foto" class="form-control" style="display: none;" onchange="preview(this);">

			</div>

		</div>



	</div>













	</div><br>



	<h5 class="text-center my-3">B. ORANG TUA / WALI</h5>



	<!-- AYAH -->

	<div class="row">



		<div class="col-5">

				<div class="form-group">

					<label for="nama-ayah" class="font-weight-bold">Nama Ayah</label>

					<input type="text" name="nama-ayah" id="nama-ayah" class="form-control" autocomplete="off" value="<?= $data_ayah["NAMA_AYAH"]; ?>" maxlength="36">

				</div>

		</div>



		<div class="col-3">

			<div class="form-group">

				<label for="umur-ayah">Umur</label>

				<input type="text" name="umur-ayah" id="umur-ayah" class="form-control" onkeypress="isInputNumber(event);" maxlength="2" autocomplete="off" value="<?= $data_ayah["UMUR_AYAH"]; ?>" maxlength="2">

			</div>

		</div>



		<div class="col-4">

			<div class="form-group">

				<label for="pekerjaan-ayah">Pekerjaan</label>

				<input type="text" name="pekerjaan-ayah" id="pekerjaan-ayah" class="form-control" autocomplete="off" value="<?= $data_ayah["PEKERJAAN"]; ?>" maxlength="24">

			</div>

		</div>



	</div>



	<div class="row">

		

		<div class="col-6">

			<div class="form-group">

				<label for="pp-ayah">Penghasilan Perbulan</label>

				<input type="text" name="pp-ayah" class="form-control" onkeypress="isInputNumber(event);" autocomplete="off" id="pp-ayah" value="<?= $data_ayah["PENGHASILAN"]; ?>" maxlength="11">

			</div>

		</div>





		<div class="col-6">

			<div class="form-group">

				<label for="agama-ayah">Agama</label>

				<select class="form-control" name="agama-ayah" id="agama-ayah">

					<option <?= ($data_ayah["AGAMA"] == 'Islam') ? "selected value='Islam'" : "" ?> >Islam</option>

					<option <?= ($data_ayah["AGAMA"] == 'Protestan') ? "selected value='Protestan'" : "" ?> >Protestan</option>

					<option <?= ($data_ayah["AGAMA"] == 'Hindu') ? "selected value='Hindu'" : "" ?>>Hindu</option>

					<option <?= ($data_ayah["AGAMA"] == 'Budha') ? "selected value='Budha'" : "" ?>>Budha</option>

					<option <?= ($data_ayah["AGAMA"] == 'Katolik') ? "selected value='Katolik'" : "" ?>>Katolik</option>

				</select>

			</div>

		</div>



	</div>



	<div class="row">

		<div class="col-6">

			<div class="form-group">

				<label for="alamat-ayah">Alamat</label>

				<input type="text" name="alamat-ayah" id="alamat-ayah" class="form-control" autocomplete="off" value="<?= $data_ayah["ALAMAT"]; ?>" maxlength="128">

			</div>

		</div>

		<div class="col-3">

			<div class="form-group">

				<label for="kode-pos-aa">Kode Pos <i class="fas fa-info-circle" data-toggle="tooltip" title="Kode Pos untuk Alamat Ayahmu !"></i></label>

				<input type="text" name="kode-pos-aa" id="kode-pos-aa" class="form-control" onkeypress="isInputNumber(event);" maxlength="5" autocomplete="off" value="<?= $data_ayah["KODE_POS"]; ?>" maxlength="5">

			</div>

		</div>

		<div class="col-3">

			<div class="form-group">

				<label for="telepon-ayah">Telepon <i class="fas fa-info-circle" data-toggle="tooltip" title="No. Telepon Ayahmu !"></i></label>

				<input type="tel" name="telepon-ayah" id="telepon-ayah" class="form-control" onkeypress="isInputNumber(event);" maxlength="12" autocomplete="off" value="<?= $data_ayah["NO_TELP"]; ?>" maxlength="12">

			</div>

		</div>

	</div><br>





	<!-- IBU -->

	<div class="row">



		<div class="col-5">

				<div class="form-group">

					<label for="nama-ibu" class="font-weight-bold">Nama Ibu</label>

					<input type="text" name="nama-ibu" id="nama-ibu" class="form-control" autocomplete="off" value="<?= $data_ibu["NAMA_IBU"]; ?>" maxlength="36">

				</div>

		</div>



		<div class="col-3">

			<div class="form-group">

				<label for="umur-ibu">Umur</label>

				<input type="text" name="umur-ibu" id="umur-ibu" class="form-control" onkeypress="isInputNumber(event);" maxlength="2" autocomplete="off" value="<?= $data_ibu["UMUR_IBU"]; ?>" maxlength="2">

			</div>

		</div>



		<div class="col-4">

			<div class="form-group">

				<label for="pekerjaan-ibu">Pekerjaan</label>

				<input type="text" name="pekerjaan-ibu" id="pekerjaan-ibu" class="form-control" autocomplete="off" value="<?= $data_ibu["PEKERJAAN"]; ?>" maxlength="24">

			</div>

		</div>



	</div>



	<div class="row">

		

		<div class="col-6">

			<div class="form-group">

				<label for="pp-ibu">Penghasilan Perbulan</label>

				<input type="text" name="pp-ibu" class="form-control" onkeypress="isInputNumber(event);" autocomplete="off" id="pp-ibu" value="<?= $data_ibu["PENGHASILAN"]; ?>" maxlength="11">

			</div>

		</div>





		<div class="col-6">

			<div class="form-group">

				<label for="agama-ibu">Agama</label>

				<select class="form-control" name="agama-ibu" id="agama-ibu">

					<option <?= ($data_ibu["AGAMA"] == 'Islam') ? "selected value='Islam'" : "" ?> >Islam</option>

					<option <?= ($data_ibu["AGAMA"] == 'Protestan') ? "selected value='Protestan'" : "" ?> >Protestan</option>

					<option <?= ($data_ibu["AGAMA"] == 'Hindu') ? "selected value='Hindu'" : "" ?>>Hindu</option>

					<option <?= ($data_ibu["AGAMA"] == 'Budha') ? "selected value='Budha'" : "" ?>>Budha</option>

					<option <?= ($data_ibu["AGAMA"] == 'Katolik') ? "selected value='Katolik'" : "" ?>>Katolik</option>

				</select>

			</div>

		</div>



	</div>



	<div class="row">

		<div class="col-6">

			<div class="form-group">

				<label for="alamat-ibu">Alamat</label>

				<input type="text" name="alamat-ibu" id="alamat-ibu" class="form-control" autocomplete="off" value="<?= $data_ibu["ALAMAT"]; ?>" maxlength="128">

			</div>

		</div>

		<div class="col-3">

			<div class="form-group">

				<label for="kode-pos-ai">Kode Pos <i class="fas fa-info-circle" data-toggle="tooltip" title="Kode Pos untuk Alamat Ibumu !"></i></label>

				<input type="text" name="kode-pos-ai" id="kode-pos-ai" class="form-control" onkeypress="isInputNumber(event);" maxlength="5" autocomplete="off" value="<?= $data_ibu["KODE_POS"]; ?>" maxlength="5">

			</div>

		</div>

		<div class="col-3">

			<div class="form-group">

				<label for="telepon-ibu">Telepon <i class="fas fa-info-circle" data-toggle="tooltip" title="No. Telepon Ibumu !"></i></label>

				<input type="tel" name="telepon-ibu" id="telepon-ibu" class="form-control" onkeypress="isInputNumber(event);" maxlength="12" autocomplete="off" value="<?= $data_ibu["NO_TELP"]; ?>" maxlength="12">

			</div>

		</div>

	</div><br>





	<!-- WALI -->

	<label for="nw-c"><input type="checkbox" id="nw-c" class="text-right" name="nw-c" autocomplete="off"> Tidak perlu Wali</label>

	<div class="row">



		<div class="col-5">

				<div class="form-group">

					<label for="nama-wali" class="font-weight-bold">Nama Wali</label>

					<input type="text" name="nama-wali" id="nama-wali" class="form-control" autocomplete="off" value="<?= $data_wali["NAMA_WALI"]; ?>" maxlength="36">

				</div>

		</div>



		<div class="col-3">

			<div class="form-group">

				<label for="umur-wali">Umur</label>

				<input type="text" name="umur-wali" id="umur-wali" class="form-control" onkeypress="isInputNumber(event);" maxlength="2" autocomplete="off" value="<?= $data_wali["UMUR_WALI"]; ?>" maxlength="2">

			</div>

		</div>



		<div class="col-4">

			<div class="form-group">

				<label for="pekerjaan-wali">Pekerjaan</label>

				<input type="text" name="pekerjaan-wali" id="pekerjaan-wali" class="form-control" autocomplete="off" value="<?= $data_wali["PEKERJAAN"]; ?>" maxlength="24">

			</div>

		</div>



	</div>



	<div class="row">

		

		<div class="col-6">

			<div class="form-group">

				<label for="pp-wali">Penghasilan Perbulan</label>

				<input type="text" name="pp-wali" class="form-control" onkeypress="isInputNumber(event);" autocomplete="off" id="pp-wali" value="<?= $data_wali["PENGHASILAN"]; ?>" maxlength="11">

			</div>

		</div>



		<div class="col-6">

			<div class="form-group">

				<label for="agama-wali">Agama</label>

				<select class="form-control" name="agama-wali" id="agama-wali">

					<option <?= ($data_wali["AGAMA"] == 'Islam') ? "selected value='Islam'" : "" ?> >Islam</option>

					<option <?= ($data_wali["AGAMA"] == 'Protestan') ? "selected value='Protestan'" : "" ?> >Protestan</option>

					<option <?= ($data_wali["AGAMA"] == 'Hindu') ? "selected value='Hindu'" : "" ?>>Hindu</option>

					<option <?= ($data_wali["AGAMA"] == 'Budha') ? "selected value='Budha'" : "" ?>>Budha</option>

					<option <?= ($data_wali["AGAMA"] == 'Katolik') ? "selected value='Katolik'" : "" ?>>Katolik</option>

					<?php if( $data_wali["AGAMA"] == '--' ) : ?>

						<option <?= ($data_wali["AGAMA"] == '--') ? "selected value='--'" : "" ?>>--</option>

					<?php endif; ?>

				</select>

			</div>

		</div>



	</div>



	<div class="row">

		<div class="col-6">

			<div class="form-group">

				<label for="alamat-wali">Alamat</label>

				<input type="text" name="alamat-wali" id="alamat-wali" class="form-control" autocomplete="off" value="<?= $data_wali["ALAMAT"]; ?>" maxlength="128">

			</div>

		</div>

		<div class="col-3">

			<div class="form-group">

				<label for="kode-pos-aw">Kode Pos <i class="fas fa-info-circle" data-toggle="tooltip" title="Kode Pos untuk Alamat Wali !"></i></label>

				<input type="text" name="kode-pos-aw" id="kode-pos-aw" class="form-control"	onkeypress="isInputNumber(event);" maxlength="5" autocomplete="off" value="<?= $data_wali["KODE_POS"]; ?>" maxlength="5">

			</div>

		</div>

		<div class="col-3">

			<div class="form-group">

				<label for="telepon-wali" class="text-gray-dark">Telepon <i class="fas fa-info-circle" data-toggle="tooltip" title="No. Telepon Wali !"></i></label>

				<input type="tel" name="telepon-wali" id="telepon-wali" class="form-control" onkeypress="isInputNumber(event);" maxlength="12" autocomplete="off" value="<?= $data_wali["NO_TELP"]; ?>" maxlength="12">

			</div>

		</div>

	</div><br>



	<br>



	<center><button type="submit" class="btn btn-outline-dark btn-block col-2" name="submit">Submit</button></center><br>





</form>







<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>



<script type="text/javascript" src="edit.js"></script>

<?php if( isset($cek) ) : ?>

<script type="text/javascript">

	

</script>

<?php endif; ?>



<script type="text/javascript">

	// CHK BOX

var chck   = document.getElementById('nw-c');

var nw_i   = document.getElementById('nama-wali');

var uw_i   = document.getElementById('umur-wali');

var pw_i   = document.getElementById('pekerjaan-wali');

var ppw_i  = document.getElementById('pp-wali');

var agw_i  = document.getElementById('agama-wali');

var alw_i  = document.getElementById('alamat-wali');

var kpaw_i = document.getElementById('kode-pos-aw');

var tw_i   = document.getElementById('telepon-wali');



chck.addEventListener('click', function(){

	chck.classList.toggle('on');

	if( chck.classList.contains('on') ){

		nw_i.setAttribute("disabled", "");

		uw_i.setAttribute("disabled", "");

		pw_i.setAttribute("disabled", "");

		ppw_i.setAttribute("disabled", "");

		agw_i.setAttribute("disabled", "");

		alw_i.setAttribute("disabled", "");

		kpaw_i.setAttribute("disabled", "");

		tw_i.setAttribute("disabled", "");

		nw_i.setAttribute("value", "--");

		uw_i.setAttribute("value", "--");

		pw_i.setAttribute("value", "--");

		ppw_i.setAttribute("value", "--");

		alw_i.setAttribute("value", "--");

		kpaw_i.setAttribute("value", "--");

		tw_i.setAttribute("value", "--");



		var opt_nw = document.createElement("option");

		opt_nw.text = '--';

		opt_nw.classList.add('nw_option');

		agw_i.add(opt_nw);

		agw_i.getElementsByTagName('option')[5].selected = 'selected';





	} else {

		var opt_del = document.querySelector('.nw_option');

		opt_del.remove();

		agw_i.getElementsByTagName('option')[0].selected = 'selected';		



		nw_i.removeAttribute("disabled");

		uw_i.removeAttribute("disabled");

		pw_i.removeAttribute("disabled");

		ppw_i.removeAttribute("disabled");

		agw_i.removeAttribute("disabled");

		alw_i.removeAttribute("disabled");

		kpaw_i.removeAttribute("disabled");

		tw_i.removeAttribute("disabled");

		nw_i.removeAttribute("value");

		uw_i.removeAttribute("value");

		pw_i.removeAttribute("value");

		ppw_i.removeAttribute("value");

		agw_i.removeAttribute("value");

		alw_i.removeAttribute("value");

		kpaw_i.removeAttribute("value");

		tw_i.removeAttribute("value");

	}

});



</script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script type="text/javascript">

	$('#tgl').daterangepicker({

		singleDatePicker: true,

		showDropdowns: true,

		opens: 'right',

		drops: 'down',

		minDate: '01-01-1995',

		maxDate: '31-12-2006',

		startDate: '<?= $data_siswa["TGL_LAHIR"]; ?>',

		locale: {

			format: 'DD-MM-YYYY'

		}

	})

</script>

</body>

</html>