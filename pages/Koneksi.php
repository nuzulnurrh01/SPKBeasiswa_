<?php
error_reporting(E_ALL ^ E_DEPRECATED);
 $host = "localhost";
 $user = "root";
 $pass = "";
 $dbName = "beasiswa";
 
 $kon = mysqli_connect($host, $user, $pass);
 if (!$kon)
	die ("Gagal Koneksi...");
	
 $hasil = mysqli_select_db($kon, $dbName);
 if (!$hasil) {
	$hasil = mysqli_query($kon, "CREATE DATABASE $dbName");
	if (!$hasil)
		die("Gagal Buat Database");
	else
		$hasil = mysqli_select_db($kon, $dbName);
		if (!$hasil) die ("Gagal Konek Database");
}

$sqlTabelSiswa = "create table if not exists siswa (
				nis int(4) not null primary key,
				nama varchar(30) not null,
				alamat text not null,
				tempat_lahir varchar(30) not null,
				tgl_lahir date,
				jenis_kelamin enum('L','P') not null,
				no_telepon varchar(13) not null,
				status enum('S','B') not null,
				periode int(4) not null

			)";
mysqli_query ($kon, $sqlTabelSiswa) or die("Gagal Buat Tabel Siswa ");

$sqlTabelKriteria = "create table if not exists kriteria (
					ID_kriteria char(2) not null primary key,
					nama_kriteria varchar(30) not null,
					jenis_kriteria enum('cost','benefit') not null,
					bobot int(2) not null
			)";
mysqli_query ($kon, $sqlTabelKriteria) or die("Gagal Buat Tabel Kriteria ");

$sqlTabelPenilaian = "create table if not exists penilaian (
					ID_penilaian int auto_increment not null primary key,
					nis int(4) not null,
					penghasilan_ortu int not null,
					jml_sdrkandung int not null,
					tanggungan_ortu int not null,
					nilai_rata dec(5,2) not null,
					jarak dec(5,2) not null,
					kondisi_rumah enum('1','2','3'),
					hasil dec(5,2) not null,
					foreign key (nis) references siswa (nis)
				)";
mysqli_query ($kon, $sqlTabelPenilaian) or die("Gagal Buat Tabel Penilaian ");

$sqlTabelAnalisa = "create table if not exists analisa (
				ID_kriteria char(2) not null,
				ID_penilaian int not null,
				nilai float not null,
				foreign key (ID_kriteria) references kriteria (ID_kriteria),
				foreign key (ID_penilaian) references penilaian (ID_penilaian)
				)";
mysqli_query ($kon, $sqlTabelAnalisa) or die("Gagal Buat Tabel Analisa ");

$sqlTabelUser = "create table if not exists user (
				ID_user int auto_increment not null primary key,
				username varchar(20) not null,
				password text not null,
				akses varchar(20) not null
			)";
mysqli_query ($kon, $sqlTabelUser) or die("Gagal Buat Tabel User ");

$sql = "select * from user";
$hasil = mysqli_query($kon, $sql);
$jumlah = mysqli_num_rows($hasil);
if($jumlah == 0){
	$sql1 = "insert into user (username, password, akses)
			values ('tatausaha', md5('tata_usaha'),'TataUsaha'),
			('bagkesiswaan', md5('bag_kesiswaan'),'BagianKesiswaan'),
			('kepalasekolah', md5('kepala_sekolah'),'KepalaSekolah')";
mysqli_query($kon, $sql1);
}
?>
