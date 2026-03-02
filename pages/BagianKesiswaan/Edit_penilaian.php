<?php include "header.php"; ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">EDIT DATA PENILAIAN</h1>
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
                                        $ID_penilaian = $_GET["ID_penilaian"];
                                        include "../koneksi.php";
                                        $sql = "select s.nama,p.nis,p.ID_penilaian,p.penghasilan_ortu,p.jml_sdrkandung,p.tanggungan_ortu,p.nilai_rata,p.jarak,p.kondisi_rumah
                                        from siswa s,penilaian p
                                        where s.nis=p.nis AND ID_penilaian=$ID_penilaian";
                                        $hasil = mysqli_query($kon, $sql);
                                        if(!$hasil) die ("Gagal query..");
                                        
                                        $data = mysqli_fetch_array($hasil);
                                        $nama               = $data['nama'];
                                        $nis               = $data['nis'];
                                        $penghasilan_ortu   = $data['penghasilan_ortu'];
                                        $jml_sdrkandung     = $data['jml_sdrkandung'];
                                        $tanggungan_ortu    = $data['tanggungan_ortu'];
                                        $nilai_rata         = $data['nilai_rata'];
                                        $jarak              = $data['jarak'];
                                        $kondisi_rumah      = $data['kondisi_rumah'];

                                        if ($kondisi_rumah == "1"){
                                            $ketkondisi_rumah = "Baik";
                                        } else if ($kondisi_rumah =="2"){
                                            $ketkondisi_rumah = "Sedang";
                                        } else {
                                            $ketkondisi_rumah = "Buruk";
                                        }

                                    ?>
                                    <form role="form" action="simpan_penilaian.php?ID_penilaian=<?php echo $ID_penilaian;?>" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>NAMA</label>
                                            <input class="form-control" type="text" name="nama" value="<?php echo $nama; ?>" disabled="true">
                                            <input type="number" name="nis" value="<?php echo $nis; ?>" hidden="true" >
                                        </div>
                                        <div class="form-group">
                                            <label>PENGHASILAN ORANG TUA (Rp)</label>
                                            <input class="form-control" type="number" name="penghasilan_ortu" value="<?php echo $penghasilan_ortu; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>JUMLAH SAUDARA KANDUNG</label>
                                            <input class="form-control" type="text" name="jml_sdrkandung" value="<?php echo $jml_sdrkandung; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>TANGGUNGAN ORANG TUA</label>
                                            <input class="form-control" type="text" name="tanggungan_ortu" value="<?php echo $tanggungan_ortu; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>NILAI RATA</label>
                                            <input class="form-control" type="number" name="nilai_rata" value="<?php echo $nilai_rata; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>JARAK RUMAH (km)</label>
                                            <input class="form-control" type="text" name="jarak" value="<?php echo $jarak; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>KONDISI RUMAH</label></br>
                                            <select name="kondisi_rumah">
                                                <option value="<?php echo $kondisi_rumah;?>"><?php echo $ketkondisi_rumah;?></option>
                                                    <?php
                                                    if ($kondisi_rumah == "1"){
                                                        echo "<option value='2'>Sedang</option>";
                                                        echo "<option value='3'>Buruk</option>";
                                                    }else if ($kondisi_rumah == "2") {
                                                        echo "<option value='1'>Baik</option>";
                                                        echo "<option value='3'>Buruk</option>";
                                                    }else{
                                                        echo "<option value='1'>Baik</option>";
                                                        echo "<option value='2'>Sedang</option>";
                                                    }
                                                    ?>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary">SIMPAN</button>
                                        <a href="daftar_penilaian.php" class='btn btn-primary'>BATAL</a>
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
