<?php

include "../koneksi.php";
include "alert/loadalert.php";

$kode_perawat = $_POST["kode_perawat"];
$nama_perawat = $_POST["nama_perawat"];
$alamat = $_POST["alamat"];
$no_telp = $_POST["no_telp"];                      

if($edit = mysqli_query($konek, "UPDATE perawat SET nama_perawat='$nama_perawat', alamat='$alamat', no_telp='$no_telp' 
    WHERE kode_perawat='$kode_perawat'")){
 
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
                                window.location.replace('perawat.php');
                                } ,1900); 
                        </script>
    ";
    exit();
}

die ("Terdapat Kesalahan : ". mysqli_error($konek));

?>
