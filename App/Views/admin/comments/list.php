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
          <span>Commentaires</span>
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
              <h3 class="box-title">Géstion <?= (isset($episode))? ' des commentaires de l\'épisode  "<b>'. $episode->title . '"</b>  dans le chapitre  <b>"' . $episode->chapter.'".</b>' :'des commentaires du Blog' ; ?> 
              </h3>
              <button class="btn btn-success pull-right open-popup details" data-modal-target="#add-comment-form" type="button" data-target="<?= urlHtml('/admin/comments/add'); ?>">Nouveau commentaire
              </button>
            </div>
                <!-- /.box-header -->
            <div class="box-body table-responsive">
              <div class="col-xs-12" id="results"></div>
              <div class="container panel">
              <?php if (isset($message)): ?>
                <div class="btn-toolbar pull-left">
                    <a href="<?= urlHtml('/admin/episodes/all-reported-comments'); ?>" class="btn btn-danger btn-lg">
                      <span><?=  $message; ?></span>
                    </a>
                    <button data-target="<?= $delete_reported; ?>" class="btn btn-danger delete">
                      <span class="hidden-sm hidden-xs">Supprimer tous les signalés</span>
                      <span class="fa fa-trash-alt"></span>
                    </button>
                  </div>
                <?php endif ?>
                <?php if (isset($warning)): ?>
                  <div class="btn-toolbar pull-right">
                    <button data-target="<?= $delete_disabled; ?>" class="btn btn-warning delete">
                      <span class="hidden-sm hidden-xs">Supprimer tous les non validé</span>
                      <span class="fa fa-trash-alt"></span>
                    </button>
                    <a href="<?= urlHtml('/admin/episodes/all-disabled-comments'); ?>" class="btn btn-warning btn-lg">
                      <span><?=  $warning; ?></span>
                    </a>
                  </div>
              <?php endif ?>
              </div>            
              <table class="pag table table-striped w-auto table-bordered table-sm table-condensed" cellspacing="0" width="100%">
                <thead>
                  <tr class="row">
                      <th class="col-xs-1 col-sm-1 hidden-sm hidden-xs">#</th>
                      <th class="col-xs-1 col-sm-1">Utilisateur</th>
                      <th class="col-xs-4 col-sm-4">Commentaires</th>
                      <th class="col-xs-1 col-sm-2">Épisode/chapitre</th>
                      <th class="col-xs-1 col-sm-1 hidden-sm hidden-xs">Crée</th>
                      <th class="col-xs-1 col-sm-1">Status</th>
                      <th class="col-xs-4 col-sm-2">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $id = 1; foreach ($comments as $comment): ?>
                  <tr class="<?= ($comment->status === 'Désactivé')? 'warning' : null;  ?> <?= ($comment->reported > 0)? 'danger' : null;  ?> row">
                    <td class="col-xs-1 col-sm-1 hidden-sm hidden-xs"><?= $id++; ?></td>

                    <?php if ($comment->first_name): ?>
                    <td class="col-xs-4 col-sm-1">
                      <strong><?= $comment->first_name . ' ' . $comment->last_name;?></strong>
                    </td>                          
                    <?php else: ?>
                    <td class="col-xs-4 col-sm-1">
                      <strong>Visiteur</strong>
                    </td>
                    <?php endif ?>                

                    <td class="col-xs-1 col-sm-4"><?= html_entity_decode(read_more($comment->comment, 20));?></td>

                    <td class="col-xs-1 col-sm-2"><?= $comment->episode . '/' . $comment->chapter;?></td>

                    <td class="col-xs-1 col-sm-1 hidden-sm hidden-xs"><?= date('d/m/Y', $comment->created);?></td>
                    <td class="col-sm-1 col-xs-1"><?= $comment->status;?></td>
                    <td class="col-xs-4 col-sm-2">
                      <div class="text-center">

                          <button class="btn btn-primary open-popup" type="button"  data-target="<?= urlHtml('/admin/comments/edit/' . $comment->id); ?>" data-modal-target="#edit-comment-<?= $comment->id; ?>">
                            <span class="hidden-sm hidden-xs ">Modifer</span>
                            <span class="fa fa-pencil-alt"></span>
                          </button>

                          <button data-target="<?= urlHtml('/admin/comments/delete/' . $comment->id); ?>" class="btn btn-danger  delete">
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
              <?php if (isset($empty)): ?>
              <div class="jumbotron">
                <div class="container ">
                  <p><?=  $empty; ?></p>
                  <p class="col-sm-4"><a href="<?= urlHtml('/admin/episodes'); ?>" class="btn btn-info btn-lg" role="button"><span class="fa fa-arrow-alt-circle-left"></span>  Retourner aux épisodes</a></p>
                </div>
              </div>
              <?php endif ?>
            </div>
          </div>
        </div>
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->