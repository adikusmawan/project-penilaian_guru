<?php

include "../koneksi.php";
include "alert/loadalert.php";
$id_guru = $_GET["id_guru"];

if($delete = mysqli_query ($conn, "DELETE FROM guru WHERE id_guru='$id_guru'")){
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
                                window.location.replace('guru.php');
                                } ,1900); 
                        </script>
	";
	exit();
}
die ("Terdapat Kesalahan : ".mysqli_error($conn));

?>