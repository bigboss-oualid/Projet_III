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
          <i class="fa fa-user"></i>
          <span>Utilisateurs</span>
        </li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
          <div class="col-sm-12">
              <div class="box box-info" id="users-list">
                <div class="box-header with-border">
                  <h3 class="box-title">Géstion des utilisateurs</h3>
                  <button class="btn btn-success pull-right open-popup" data-modal-target="#add-user-form" type="button" data-target="<?= urlHtml('/admin/users/add'); ?>">Nouveau utilisateur</button>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                  <div id="results"></div>
                  <table class="pag table table-striped w-auto table-bordered table-sm table-condensed" cellspacing="0" width="100%">
                    <thead>
                      <tr class="row">
                          <th class="col-sm-1 col-xs-1">#</th>
                          <th class="col-sm-1 col-xs-1 hidden-sm hidden-xs">Image</th>
                          <th class="col-sm-1 col-xs-1">Nom</th>
                          <th class="col-sm-2 col-xs-2">Groupe</th>
                          <th class="col-sm-1 col-xs-1">Statut</th>
                          <th class="col-sm-1 col-xs-1 hidden-sm hidden-xs">Ajouté</th>
                          <th class="col-sm-3 col-xs-3">Email</th>
                          <th class="col-sm-2 col-xs-2">Action</th>
                      </tr>
                    <thead>
                    <tbody>
                    <?php foreach ($users as $user): ?>
                      <tr class="row">
                        <td class="col-sm-1 col-xs-1"><?= $user->id; ?></td>
                        <td class="col-sm-1 col-xs-1 hidden-sm hidden-xs">
                          <img src="<?= assets('uploads/images/users/' . $user->image); ?>" >
                        </td>
                        <td class="col-sm-1 col-xs-1">
                          <strong><?= $user->last_name . " " . $user->first_name;?></strong>
                        </td>
                        <td class="col-sm-2 col-xs-2"><?= $user->group;?></td>
                        <td class="col-sm-1 col-xs-1"><?= $user->status;?></td>
                        <td class="col-sm-1 col-xs-1 hidden-sm hidden-xs"><?= date('d/m/Y', $user->created);?></td>
                        <td class="col-sm-3 col-xs-3"><?= $user->email;?></td>
                        <td class="col-sm-2 col-xs-1 ">
                          <div class="text-center">
                            <button class="btn btn-primary open-popup" type="button"  data-target="<?= urlHtml('/admin/users/edit/' . $user->id); ?>" data-modal-target="#edit-user-<?= $user->id; ?>">
                              <span class="hidden-sm hidden-xs ">Modifer</span>
                              <span class="fa fa-pencil-alt"></span>
                            </button>
                            <?php if ($user->id != 1): ?>
                              <button data-target="<?= urlHtml('/admin/users/delete/' . $user->id); ?>" class="btn btn-danger delete">
                                <span class="hidden-sm hidden-xs ">Supprimer</span>
                                <span class="fa fa-trash-alt"></span>
                              </button>
                            <?php endif ?>
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
              </div>
          </div>
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
