<?php include"header.php"; ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">DAFTAR CALON PENERIMA BEASISWA</h1>
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

            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                          <h3>Periode <?php echo $periode; ?></h3>
                        </div>
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <?php
                                     $nama_siswa = "";
                                     if(isset($_POST["nama_siswa"]))
                                        $nama_siswa = $_POST["nama_siswa"];
                                        
                                     $sql = "select * from siswa where nama like '%".$nama_siswa."%' and periode = '$periode' order by nis asc";

                                     $hasil = mysqli_query($kon, $sql);
                                     if (!$hasil)
                                        die("Gagal query..".mysqli_error($kon));
                                 ?>
                                <thead>
                                    <tr>
                                        <th>NIS</th>
                                        <th>NAMA</th>
                                        <th>ALAMAT</th>
                                        <th>TEMPAT LAHIR</th>
                                        <th>TANGGAL LAHIR</th>
                                        <th>JENIS KELAMIN</th>
                                        <th>NO TELP</th>
                                        <th>PERIODE</th>
                                        <th>OPERASI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $no = 0;
                                        while ($row = mysqli_fetch_assoc($hasil)) {
                                             echo " <tr> ";
                                             echo "  <td> ".$row['nis']." </td> " ;
                                             echo "  <td> ".$row['nama']." </td> " ;
                                             echo "  <td> ".$row['alamat']." </td> " ;
                                             echo "  <td> ".$row['tempat_lahir']." </td> " ;
                                             echo "  <td> ".$row['tgl_lahir']." </td> " ;
                                                if ($row['jenis_kelamin'] == 'L') {
                                                    $jenis_kelamin = "Laki-laki";
                                                }else{
                                                    $jenis_kelamin = "Perempuan";
                                                }
                                             echo "  <td> ".$jenis_kelamin." </td> " ;
                                             echo "  <td> ".$row['no_telepon']." </td> " ;
                                             echo "  <td> ".$row['periode']." </td> " ;
                                             echo "<td align='center'>
                                                <a href='edit_siswa.php?nis=".$row['nis']."' class='btn fa fa-edit'></a>";

                                             if ($row['status'] == "S") {
                                                 echo "<a disabled='true'><i class='btn fa fa-trash'></i></a>";
                                             } else {
                                                 echo "<a data-toggle='modal' data-target='#".$row['nis']."' ><i class='btn fa fa-trash'></i></a>";
                                             }

                                             echo "</td>";
                                            echo " </tr> ";

                                        }
                                    ?>
                                </tbody>
                            </table>
                            <br>
                            <a href="input_siswa.php" class='btn btn-primary'>TAMBAH</a>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <?php
              }
            ?>

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <?php 
        $sql = "select * from siswa";

                                 $hasil = mysqli_query($kon, $sql);
                                 if (!$hasil)
                                    die("Gagal query..".mysqli_error($kon));
                                while ($row = mysqli_fetch_assoc($hasil)) {
    ?>
    <div class="modal fade" id="<?php echo $row['nis']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">HAPUS SISWA</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            Apakah anda yakin untuk menghapus siswa <?php echo $row['nama'];?> ??
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
            <?php
              echo "<a href='hapus_siswa.php?nis=".$row['nis']."&hapus=1' class='btn btn-primary'>Hapus</a>";
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
