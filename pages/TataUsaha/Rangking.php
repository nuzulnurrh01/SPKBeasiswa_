<?php include "header.php"; ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">RANGKING CALON PENERIMA BEASISWA</h1>
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
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <?php
                                     $nis = "";
                                     if(isset($_POST["nis"]))
                                        $nis = $_POST["nis"];

                                     $sql = "select a.nis, a.nama, a.periode, b.hasil
                                        from siswa a,penilaian b
                                        where a.nis=b.nis and a.periode='$periode' order by hasil desc";

                                     $hasil = mysqli_query($kon, $sql);
                                     if (!$hasil)
                                        die("Gagal query..".mysqli_error($kon));
                                ?>
                                <thead>
                                    <tr>
                                        <th>N0</th>
                                        <th>NIS</th>
                                        <th>NAMA</th>
                                        <th>HASIL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                       $no = 1;
                                       while ($row = mysqli_fetch_assoc($hasil)) {
                                         echo " <tr> ";
                                         echo "  <td> ".$no." </td> " ;
                                         echo "  <td> ".$row['nis']." </td> " ;
                                         echo "  <td> ".$row['nama']." </td> " ;
                                         echo "  <td> ".$row['hasil']." </td> " ;
                                         echo " </tr> ";
                                         $no++; 
                                        }
                                    ?>
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>
        <!-- /#page-wrapper -->

        <?php
            }
        ?>
    </div>
    <!-- /#wrapper -->
    <?php 
        $sql = "select s.nama,p.ID_penilaian 
                from siswa s,penilaian p
                where s.nis=p.nis";
        $hasil = mysqli_query($kon, $sql);
        if (!$hasil)
            die("Gagal query..".mysqli_error($kon));
        while ($row = mysqli_fetch_assoc($hasil)) {
    ?>
    <div class="modal fade" id="<?php echo $row['ID_penilaian']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">HAPUS PENILAIAN</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            Apakah anda yakin untuk data penilaian siswa bernama <?php echo $row['nama'];?> ??
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
            <?php
              echo "<a href='hapus_penilaian.php?ID_penilaian=".$row['ID_penilaian']."&hapus=1' class='btn btn-primary'>Hapus</a>";
            ?>
          </div>
        </div>
      </div>
    </div>
    <?php 
        }
    ?>

    <!-- jQuery -->
    <script src="../../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../../vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../../dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>

</body>

</html>

