<?php include "header.php"; ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">EDIT DATA KRITERIA</h1>
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
                                <div class="col-lg-10">
                                    <?php
                                        $ID_kriteria = $_GET["ID_kriteria"];
                                        include "../koneksi.php";
                                        $sql = "select * from kriteria where ID_kriteria  = '$ID_kriteria'";
                                        $hasil = mysqli_query($kon, $sql);
                                        if(!$hasil) die ("Gagal query..");
                                        
                                        $data = mysqli_fetch_array($hasil);
                                        $ID_kriteria    = $data['ID_kriteria'];
                                        $nama_kriteria  = $data['nama_kriteria'];
                                        $jenis_kriteria = $data['jenis_kriteria'];
                                        $bobot          = $data['bobot'];

                                        if ($jenis_kriteria == "B"){
                                            $jenis_kriteria = "Benefit";
                                        } else {
                                            $jenis_kriteria = "Cost";
                                        }
                                    ?>
                                    <form role="form" action="simpan_kriteria.php?ID_kriteria=<?php echo $ID_kriteria;?>" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            
                                            <label>ID Kriteria</label>
                                            <input class="form-control" type="text" name="ID_kriteria" value="<?php echo $ID_kriteria; ?>" disabled="true">                         
                                            <input type="hidden" name="ID_kriteria" value="<?php echo $ID_kriteria; ?>">
                                            
                                            <label>NAMA KRITERIA</label>
                                            <input class="form-control" type="text" name="nama_kriteria" value="<?php echo $nama_kriteria; ?> " disabled="true">
                                            <input class="form-control" type="hidden" name="nama_kriteria" value="<?php echo $nama_kriteria; ?>" >
                                        </div>
                                        <div class="form-group">
                                            <label>BOBOT</label>
                                            <input class="form-control" type="number" name="bobot" value="<?php echo $bobot; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>JENIS KRITERIA</label>
                                            <br/>
                                            <select name="jenis_kriteria">
                                                <option value="<?php echo $jenis_kriteria;?>"><?php echo $jenis_kriteria;?></option>
                                                <?php
                                                if ($jenis_kriteria == "B"){
                                                    echo "<option value='Cost'>Cost</option>";
                                                }else {
                                                    echo "<option value='Benefit'>Benefit</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary">SIMPAN</button>
                                        <a href="daftar_kriteria.php" class='btn btn-primary'>BATAL</a>
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
