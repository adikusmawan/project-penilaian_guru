<?php

include "../koneksi.php";
include "alert/loadalert.php";
 
$username                       = $_POST["username"];
$password                       = $_POST["password"];
$role                       = $_POST["role"];

if($add = mysqli_query($conn, "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')")){
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
                                window.location.replace('user.php');
                                } ,1900); 
                        </script>
    ";
        exit();
}
die ("Terdapat Kesalahan : ". mysqli_error($conn));

?>