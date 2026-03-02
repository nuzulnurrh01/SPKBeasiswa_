<?php include "header.php"; ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">INPUT DATA SISWA</h1>
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
                                    <form role="form" action="simpan_siswa.php" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>PERIODE</label>
                                            <br>
                                            <select name="periode" required="">
                                                <option value="">= Tahun =</option>
                                                    <?php
                                                        for ($i=2016; $i <= date('Y'); $i++) {
                                                            echo "<option value=$i>$i</option>";
                                                        }
                                                    ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>NIS</label>
                                            <input class="form-control" type="tel" name="nis" placeholder="Nis" minlength="4" maxlength="4" required="">
                                        </div>
                                        <div class="form-group">
                                            <label>NAMA</label>
                                            <input class="form-control" type="text" name="nama" placeholder="Nama" required="">
                                        </div>
                                        <div class="form-group">
                                            <label>ALAMAT</label>
                                            <textarea class="form-control" name="alamat" cols="40" rows="5" placeholder="Alamat" required=""></textarea> 
                                        </div>
                                        <div class="form-group">
                                            <label>TEMPAT LAHIR</label>
                                            <input class="form-control" type="text" name="tempat_lahir" placeholder="Tempat Lahir" required="">
                                        </div>
                                        <div class="form-group">
                                            <label>TANGGAL LAHIR</label>
                                            <input class="form-control" type="date" name="tgl_lahir" placeholder="Tanggal Lahir" required="">
                                        </div>
                                        <div class="form-group">
                                            <label>JENIS KELAMIN</label>
                                            <br/>
                                            <input name="jenis_kelamin" type="radio" value="P"/>Perempuan 
                                            &nbsp;&nbsp;&nbsp;
                                            <input name="jenis_kelamin" type="radio" value="L"/>Laki-laki
                                        </div>
                                        <div class="form-group">
                                            <label>NO TELEPON</label>
                                            <input class="form-control" type="tel" name="no_telepon" placeholder="No Telepon" minlength="10" maxlength="13" required="">
                                        </div>
                                        <button type="submit" value="Simpan" name="proses" class="btn btn-primary">SIMPAN</button>
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

