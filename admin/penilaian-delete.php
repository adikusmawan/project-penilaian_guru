<?php

include "../koneksi.php";
include "alert/loadalert.php";
$id_penilaian = $_GET["id_penilaian"];

if($delete = mysqli_query ($conn, "DELETE FROM penilaian WHERE id_penilaian='$id_penilaian'")){
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
                                window.location.replace('penilaian.php');
                                } ,1900); 
                        </script>
	";
	exit();
}
die ("Terdapat Kesalahan : ".mysqli_error($conn));

?>