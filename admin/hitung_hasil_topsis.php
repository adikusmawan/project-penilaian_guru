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

function hitung_topsis($penilaian, $kriteria) {
    $norm_matriks = [];
    foreach ($penilaian as $nilai) {
        $id_guru = $nilai['id_guru'];
        $id_kriteria = $nilai['id_kriteria'];
        if (!isset($norm_matriks[$id_guru])) {
            $norm_matriks[$id_guru] = [];
        }
        $norm_matriks[$id_guru][$id_kriteria] = $nilai['nilai'] / sqrt(array_sum(array_map(function($n) use ($id_kriteria) {
            return pow($n['nilai'], 2);
        }, array_filter($penilaian, function($n) use ($id_kriteria) {
            return $n['id_kriteria'] == $id_kriteria;
        }))));
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

    $ideal_positive = [];
    $ideal_negative = [];
    foreach ($kriteria as $id_kriteria => $bobot) {
        $values = array_column($weighted_matriks, $id_kriteria);
        if (!empty($values)) {
            $ideal_positive[$id_kriteria] = max($values);
            $ideal_negative[$id_kriteria] = min($values);
        }
    }

    $distance_positive = [];
    $distance_negative = [];
    foreach ($weighted_matriks as $id_guru => $nilai) {
        $distance_positive[$id_guru] = sqrt(array_sum(array_map(function($k) use ($ideal_positive, $nilai) {
            return isset($ideal_positive[$k]) ? pow($ideal_positive[$k] - $nilai[$k], 2) : 0;
        }, array_keys($nilai))));
        
        $distance_negative[$id_guru] = sqrt(array_sum(array_map(function($k) use ($ideal_negative, $nilai) {
            return isset($ideal_negative[$k]) ? pow($ideal_negative[$k] - $nilai[$k], 2) : 0;
        }, array_keys($nilai))));
    }

    $topsis_score = [];
    foreach ($distance_positive as $id_guru => $distance_p) {
        $distance_n = $distance_negative[$id_guru];
        $topsis_score[$id_guru] = ($distance_p + $distance_n) != 0 ? $distance_n / ($distance_p + $distance_n) : 0;
    }

    return $topsis_score;
}

function simpan_hasil_topsis($conn, $id_periode, $topsis_score) {
    foreach ($topsis_score as $id_guru => $nilai_topsis) {
        $sql = "INSERT INTO hasil_topsis (id_guru, id_periode, nilai_topsis) 
                VALUES ('$id_guru', '$id_periode', '$nilai_topsis') 
                ON DUPLICATE KEY UPDATE nilai_topsis = '$nilai_topsis'";
        if ($conn->query($sql) !== TRUE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_periode'])) {
    $id_periode = $_POST['id_periode'];

    $penilaian = get_penilaian($conn, $id_periode);
    $kriteria = get_kriteria($conn);

    $topsis_score = hitung_topsis($penilaian, $kriteria);
    simpan_hasil_topsis($conn, $id_periode, $topsis_score);
 
    echo " 
    <script>
                                setTimeout(function () {  
                                swal({
                                title: 'Sukses',
                                text:  'Hasil TOPSIS berhasil dihitung dan disimpan.',
                                type: 'success',
                                timer: 1500,
                                showConfirmButton: true
                                });  
                                },50); 
                                window.setTimeout(function(){ 
                                window.location.replace('hasil_topsis.php');
                                } ,1900); 
                        </script>
    ";
} else {
    die("Invalid request.");
}
?>
