  <!-- /.content-wrapper -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tableau de bord
        <small>Panneau de contrôle</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= urlHtml('/admin'); ?>"><i class="fa fa-tachometer-alt"></i> Tableau de borad</a></li>
        <li class="active">
          <i class="fa fa-cogs"></i>
          <span>Paramétrage</span>
        </li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
          <div class="col-sm-12">
              <div class="box box-danger" id="ads-list">
                <div class="box-header with-border">
                  <h3 class="box-title">
                    <span class="fa fa-cogs"></span>
                    Paramétrage
                  </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form action="<?= $action; ?>" method="post">
                        <?php if ($errors):  ?>
                            <div id="form-results" class="alert alert-danger">
                                <?= $errors;?>
                            </div>
                        <?php endif ?>
                        <?php if ($success):  ?>
                            <div id="form-results" class="alert alert-success">
                                <?= $success;?>
                            </div>
                        <?php endif ?>
                        <div class="form-group col-sm-12">
                          <label for="site_name">Nom du site</label>
                          <input type="text" class="form-control" name="site_name" id="site_name" value="<?= $site_name; ?>" placeholder="Site Name">
                        </div>
                        <div class="form-group col-sm-12">
                          <label for="site_email">E-mail du site</label>
                          <input type="email" class="form-control" name="site_email" id="site_email" value="<?= $site_email; ?>" placeholder="Site E-Mail">
                        </div>

                        <div class="form-group col-sm-6 col-sx-12">
                          <label for="comments_status">Commentaires entrés par les visiteurs</label>
                          <select class="form-control" id="comments_status" name="comments_status">
                              <option value="Activé">Activé </option>
                              <option value="Désactivé" <?= $comments_status == 'Désactivé' ? 'selected': false; ?>>Désactivé</option>
                          </select>
                        </div>

                        <div class="form-group col-sm-6 col-sx-12">
                          <label for="episodes_in_home">Nombre des épisodes afficher à la page d'acceuil</label>
                          <select class="form-control" id="episodes_in_home" name="episodes_in_home">
                            <?php for ($i=1; $i < $total_episodes ; $i++):?> 
                            <option value="<?= $i;?>" <?= $episodes_in_home == $i ? 'selected': false; ?>><?= $i;?></option>
                            <?php endfor ?>
                            <option value="<?= $total_episodes?>" <?= $episodes_in_home == $total_episodes ? 'selected': false; ?>>Toutes</option>
                          </select>
                        </div>

                        <div class="form-group col-sm-12">
                          <label for="site_status">État du site</label>
                          <select class="form-control" id="site_status" name="site_status">
                              <option value="Activé">Activé </option>
                              <option value="Désactivé" <?= $site_status == 'Désactivé' ? 'selected': false; ?>>Désactivé</option>
                          </select>
                        </div>
                        <div class="form-group col-sm-12">
                          <label for="site_close_msg">Message de fermeture du site</label>
                          <textarea name="site_close_msg"  id="site_close_msg" class="tinyeditor"><?= $site_close_msg;?></textarea>
                        </div>
                          <button class="btn btn-info">Sauvgarder</button>
                    </form>
                </div>
                <!-- /.box-body -->
              </div>
          </div>
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->