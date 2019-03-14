<?php //pre($contacts); ?>
<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <ul class="sidebar-menu">
        <li class="header text-center administration"><h4>Administration</h4></li>

        <li id="dashboard-link" class="sidebar-link">
          <a href="<?= urlHtml('/admin'); ?>">
            <i class="fa fa-tachometer-alt"></i>
            <span>Panneau de contrôle</span>
          </a>
        </li>
        
        <?php if (!empty($contacts)): ?>
        <li id="contacts-link" class="sidebar-link">
          <a href="<?= urlHtml('/admin/contacts'); ?>">
            <i class="fa fa-mail-bulk"></i>
            <span>Boites aux lettres
            <?php if (!empty($number_of_new_letters)): ?>
             <span class="label label-success"> <?= $number_of_new_letters; ?> </span>
            <?php endif?> 
            </span>
          </a>
        </li>
        <?php endif ?>

        <?php if (!empty($chapters)): ?>
        <li id="chapters-link" class="sidebar-link">
          <a href="<?= urlHtml('/admin/chapters'); ?>">
            <i class="fa fa-list-ol"></i>
            <span>Chapitres</span>
          </a>
        </li>
        <?php endif ?>

        <?php if (!empty($episodes)): ?>
        <li id="episodes-link" class="sidebar-link">
          <a href="<?= urlHtml('/admin/episodes'); ?>">
            <i class="fa fa-edit"></i>
            <span>Épisodes</span>
          </a>
        </li>
        <?php endif ?>

        <?php if (!empty($comments)): ?>
        <li id="comments-link" class="sidebar-link">
          <a class="dropdown-toggle" data-toggle="dropdown" href="<?= urlHtml('/admin/episodes/comments'); ?>">
            <i class="fa fa-comment-dots"></i>
            <span>Commentaires</span>
            <ul class="dropdown-menu col-xs-12" role="menu" aria-labelledby="dLabel">
            <li>
              <a href="<?= urlHtml('/admin/episodes/comments');?>">
                <i class="fa fa-comments"></i>
                <span> Tous</span>
              </a>
            </li>
            <li>
              <a href="<?= urlHtml('/admin/episodes/all-reported-comments');?>">
                <i class="fa fa-bug "></i>
                <span> Signalés</span>
              </a>
            </li>
            <li>
              <a href="<?= urlHtml('/admin/episodes/all-disabled-comments');?>">
                <i class="fa fa-comment-slash"></i>
                <span> En attente</span>
              </a>
            </li>
          </ul>
        </li>
        <?php endif ?>
        
        <?php if (!empty($users)): ?>
        <li id="users-link" class="sidebar-link">
          <a href="<?= urlHtml('/admin/users'); ?>">
            <i class="fa fa-user-tie"></i>
            <span>Utilisateurs</span>
          </a>
        </li>
        <?php endif ?>

        <?php if (!empty($users_groups)): ?>
        <li id="users-groups-link" class="sidebar-link">
          <a href="<?= urlHtml('/admin/users-groups'); ?>">
            <i class="fa fa-users"></i>
            <span>Groupe des utilisateurs</span>
          </a>
        </li>
        <?php endif ?>

        <?php if (!empty($settings)): ?>
        <li id="settings-link" class="sidebar-link">
          <a href="<?= urlHtml('/admin/settings'); ?>">
            <i class="fa fa-tools "></i>
            <span>Réglages</span>
          </a>
        </li>
        <?php endif ?>
        <hr>
        <li class="sidebar-link">
          <a href="" data-toggle="modal" data-target="#user-profile">
            <i style="color:green" class="fa fa-user-circle "></i>
            <span style="color:green"><b>Profil</b></span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
