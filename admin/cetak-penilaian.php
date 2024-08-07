<?php
include "../vendor/autoload.php";
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4',]);

ob_start();
?>

<!DOCTYPE html>
<html>
<head>
    <style type='text/css'>
        body { font-family: Times New Roman; font-size: 12px; }
        header, footer { text-align: center; padding: 3px 0; background: #FFFFFF; color: #000000; }
        header { border-bottom: 2px solid #FFFFFF; }
        footer { border-top: 2px solid #FFFFFF; font-size: 10px; text-align: right;}
        .main-wrapper { padding: 10px; }
        .table { border-collapse: collapse; width: 100%; margin-bottom: 20px; }
        .table th, .table td { border: 1px solid #e1edff; padding: 7px 17px; }
        .table th { background-color: #508abb; color: #FFFFFF; text-transform: uppercase; }
        .table tbody tr:nth-child(odd) td { background-color: #f4fbff; }
        .table tbody tr:hover td { background-color: #ffffa2; }
        .separator { border-bottom: 2px solid #363636; margin: 20px 0; }
        .pos { position: absolute; z-index: 0; left: 9px; top: 0px }
    </style>
</head>
<body>

<header>
    <h2>PEMERINTAH PROVINSI SUMATERA UTARA</h2>
    <h3>DINAS PENDIDIKAN DAN KEBUDAYAAN</h3>
    <h3>SMK SWASTA PABAKU STABAT</h3>
    <p>JL. Pringgondani, No. 813, Karang Rejo, Stabat, Langkat, Sumatera Utara, 20851, Indonesia</p>
    <p>Telp. /Fax (0512) 26048, Email: smkswastapabakustabat@gmail.com</p>
</header>
<div class="separator"></div>
<div class="main-wrapper">
    <h4 style="text-align: center;">LAPORAN PENILAIAN GURU</h4>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Guru</th>
                <th>Nama Kriteria</th>
                <th>Nilai</th>
                <th>Periode</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include "../koneksi.php";
            $queryPenilaian = mysqli_query($conn, "SELECT g.nama_guru, k.nama_kriteria, p.nilai, pe.nama_periode
                                                  FROM penilaian p
                                                  JOIN guru g ON p.id_guru = g.id_guru
                                                  JOIN kriteria k ON p.id_kriteria = k.id_kriteria
                                                  JOIN periode pe ON p.id_periode = pe.id_periode");
            if ($queryPenilaian == false) {
                die("Terjadi Kesalahan: " . mysqli_error($conn));
            }
            $no = 1;
            while ($penilaian = mysqli_fetch_array($queryPenilaian)) {
                echo "<tr>
                        <td>$no</td>
                        <td>{$penilaian['nama_guru']}</td>
                        <td>{$penilaian['nama_kriteria']}</td>
                        <td>{$penilaian['nilai']}</td>
                        <td>{$penilaian['nama_periode']}</td>
                      </tr>";
                $no++;
            }
            ?>
        </tbody>
    </table>
</div>

<footer>
    <p>Bati-bati, <?php echo date('d F Y'); ?></p>
    <p>Kepala Sekolah</p>
    <br><br><br>
    <p><b>Sutiyo, S.Pd</b></p>
    <p><b>NIP. 19720701 199702 1002</b></p>
</footer>

</body>
</html>

<?php
$html = ob_get_contents();
ob_end_clean();
$mpdf->WriteHTML($html);
$mpdf->Output('laporan_penilaian_guru.pdf', 'I');
?>
