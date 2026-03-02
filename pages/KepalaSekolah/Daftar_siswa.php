<?php include "header.php"; ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">DAFTAR CALON PENERIMA BEASISWA</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form action="#" method="post">
                        <label>Periode</label>
                        <select name="periode" required>
                            <option value="">= Tahun =</option>
                            <?php
                            for ($i = 2016; $i <= date('Y'); $i++) {
                                echo "<option value='$i'>$i</option>";
                            }
                            ?>
                        </select>
                        <input type="submit" name="lihat" value="Lihat">
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php
include "../koneksi.php";
if (isset($_POST['lihat'])) {
    $periode = $_POST['periode'];
?>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Periode <?php echo $periode; ?></h3>
                </div>
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <?php
                        $sql = "SELECT * FROM siswa 
                                WHERE periode = '$periode' 
                                ORDER BY nis ASC";
                        $hasil = mysqli_query($kon, $sql);
                        if (!$hasil) {
                            die("Gagal query.." . mysqli_error($kon));
                        }
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
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($hasil)) {
                                $jk = ($row['jenis_kelamin'] == 'L') ? 'Laki-laki' : 'Perempuan';
                                echo "<tr>";
                                echo "<td>{$row['nis']}</td>";
                                echo "<td>{$row['nama']}</td>";
                                echo "<td>{$row['alamat']}</td>";
                                echo "<td>{$row['tempat_lahir']}</td>";
                                echo "<td>{$row['tgl_lahir']}</td>";
                                echo "<td>$jk</td>";
                                echo "<td>{$row['no_telepon']}</td>";
                                echo "<td>{$row['periode']}</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php } ?>

</div>

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

<script>
$(document).ready(function () {
    $('#dataTables-example').DataTable({
        responsive: true
    });
});
</script>

</body>
</html>
