<?php include "header.php"; ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">EDIT DATA SISWA</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <?php
                                        $nis = $_GET["nis"];
                                        include "../koneksi.php";
                                        $sql = "select * from siswa where nis = '$nis'";
                                        $hasil = mysqli_query($kon, $sql);
                                        if(!$hasil) die ("Gagal query..");
                                        
                                        $data = mysqli_fetch_array($hasil);
                                        $nis            = $data['nis'];
                                        $nama           = $data['nama'];
                                        $alamat         = $data['alamat'];
                                        $tempat_lahir   = $data['tempat_lahir'];
                                        $tgl_lahir      = $data['tgl_lahir'];
                                        $jenis_kelamin  = $data['jenis_kelamin'];
                                        $no_telepon     = $data['no_telepon'];
                                        $periode        = $data['periode'];

                                        if ($jenis_kelamin == "L"){
                                            $jk = "Laki-laki";
                                        } else {
                                            $jk = "Perempuan";
                                        }

                                    ?>
                                    <form role="form" action="simpan_siswa.php?nis=<?php echo $nis;?>" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>PERIODE</label>
                                            <br>
                                            <select name="periode">
                                                <option value="<?php echo $periode;?>"><?php echo $periode; ?></option>
                                                <?php
                                                        for ($i=2016; $i <= date('Y'); $i++) {
                                                            echo "<option value=$i>$i</option>";
                                                        }
                                                    ?>
                                            </select>
                                        <div class="form-group">
                                        <div class="form-group">
                                            <label>NIS</label>
                                            <input class="form-control" type="number" value="<?php echo $nis; ?>" disabled="true">
                                        <div class="form-group">
                                            <label>NAMA</label>
                                            <input class="form-control" type="text" name="nama" value="<?php echo $nama; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>ALAMAT</label>
                                            <textarea class="form-control" name="alamat" cols="40" rows="5"/><?php echo $data ['alamat']; ?></textarea> 
                                        </div>
                                        <div class="form-group">
                                            <label>TEMPAT LAHIR</label>
                                            <input class="form-control" type="text" name="tempat_lahir" value="<?php echo $tempat_lahir; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>TANGGAL LAHIR</label>
                                            <input class="form-control" type="date" name="tgl_lahir" value="<?php echo $tgl_lahir; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>JENIS KELAMIN</label>
                                            <br/>
                                            <select name="jenis_kelamin">
                                                <option value="<?php echo $jenis_kelamin;?>"><?php echo $jk;?></option>
                                                <?php
                                                if ($jenis_kelamin == "L"){
                                                    echo "<option value='P'>Perempuan</option>";
                                                }else {
                                                    echo "<option value='L'>Laki-laki</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>NO TELEPON</label>
                                            <input class="form-control" type="number" name="no_telepon" value="<?php echo $no_telepon; ?>">
                                        </div>
                                        <button type="submit" value="Simpan" name="proses" class="btn btn-primary">SIMPAN</button>
                                        <a href="daftar_siswa.php" class='btn btn-primary'>BATAL</a>
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

