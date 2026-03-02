<?php
	$ID_penilaian = $_GET["ID_penilaian"];
	include "../koneksi.php";
	$sql = "select * from penilaian where ID_penilaian = '$ID_penilaian'";

	$hasil = mysqli_query($kon, $sql);
	if(!$hasil) die ("Gagal query..");
	
	$data = mysqli_fetch_array($hasil);
	$ID_penilaian	    		= $data['ID_penilaian'];
	$nis                        = $data['nis'];
	
	if(isset($_GET['hapus'])){
		$sql = "delete from penilaian where ID_penilaian = '$ID_penilaian'";
mysqli_query($kon, 
    "DELETE FROM analisa WHERE ID_penilaian='$ID_penilaian'"
);
		$hasil = mysqli_query($kon, $sql);
		$update = "update siswa set status = 'B' where nis='$nis'";
  		$hasilupdate = mysqli_query($kon, $update);
		if(!$hasil){
			echo "<script>alert('Gagal Hapus Penilaian : '".$ID_penilaian."');history.go(-1);</script>";
		} else {
			header('location:daftar_penilaian.php');
		}
	}
?>
