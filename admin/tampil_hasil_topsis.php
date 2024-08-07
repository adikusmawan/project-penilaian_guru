<?php
session_start();
include '../koneksi.php';  

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id_periode'])) {
    $id_periode = $_GET['id_periode'];

    // Ambil data hasil TOPSIS untuk periode yang dipilih
    $hasil_topsis_query = "SELECT h.id_guru, g.nama_guru, h.nilai_topsis 
                           FROM hasil_topsis h
                           JOIN guru g ON h.id_guru = g.id_guru
                           WHERE h.id_periode = '$id_periode'
                           ORDER BY h.nilai_topsis DESC";
    $hasil_topsis_result = $conn->query($hasil_topsis_query);
} else {
    die("Invalid request.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hasil TOPSIS</title>
</head>
<body>
    <h2>Hasil TOPSIS Periode <?php echo $id_periode; ?></h2>
    <table border="1">
        <tr>
            <th>Nama Guru</th>
            <th>Nilai TOPSIS</th>
        </tr>
        <?php while($row = $hasil_topsis_result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['nama_guru']; ?></td>
            <td><?php echo $row['nilai_topsis']; ?></td>
        </tr>
        <?php } ?>
    </table>
    <br>
    <a href="hasil_topsis.php">Kembali</a>
</body>
</html>

