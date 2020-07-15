<?php 
include 'functions.php';
session_start();



$id = $_GET["id"];

mysqli_query($connect, "DELETE FROM `biodata_siswa` WHERE ID = $id");

header("Location: list.php");

 ?>