<?php 



$connect = mysqli_connect("localhost", "c5favian", "xisijabfaps", "c5favian");



date_default_timezone_set("Asia/Bangkok");





function upload(){

	$na = explode(' ',trim($_POST["nama-lengkap"]))[0];

	$unique = $na.'_'.date("d-m-Y,H;i;s").'+'.mt_rand(0,99);

	$file_name = $_FILES["foto"]["name"];

	$tmp_name = $_FILES["foto"]["tmp_name"];

	$error = $_FILES["foto"]["error"];

	$file_size = $_FILES["foto"]["size"];



if( $error === 4 ){

	echo "<script>alert('Kamu tidak mengupload apapun !')</script>";

	return false;

}



$valid_ext = ["jpg", "png", "gif", "jpeg"];

$ext = explode(".", $file_name);

$ext = strtolower(end($ext));



if( !in_array($ext, $valid_ext) ){

	echo "<script>alert('Yang anda upload bukan Gambar !')</script>";

	return false;

}



if( $file_size > 1000000 ){

	echo "<script>alert('Ukuran gambar yang diupload terlalu besar !')</script>";

	return false;

}



$newfilename = $unique.".".$ext;



move_uploaded_file($tmp_name, "foto/".$newfilename);



return $newfilename;



}





function create(){

	global $connect;



	// AKUN

	$username		=	htmlspecialchars($_POST["username"]);

	$password		=	password_hash(htmlspecialchars($_POST["password"]), PASSWORD_DEFAULT);





	// CEK APAKAH ADA USERNAME YANG SAMA

	$cek_user = mysqli_query($connect, "SELECT * FROM `akun` WHERE Username = '$username'");

	$validasi = mysqli_num_rows($cek_user);





	if( $validasi > 0 ){

		echo "<script>alert('Username yang didaftarkan sudah dipakai !'); document.location.href = 'daftar.php';</script>";

		return false;

	} 



	// IDENTITAS SISWA

	$nama_lengkap	=	htmlspecialchars($_POST["nama-lengkap"]);

	$nama_panggilan	= 	htmlspecialchars($_POST["nama-panggilan"]);

	$kelas			=	htmlspecialchars($_POST["kelas"]);

	$jenis_kelamin	= 	htmlspecialchars($_POST["jenis_kelamin"]);

	$tempat_lahir	=	htmlspecialchars($_POST["tempat-lahir"]);

	$tanggal_lahir	=	htmlspecialchars($_POST["tanggal-lahir"]);

	$alamat_skrng	=	htmlspecialchars($_POST["alamat-sekarang"]);

	$kodepos_as		=	htmlspecialchars($_POST["kode-pos-as"]);

	$telepon_as		=	htmlspecialchars($_POST["telepon-as"]);

	$alamat_lbr		=	htmlspecialchars($_POST["alamat-libur"]);

	$kodepos_al		=	htmlspecialchars($_POST["kode-pos-al"]);

	$telepon_al		=	htmlspecialchars($_POST["telepon-al"]);

	$hobby			=	htmlspecialchars($_POST["hobby"]);

	$ekskul			=	htmlspecialchars($_POST["ekskul"]);

	$gol_darah		=	htmlspecialchars($_POST["gol-darah"]);

	$agama			=	htmlspecialchars($_POST["agama"]);

	$anak_ke		= 	htmlspecialchars($_POST["anak-ke"]);

	$dari_ke		=	htmlspecialchars($_POST["dari"]);

	$asal_smp  		= 	htmlspecialchars($_POST["asal-smp"]);

	$foto 			=  	upload();



	if( $foto == false ){

		return false;

	}



	// MENGUBAH FORMAT TANGGAL LAHIR	

	$originalDate = $tanggal_lahir;

	$newDate = date("Y-m-d", strtotime($originalDate));

	$tanggal_lahir = $newDate;





	// SI AYAH

	$nama_ayah		=	htmlspecialchars($_POST["nama-ayah"]);

	$umur_ayah		=	htmlspecialchars($_POST["umur-ayah"]);

	$pekerjaan_a	=	htmlspecialchars($_POST["pekerjaan-ayah"]);

	$pp_ayah		=	htmlspecialchars($_POST["pp-ayah"]);

	$agama_ayah		=	htmlspecialchars($_POST["agama-ayah"]);

	$alamat_ayah	=	htmlspecialchars($_POST["alamat-ayah"]);

	$kodepos_aa		=	htmlspecialchars($_POST["kode-pos-aa"]);

	$telepon_ayah	=	htmlspecialchars($_POST["telepon-ayah"]);



	// SI IBU

	$nama_ibu		=	htmlspecialchars($_POST["nama-ibu"]);

	$umur_ibu		=	htmlspecialchars($_POST["umur-ibu"]);

	$pekerjaan_i	=	htmlspecialchars($_POST["pekerjaan-ibu"]);

	$pp_ibu			=	htmlspecialchars($_POST["pp-ibu"]);

	$agama_ibu		=	htmlspecialchars($_POST["agama-ibu"]);

	$alamat_ibu		=	htmlspecialchars($_POST["alamat-ibu"]);

	$kodepos_ai		=	htmlspecialchars($_POST["kode-pos-ai"]);

	$telepon_ibu	=	htmlspecialchars($_POST["telepon-ibu"]);



	if( isset($_POST["nw-c"]) && $_POST["nw-c"] == 'on' ){



		$nama_wali		=	"--";

		$umur_wali		=	00;

		$pekerjaan_w	=	"--";

		$pp_wali		=	00;

		$agama_wali		=	"--";

		$alamat_wali	=	"--";

		$kodepos_aw		=	"--";

		$telepon_wali	=	"--";



	} else {



	// WALI

	$nama_wali		=	htmlspecialchars($_POST["nama-wali"]);

	$umur_wali		=	htmlspecialchars($_POST["umur-wali"]);

	$pekerjaan_w	=	htmlspecialchars($_POST["pekerjaan-wali"]);

	$pp_wali		=	htmlspecialchars($_POST["pp-wali"]);

	$agama_wali		=	htmlspecialchars($_POST["agama-wali"]);

	$alamat_wali	=	htmlspecialchars($_POST["alamat-wali"]);

	$kodepos_aw		=	htmlspecialchars($_POST["kode-pos-aw"]);

	$telepon_wali	=	htmlspecialchars($_POST["telepon-wali"]);



	}



	// QUERY BIODATA SISWA

	$query = "INSERT INTO `biodata_siswa` VALUES(

			 '', '$nama_lengkap', '$nama_panggilan', '$kelas', '$jenis_kelamin', '$tempat_lahir', '$tanggal_lahir', '$alamat_skrng', '$kodepos_as',

			 '$telepon_as', '$alamat_lbr', '$kodepos_al', '$telepon_al', '$hobby', '$ekskul', '$gol_darah', '$agama', '$anak_ke', '$dari_ke', '$asal_smp', '$foto' )";



	$result = mysqli_query($connect, $query);





	// TAKE ID

	$id_siswa_arr = mysqli_fetch_assoc(mysqli_query($connect, "SELECT ID FROM `biodata_siswa` WHERE FOTO = '$foto' AND NAMA_LENGKAP = '$nama_lengkap' "));



	$id_siswa = $id_siswa_arr["ID"];



	// QUERY AKUN

	$query_akun = "INSERT INTO `akun` VALUES('', '$username', '$password', 'user', '$id_siswa')";



	$result_akun = mysqli_query($connect, $query_akun);

	



	// QUERY DATA AYAH

	$query_ayah = "INSERT INTO `ayah_siswa` VALUES('', '$nama_ayah', $umur_ayah, '$pekerjaan_a', $pp_ayah, '$agama_ayah', '$alamat_ayah', '$kodepos_aa', '$telepon_ayah', '$id_siswa' )";



	$result_ayah = mysqli_query($connect, $query_ayah);



	// QUERY DATA IBU

	$query_ibu = "INSERT INTO `ibu_siswa` VALUES('', '$nama_ibu', $umur_ibu, '$pekerjaan_a', $pp_ibu, '$agama_ibu', '$alamat_ibu', '$kodepos_ai', '$telepon_ibu', '$id_siswa' )";



	$result_ibu = mysqli_query($connect, $query_ibu);



	// QUERY DATA WALI

	$query_wali = "INSERT INTO `wali_siswa` VALUES('', '$nama_wali', $umur_wali, '$pekerjaan_w', $pp_wali, '$agama_wali', '$alamat_wali', '$kodepos_aw', '$telepon_wali', '$id_siswa' )";



	$result_wali = mysqli_query($connect, $query_wali);





	return mysqli_affected_rows($connect);

	

};





