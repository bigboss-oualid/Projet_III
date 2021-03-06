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

            <div class="message-input form-group col-sm-12">
              <label for="group-name">Nom de la groupe</label>
              <input type="text" class="form-control" name="name" id="group-name" value="<?= $name; ?>" placeholder="Nom du groupe"/>
            </div>

            <div class="form-group col-sm-12">
              <span class="bottom d-inline-block" tabindex="0" data-toggle="tooltip" title="maintenez la touche Ctrl ou Maj enfoncée / faites glisser la souris pour en sélectionner plusieurs)">
                <label for="pages">Permissions</label>

                <select multiple="multiple" name="pages[]" id="pages" class="form-control">
                    <?php foreach ($pages as $page): ?>
                    <option value="<?=  $page ?>" <?= in_array($page, $users_group_pages) ? ' selected '  : false; ?>><?=  $page ?></option>    
                  <?php endforeach; ?>
                </select>
              </span>
            </div>

            <div class="clearfix"></div>
            <button class="btn btn-success submit-btn"><?= $submit;  ?></button>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>