<?php 
    include 'koneksi.php';
 ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>ECV</title>

    <!-- core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/owl.carousel.min.css" rel="stylesheet">
    <link href="css/icomoon.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="images/logounlamHD.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head>
<!--/head-->


<body>

    <header id="header">
        <div class="top-bar">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-xs-12">
                        <div class="top-number">
                            <p><i class="fa fa-whatsapp"></i> +6285246192624</p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-12">
                        <div class="social">
                            <ul class="social-share">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                <li><a href="#"><i class="fa fa-google"></i></a></li>
                                <li><a href="#"><i class="fa fa-whatsapp"></i></a></li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
            <!--/.container-->
        </div>
        <!--/.top-bar-->

        <nav class="navbar navbar-inverse" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                   <a class="navbar-brand" href="index.php"><img src="images/logounlam.jpg" alt="logo"></a>
                </div>

                <div class="collapse navbar-collapse navbar-right">
                    <ul class="nav navbar-nav">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="certificate.php">E - Certificate</a></li>
                        <li class="active"><a href="verification.php">Verification</a></li>
                        <li><a href="404.php">Tutorial</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">About <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="portfolio.php">Profil</a></li>
                                <li><a href="contact-us.php">Contact</a></li>
                            </ul>
                        </li>
                        <li><a href="http://himadefebunlam.blogspot.com" target='_blank'>Blog</a></li>
                        <li><a href="login.php">Login</a></li>

                       <!-- <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Login <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="blog-item.html">Registrasi</a></li>
                                <li><a href="pricing.html">Login</a></li>
                            </ul>
                        </li>-->

                    </ul>
                </div>
            </div>
            <!--/.container-->
        </nav>
        <!--/nav-->
    </header>
    <!--/header-->
    
    <div class="page-title" style="background-image: url(images/bgunlam1.jpg)">
        <h1>Verification</h1>
    </div>

    <section id="about-us">
        <div class="container">
            <div class="row">

                <div class="col-md-13">
                    <div class="about-content">
                        <h2>Verification</h2>

                     <form action="" method="post">
                        <div class="panel-footer">

 <?php
                    $sql=mysqli_query($konek, "SELECT * FROM peserta WHERE no_sertifikat='$_POST[no_sertifikat]'");
                    $d=mysqli_fetch_array($sql);

                    if(mysqli_num_rows($sql) < 1){
                        ?>
                        <div class="alert alert-danger">
                            <center>
                            <strong>Maaf, Data tidak ditemukan..!</strong><br>
                            <i>Silahkan menghubungi Admin yang terkait untuk menanyakan masalah ini.</i>
                            </center>
                        </div>
                        <?php
                    }else{
                    ?>
                    <table  border="0">
                        <h3><span class="fa fa-check-circle"></span><b> Your certificate is valid.</b></h3>
                        <tr>
                            <th>Verification Number<td>:</td><td><?php echo $d['no_sertifikat']; ?></td></th>
                        </tr>

                        <tr>
                            <th><h3><span class="fa fa-address-card"></span><b> Participant Profile.</b></h3></th>
                        </tr>

                        <tr>
                            <th>Full Name<td>:</td><td><?php echo $d['nama_lengkap']; ?></td></th>
                        </tr>

                        <tr>
                            <th><h3><span class="fa fa-cube"></span><b> Programme.</b></h3></th>
                        </tr>

                        <tr>
                            <th>Keterangan<td>:</td><td><?php echo $d['kategori_seminar']; ?></td></th>
                        </tr>

                        <tr>
                            <th>Status<td>:</td><td><?php echo $d['status']; ?></td></th>
                        </tr>

                        <tr>
                            <th>Jabatan<td>:</td><td><?php echo $d['jabatan']; ?></td></th>
                        </tr>

                        <tr>
                            <th>Date<td>:</td><td><?php echo $d['tgl']; ?></td></th>
                        </tr>
                            <th><a href="cetak.php?id=<?php echo $d['id']; ?>" class="btn btn-primary fa fa-download" target="_blank"> Download</a></th>
                        </tr>
                    </table>
                    <?php } ?>
                </div>
                <br><br>
                    <center><a class="btn btn-danger" href="verification.php">Kembali</a></center>

                                </div>
    </section>


        
    <!--/#middle-->
            <section id="bottom">
        <div class="container fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
            <div class="row">
                <div class="col-md-2">
                    <a href="#" class="footer-logo">
                        <img src="images/cropped-unlam-bjm.png" alt="logo">
                    </a>
                </div>
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-3 col-sm-6">
                            <div class="widget">
                                <h3>Developers</h3>
                                <ul>
                                    <li><a href="#">Web Development</a></li>
                                    <li><a href="#">SEO Marketing</a></li>
                                    <li><a href="#">Theme</a></li>
                                    <li><a href="#">Development</a></li>
                                </ul>
                            </div>
                        </div>
                        <!--/.col-md-3-->
                        <!--/.col-md-3-->

                        <!--/.col-md-3-->
                    </div>
                </div>


            </div>
        </div>
    </section>
<?php 
    include 'footer.php';
 ?>
    <!--/#footer-->


    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>
                