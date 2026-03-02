<?php
	$nis = $_GET["nis"];
	include "../koneksi.php";
	$sql = "select * from siswa where nis = '$nis'";
	$hasil = mysqli_query($kon, $sql);
	if(!$hasil) die ("Gagal query..");
	
	$data = mysqli_fetch_array($hasil);
	$nama	    	= $data['nama'];
	
	if(isset($_GET['hapus'])){
		$sql = "delete from siswa where nis = '$nis'";
		$hasil = mysqli_query($kon, $sql);
		if(!$hasil){
			echo "<script>alert('Gagal Hapus siswa : '".$nama."');history.go(-1);</script>";
			
		} else {
			header('location:daftar_siswa.php');
		}
	}
?>
