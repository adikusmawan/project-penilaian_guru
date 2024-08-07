<?php

include "../koneksi.php";
include "alert/loadalert.php";

$id_kriteria                    = $_POST["id_kriteria"];
$nama_kriteria                  = $_POST["nama_kriteria"];
$bobot                          = $_POST["bobot"];                      

if($edit = mysqli_query($conn, "UPDATE kriteria SET nama_kriteria='$nama_kriteria', bobot='$bobot' 
    WHERE id_kriteria='$id_kriteria'")){
 
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
                                window.location.replace('kriteria.php');
                                } ,1900); 
                        </script>
    ";
    exit();
}

die ("Terdapat Kesalahan : ". mysqli_error($conn));

?>
