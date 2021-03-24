



<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>KSS Admin</title>
     <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo URLROOT ?>/public/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo URLROOT ?>/public/assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo URLROOT ?>/public/assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo URLROOT ?>/public/assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo URLROOT ?>/public/assets/bower_components/datatables.net/css/select.dataTables.min.css">
  <link rel="stylesheet" href="<?php echo URLROOT ?>/public/assets/bower_components/datatables.net/css/datatables.mark.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo URLROOT ?>/public/assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo URLROOT ?>/public/assets/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="<?php echo URLROOT ?>/public/assets/dist/css/customModalStyle.css">
  <style>
 

 .has-error
 {
  border-color:#cc0000;
  background-color:#ffff99;
 }
 .has-success
 {
  border-color:lightskyblue;
  background-color:azure;
 }
 </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-blue sidebar-mini ">
    <div class="wrapper">

   <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo URLROOT; ?>/administrator/index" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>ORACC</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-bell-o"></i>
              <span class="label label-success" id="notification_count2"></span>
            </a>
            <ul class="dropdown-menu">
           
            <li class="header">You have <span class="badge bg-green" id="notification_count"></span > new solution notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu" id="notifications">

                </ul>
              </li>
              <li class="footer"><a href="#">See All Notifications</a></li>
            </ul>
          </li>
        
         
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              
              <span class="hidden-xs"><?php echo $data['username']; ?> </span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
               

                <p>
                <?php echo $data['username']; ?>
                  <small><?php echo $data['email']; ?></small>
                </p>
              </li>
              <!-- Menu Body -->
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="#" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>