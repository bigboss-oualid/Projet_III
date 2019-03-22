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
          <!--Message: Infos -->
          <div class="panel panel-info">
            <table class="table table-striped table-bordered table-condensed">
              <div class="panel-heading"> 
                <h3 class="panel-title text-center"><span class="fa fa-address-card"></span>  <b>Information sur l'expéditeur</h3>
              </div>
              <tr>
                  <th><span class="fa <?= ($user_id==0)? 'fa-user-secret' : 'fa-user '; ?>"></span>  Nom</th> <td><?= $name; ?></td>
              </tr>
              <tr>
                  <th><span class="glyphicon glyphicon-envelope"> Mail</span></th><td><?= $email; ?></td>
              </tr>
              <tr>
                  <th><span class="glyphicon glyphicon-phone-alt"> Télé</span></th><td><?= $phone; ?></td>
              </tr>
              <tr>
                  <th><span class="glyphicon glyphicon-paperclip"> Sujet</span></th><td><?= $subject; ?></td>
              </tr>
              <tr>
                  <th><span class="glyphicon glyphicon-time"> Reçu</span></th><td><?= $created; ?></td>
              </tr>
            </table>
          </div>
          <!-- /.info -->
          <!--details: Email + reply(if exists) -->
          <div class="panel panel-warning">
            <div class="panel-heading">
              <h3 class="panel-title text-center"><span class="fa fa-envelope-open-text"></span>  <b>E-mail</h3>
            </div>
            <div class="jumbotron">
              <div class="container ">
                <p><?= $details ?></p>   
              </div>
            </div>
          </div>
          <!-- /.details -->
          <!--Object -->
          <div class="panel panel-success">
            <div class="panel-heading"> 
              <h3 class="panel-title text-center"><span class="fa fa-edit"></span>  <b>Répondre</h3>
            </div>
            <textarea name="details" class="details" id="details" cols="30" rows="10"></textarea>
          

            <div class="clearfix"></div>
            <div class="clearfix"></div>
          </div>
          <!-- /.Object -->

          <button class=" btn btn-success submit-btn"><span class="glyphicon glyphicon-ok-sign"></span>Envoyer</button>

        
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