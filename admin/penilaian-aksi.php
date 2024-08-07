
<?php
session_start();
include "../koneksi.php";
include "alert/loadalert.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_guru = $_POST['guru'];
    $id_periode = $_POST['periode'];
    $nilai_kriteria = $_POST['nilai'];

    foreach ($nilai_kriteria as $id_kriteria => $nilai) {
        // Sanitize inputs
        $id_guru = mysqli_real_escape_string($conn, $id_guru);
        $id_periode = mysqli_real_escape_string($conn, $id_periode);
        $id_kriteria = mysqli_real_escape_string($conn, $id_kriteria);
        $nilai = mysqli_real_escape_string($conn, $nilai);

        // Insert or update nilai guru
        $sql = "INSERT INTO penilaian (id_guru, id_kriteria, id_periode, nilai) 
                VALUES ('$id_guru', '$id_kriteria', '$id_periode', '$nilai')
                ON DUPLICATE KEY UPDATE nilai = '$nilai'";

        if ($conn->query($sql) !== TRUE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    echo " 
    <script>
                                setTimeout(function () {  
                                swal({
                                title: 'Sukses',
                                text:  'Data Berhasil Di Tambah',
                                type: 'success',
                                timer: 1500,
                                showConfirmButton: true
                                });  
                                },50); 
                                window.setTimeout(function(){ 
                                window.location.replace('penilaian.php');
                                } ,1900); 
                        </script>
    ";
}
?>
