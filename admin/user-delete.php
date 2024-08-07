<?php

include "../koneksi.php";
include "alert/loadalert.php";
$id_user = $_GET["id_user"];

if($delete = mysqli_query ($conn, "DELETE FROM users WHERE id_user='$id_user'")){
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
                                window.location.replace('user.php');
                                } ,1900); 
                        </script>
	";
	exit();
}
die ("Terdapat Kesalahan : ".mysqli_error($conn));

?>