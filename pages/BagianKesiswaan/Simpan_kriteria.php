<?php
	if(isset($_GET['ID_kriteria'])){
		$ID_kriteria = $_GET['ID_kriteria'];
		$simpan = "EDIT";
	} else {
		$simpan = "BARU";
	}
	  $ID_kriteria		= $_POST['ID_kriteria'];	
	  $nama_kriteria	= $_POST['nama_kriteria'];
	  $jenis_kriteria	= $_POST['jenis_kriteria'];
	  $bobot			= $_POST['bobot'];
  
  $dataValid="YA";
  
  if (strlen(trim($ID_kriteria))==0) {
	 echo "ID Kriteria Harus Diisi ! <br/>";
	 $dataValid = "TIDAK";
  }
  if (strlen(trim($nama_kriteria))==0) {
	 echo "Nama Kriteria Harus Diisi ! <br/>";
	 $dataValid = "TIDAK";
  }
  if (strlen(trim($jenis_kriteria))==0) {
	 echo "Jenis Kriteria Harus Diisi ! <br/>";
	 $dataValid = "TIDAK";
  }
  if (strlen(trim($bobot))==0) {
	 echo "Bobot Kriteria Harus Diisi ! <br/>";
	 $dataValid = "TIDAK";
  }
  if ($dataValid == "TIDAK") {
	 echo "Masih ada kesalahan, silahkan perbaiki! <br/>";
	 echo "<input type='button' value='Kembali'
		  onClick='self.history.back()'> ";
	 exit;
  }
  
  include "../koneksi.php";

  if($simpan == "EDIT"){
		$sql = "update kriteria set
				ID_kriteria		= '$ID_kriteria',
				nama_kriteria 	= '$nama_kriteria',
				jenis_kriteria 	= '$jenis_kriteria',
				bobot 			= '$bobot'
				where ID_kriteria = '$ID_kriteria'";
	} else {
  
  $sql = "insert into kriteria
		  (ID_kriteria,nama_kriteria,jenis_kriteria,bobot)
		  values
		  ('$ID_kriteria','$nama_kriteria','$jenis_kriteria','$bobot') ";
	}

  $hasil = mysqli_query($kon, $sql);
  
  if (!$hasil) {
	echo "Gagal simpan, silahkan diulangi! <br/>";
	echo mysqli_error($kon);
	echo "<br/> <input type='button' value='Kembali'
		 onClick='self.history.back() '>";
	exit;
  } else {
	header("location:daftar_kriteria.php");
  }

?>

