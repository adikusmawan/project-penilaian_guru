<?php

include "../koneksi.php";
include "alert/loadalert.php";
$kode_perawat = $_GET["kode_perawat"];

if($delete = mysqli_query ($konek, "DELETE FROM perawat WHERE kode_perawat='$kode_perawat'")){
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
                                window.location.replace('perawat.php');
                                } ,1900); 
                        </script>
	";
	exit();
}
die ("Terdapat Kesalahan : ".mysqli_error($konek));

?>