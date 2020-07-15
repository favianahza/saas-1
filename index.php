<?php 

session_start();



 ?>

<!DOCTYPE html>

<html>

<head>

	<title>Welcome to SIJA WEBSITE</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">	

	<meta charset="utf-8">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="	sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<link rel="stylesheet" type="text/css" href="primary.css">

	<link rel="stylesheet" type="text/css" href="index.css">
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

			<a id="navbarDropdown" role="button" data-toggle="dropdown" class="nav-item dropdown-toggle text-light cursor-pointer">

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



<!-- INTRO -->



<div class="jumbotron my-auto">

	<h1 class="display-4 text-center">WELCOME TO WEBSITE SIJA</h1>

		<center><img src="img/circle-cropped.png" style="width: 250px;" class="my-2"></center>

	<p class="lead text-center" id="title">Sistem Informatika Jaringan dan Aplikasi</p>

	<hr class="col-4">

</div>



<<!-- Footer -->

<footer class="page-footer font-small blue pt-4">





  <!-- Copyright -->

  <div class="footer-copyright text-center py-3">Created by Favian Ahza ©2019

    

  </div>

  <!-- Copyright -->



</footer>

<!-- Footer -->



<!-- INTRO -->



 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>