<?php

include "../koneksi.php";
include "alert/loadalert.php";
 
$nama_kriteria                       = $_POST["nama_kriteria"];
$bobot                       = $_POST["bobot"]; 

if($add = mysqli_query($conn, "INSERT INTO kriteria (nama_kriteria, bobot) VALUES ('$nama_kriteria', '$bobot')")){
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
                                window.location.replace('kriteria.php');
                                } ,1900); 
                        </script>
    ";
        exit();
}
die ("Terdapat Kesalahan : ". mysqli_error($conn));

?>