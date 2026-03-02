<?php
	if(isset($_GET['nis'])){
		$nis    = $_GET['nis'];
		$simpan = "EDIT";
	} else {
		$simpan = "BARU";
		$nis	  = $_POST['nis'];
	}

	  $nama	    		= $_POST['nama']?? '';
	  $alamat			= $_POST['alamat']??'';
	  $tempat_lahir		= $_POST['tempat_lahir']??'';
	  $tgl_lahir		= $_POST['tgl_lahir']??'';
	  $jenis_kelamin 	      = $_POST['jenis_kelamin']??'';
	  $no_telepon     	= $_POST['no_telepon']??'';
	  $periode			= $_POST['periode']??'';
  
  $dataValid="YA";
  

  if (strlen(trim($nama))==0) {
	 echo "Nama Harus Diisi ! <br/>";
	 $dataValid = "TIDAK";
  }
  if (strlen(trim($alamat))==0) {
	 echo "Alamat Harus Diisi ! <br/>";
	 $dataValid = "TIDAK";
  }
  if (strlen(trim($tempat_lahir))==0) {
	 echo "Tempat Lahir Harus Diisi ! <br/>";
	 $dataValid = "TIDAK";
  }
  if (strlen(trim($tgl_lahir))==0) {
	 echo "Tanggal Lahir Harus Diisi ! <br/>";
	 $dataValid = "TIDAK";
  }
  if (strlen(trim($jenis_kelamin))==0) {
	 echo "Jenis Kelamin Harus Diisi ! <br/>";
	 $dataValid = "TIDAK";
  }
  if (strlen(trim($no_telepon))==0) {
	 echo "Nomer Telepon Harus Diisi ! <br/>";
	 $dataValid = "TIDAK";
  }
  if (strlen(trim($periode))==0) {
	 echo "Periode Harus Diisi ! <br/>";
	 $dataValid = "TIDAK";
  }
  if ($dataValid == "TIDAK") {
	 echo "Masih ada kesalahan, silahkan perbaiki! <br/>";
	 echo "<input type='button' value='Kembali'
		  onClick='self.history.back()'> ";
	 exit;
  }
  
  include "../koneksi.php";

  	$cek = "select * from siswa where nis = '$nis'";
  	$h_cek = mysqli_query($kon, $cek);
  	$data = mysqli_fetch_array($h_cek);
  	$cek_nis = $data['nis'];
	if ($simpan == "BARU" && $cek_nis == $nis) {
    echo "NIS sudah terdaftar, tidak boleh duplikat!";
    echo "<br/><input type='button' value='Kembali'
          onClick='self.history.back()'>";
    exit;
}

  
	  	if($simpan == "EDIT"){
			$sql = "update siswa set
					nama = '$nama',
					alamat = '$alamat',
					tempat_lahir = '$tempat_lahir',
					tgl_lahir = '$tgl_lahir',
					jenis_kelamin = '$jenis_kelamin',
					no_telepon ='$no_telepon',
					periode ='$periode'
					where nis = '$nis'";
		} else {
	  		$sql = "insert into siswa
				  (nis,nama,alamat,tempat_lahir,tgl_lahir,jenis_kelamin,no_telepon,periode,status)
				  values
				  ('$nis','$nama','$alamat','$tempat_lahir','$tgl_lahir','$jenis_kelamin','$no_telepon','$periode','B') ";
		}

	 	$hasil = mysqli_query($kon, $sql);
	  
	  	if (!$hasil){
			echo "Gagal simpan, silahkan diulangi! <br/>";
			echo mysqli_error($kon);
			echo "<br/> <input type='button' value='Kembali'
			 	onClick='self.history.back() '>";
			exit;
	  	} else {
			header("location:daftar_siswa.php");
	  	}
?>

