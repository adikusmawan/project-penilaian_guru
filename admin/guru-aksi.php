<?php

include "../koneksi.php";
include "alert/loadalert.php";
 
$nama_guru                       = $_POST["nama_guru"];
$alamat                       = $_POST["alamat"];
$no_telepon                           = $_POST["no_telepon"];

if($add = mysqli_query($conn, "INSERT INTO guru (nama_guru, alamat, no_telepon) VALUES ('$nama_guru', '$alamat', '$no_telepon')")){
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
                                window.location.replace('guru.php');
                                } ,1900); 
                        </script>
    ";
        exit();
}
die ("Terdapat Kesalahan : ". mysqli_error($conn));

?>