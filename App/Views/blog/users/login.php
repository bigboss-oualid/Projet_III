<!-- Login Page -->
<div id="login-page" class="page box">
    <!-- Centered Content -->
    <div class="centered-content">
        <h1 class="heading">Connectez-vous à votre compte</h1>
        <!-- Form -->
        <form action="<?= urlHtml('login/submit'); ?>" class="form">
            <div id="form-results"></div>
            <div class="form-group">
                <label for="email" class="col-sm-3 col-xs-12">Adresse e-mail</label>
                <div class="col-sm-9 col-xs-12">
                    <input type="email" name="email" id="email" placeholder="Email Address" class="input placeholder" />
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-sm-3 col-xs-12">Mot de passe</label>
                <div class="col-sm-9 col-xs-12">
                    <input type="password" name="password" id="password" placeholder="Password" class="input" />
                </div>
            </div>
            <div class="form-group">
                <div class=" col-sm-offset-3 col-sm-9">
                    <button class="button bold submit-btn">Se connecter</button>
                 </div>
            </div>
        </form>
        <!--/ Form -->
    </div>
    <!--/ Centered Content -->
</div>
<!--/ Login Page -->