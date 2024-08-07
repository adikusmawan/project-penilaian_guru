<?php

include "../koneksi.php";
include "alert/loadalert.php";
$id_kriteria = $_GET["id_kriteria"];

if($delete = mysqli_query ($conn, "DELETE FROM kriteria WHERE id_kriteria='$id_kriteria'")){
	echo " 
	<script>
                                setTimeout(function () {  
                                swal({
                                title: 'Sukses',
                                text:  'Data Berhasil Di Hapus!!',
                                type: 'success',
                                timer: 1900,
                                showConfirmButton: true
                                });  
                                },90); 
                                window.setTimeout(function(){ 
                                window.location.replace('kriteria.php');
                                } ,1900); 
                        </script>
	";
	exit();
}
die ("Terdapat Kesalahan : ".mysqli_error($conn));

?>