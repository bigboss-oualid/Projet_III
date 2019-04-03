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
            <div class="message-input form-group col-sm-6">
              <label for="chapter-name">Nom du chapitre</label>
              <input type="text" class="form-control" name="name" id="chapter-name" value="<?= $name; ?>" placeholder="Nom du chapitre"/>
            </div>

            <div class="form-group col-sm-6">
              <label for="status">Statut</label>
              <select class="form-control" id="status" name="status">
                  <option value="Activé">Activé </option>
                  <option value="Désactivé" <?= $status == 'Désactivé' ? 'selected' : false; ?> >Désactivé</option>
              </select>
            </div>
            
            <div class="clearfix"></div>
            <button class="btn btn-success submit-btn"><?= $submit;?></button>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>