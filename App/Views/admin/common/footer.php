  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.2.0
    </div>
    <strong>Copyright &copy; 2019 <a href="../http://www.google.com">BigBoss</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- user's profile -->
<div class="modal fade" id="user-profile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Mise à jour du profil</h4>
      </div>
      <div class="modal-body">
          <form class="form-modal form" action="<?= urlHtml('/admin/profile/update'); ?>">
            <div id="form-results"></div>
            
            <div  class="message-input form-group col-sm-6">
              <label for="first_name">Prénom</label>
              <input type="text" class="form-control" name="first_name" id="first_name" value="<?= $user->first_name; ?>" placeholder="Nom"/>
            </div>

            <div  class="message-input form-group col-sm-6">
              <label for="last_name">Nom</label>
              <input type="text" class="form-control" name="last_name" id="last_name" value="<?= $user->last_name; ?>" placeholder="Prénom"/>
            </div>

            <div class="form-group col-sm-6 ">
              <label for="gender">sexe</label>
              <select class="form-control" id="gender" name="gender">
                  <option value="homme">Homme </option>
                  <option value="femme" <?= $user->gender == 'femme' ? 'selected' : false; ?> >Femme</option>
              </select>
            </div>

            <div class="message-input form-group col-sm-6">
              <label  for="birthday">Date de naissance</label>
              <input type="text" class="datepicker form-control" data-date-end-date="0d" data-date-format="dd/mm/yyyy" name="birthday" id="birthday" placeholder="Date de naissance" value="<?= date('d/m/Y', $user->birthday); ?>"/>
            </div>

            <div class="message-input form-group col-sm-12">
              <label for="email">Email</label>
              <input type="email" class="form-control" name="email" id="email" value="<?= $user->email; ?>" placeholder="Email"/>
            </div>

            <div class="message-input form-group col-sm-6">
              <label for="password">Mot de passe</label>
              <input data-placement="bottom" title="enter un nouveau mot de passe, si vous souhaitez le changer" data-toggle="tooltip" type="password" class="form-control" name="password" id="password" placeholder="Mot de passe"/>
            </div>

            <div class="message-input form-group col-sm-6">
              <label  for="confirm_password">Confirmation de mot de passe</label>
              <input data-placement="bottom" title="retaper votre nouveau mot de passe, si vous souhaitez le changer" data-toggle="tooltip" type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Mot de passe"/>
            </div>
            
            <div class="clearfix"></div>

            <div class="message-input form-group col-sm-6 ">
              <label  for="image">Image</label>
              <input type="file" name="image" />
            </div>
            <?php if ($user->image) { ?>
              <div class=" form-group col-sm-6 ">
                <img src="<?= assets('uploads/images/users/' . $user->image); ?>" style="width:50px; height: 50px;"/>
              </div>
            <?php }  ?>
            <div class="clearfix"></div>
            <br/>
            <button class=" btn btn-success submit-btn">Modifier</button>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>
</body>


<!-- jQuery 2.2.0 -->
<script src="<?= assets('admin/plugins/jQuery/jQuery-2.2.0.min.js'); ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- datepicker -->
<script src="<?= assets('admin/plugins/datepicker/bootstrap-datepicker.js'); ?>"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?= assets('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'); ?>"></script>
<!-- AdminLTE App -->
<script src="<?= assets('admin/dist/js/app.min.js'); ?>"></script>
<!--CKEditor WYSIWYG -->
<script src="<?php echo assets('admin/plugins/ckeditor/ckeditor.js'); ?>"></script>

<!--Pagination -->
<script type="text/javascript" src=" <?= assets('admin/plugins/datatables/1.10.2/js/jquery.dataTables.min.js')?>"></script>

<script type="text/javascript" src=" <?= assets('admin/plugins/datatables/1.10.2/bootstrap/bootstrap.min.js')?>"></script>
<!-- Custom JS -->
<script src="<?= assets('admin/dist/js/custom.js'); ?>"></script>

</html>
