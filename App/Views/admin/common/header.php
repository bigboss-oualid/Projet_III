<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?=  $title; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  </style>
  <!--Pagination-->
  <link rel="stylesheet" href="<?= assets('admin/plugins/datatables/1.10.2/css/jquery.dataTables.min.css'); ?>">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?= assets('admin/bootstrap/css/bootstrap.min.css'); ?>">
  <!-- Font Awesome -->
  <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js" integrity="sha384-0pzryjIRos8mFBWMzSSZApWtPl/5++eIfzYmTgBBmXYdhvxPc+XcFEk+zJwDgWbP" crossorigin="anonymous"></script>
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
    <link rel="stylesheet" href="<?= assets('admin/dist/css/AdminLTE.css'); ?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?= assets('admin/dist/css/skins/_all-skins.css'); ?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= assets('admin/plugins/iCheck/flat/blue.css'); ?>">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?= assets('admin/plugins/datepicker/datepicker3.css'); ?>">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?= assets('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'); ?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js">
  </script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js">
  </script>
  <![endif]-->
</head>
<body class=" hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <div class="navbar navbar-fixed-top">
    <header class="main-header ">
      <!-- Logo -->
      <a href="<?= urlHtml('/'); ?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><span class="fa fa-blog text-center"></span></span>
        <!-- logo for regular state and mobile devices -->
        <span class="row logo-lg"></span ><span class="col-md-1"><i class="fa fa-arrow-alt-circle-left"></i></span><span class="col-md-6 "><b>Blog</b>Panel</span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button data-toogle="push-menu"-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <i class="fa fa-bars"></i>
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- Messages: style can be found in dropdown.less-->

            <!-- Notifications: style can be found in dropdown.less -->


            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="<?= assets('uploads/images/users/' . $user->image); ?>" class="user-image" alt="<?= $user->first_name . ' ' . $user->last_name; ?>" title="">
                <span class="hidden-xs">
                  <?= $user->first_name . ' ' . $user->last_name; ?>
                </span>
              </a>
               <ul class="dropdown-menu">
                <li>
                  <a href="<?= urlHtml('/admin/profile'); ?>" class="btn btn-default">
                    <span class="fa fa-user"></span>
                    Profil
                  </a>
                </li>
                <li>
                  <a href="<?= urlHtml('/admin/logout'); ?>" class="btn btn-default">
                    <span class="fa fa-power-off"></span>
                    Déconnexion
                  </a>
                </li>
              </ul>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header hidden-xs">
                  <img src="<?= assets('uploads/images/users/' . $user->image); ?>"  class="img-circle" alt="<?= $user->first_name . ' ' . $user->last_name; ?>" title="<?= $user->last_name; ?>">
                  <p><b>
                    <?= $user->last_name . '</b> ' . $user->first_name; ?> - <?= $user->user_group ?> 
                    <small>Membre depuis <?= date('d/m/Y', $user->created); ?></small>
                  </p>
                </li>
                <!-- Menu Body -->
                <li class="user-body">
                  <div class="row">

                    <div class="col-xs-6 text-center">
                      <form action="<?= urlHtml('/'); ?>">
                        <button class="btn btn-warning">
                          <span class="fa fa-blog"></span>
                          Blog
                        </button>
                      </form>
                    </div>

                    <div class="col-xs-6 text-center">
                      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#user-profile">
                        <span class="fa fa-user"></span>
                        Profil
                      </button>
                    </div>

                  </div>
                  <!-- /.row -->
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  
                  <!-- Logout -->
                  <div class="text-center">
                    <form action="<?= urlHtml('/admin/logout'); ?>">
                        <button class="btn btn-danger" ><span class="fa fa-power-off"></span> Déconnexion</button>
                    </form>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header>
  </div>