function login(){

	global $connect;



	$user = $_POST["username"];

	$pass = $_POST["password"];





	$cek1 = "SELECT * FROM `akun` WHERE Username = '$user'";

	

	$result1 = mysqli_query($connect, $cek1);



	if( mysqli_num_rows($result1) === 1 ) {

		$row = mysqli_fetch_assoc($result1);



		if( password_verify($pass, $row["Password"]) ){

			$_SESSION["valid"] = $row["Username"];

			$_SESSION["id"] = $row["ID_SISWA"];

			$_SESSION["class"] = $row["Class"];

			header("Location: index.php");

			exit;

		} else {

			echo "<script>alert('Username atau Password yang dimasukan salah !'); document.location.href = 'login.php';</script>";

			exit;

		}



	} else {

			echo "<script>alert('Username atau Password yang dimasukan salah !'); document.location.href = 'login.php';</script>";

			exit;

	}



}





function edit() {

	global $connect;

	$id = $_POST["id"];



	// IDENTITAS SISWA

	$nama_lengkap	=	htmlspecialchars($_POST["nama-lengkap"]);

	$nama_panggilan	= 	htmlspecialchars($_POST["nama-panggilan"]);

	$kelas			=	htmlspecialchars($_POST["kelas"]);

	$jenis_kelamin	= 	htmlspecialchars($_POST["jenis_kelamin"]);

	$tempat_lahir	=	htmlspecialchars($_POST["tempat-lahir"]);

	$tanggal_lahir	=	htmlspecialchars($_POST["tanggal-lahir"]);

	$alamat_skrng	=	htmlspecialchars($_POST["alamat-sekarang"]);

	$kodepos_as		=	htmlspecialchars($_POST["kode-pos-as"]);

	$telepon_as		=	htmlspecialchars($_POST["telepon-as"]);

	$alamat_lbr		=	htmlspecialchars($_POST["alamat-libur"]);

	$kodepos_al		=	htmlspecialchars($_POST["kode-pos-al"]);

	$telepon_al		=	htmlspecialchars($_POST["telepon-al"]);

	$hobby			=	htmlspecialchars($_POST["hobby"]);

	$ekskul			=	htmlspecialchars($_POST["ekskul"]);

	$gol_darah		=	htmlspecialchars($_POST["gol-darah"]);

	$agama			=	htmlspecialchars($_POST["agama"]);

	$anak_ke		= 	htmlspecialchars($_POST["anak-ke"]);

	$dari_ke		=	htmlspecialchars($_POST["dari"]);

	$asal_smp  		= 	htmlspecialchars($_POST["asal-smp"]);

	// MENGUBAH FORMAT TANGGAL LAHIR	

	$originalDate = $tanggal_lahir;

	$newDate = date("Y-m-d", strtotime($originalDate));

	$tanggal_lahir = $newDate;



	

	if( $_FILES["foto"]["error"] == 4 ){

			$foto = htmlspecialchars($_POST["foto_lama"]);	

	} else {

			$foto = upload();

			if( $foto == false ){

				return false;

			}

	}





	// DATA AYAH

	$nama_ayah		=	htmlspecialchars($_POST["nama-ayah"]);

	$umur_ayah		=	htmlspecialchars($_POST["umur-ayah"]);

	$pekerjaan_a	=	htmlspecialchars($_POST["pekerjaan-ayah"]);

	$pp_ayah		=	htmlspecialchars($_POST["pp-ayah"]);

	$agama_ayah		=	htmlspecialchars($_POST["agama-ayah"]);

	$alamat_ayah	=	htmlspecialchars($_POST["alamat-ayah"]);

	$kodepos_aa		=	htmlspecialchars($_POST["kode-pos-aa"]);

	$telepon_ayah	=	htmlspecialchars($_POST["telepon-ayah"]);



	// DATA IBU

	$nama_ibu		=	htmlspecialchars($_POST["nama-ibu"]);

	$umur_ibu		=	htmlspecialchars($_POST["umur-ibu"]);

	$pekerjaan_i	=	htmlspecialchars($_POST["pekerjaan-ibu"]);

	$pp_ibu			=	htmlspecialchars($_POST["pp-ibu"]);

	$agama_ibu		=	htmlspecialchars($_POST["agama-ibu"]);

	$alamat_ibu		=	htmlspecialchars($_POST["alamat-ibu"]);

	$kodepos_ai		=	htmlspecialchars($_POST["kode-pos-ai"]);

	$telepon_ibu	=	htmlspecialchars($_POST["telepon-ibu"]);



	// DATA WALI

	if( isset($_POST["nw-c"]) && $_POST["nw-c"] == 'on' ){



		$nama_wali		=	"--";

		$umur_wali		=	00;

		$pekerjaan_w	=	"--";

		$pp_wali		=	00;

		$agama_wali		=	"--";

		$alamat_wali	=	"--";

		$kodepos_aw		=	"--";

		$telepon_wali	=	"--";



	} else {



	// WALI

	$nama_wali		=	htmlspecialchars($_POST["nama-wali"]);

	$umur_wali		=	htmlspecialchars($_POST["umur-wali"]);

	$pekerjaan_w	=	htmlspecialchars($_POST["pekerjaan-wali"]);

	$pp_wali		=	htmlspecialchars($_POST["pp-wali"]);

	$agama_wali		=	htmlspecialchars($_POST["agama-wali"]);

	$alamat_wali	=	htmlspecialchars($_POST["alamat-wali"]);

	$kodepos_aw		=	htmlspecialchars($_POST["kode-pos-aw"]);

	$telepon_wali	=	htmlspecialchars($_POST["telepon-wali"]);



	}





	// UPDATE DATA SISWA

	$query_siswa = "UPDATE `biodata_siswa` SET NAMA_LENGKAP = '$nama_lengkap', NAMA_PANGGILAN = '$nama_panggilan', KELAS = '$kelas', 

	               JENIS_KELAMIN = '$jenis_kelamin', TEMPAT_LAHIR = '$tempat_lahir', TGL_LAHIR = '$tanggal_lahir', 

	               ALAMAT_SEKARANG = '$alamat_skrng', KP_AS = '$kodepos_as', TLP_AS = '$telepon_as', ALAMAT_LIBUR = '$alamat_lbr',

	               KP_AL = '$kodepos_al', TLP_AL = '$telepon_al', HOBBY = '$hobby', EKSKUL = '$ekskul', GOL_DARAH = '$gol_darah',

	               AGAMA = '$agama', ANAK_KE = $anak_ke, DARI = $dari_ke, ASAL_SMP = '$asal_smp', FOTO = '$foto' WHERE ID = $id";



	$result_siswa = mysqli_query($connect, $query_siswa);







	$query_ayah	= "UPDATE `ayah_siswa` SET NAMA_AYAH = '$nama_ayah', UMUR_AYAH = $umur_ayah, PEKERJAAN = '$pekerjaan_a', PENGHASILAN = $pp_ayah, 

				  AGAMA = '$agama_ayah', ALAMAT = '$alamat_ayah', KODE_POS = '$kodepos_aa', NO_TELP = '$telepon_ayah' WHERE ID_SISWA = $id";



	$result_ayah = mysqli_query($connect, $query_ayah);







	$query_ibu	= "UPDATE `ibu_siswa` SET NAMA_IBU = '$nama_ibu', UMUR_IBU = '$umur_ibu', PEKERJAAN = '$pekerjaan_i', PENGHASILAN = $pp_ibu, 

				  AGAMA = '$agama_ibu', ALAMAT = '$alamat_ibu', KODE_POS = '$kodepos_ai', NO_TELP = '$telepon_ibu' WHERE ID_SISWA = $id ";



	$result_ibu = mysqli_query($connect, $query_ibu);







	$query_wali	= "UPDATE `wali_siswa` SET NAMA_WALI = '$nama_wali', UMUR_WALI = '$umur_wali', PEKERJAAN = '$pekerjaan_w', PENGHASILAN = $pp_wali, 

				  AGAMA = '$agama_wali', ALAMAT = '$alamat_wali', KODE_POS = '$kodepos_aw', NO_TELP = '$telepon_wali' WHERE ID_SISWA = $id ";



	$result_wali = mysqli_query($connect, $query_wali);





	if( $result_siswa && $result_ayah && $result_ibu && $result_wali ){

		$affected_rows = 1;

	} else {

		$affected_rows = 0;

	}



	return $affected_rows;



}







function read($syntax){

	global $connect;

	$hasil = mysqli_query($connect, $syntax);

	$records = [];

	while( $record = mysqli_fetch_assoc($hasil)){

		$records[] = $record;

	}



	return $records;

}





function edit_pass(){

	global $connect;



	$id = $_POST["id"];

	$pass = password_hash(htmlspecialchars($_POST["pass"]), PASSWORD_DEFAULT);



	mysqli_query($connect, "UPDATE `akun` SET Password = '$pass' WHERE ID_SISWA = $id");



	return mysqli_affected_rows($connect);

	

}





 ?>