<?php

include "../koneksi.php";
include "alert/loadalert.php";
$id_periode = $_GET["id_periode"];

if($delete = mysqli_query ($conn, "DELETE FROM periode WHERE id_periode='$id_periode'")){
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
                                window.location.replace('periode.php');
                                } ,1900); 
                        </script>
	";
	exit();
}
die ("Terdapat Kesalahan : ".mysqli_error($conn));

?>