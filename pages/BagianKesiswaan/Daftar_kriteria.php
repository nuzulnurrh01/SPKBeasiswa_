<?php include "header.php"; ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">DAFTAR KRITERIA</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <?php
                                 $nama_kriteria = "";
                                 if(isset($_POST["nama_kriteria"]))
                                    $nama_kriteria = $_POST["nama_kriteria"];
                                    
                                 include "../koneksi.php";
                                 $sql = "select * from kriteria";

                                 $hasil = mysqli_query($kon, $sql);
                                 if (!$hasil)
                                    die("Gagal query..".mysqli_error($kon));
                                ?>
                                <thead>
                                    <tr>
                                        <th>ID KRITERIA</th>
                                        <th>NAMA KRITERIA</th>
                                        <th>JENIS KRITERIA</th>
                                        <th>BOBOT</th>
                                        <th>OPERASI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                       $no = 0;
                                       while ($row = mysqli_fetch_assoc($hasil)) {
                                         echo " <tr> ";
                                         echo "  <td> ".$row['ID_kriteria']." </td> " ;
                                         echo "  <td> ".$row['nama_kriteria']." </td> " ;
                                         echo "  <td> ".$row['jenis_kriteria']." </td> " ;
                                         echo "  <td> ".$row['bobot']." </td> " ;
                                         echo "<td align='center'>
                                                <a href='edit_kriteria.php?ID_kriteria=".$row['ID_kriteria']."' class='btn fa fa-edit'></a>
                                                </td>";
                                        echo " </tr> ";
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
            <!-- /.row -->
            <div class="row">
            </div>
            <!-- /.row -->
            <div class="row">
            </div>
            <!-- /.row -->
            <div class="row">
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <?php 
        $sql = "select * from kriteria";

                                 $hasil = mysqli_query($kon, $sql);
                                 if (!$hasil)
                                    die("Gagal query..".mysqli_error($kon));
                                while ($row = mysqli_fetch_assoc($hasil)) {
    ?>
    <div class="modal fade" id="<?php echo $row['ID_kriteria']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">HAPUS KRITERIA</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            Apakah anda yakin untuk menghapus kriteria <?php echo $row['nama_kriteria']; ?> ??
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
            <?php
              echo "<a href='hapus_kriteria.php?ID_kriteria=".$row['ID_kriteria']."&hapus=1' class='btn btn-primary'>Hapus</a>";
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
    })
    </script>

</body>

</html>
