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
          <i class="fa fa-mail-bulk"></i>
          <span>Boites aux lettres</span>
        </li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
          <div class="col-sm-12">
              <div class="box box-info" id="contacts-list">
                <div class="box-header with-border">
                  <h3 class="box-title">Géstion des contacts</h3>
                </div>

                <!-- /.box-header -->
                <div class="box-body table-responsive">
                  <div id="results"></div>
                  <table class="pag table table-striped w-auto table-bordered table-sm table-condensed" cellspacing="0" width="100%">
                    <thead>
                      <tr class="row">
                          <th class="col-sm-1 col-xs-1">#</th>
                          <th class="col-sm-1 col-xs-2">Utilisateur</th>
                          <th class="col-sm-2 col-xs-2">Sujet</th>
                          <th class="col-sm-1 col-xs-1">Téléphone</th>
                          <th class="col-sm-1 hidden-xs">email</th>
                          <th class="col-sm-1 hidden-xs">Crée</th>
                          <th class="col-sm-3 col-xs-3">Répondu par</th>
                          <th class="col-sm-2 col-xs-3">Action</th>
                      </tr>
                    <thead>
                    <tbody>
                      <?php foreach ($contacts as $contact): ?>
                      <tr class="row <?= ($contact->reply)? null : 'success'; ?>">
                        <td class="col-sm-1 col-xs-1"><?= $contact->id; ?></td>
                        <td class="col-sm-1 col-xs-2">
                          <strong><?= $contact->name ?></strong>
                        </td>
                        <td class="col-sm-2 col-xs-2"><?= $contact->subject;?></td>
                        <td class="col-sm-1 col-xs-1"><?= $contact->phone;?></td>
                        <td class="col-sm-1 hidden-xs"><?= $contact->email;?></td>
                        <td class="col-sm-1 hidden-xs"><?= date('d/m/Y', $contact->created);?></td>
                        <td class="col-sm-3 col-xs-3"><h4><?= ($contact->reply)?   '<span class="label label-primary"><b>'.$contact->first_name.'</b></span>' :'_';?></h4></td>
                        <td class="col-sm-2 col-xs-3">
                          <div class="text-center">
                            <?php if ($contact->reply): ?>
                              <button class="btn btn-info open-popup" type="button"  data-target="<?= urlHtml('/admin/contacts/reply/' . $contact->id); ?>" data-modal-target="#reply-contact-<?= $contact->id; ?>">
                                <span class="hidden-sm hidden-xs "> Afficher</span>
                                <span class="fa fa-envelope-open-text"></span>
                              </button>                            
                            <?php else: ?>
                              <button class="btn btn-success open-popup" type="button"  data-target="<?= urlHtml('/admin/contacts/reply/' . $contact->id); ?>" data-modal-target="#reply-contact-<?= $contact->id; ?>">
                                <span class="hidden-sm hidden-xs "> Répondre</span>
                                <span class="glyphicon glyphicon-send"></span>
                              </button>
                            <?php endif ?>
                              <?php if ($users_group_id == 1): ?>
                              <button data-target="<?= urlHtml('/admin/contacts/disabled/' . $contact->id); ?>" class="btn btn-danger delete">
                                <span class="hidden-sm hidden-xs ">Retirer</span>
                                <span class="fa fa-calendar-times"></span>
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
