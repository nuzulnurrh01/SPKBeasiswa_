<?php
	session_start();
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	$akses = $_POST['akses'];
	
	$dataValid="YA";
	if (strlen(trim($username))==0) {
		$dataValid = "TIDAK";
	}
	if (strlen(trim($password))==0) {
		$dataValid = "TIDAK";
	}
	if ($dataValid=="TIDAK"){
		echo "Masih Ada Kesalahan, Silakan Perbaiki! <br/>";
		echo "<input type='button' value='Kembali'
		onClick='self.history.back()'>";
	exit;
	}
	
	include "koneksi.php";
	$sql = "select * from user where
			username='".$username."' and password='".$password."' and akses='".$akses."' limit 1";
	$hasil = mysqli_query($kon, $sql) or die ('Gagal Akses! <br/>');
	$jumlah = mysqli_num_rows($hasil);
	if($jumlah > 0){
        $row = mysqli_fetch_assoc($hasil);       
        $_SESSION['username']=$row['username'];
        $_SESSION['akses'] = $row['akses'];

        
        if ($row['akses']=="TataUsaha") {
        	header("Location: TataUsaha/index.php");
        } elseif ($row['akses']=="BagianKesiswaan") {
        	header("Location: BagianKesiswaan/index.php");
        } else {
        	header("Location: KepalaSekolah/index.php ");
        }
        
    }else{
        echo '<div class="alert alert-danger">LOGIN GAGAL!!!!!</div>';
    }
?>
