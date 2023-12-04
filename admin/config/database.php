<?php 

// nama host, Username, password dan nama database
$database = mysqli_connect("localhost","root","","db_sct");

// Periksa Koneksi
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}

?>