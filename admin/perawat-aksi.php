<?php
include "../koneksi.php";
include "alert/loadalert.php";
  
$kode_perawat = $_POST["kode_perawat"];
$nama_perawat = $_POST["nama_perawat"];
$alamat = $_POST["alamat"];
$no_telp = $_POST["no_telp"];  


if ($add = mysqli_query($konek, "INSERT INTO perawat (kode_perawat, nama_perawat, alamat, no_telp ) VALUES 
        ('$kode_perawat','$nama_perawat','$alamat','$no_telp' )")){
        echo " 
        <script>
                                setTimeout(function () {  
                                swal({
                                title: 'Sukses',
                                text:  'Data Berhasil Di Simpan!!',
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
die ("Terdapat kesalahan : ". mysqli_error($konek));

?>