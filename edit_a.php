 <?php 

include 'functions.php';

session_start();



if( !isset($_SESSION["id"]) && !isset($_SESSION["valid"]) ) {

	header("Location: index.php");

} 



$id = $_SESSION["id"];



if( isset($_POST["edit"]) ){



	if( $_POST["pass"] != $_POST["cpass"] ){

		echo"<script>alert('Konfirmasi Password yang dimasukan tidak sama !'); document.location.href = 'edit_a.php';</script>";

	}



	if( edit_pass() > 0 ){

		echo"<script>alert('Edit Berhasil !'); document.location.href = 'index.php';</script>";

	} else {

		echo"<script>alert('Edit Gagal !'); document.location.href = 'edit_a.php';</script>";

	}



}



 ?>

<!DOCTYPE html>

<html>

<head>

	<title>Edit Password</title>

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

<br>

<div class="container" id="form-box">

	<h1 class="text-center font-weight-bold mb-3" id="head">EDIT PASSWORD</h1>

</div>



<form method="post" class="container border border-dark rounded p-4 shadow-sm" style="margin: auto; width: 325px;" id="box-f">

		<input type="hidden" name="id" value="<?php echo $_SESSION["id"]; ?>">

		<div class="form-group">

			<label for="user">Password</label>

			<input type="password" name="pass" autocomplete="off" id="pass" class="form-control shadow-sm" placeholder="Masukan Password"  minlegth="5" maxlength="12">

		</div>



		<div class="form-group">

			<label for="pass">Konfirmasi</label>

			<input type="password" name="cpass" autocomplete="off" id="cpass" class="form-control shadow-sm" placeholder="Masukan Konfirmasi Password" minlength="5" maxlength="12">

		</div>



		<div class="form-check text-center ">

			<input type="checkbox" name="show" id="show" class="form-check-input">

			<label for="show" class="form-check-label">Show Password</label>

		</div>



		<br><center><button type="submit" class="btn btn-outline-dark shadow-sm col-4" name="edit">Edit</button></center>



</form>









<!-- FORM -->



<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script type="text/javascript" src="edit_a.js"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>



</body>

</html>