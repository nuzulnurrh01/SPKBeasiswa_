<?php
	if(isset($_POST['nis']) && isset($_GET['ID_penilaian'])){
		$nis = $_POST['nis'];
		$ID_penilaian = $_GET['ID_penilaian'];
		$simpan = "EDIT";
	} else {
		$simpan = "BARU";
	}
$nis = $_POST['nis'] ?? '';
$penghasilan_ortu = $_POST['penghasilan_ortu'] ?? '';
$jml_sdrkandung = $_POST['jml_sdrkandung'] ?? '';
$tanggungan_ortu = $_POST['tanggungan_ortu'] ?? '';
$nilai_rata = $_POST['nilai_rata'] ?? '';
$jarak = $_POST['jarak'] ?? '';
$kondisi_rumah = $_POST['kondisi_rumah'] ?? '';
		
  $dataValid="YA";
  

  if (strlen(trim($nis))==0) {
	 echo "Nis Harus Diisi ! <br/>";
	 $dataValid = "TIDAK";
  }
  if (strlen(trim($penghasilan_ortu))==0) {
	 echo "Penghasilan Harus Diisi ! <br/>";
	 $dataValid = "TIDAK";
  }
  if (strlen(trim($jml_sdrkandung))==0) {
	 echo "Jumlah Saudara Kandung Harus Diisi ! <br/>";
	 $dataValid = "TIDAK";
  }
  if (strlen(trim($tanggungan_ortu))==0) {
	 echo "Tanggungan Harus Diisi ! <br/>";
	 $dataValid = "TIDAK";
  }
  if (strlen(trim($nilai_rata))==0) {
	 echo "Nilai Harus Diisi ! <br/>";
	 $dataValid = "TIDAK";
  }
  if (strlen(trim($jarak))==0) {
	 echo "Jarak Harus Diisi ! <br/>";
	 $dataValid = "TIDAK";
  }
  if (strlen(trim($kondisi_rumah))==0) {
	 echo "Kondisi Harus Diisi ! <br/>";
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
		$sql = "update penilaian set
				nis 			= '$nis',
				jml_sdrkandung	= '$jml_sdrkandung',
				penghasilan_ortu 	= '$penghasilan_ortu',
				tanggungan_ortu 	= '$tanggungan_ortu',
				nilai_rata		= '$nilai_rata',
				jarak			= '$jarak',
				kondisi_rumah 	= '$kondisi_rumah'
				where ID_penilaian= '$ID_penilaian'";

    $up_C1 = "update analisa set nilai = '$penghasilan_ortu' where ID_penilaian = '$ID_penilaian' and ID_kriteria = 'C1'";
    $hasil_up_C1 = mysqli_query($kon, $up_C1);

    $up_C2 = "update analisa set nilai = '$jml_sdrkandung' where ID_penilaian = '$ID_penilaian' and ID_kriteria = 'C2'";
    $hasil_up_C2 = mysqli_query($kon, $up_C2);

    $up_C3 = "update analisa set nilai = '$tanggungan_ortu' where ID_penilaian = '$ID_penilaian' and ID_kriteria = 'C3'";
    $hasil_up_C3 = mysqli_query($kon, $up_C3);

    $up_C4 = "update analisa set nilai = '$nilai_rata' where ID_penilaian = '$ID_penilaian' and ID_kriteria = 'C4'";
    $hasil_up_C4 = mysqli_query($kon, $up_C4);

    $up_C5 = "update analisa set nilai = '$jarak' where ID_penilaian = '$ID_penilaian' and ID_kriteria = 'C5'";
    $hasil_up_C5 = mysqli_query($kon, $up_C5);

    $up_C6 = "update analisa set nilai = '$kondisi_rumah' where ID_penilaian = '$ID_penilaian' and ID_kriteria = 'C6'";
    $hasil_up_C6 = mysqli_query($kon, $up_C6);

    $hasil = mysqli_query($kon, $sql);
	} else {
  
  $sql = "insert into penilaian
		  (nis,penghasilan_ortu,jml_sdrkandung,tanggungan_ortu,nilai_rata,jarak,kondisi_rumah)
		  values
		  ('$nis','$penghasilan_ortu','$jml_sdrkandung','$tanggungan_ortu','$nilai_rata','$jarak','$kondisi_rumah') ";

	$update = "update siswa set status = 'S' where nis='$nis'";
  	$hasilupdate = mysqli_query($kon, $update);

    $hasil = mysqli_query($kon, $sql);

    //mengambil data penilaian terbaru
    $cekPenilaian = "select * from penilaian order by ID_penilaian desc limit 1";
    $penilaian = mysqli_query($kon, $cekPenilaian);
    $data = mysqli_fetch_array($penilaian);
    $ID_penilaian = $data['ID_penilaian'];
    $C1 = $data['penghasilan_ortu'];
    $C2 = $data['jml_sdrkandung'];
    $C3 = $data['tanggungan_ortu'];
    $C4 = $data['nilai_rata'];
    $C5 = $data['jarak'];
    $C6 = $data['kondisi_rumah'];

    $cekKriteria = "select * from kriteria";
    $kriteria = mysqli_query($kon, $cekKriteria);
         if (!$kriteria)
          die("Gagal query..".mysqli_error($kon));
          while ($row = mysqli_fetch_assoc($kriteria)) {
            if ($row['ID_kriteria'] == "C1") {
              $insert = " insert into analisa (ID_penilaian,ID_kriteria,nilai) values ('".$ID_penilaian."','".$row['ID_kriteria']."','".$C1."')";
            } elseif ($row['ID_kriteria'] == "C2") {
              $insert = " insert into analisa (ID_penilaian,ID_kriteria,nilai) values ('".$ID_penilaian."','".$row['ID_kriteria']."','".$C2."')";
            } elseif ($row['ID_kriteria'] == "C3") {
              $insert = " insert into analisa (ID_penilaian,ID_kriteria,nilai) values ('".$ID_penilaian."','".$row['ID_kriteria']."','".$C3."')";
            } elseif ($row['ID_kriteria'] == "C4") {
              $insert = " insert into analisa (ID_penilaian,ID_kriteria,nilai) values ('".$ID_penilaian."','".$row['ID_kriteria']."','".$C4."')";
            } elseif ($row['ID_kriteria'] == "C5") {
              $insert = " insert into analisa (ID_penilaian,ID_kriteria,nilai) values ('".$ID_penilaian."','".$row['ID_kriteria']."','".$C5."')";
            } else {
              $insert = " insert into analisa (ID_penilaian,ID_kriteria,nilai) values ('".$ID_penilaian."','".$row['ID_kriteria']."','".$C6."')";
            }
            
            // MEMAANGGIL PERINTAH INSERT
            $simpan = mysqli_query($kon, $insert);
         }
	}  	
  
  if (!$hasil) {
	echo "Gagal simpan, silahkan diulangi! <br/>";
	echo mysqli_error($kon);
	echo "<br/> <input type='button' value='Kembali'
		 onClick='self.history.back() '>";
	exit;
  } else {
	header("location:daftar_penilaian.php");
  }

?>
