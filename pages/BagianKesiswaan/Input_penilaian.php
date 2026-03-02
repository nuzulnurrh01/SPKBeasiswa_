<?php include "header.php"; ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">INPUT DATA PENILAIAN</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

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

            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3>Periode <?php echo $periode; ?></h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-10">
                                    <form role="form" action="simpan_penilaian.php" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>NAMA</label>
                                            <?php
                                                include "../koneksi.php";
                                                $sql = "select nis, nama from siswa where status = 'B' and periode = '$periode'";
                                                $penilaian = mysqli_query($kon,$sql);
                                                if(!$penilaian)
                                                  die("Gagal query..".mysqli_error($kon));
                                                echo "<select class='form-control' name='nis'>";
                                                echo "<option value=''>= Pilihan =</option>";
                                                while ($nilai = mysqli_fetch_object($penilaian)) {
                                                    echo "<option value='$nilai->nis'>$nilai->nama</option>";
                                                }
                                                echo "</select>";
                                            ?>
                                        </div>
                                        <div class="form-group">
                                            <label>PENGHASILAN ORANG TUA (Rp)</label>
                                            <input class="form-control" type="number" name="penghasilan_ortu" placeholder="Penghasilan Orang Tua" required="" min=100000 max=5000000>
                                        </div>
                                        <div class="form-group">
                                            <label>JUMLAH SAUDARA KANDUNG</label>
                                            <input class="form-control" type="text" name="jml_sdrkandung" placeholder="Jumlah Saudara Kandung " required="" max=5>
                                        </div>
                                        <div class="form-group">
                                            <label>TANGGUNGAN ORANG TUA</label>
                                            <input class="form-control" type="text" name="tanggungan_ortu" placeholder="Tanggungan Orang Tua" required="" max=10>
                                        </div>
                                        <div class="form-group">
                                            <label>NILAI RATA-RATA RAPORT</label>
                                            <input class="form-control" type="number" name="nilai_rata" placeholder="Nilai Rata" required="" max=100>
                                        </div>
                                        <div class="form-group">
                                            <label>JARAK RUMAH KE SEKOLAH (km)</label>
                                            <input class="form-control" type="text" name="jarak" placeholder="Jarak Rumah" required="" max=10>
                                        </div>
                                        <div class="form-group">
                                            <label>KONDISI RUMAH</label>
                                            </br>
                                            <input name="kondisi_rumah" type="radio" value="1"/>Baik
                                            <input name="kondisi_rumah" type="radio" value="2"/>Sedang
                                            <input name="kondisi_rumah" type="radio" value="3"/>Buruk
                                        </div>
                                        <button type="submit" class="btn btn-primary">SIMPAN</button>
                                        <button type="reset" class="btn btn-primary">BATAL</button>
                                    </form>
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
        </div>
        <!-- /#page-wrapper -->

        <?php
            }
        ?>
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

