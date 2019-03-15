<!-- Register Page -->
<div id="register-page" class="page box">
    <!-- Centered Content -->
    <div class="centered-content">
        <h1 class="heading">Crée un nouveau compte</h1>
        <!-- Form -->
        <form action="<?= urlHtml('/register/submit'); ?>" class="form">
            <div id="form-results"></div>
            <div class="form-group">
                <label for="first_name" class="col-sm-3 col-xs-12">Prénom</label>
                <div class="col-sm-9 col-xs-12">
                    <input type="text" name="first_name" id="first_name" placeholder="Prénom" class="input placeholder" />
                </div>
            </div>
            <div class="form-group">
                <label for="last_name" class="col-sm-3 col-xs-12">Nom</label>
                <div class="col-sm-9 col-xs-12">
                    <input type="text" name="last_name" id="last_name" placeholder="Nom" class="input placeholder" />
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-sm-3 col-xs-12">Email</label>
                <div class="col-sm-9 col-xs-12">
                    <input type="email" name="email" id="email" placeholder="Adresse E-mail" class="input placeholder" />
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
                    <select name="gender" id="gender" class="input">
                        <option value="homme">Homme</option>
                        <option value="femme">Femme</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="image" class="col-sm-3 col-xs-12">Image de votre profil</label>
                <div class="col-sm-9 col-xs-12">
                    <input type="file" name="image" id="image" class="input" />
                </div>
            </div>

            <div class="form-group">
                <div class=" col-sm-offset-3 col-sm-9">
                    <button class="button bold submit-btn">S'inscrire</button>
                 </div>
            </div>
        </form>
        <!--/ Form -->
    </div>
    <!--/ Centered Content -->
</div>
<!--/ Register Page -->