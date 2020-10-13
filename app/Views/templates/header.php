<html lang="en"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title></title>
    <!-- Bootstrap core CSS -->
    <?php 
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);
echo link_tag('assets/css/style.css');
echo link_tag('assets/css/bootstrap.min.css');
echo link_tag('assets/css/sticky-footer-navbar.css');
echo link_tag('assets/css/dataTables.bootstrap4.min.css');
echo script_tag("assets/js/jquery-3.5.1.js");
?>

</head>
  <body>

    <header>
      <!-- Fixed navbar -->
      <nav class="navbar navbar-expand-md navbar-dark fixed-top heade-nav">
          <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="<?php echo base_url(); ?>">
                  <img border="0" src="<?php echo base_url('assets/img/logo-admin.jpg');?>">
                </a>
            </li>
          </ul>
          <h1 class="form-inline mt-2 mt-md-0 siteheader"> Lowy Inventory Management </h1>
          </div>
      </nav>
    </header>
     <!-- Begin page content -->
     <main role="main" class="container">
       <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
      <a class="nav-link active"  href="<?php echo base_url('adminShowAllFrames.action'); ?>">FRAME LIST</a>
    </li>
    <li class="nav-item">
      <a class="nav-link detail" href="<?php echo base_url('frameAdminView.action'); ?>">DETAILS</a>
    </li>
    <li class="nav-item">
      <a class="nav-link missingImages"  href="<?php echo base_url('imagesSyncNoImages.action'); ?>">MISSING IMAGES</a>
    </li>
    <li class="nav-item">
      <a class="nav-link categories"  href="<?php echo base_url('adminManageLookupablesView.action'); ?>">CATEGORIES</a>
    </li>
    <li class="nav-item">
      <a class="nav-link import"  href="<?php echo base_url('imagesSyncImport.action'); ?>">IMPORT</a>
    </li>
  </ul>
  <br>