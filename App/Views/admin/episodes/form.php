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

            <div  class="message-input form-group col-sm-12">
              <label for="title">Titre de l'épisode</label>
              <input type="text" class="form-control" name="title" id="title" value="<?= $title; ?>" placeholder="Entrer le titre de l'épisode"/>
            </div>

            <div class="message-input form-group col-sm-12">
              <label for="details">Contenu de l'épisode</label>
              <textarea name="details" id="details" class="tinyeditor"><?= $details; ?></textarea>
            </div>

            <div class="message-input form-group col-sm-12">
              <label for="tags">Tags</label>
              <input type="text" class="form-control" name="tags" id="tags" value="<?= $tags; ?>" placeholder="Mots Clés"/>
            </div>

            <div class="form-group col-sm-6">
              <label for="chapter_id">Chapitre</label>
              <select name="chapter_id" id="chapter_id" class="form-control">
                <?php foreach ($chapters as $chapter): ?>
                  <option value="<?=  $chapter->id ?>" <?= $chapter->id == $chapter_id ? 'selected' : false;  ?>><?=  $chapter->name ?></option>    
                <?php endforeach; ?>
              </select>
            </div>

            <div class="form-group col-sm-6 ">
              <label for="status">Statut</label>
              <select class="form-control" id="status" name="status">
                  <option value="Activé">Activé </option>
                  <option value="Désactivé" <?= $status == 'Désactivé' ? 'selected' : false; ?> >Désactivé</option>
              </select>
            </div>

            <div class="form-group col-sm-12">
              <label for="related_episodes">Épisodes similaires</label>
              <select name="related_episodes[]" id="related_episodes" class="form-control" multiple="multiple">
                <?php foreach ($episodes as $episode) { if($episode->id == $id) continue; ?>
                  <option value="<?=  $episode->id ?>" <?= in_array($episode->id, $related_episodes) ? 'selected' : false;  ?>><?=  $episode->title ?></option>    
                <?php } ?>
              </select>
            </div>
            <div class="clearfix"></div>

            <div class="message-input form-group col-sm-6 ">
              <label  for="image">Image</label>
              <input type="file" name="image" />
            </div>
            <?php if ($image) : ?>
              <div class=" form-group col-sm-6 ">
                <img src="<?= assets('uploads/images/episodes/' . $image); ?>" style="width:50px; height: 50px;"/>
              </div>
            <?php endif  ?>
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
 
<!--TinyMCE-->
<script  type="text/javascript" src="<?= assets('plugins/tinymce_5.0.3/tinymce.min.js'); ?>"></script>
<script  type="text/javascript" src="<?= assets('plugins/tinymce_5.0.3/init-tinymce.js'); ?>"></script>