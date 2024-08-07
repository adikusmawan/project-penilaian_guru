<?php

include "../koneksi.php";
include "alert/loadalert.php";

$Id_Usergroup_User      = $_POST["Id_Usergroup_User"];
$Username                       = $_POST["Username"];
$Password                       = $_POST["Password"];
$Password_Hash          = password_hash($Password, PASSWORD_DEFAULT);

if($add = mysqli_query($konek, "INSERT INTO user (Id_Usergroup_User, Username, Password) VALUES ('$Id_Usergroup_User', '$Username', '$Password_Hash')")){
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
                                window.location.replace('userpelanggan.php');
                                } ,1900); 
                        </script>
    ";
        exit();
}
die ("Terdapat Kesalahan : ". mysqli_error($konek));

?>