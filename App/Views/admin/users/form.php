<div class="modal fade" id="<?= $target; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?= $heading;?></h4>
      </div>
      <div class="modal-body">
          <form class="form-modal form" action="<?= $action; ?>">
            <div id="form-results"></div>
            
            <div  class="message-input form-group col-sm-6">
              <label for="first_name">Prénom</label>
              <input type="text" class="form-control" name="first_name" id="first_name" value="<?= $first_name; ?>" placeholder="Nom"/>
            </div>

            <div  class="message-input form-group col-sm-6">
              <label for="last_name">Nom</label>
              <input type="text" class="form-control" name="last_name" id="last_name" value="<?= $last_name; ?>" placeholder="Prénom"/>
            </div>

            <div class="message-input form-group col-sm-12">
              <label for="email">Email</label>
              <input type="email" class="form-control" name="email" id="email" value="<?= $email; ?>" placeholder="Email"/>
            </div>
            <div class="form-group col-sm-6">
              <label for="users_group_id">Groupe</label>
              <select name="users_group_id" id="users_group_id" class="form-control">
                <?php foreach ($users_groups as $users_group): ?>
                  <option value="<?=  $users_group->id ?>" <?= $users_group->id == $users_group_id ? 'selected' : false;  ?>><?=  $users_group->name; ?></option>
                  <?php if ($id == 1) break;?>  
                <?php endforeach; ?>
              </select>
            </div>

            <div class="form-group col-sm-6 ">
              <label for="status">Statut</label>
              <select class="form-control" id="status" name="status">
                  <option value="Activé">Activé </option>
                  <?php if ($id != 1) :?>
                  <option value="Désactivé" <?= $status == 'Désactivé' ? 'selected' : false; ?> >Désactivé</option>
                  <?php endif ?>
              </select>
            </div>

            <div class="form-group col-sm-6 ">
              <label for="gender">sexe</label>
              <select class="form-control" id="gender" name="gender">
                  <option value="homme">Homme </option>
                  <option value="femme" <?= ($gender == 'femme') ? 'selected' : false; ?> >Femme</option>
              </select>
            </div>

            <div class="message-input form-group col-sm-6">
              <label  for="birthday">Date de naissance</label>
              <input type="text" class="datepicker form-control" data-date-end-date="0d" data-date-format="dd/mm/yyyy" name="birthday" id="birthday" placeholder="DD/MM/YYYY" value="<?= $birthday; ?>"/>
            </div>

            <div class="message-input form-group col-sm-6">
              <label for="password">Mot de passe</label>
              <input type="password" class="form-control" name="password" id="password" placeholder="Mot de passe"/>
            </div>

            <div class="message-input form-group col-sm-6">
              <label  for="confirm_password">Confirmation de mot de passe</label>
              <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Mot de passe"/>
            </div>
            
            <div class="clearfix"></div>

            <div class="message-input form-group col-sm-6 ">
              <label  for="image">Image</label>
              <input type="file" name="image" />
            </div>
            <?php if ($image): ?>
              <div class=" form-group col-sm-6 ">
                <img src="<?=  $image; ?>" style="width:50px; height: 50px;"/>
              </div>
            <?php endif  ?>
            <div class="clearfix"></div>
            <div class="clearfix"></div>
            <button class=" btn btn-success submit-btn"><?= $submit;  ?></button>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>

<script>  
  $('.datepicker').datepicker();
</script>