<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | Corlate</title>
	
	<!-- core CSS -->
    <link href="<?php echo base_url();?>assets/dashboard/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/dashboard/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/dashboard/css/animate.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/dashboard/css/prettyPhoto.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/dashboard/css/main.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/dashboard/css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url();?>assets/dashboard/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url();?>assets/dashboard/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url();?>assets/dashboard/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo base_url();?>assets/dashboard/images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->
<body class="homepage">

    <header id="header">
        <div class="top-bar">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-xs-4">
                        <div class="top-number"><p><i class="fa fa-phone-square"></i>  +6281 31581 9727</p></div>
                    </div>
                    <div class="col-sm-6 col-xs-8">
                       <div class="social">
                            <div class="search">
                                <form role="form">
                                    <input type="text" class="search-form" autocomplete="off" placeholder="Search">
                                    <i class="fa fa-search"></i>
                                </form>
                           </div>
                       </div>
                    </div>
                </div>
            </div><!--/.container-->
        </div><!--/.top-bar-->

        <nav class="navbar navbar-inverse" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html"><img src="<?php echo base_url();?>assets/dashboard/images/logo.png" alt=""></a>
                </div>
				
                <div class="collapse navbar-collapse navbar-right">
                    <ul class="nav navbar-nav">
                        <li class=""><a href="<?php echo base_url('Pemakaman'); ?>">Beranda</a></li>
                        <li><a href="<?php echo base_url('Pemakaman/tentang_kami'); ?>">Tentang Kami</a></li>
                        <li><a href="<?php echo base_url('Pemakaman/layanan'); ?>">Pelayanan & Fasilitas</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pemakaman </a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo base_url('Pemakaman/pendaftaran'); ?>">Pendaftaran makam</a></li>
                                <li><a href="<?php echo base_url('Pemakaman/login_perpanjang'); ?>">Perpanjang makam</a></li>
                                <li><a href="<?php echo base_url('Pemakaman/pemesanan'); ?>">Info Pemesanan</a></li>
                                <li><a href="<?php echo base_url('Pemakaman/makam'); ?>">Makam 3D</a></li>
                            </ul>
                        </li>
                        <li><a href="<?php echo base_url('pemakaman/kontak'); ?>">Kontak</a></li>                        
                    </ul>
                </div>
            </div><!--/.container-->
        </nav><!--/nav-->
		
    </header><!--/header-->