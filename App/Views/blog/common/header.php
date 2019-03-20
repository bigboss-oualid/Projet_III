<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?= $title; ?></title>

    <link href="<?= assets('blog/css/intlTelInput.min.css');?>" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="<?= assets('blog/css/bootstrap.min.css');?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= assets('blog/css/font-awesome.min.css');?>" />
    <!-- Animate CSS -->
    <link rel="stylesheet" href="<?= assets('blog/css/animate.css');?>" />
    <!-- Custom Style -->
    <link rel="stylesheet" href="<?= assets('blog/css/style.css');?>" />
    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <!-- Header -->
    <header>
        <nav class="navbar">
          <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="<?= urlHtml('/'); ?>">
                Jean Forteroche <br/>
              </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <li class="active">
                    <a href="<?= urlHtml('/'); ?>">Home</a>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Chapitres<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <?php foreach ($chapters as $chapter) { ?>
                    <li>
                        <a href="<?= urlHtml('chapter/' . seo($chapter->name) . '/' . $chapter->id); ?>"><?= $chapter->name; ?></a>
                    </li>
                    <?php } ?>
                  </ul>
                </li>
                <li>
                    <a href="<?= urlHtml('/about-me'); ?>">Qui suis-je?</a>
                </li>
                <li>
                    <a href="<?= urlHtml('/contact-me'); ?>">Contactez-moi</a>
                </li>
              </ul>
              <ul class="nav navbar-nav navbar-right">
                <?php if ($user) { ?>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle user-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    <img src="<?= assets('uploads/images/users/' . $user->image); ?>" alt="<?= $user->first_name . ' ' . $user->last_name; ?>" title="<?= $user->first_name . ' ' . $user->last_name;?>" class="user-image" />
                    <?= $user->first_name; ?>
                    <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu">
                    <li>
                        <a href="<?= urlHtml('/profile') ?>">Mon profil</a>
                        <a href="<?= urlHtml('/profile/episodes') ?>">Mes commentaires</a>
                        <a href="<?= urlHtml('/logout') ?>">Logout</a>
                    </li>
                  </ul>
                </li>
                <?php } else { ?>
                    <li><a href="<?= urlHtml('/login'); ?>">Connexion</a></li>
                    <li><a href="<?= urlHtml('/register'); ?>">S'inscrire</a></li>
                <?php } ?>
              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
    </header>
    <!--/ Header -->
    <!-- Content -->
    <div id="content">
