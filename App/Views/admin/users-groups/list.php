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
          <i class="fa fa-users"></i>
          <span>Groupe des utilisateurs</span>
        </li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
          <div class="col-sm-12">
              <div class="box box-primary" id="users-list">
                <div class="box-header with-border">
                  <h3 class="box-title">Géstion des groupes des utilisateurs</h3>
                  <button class="btn btn-success pull-right open-popup" data-modal-target="#add-users-group-form" type="button" data-target="<?= urlHtml('/admin/users-groups/add'); ?>">Nouveau groupe</button>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                  <div id="results"></div>
                  <table class="pag table table-striped w-auto table-bordered table-sm table-condensed" cellspacing="0" width="100%">
                    <thead>
                      <tr class="row">
                          <th class="col-xs-1">#</th>
                          <th class="col-xs-9">Nom de la groupe</th>
                          <th class="col-xs-2">Action</th>
                      </tr>
                    <thead>
                    <tbody>
                    <?php foreach ($users_groups as $users_group): ?>
                      <tr class="row">
                        <td class="col-xs-1"><?= $users_group->id; ?></td>
                        <td class="col-xs-9">
                          <h3>
                            <?php if ($users_group->id == 1): ?><span class="label label-default"><?php endif ?>
                              <?= ucfirst($users_group->name);?>
                            <?php if ($users_group->id != 1): ?></span><?php endif ?>
                          </h3>
                        </td>
                        <td class="col-xs-2">
                          <div class="text-center">
                            <?php if ($users_group->id != 1): ?>
                            <button class="btn btn-primary open-popup" type="button"  data-target="<?= urlHtml('/admin/users-groups/edit/' . $users_group->id); ?>" data-modal-target="#edit-users-group-<?= $users_group->id; ?>">
                              <span class="hidden-sm hidden-xs ">Modifer</span>
                              <span class="fa fa-pencil-alt"></span>
                            </button>
                            
                            <button data-target="<?= urlHtml('/admin/users-groups/delete/' . $users_group->id); ?>" class=" btn btn-danger delete">
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
