<?php

include "../koneksi.php";
include "alert/loadalert.php";

$id_guru = $_POST["id_guru"];
$nama_guru                       = $_POST["nama_guru"];
$alamat                       = $_POST["alamat"];
$no_telepon                           = $_POST["no_telepon"];                      

if($edit = mysqli_query($conn, "UPDATE guru SET nama_guru='$nama_guru', alamat='$alamat', no_telepon='$no_telepon' 
    WHERE id_guru='$id_guru'")){
 
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
                                window.location.replace('guru.php');
                                } ,1900); 
                        </script>
    ";
    exit();
}

die ("Terdapat Kesalahan : ". mysqli_error($conn));

?>
