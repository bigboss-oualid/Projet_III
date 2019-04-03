<div class="modal fade" id="<?= $target; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?= $heading; ?></h4>
      </div>
      <div class="modal-body">
          <form class="form-modal form" action="<?= $action; ?>">
            <div id="form-results"></div>

            <div class="message-input form-group col-sm-12">
              <label for="details">Contenu du commentaire</label>
              <div class="jumbotron">
                      <div class="container "><p><?= html_entity_decode($comment); ?></p></div></div>
            </div>

            <div class="form-group col-sm-6 ">
              <label for="status">Statut</label>
              <select class="form-control" id="status" name="status">
                  <option value="Activé">Approuvé</option>
                  <option value="Désactivé" <?= $status == 'Désactivé' ? 'selected' : false; ?> >En attente</option>
              </select>
            </div>

            <div class="form-group col-sm-6 ">
              <label for="reported">Contenu</label>
              <?php if($reported > 0): ?>
                <select class="btn btn-danger form-control" id="reported" name="reported">
                  <option class="btn btn-success" value="0">Validé</option>
                  <option class="btn btn-danger" value="<?= $reported  ?>" <?= $reported > 0 ? 'selected' : false; ?> ><?= $reported  ?> </option>
                </select>
              <?php else: ?>
                <select class="form-control btn-success" id="reported" name="reported">
                  <option value="0">Validé</option>
                </select>
              <?php endif ?>
            </div>
            
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