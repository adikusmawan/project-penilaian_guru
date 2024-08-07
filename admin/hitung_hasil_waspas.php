<?php
include '../koneksi.php'; 
include "alert/loadalert.php";

function get_penilaian($conn, $id_periode) {
    $sql = "SELECT p.id_guru, p.id_kriteria, p.nilai, k.bobot 
            FROM penilaian p 
            JOIN kriteria k ON p.id_kriteria = k.id_kriteria 
            WHERE p.id_periode = '$id_periode'";
    $result = $conn->query($sql);
    $penilaian = [];
    while ($row = $result->fetch_assoc()) {
        $penilaian[] = $row;
    }
    return $penilaian;
}

function get_kriteria($conn) {
    $sql = "SELECT id_kriteria, bobot FROM kriteria";
    $result = $conn->query($sql);
    $kriteria = [];
    while ($row = $result->fetch_assoc()) {
        $kriteria[$row['id_kriteria']] = $row['bobot'];
    }
    return $kriteria;
}

function hitung_waspas($penilaian, $kriteria) {
    $norm_matriks = [];
    foreach ($penilaian as $nilai) {
        $id_guru = $nilai['id_guru'];
        $id_kriteria = $nilai['id_kriteria'];
        if (!isset($norm_matriks[$id_guru])) {
            $norm_matriks[$id_guru] = [];
        }
        $norm_matriks[$id_guru][$id_kriteria] = $nilai['nilai'] / max(array_column($penilaian, 'nilai', 'id_kriteria'));
    }

    $weighted_matriks = [];
    foreach ($norm_matriks as $id_guru => $nilai) {
        foreach ($nilai as $id_kriteria => $v) {
            if (!isset($weighted_matriks[$id_guru])) {
                $weighted_matriks[$id_guru] = [];
            }
            $weighted_matriks[$id_guru][$id_kriteria] = $v * $kriteria[$id_kriteria];
        }
    }

    $sums = [];
    $products = [];
    foreach ($weighted_matriks as $id_guru => $nilai) {
        $sums[$id_guru] = array_sum($nilai);
        $products[$id_guru] = array_product($nilai);
    }

    $waspas_score = [];
    foreach ($sums as $id_guru => $sum) {
        $product = $products[$id_guru];
        $waspas_score[$id_guru] = 0.5 * $sum + 0.5 * $product;
    }

    return $waspas_score;
}

function simpan_hasil_waspas($conn, $id_periode, $waspas_score) {
    foreach ($waspas_score as $id_guru => $nilai_waspas) {
        $sql = "INSERT INTO hasil_waspas (id_guru, id_periode, nilai_waspas) 
                VALUES ('$id_guru', '$id_periode', '$nilai_waspas') 
                ON DUPLICATE KEY UPDATE nilai_waspas = '$nilai_waspas'";
        if ($conn->query($sql) !== TRUE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_periode'])) {
    $id_periode = $_POST['id_periode'];

    $penilaian = get_penilaian($conn, $id_periode);
    $kriteria = get_kriteria($conn);

    $waspas_score = hitung_waspas($penilaian, $kriteria);
    simpan_hasil_waspas($conn, $id_periode, $waspas_score);

    echo " 
    <script>
                                setTimeout(function () {  
                                swal({
                                title: 'Sukses',
                                text:  'Hasil WASPAS berhasil dihitung dan disimpan.',
                                type: 'success',
                                timer: 1500,
                                showConfirmButton: true
                                });  
                                },50); 
                                window.setTimeout(function(){ 
                                window.location.replace('hasil_waspas.php');
                                } ,1900); 
                        </script>
    ";
} else {
    die("Invalid request.");
}
?>

 
    
