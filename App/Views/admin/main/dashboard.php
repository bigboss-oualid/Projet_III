  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tableau de bord
        <small>Panneau de contrôle</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= urlhtml('/admin'); ?>"><i class="fa fa-tachometer-alt"></i> Dashboard</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
          <div class="col-sm-12">
              <div class="box box-danger" id="episodes-list">
                <div class="box-header with-border">
                  <h3 class="box-title">Dashboard</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body text-center">
                  <div class="jumbotron">
                      <div class="container ">
                        <h1 class="text-center">Bienvenue <?= $first_name; ?> </h1>
                        <?php if ((!empty($permissions['contacts'])) || (!empty($permissions['comments']))): ?>
                          <?php if ($disabled_comments || $new_contacts || $reported_comments): ?>
                          <p  class = "news-dash"><span class="fa fa-exclamation"></span></p>
                          <?php else: ?>
                          <p><span class="label label-success">Vous avez rien de nouveau</span></p>
                          <?php endif ?>
                                                 
                          <?php if ($disabled_comments && (!empty($permissions['comments']))): ?>
                          <p class="col-xs-12">
                            <a href="<?= urlHtml('/admin/episodes/all-disabled-comments'); ?>" class="btn btn-warning btn-lg" role="button">
                              <span><?=  $warning; ?></span>
                              <span class="fa fa-comment-medical"></span>
                               </a>
                          </p>
                          <?php endif ?>                        
                        
                          <?php if($new_contacts && (!empty($permissions['contacts']))): ?>
                          <p class="col-xs-12">
                            <a href="<?= urlHtml('/admin/contacts'); ?>" class="btn btn-success btn-lg" role="button">
                              <span><?= $news; ?></span>
                              <span class="fa fa-file-signature"></span>
                            </a>
                          </p>
                          <?php endif ?>

                          <?php if($reported_comments && (!empty($permissions['comments']))): ?>
                          <p class="col-xs-12">
                            <a href="<?= urlHtml('/admin/episodes/all-reported-comments'); ?>" class="btn btn-danger btn-lg" role="button">
                              <span><?=  $message; ?></span>
                              <span class="fa fa-comment-slash"></span></a>
                          </p>
                          <?php endif ?>
                        
                      <?php endif ?>
                      </div>
                    </div>
                </div>
                <!-- /.box-body -->
              </div>
          </div>
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->