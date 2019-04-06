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
          <i class="fa fa-list-ol"></i>
          <span>Chapitres</span>
        </li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
          <div class="col-sm-12">
              <div class="box box-success" id="users-list">
                <div class="box-header with-border">
                  <h3 class="box-title">Géstion des chapitres</h3>
                  <button class="btn btn-success pull-right open-popup" data-modal-target="#add-chapter-form" type="button" data-target="<?= urlHtml('/admin/chapters/add'); ?>">Nouveau chapitre</button>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <div id="results"></div>
                  <table class="pag table table table-hover table-hover table-striped w-auto table-bordered table-sm table-condensed" cellspacing="0" width="100%">

                    <thead>
                      <tr class="row info">
                          <th class="col-xs-1">#</th>
                          <th class="col-xs-5">Nom du chapitre</th>
                          <th class="col-xs-3">Statut</th>
                          <th class="col-xs-3">Action</th>
                      </tr>
                    </thead>

                    <tbody>
                    <?php foreach ($chapters as $chapter): ?>
                      <tr class="row">
                        <td class="col-xs-1"><?= $chapter->id; ?></td>
                        <td class="col-xs-5"><?= $chapter->name;?></td>
                        <td class="col-xs-3"><?= $chapter->status;?></td>
                        <td class="col-xs-3">
                          <div class="text-center">
                            <button class="btn btn-primary open-popup " type="button"  data-target="<?= urlHtml('/admin/chapters/edit/' . $chapter->id); ?>" data-modal-target="#edit-chapter-<?= $chapter->id; ?>">
                              <span class="hidden-sm hidden-xs ">Modifer</span>
                              <span class="fa fa-pencil-alt"></span>
                            </button>
                            <button data-target="<?= urlHtml('/admin/chapters/delete/' . $chapter->id); ?>" class=" btn btn-danger delete">
                              <span class="hidden-sm hidden-xs ">Supprimer</span>
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