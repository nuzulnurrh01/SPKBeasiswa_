<?php include "header.php"; ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">PERHITUNGAN TOPSIS</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form action="#" method="post">
                                <label>Periode</label>

                                <select name="periode">
                                    <option value="">= Tahun =</option>
                                    <?php
                                        for ($i=2016; $i <= date('Y'); $i++) { 
                                            echo "<option value=$i>$i</option>";
                                        }
                                    ?>
                                </select>
                                <input type="submit" name="lihat" value="Lihat">
                            </form>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <?php
                include "../koneksi.php";

                if (isset($_POST['lihat'])){
                    $periode = $_POST['periode'];
            ?>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                          <h3>Periode <?php echo $periode; ?></h3>
                        </div>
                        <div class="panel-body">
                            <?php
                                $dbhost='localhost';
                                $dbuser='root';
                                $dbpass='';
                                $dbname='beasiswa';
                                $db=new mysqli($dbhost,$dbuser,$dbpass,$dbname);

                                

                                $sql = "SELECT  
                                a.nama, a.periode, b.nama_kriteria, b.bobot, b.jenis_kriteria, c.nis, d.ID_penilaian, d.ID_kriteria, d.nilai
                                FROM
                                siswa a, kriteria b, penilaian c, analisa d
                                where  
                                a.nis=c.nis and b.ID_kriteria=d.ID_kriteria and c.ID_penilaian=d.ID_penilaian and a.periode='$periode'";

                                $result=$db->query($sql);
                                $data=array();
                                $kriterias=array();
                                $bobot=array();
                                $atribut=array();
                                $nilai_kuadrat=array();
                              while($row=$result->fetch_object()){
                                if(!isset($data[$row->nama])){
                                $data[$row->nama]=array();
                                }
                                if(!isset($data[$row->nama][$row->nama_kriteria])){
                                $data[$row->nama][$row->nama_kriteria]=array();
                                }
                                if(!isset($nilai_kuadrat[$row->nama_kriteria])){
                                $nilai_kuadrat[$row->nama_kriteria]=0;
                                }
                                $bobot[$row->nama_kriteria]=$row->bobot;
                                $atribut[$row->nama_kriteria]=$row->jenis_kriteria;
                                $data[$row->nama][$row->nama_kriteria]=$row->nilai;
                                $nilai_kuadrat[$row->nama_kriteria]+=pow($row->nilai,2);
                                $kriterias[]=$row->nama_kriteria;
                              }
                              $kriteria=array_unique($kriterias);
                              $jml_kriteria=count($kriteria);


                            ?>

                            <table border="1" cellpadding="1" cellspacing="1">
                              <thead>
                                <tr>
                                  <th rowspan="4">No</th> 
                                  <th rowspan="3">Alternatif</th>
                                  <th rowspan="3">Nama</th>
                                  <th colspan='<?php echo $jml_kriteria ?>'>Kriteria (<?php print $jml_kriteria ?>)</th>
                                </tr>
                                <tr>
                                <?php 
                                  foreach ($kriteria as $k) {
                                    echo "<th>{$k}</th>";
                                  }
                                ?>
                                </tr>
                                <tr>
                                <?php 
                                for ($n=1; $n<=$jml_kriteria; $n++) { 
                                  echo "<th>C{$n}</th>";
                                }
                                 ?>
                                </tr>
                              </thead>
                              <tbody>
                                <?php 
                                $i=0;
                                foreach ($data as $nama=>$krit) {
                                  echo "<tr>
                                  <td>".(++$i)."</td>
                                  <th>A{$i}</th>
                                  <th>{$nama}</th>";
                                  foreach ($kriteria as $k) {
                                    echo "<td align='center'>{$krit[$k]}</td>";
                                  }
                                }
                                ?>
                              </tbody>
                            </table>

                            <header>
                              <h2>Matriks Keputusan Ternormalisasi(R<sub>ij</sub>)</h2>
                            </header>
                            <table border="1" cellspacing="0" cellpadding="1">
                              <thead>
                                <tr>
                                  <th rowspan="3">No</th>
                                  <th rowspan="3">Alternatif</th>
                                  <th rowspan="3">Nama</th>
                                  <th colspan="<?php print $jml_kriteria; ?>"><center>Kriteria</center></th>
                                </tr>
                                <tr>
                                <?php 
                                  foreach ($kriteria as $k) {
                                    echo "<th>{$k}</th>";
                                  }
                                ?>
                                </tr>
                                <tr>
                                <?php 
                                  for ($n=1; $n<=$jml_kriteria; $n++) { 
                                    echo "<th>C{$n}</th>";
                                  }
                                ?>
                                </tr>
                              </thead>
                              <thead>
                              <?php 
                              $i=0;
                              foreach ($data as $nama => $krit) {
                                echo "<tr>
                                <td>".(++$i)."</td>
                                <th>A{$i}</th>
                                <td>{$nama}</td>";
                                foreach ($kriteria as $k) {
                                  echo "<td align='center'>".round(($krit[$k])/sqrt($nilai_kuadrat[$k]),4)."</td>";
                                }
                                echo "</tr>";
                              }
                              ?>
                              </thead>
                            </table>

                            <header><h2>Matriks Keputusan Ternormalisasi Terbobot(Y<sub>ij</sub>)</h2></header>
                            <table border="1" cellpadding="0" cellspacing="0">
                              <thead>    
                                <tr>
                                  <th rowspan="3">No</th>
                                  <th rowspan="3">Alternatif</th>
                                  <th rowspan="3">Nama</th>
                                  <th colspan="<?php echo $jml_kriteria; ?>">Kriteria</th>
                                </tr>
                                <tr>
                                <?php 
                                foreach ($kriteria as $k) {
                                  echo "<th>{$k}</td>\n";
                                }
                                ?>
                                </tr>
                                <tr>
                                <?php 
                                for ($n=1; $n<=$jml_kriteria; $n++) { 
                                  echo "<th>C{$n}</th>";
                                }
                                ?>
                                </tr>
                              </thead>
                              <tbody>
                              <?php 
                              $i=0;
                              $y=array();
                              foreach ($data as $nama => $krit) {
                                echo "<tr>
                                <td>".(++$i)."</td>
                                <th>A{$i}</th>
                                <td>{$nama}</td>";
                                foreach ($kriteria as $k) {
                                  $y[$k][$i-1]=round(($krit[$k]/sqrt($nilai_kuadrat[$k]))*$bobot[$k],4);
                                  echo "<td align='center'>".$y[$k][$i-1]."</td>";
                                }
                                echo "</tr>";
                              }
                              ?>
                              </tbody>
                            </table>

                            <header><h2>Solusi Ideal Positif (A<sup>+</sup>)</h2></header>
                            <table border="1" cellspacing="0" cellpadding="2">
                              <thead>
                                <tr>
                                  <th colspan="<?php echo $jml_kriteria; ?>">Kriteria</th>
                                </tr>
                                <tr>
                                <?php 
                                foreach ($kriteria as $k) {
                                  echo "<th>{$k}</th>";
                                }
                                ?>
                                </tr>
                                <tr>
                                <?php  
                                for ($n=1; $n<=$jml_kriteria; $n++) { 
                                  echo "<th>y<sub>{$n}</sub><sup>+</sup></th>";
                                }
                                ?>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                <?php 
                                $yplus=array();
                                foreach ($kriteria as $k) {
                                  $yplus[$k]=($atribut[$k]=='benefit'?max($y[$k]):min($y[$k]));
                                  echo "<th>{$yplus[$k]}</th>";
                                }
                                ?>
                                </tr>
                              </tbody>
                            </table>


                            <header><h2>Solusi Ideal negatif (A<sup>-</sup>)</h2></header>
                            <table border="1" cellspacing="0" cellpadding="2">
                              <thead>
                                <tr>
                                  <th colspan="<?php echo $jml_kriteria; ?>">Kriteria</th>
                                </tr>
                                <tr>
                                <?php 
                                foreach ($kriteria as $k) {
                                  echo "<th>{$k}</th>";
                                }
                                ?>
                                </tr>
                                <tr>
                                <?php  
                                for ($n=1; $n<=$jml_kriteria; $n++) { 
                                  echo "<th>y<sub>{$n}</sub><sup>-</sup></th>";
                                }
                                ?>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                <?php 
                                $ymin=array();
                                foreach ($kriteria as $k) {
                                  $ymin[$k]=($atribut[$k]=='cost'?max($y[$k]):min($y[$k]));
                                  echo "<th>{$ymin[$k]}</th>";
                                }
                                ?>
                                </tr>
                              </tbody>
                            </table>



                            <header><h2>Jarak Solusi Ideal Positif (D<sub>i</sub><sup>+</sup>)</h2></header>
                            <table border="1" cellpadding="1" cellspacing="0">
                              <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Alternatif</th>
                                  <th>Nama</th>
                                  <th>D<sup>+</sup></th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php 
                                $i=0;
                                $dplus=array();
                                foreach ($data as $nama => $krit) {
                                  echo "<tr>
                                  <td>".(++$i)."</td>
                                  <th>A{$i}</th>
                                  <td>{$nama}</td>";
                                  foreach ($kriteria as $k) {
                                    if (!isset($dplus[$i-1])) $dplus[$i-1]=0;
                                    $dplus[$i-1]+=pow($yplus[$k]-$y[$k][$i-1],2);
                                  }
                                  echo "<td>".round(sqrt($dplus[$i-1]),4)."</td>
                                  </tr>";
                                }
                                ?>
                              </tbody>
                            </table>


                            <header><h2>Jarak Solusi Ideal Negatif(D<sub>i</sub><sup>-</sup>)</h2></header>
                            <table border="1" cellpadding="1" cellspacing="0">
                              <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Alternatif</th>
                                  <th>Nama</th>
                                  <th>D<sup>-</sup></th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php 
                                $i=0;
                                $dmin=array();
                                foreach ($data as $nama => $krit) {
                                  echo "<tr>
                                  <td>".(++$i)."</td>
                                  <th>A{$i}</th>
                                  <td>{$nama}</td>";
                                  foreach ($kriteria as $k) {
                                    if (!isset($dmin[$i-1])) $dmin[$i-1]=0;
                                    $dmin[$i-1]+=pow($ymin[$k]-$y[$k][$i-1],2);
                                  }
                                  echo "<td>".round(sqrt($dmin[$i-1]),4)."</td>
                                  </tr>";
                                }
                                ?>
                              </tbody>
                            </table>

                            <header>
                              <h2>Nilai Preferensi(V<sub>i</sub>)</h2>                                  
                            </header>

                            <table border="1" cellpadding="1" cellspacing="0">
                              <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Alternatif</th>
                                  <th>Nama</th>
                                  <th>V<sub>i</sub></th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php 
                                $i = 0;
$V = array();

foreach ($data as $nama => $krit) {
  echo "<tr>
        <td>".(++$i)."</td>
        <th>A{$i}</th>
        <td>{$nama}</td>";

  include '../koneksi.php';

  $denom = sqrt($dmin[$i-1]) + sqrt($dplus[$i-1]);

  if ($denom == 0) {
      $V[$i-1] = 0;
  } else {
      $V[$i-1] = round(sqrt($dmin[$i-1]) / $denom, 4);
  }

  $cek_siswa = "select * from siswa where nama = '$nama'";
  $hasil_siswa = mysqli_query($kon, $cek_siswa);
  $data_siswa = mysqli_fetch_array($hasil_siswa);
  $nis = $data_siswa['nis'];

  $update = "update penilaian set hasil = '".$V[$i-1]."' where nis = '".$nis."'";
  $simpan = mysqli_query($kon, $update);

  echo "<td>{$V[$i-1]}</td></tr>";

                                }
                                ?>
                              </tbody>
                            </table>
                        </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <?php
              }
            ?>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../../dist/js/sb-admin-2.js"></script>

</body>

</html>
