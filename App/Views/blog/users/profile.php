<!-- Register Page -->
<div id="register-page" class="page box">
    <!-- Centered Content -->
    <div class="centered-content">
        <p id="titrepage" class="text-center"><span class="ion-minus fa fa-minus"> </span>Modifier votre compte<span class="fa fa-minus"> </span></p>
        <hr id="hr-user">
        <!-- Form -->
        <form action="<?= urlHtml('/profile/save'); ?>" class="form">
            <div class="form-group text-center image-upload col-xs-12">
              <label for="image" class="user-img">
                <?php if (isset($user->image)): ?>
                <img class="img-responsive img-rounded thumbnail" src="<?= assets('uploads/images/users/' . $user->image); ?>"/>
                <?php else: ?>
                <img class="img-responsive img-rounded thumbnail" src="<?= assets('uploads/images/users/blogger.png'); ?>"/>
                <?php endif  ?>
              </label>
              <input name="image" id="image" class="input" type="file" />
            </div>

            <div class="clearfix"></div>
            <div id="form-results"></div>
            <div class="form-group">
                <label for="first_name" class="col-sm-3 col-xs-12">Prénom</label>
                <div class="col-sm-9 col-xs-12">
                    <b><input type="text" name="first_name" id="first_name" placeholder="Prénom" class="input " value="<?= $user->first_name; ?>"/></b>
                </div>
            </div>

            <div class="form-group">
                <label for="last_name" class="col-sm-3 col-xs-12">Nom</label>
                <div class="col-sm-9 col-xs-12">
                    <b><input type="text" name="last_name" id="last_name" placeholder="Nom" class="input" value="<?= $user->last_name; ?>" /></b>
                </div>
            </div>

            <div class="form-group">
                <label for="email" class="col-sm-3 col-xs-12">Email</label>
                <div class="col-sm-9 col-xs-12">
                    <b><input type="email" name="email" id="email" placeholder="Adresse E-mail" class="input"  value="<?= $user->email; ?>" /></b>
                </div>
            </div>

            <div class="form-group">
                <label for="password" class="col-sm-3 col-xs-12">Mot de passe</label>
                <div class="col-sm-9 col-xs-12">
                    <input type="password" name="password" id="password" placeholder="Mot de passe" class="input" />
                </div>
            </div>

            <div class="form-group">
                <label for="confirm_password" class="col-sm-3 col-xs-12">Confirmation du mot de passe</label>
                <div class="col-sm-9 col-xs-12">
                    <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirmation du mot de passe" class="input" />
                </div>
            </div>

            <div class="form-group">
                <label for="gender" class="col-sm-3 col-xs-12">Sexe</label>
                <div class="col-sm-9 col-xs-12">
                    <b><select name="gender" id="gender" class="input">
                        <option value="homme">Homme</option>
                        <option value="femme" <?= ($user->gender == 'femme') ? 'selected' : false; ?>>Femme</option>
                    </select></b>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <button class="button bold submit-btn">Sauvgarder</button>
                 </div>
            </div>
        </form>
        <div class="jumbotron col-sm-offset-3 col-sm-9">
            <h3 id="supprimer-compte" class="text-center">Supprimer votre compte</h3>
            <span class="col-xs-12">Vous avez été utilisateur sur Blog|Jean-Forteroche. je dois  conserver certaines informations pour des raisons réglementaires. Si vous souhaitez réellement supprimer votre compte, merci de me <a href="<?= urlHtml('/contact-me'); ?>">contacter</a></span>
        </div>
        <!--/ Form -->
    </div>
    <!--/ Centered Content -->
</div>
<!--/ Register Page -->