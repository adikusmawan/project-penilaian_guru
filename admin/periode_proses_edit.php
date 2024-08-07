<?php

include "../koneksi.php";
include "alert/loadalert.php";

$id_periode                    = $_POST["id_periode"];
$nama_periode                       = $_POST["nama_periode"];
$tanggal_mulai                       = $_POST["tanggal_mulai"]; 
$tanggal_selesai                       = $_POST["tanggal_selesai"];                     

if($edit = mysqli_query($conn, "UPDATE periode SET nama_periode='$nama_periode', tanggal_mulai='$tanggal_mulai', tanggal_selesai='$tanggal_selesai'
    WHERE id_periode='$id_periode'")){
 
    echo " 
    <script>
                                setTimeout(function () {  
                                swal({
                                title: 'Sukses',
                                text:  'Data Berhasil Di Edit',
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
