  <!--add in <td></td> style="vertical-align: middle;" only tdimg still empthy -->
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
          <i class="fa fa-edit"></i>
          <span>Épisodes</span>
        </li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
          <div class="col-sm-12">
              <div class="box box-warning" id="episodes-list">
                <div class="box-header with-border">
                  <h3 class="box-title">Géstion des épisodes</h3>
                  <button class="btn btn-success pull-right open-popup details" data-modal-target="#add-episode-form" type="button" data-target="<?= urlHtml('/admin/episodes/add'); ?>">Nouvelle épisode</button>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                  <div id="results"></div>
                  <table class="pag table table-responsive table-striped w-auto table-bordered table-sm table-condensed" cellspacing="0" width="100%">
                    <thead>
                      <tr class="row">
                          <th class="col-xs-1 col-sm-1">#</th>
                          <th class="col-xs-1 col-sm-1 hidden-xs">Image</th>
                          <th class="col-xs-4 col-sm-2">Titre</th>
                          <th class="col-xs-2 col-sm-2">Chapitre</th>
                          <th class="col-xs-1 col-sm-1">Commentaires</th>
                          <th class="col-xs-1 col-sm-1">Vues</th>
                          <th class="col-xs-1 col-sm-1">Statut</th>
                          <th class="col-xs-2 col-sm-1 hidden-xs">Crée</th>
                          <th class="col-xs-2 col-sm-2">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($episodes as $episode): ?>
                      <tr class="row">
                        <td class="col-xs-1 col-sm-1"><?= $episode->id; ?></td>

                        <td class="col-xs-1 col-sm-1 hidden-xs">
                          <img src="<?= assets('uploads/images/episodes/' . $episode->image); ?>">
                        </td>

                        <td class="col-xs-4 col-sm-2">
                          <strong><?= $episode->title;?></strong>
                        </td>

                        <td class="col-xs-2 col-sm-2"><?= $episode->chapter;?></td>

                        <td class="col-xs-1 col-sm-1 ">
                          <?php if ($episode->total_comments): ?>
                            <a class="btn btn-success" href="<?= urlHtml('admin/episodes/'. $episode->id . '/comments'); ?>">
                              <span class="hidden-sm"><span class="label label-info"><?= $episode->total_comments ?></span></span>
                              <span class="fa fa-comments"></span>
                            </a>
                            <?php else: ?>
                              <small><span class="label label-default">Vide</span></small>
                            <?php endif  ?>
                        </td>

                        <td class="col-xs-1 col-sm-1"><?= $episode->views;?></td>

                        <td class="col-xs-1 col-sm-1"><?= $episode->status;?></td>

                        <td class="col-xs-1 col-sm-1 hidden-xs"><?= date('d/m/Y', $episode->created);?></td>

                        <td class="col-xs-2 col-sm-2">
                          <div class="text-center">
                              <button class="btn btn-primary open-popup" type="button"  data-target="<?= urlHtml('/admin/episodes/edit/' . $episode->id); ?>" data-modal-target="#edit-episode-<?= $episode->id; ?>">
                                <span class="hidden-sm hidden-xs ">Modifer</span>
                                <span class="fa fa-pencil-alt"></span>
                              </button>

                              <button data-target="<?= urlHtml('/admin/episodes/delete/' . $episode->id); ?>" class="btn btn-danger delete">
                                <span class="hidden-sm hidden-xs">Supprimer</span>
                                <span class="fa fa-trash-alt"></span>
                              </button>
                          </div>
                        </td>

                      </tr>
                    <?php endforeach; ?>
                    </tbody>
                    <tfooter>             
                    </tfooter> 
                  </table>
                </div>
                
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                </div>
              </div>
          </div>
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->