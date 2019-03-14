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
              <textarea name="details" class="details" id="details" cols="30" rows="10"></textarea>
            </div>

            <div class="form-group col-sm-12">
              <label for="Chapitre_Episode">Chapitre/Épisode</label>
              <select name="episode_id" id="episode_id" class="form-control selectpicker">
                <?php foreach ($episodesWithChapters as $episodesWithChapter): ?>
                  <?php if ($chapter != $episodesWithChapter->chapter): ?>
                  <optgroup name="chapter_name" label="<?= $chapter = $episodesWithChapter->chapter; ?>">
                  <?php endif ?>
                    <option name="episode" id="episode" value="<?=  $episodesWithChapter->id ?>"><?=  $episodesWithChapter->title ?></option>
                  <?php if ($chapter != $episodesWithChapter->chapter): ?>
                  </optgroup>   
                  <?php endif ?>
                <?php endforeach; ?>
              </select>
            </div>
            
            <?php if (isset($user)): ?>
            <div class="form-group col-sm-6 ">
              <label for="status">Statut</label>
              <select class="form-control" id="status" name="status">
                <option value="Activé">Publier</option>
                <option value="Désactivé"?>En attente</option>
              </select>
            </div>
            <?php endif ?>

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
  for(name in CKEDITOR.instances){
    CKEDITOR.instances[name].destroy();
  }
  CKEDITOR.replaceAll('details');
  
</script>