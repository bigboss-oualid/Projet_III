<!-- Contact Page -->
<div id="register-page" class="page box">
    <!-- Centered Content -->
    <div class="centered-content clearheight">
        <p id="titrepage" class="text-center"><span class="ion-minus fa fa-minus"> </span>Contactez moi ! <span class="fa fa-minus"> </span></p>
      <hr id="hrapropos">
        <!-- Form -->
        <form action="<?= urlHtml('/contact-me/submit'); ?>" class="form">
          <div id="form-results"></div>
          <div class="form-group">
              <label for="name" class="col-sm-3 col-xs-12">Prénom</label>
              <div class="col-sm-9 col-xs-12">
                  <input class="form-control <?= (isset($name))? ' form-control-plaintext" readonly value="'.$name.'" ': ' input placeholder" placeholder="Prénom, Nom';  ?>" type="text" name="name" id="name"   />
              </div>
          </div>

          <div>
            <label id="phone-label" for="phone" class="col-sm-3 col-xs-12">Télephone</label>
            <div class="input-group">
                <input type="tel" class="form-control" name="phone" id="phone">
            </div>
          </div>
          <div class="clearfix"></div>

          <div class="form-group">
              <label for="email" class="col-sm-3 col-xs-12">Email</label>
              <div class="col-sm-9 col-xs-12">
                  <input type="email" name="email" id="email"  class="form-control <?= (isset($name))? ' form-control-plaintext" readonly value="'.$email.'" ': ' placeholder="Adresse E-mail';  ?>" />
              </div>
          </div>

          <div class="form-group">
              <label for="subject" class="col-sm-3 col-xs-12">Objet</label>
              <div class="col-sm-9 col-xs-12">
                  <input type="text" name="subject" id="subject" placeholder="Sujet" class="form-control" />
              </div>
          </div>

          <div class="form-group">
            <label for="message" class="col-sm-3 col-xs-12" > Message:</label>
              <div class="col-sm-9 col-xs-12">
                <textarea class="form-control" type="textarea" name="message" id="message" placeholder="Entrer votre message" maxlength="6000" rows="15"></textarea>
              </div>
          </div>

          <div class="form-group">
              <div class="col-sm-offset-3 col-sm-9 col-xs-12">
                  <button class="form-control button bold submit-btn">Envoyer</button>
               </div>
          </div>
        </form>
        <!--/ Form -->
    </div>
    <!--/ Centered Content -->
</div>
<!--/ Contact-me Page -->

