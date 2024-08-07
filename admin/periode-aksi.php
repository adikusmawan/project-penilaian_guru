<?php

include "../koneksi.php";
include "alert/loadalert.php";
 
$nama_periode                       = $_POST["nama_periode"];
$tanggal_mulai                       = $_POST["tanggal_mulai"]; 
$tanggal_selesai                       = $_POST["tanggal_selesai"];

if($add = mysqli_query($conn, "INSERT INTO periode (nama_periode, tanggal_mulai, tanggal_selesai) VALUES ('$nama_periode', '$tanggal_mulai', '$tanggal_selesai')")){
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
                                window.location.replace('periode.php');
                                } ,1900); 
                        </script>
    ";
        exit();
}
die ("Terdapat Kesalahan : ". mysqli_error($conn));

?>