        <!-- Widget -->
        <div class="col-sm-3 col-xs-12" id="widget">
            <!-- Social Widget -->
            <section class="box wow fadeInDown" data-wow-duration="2s" id="social-widget">
                <h3 class="heading">Médias Sociaux</h3>
                <div class="content">
                    <a href="#" class="facebook">
                        <span class="fa fa-facebook"></span>
                    </a>
                    <a href="#" class="google">
                        <span class="fa fa-google-plus"></span>
                    </a>
                    <a href="#" class="twitter">
                        <span class="fa fa-twitter"></span>
                    </a>
                    <a href="#" class="youtube">
                        <span class="fa fa-youtube"></span>
                    </a>
                    <a href="#" class="instagram">
                        <span class="fa fa-instagram"></span>
                    </a>
                    <a href="#" class="pinterest">
                        <span class="fa fa-pinterest"></span>
                    </a>
                    <a href="#" class="rss">
                        <span class="fa fa-rss"></span>
                    </a>
                </div>
            </section>
            <!--/ Social Widget -->
            <!-- Search Widget -->
            <section class="box wow fadeInDown" data-wow-duration="2s" id="search-widget">
                <h3 class="heading">Recherche</h3>
                <div class="content">
                    <form action="<?= urlHtml('/search'); ?>"  method = 'POST'>
                        <div class="row">
                            <div class="col-xs-4">
                              <input class="form-check-input" type="radio" value="episodes" name="select-radio" id="episodes-radio"  checked >
                              <label class="form-check-label" for="episodes-radio">Épisodes
                              </label>
                            </div>
                            <div class="col-xs-4">
                              <input class="form-check-input" type="radio" value="chapters" name="select-radio" id="chapters-radio">
                              <label class="form-check-label" for="chapters-radio">Chapitres
                              </label>
                            </div>
                            <div class="col-xs-4">
                              <input class="form-check-input" type="radio" value="details" name="select-radio" id="details-radio" >
                              <label class="form-check-label" for="details-radio">Contenu
                              </label>
                            </div>
                        </div>
                        <input type="search" name="term" class="input" placeholder="Chercher un mot ou une phrase"  required />
                        <button name = "search" value = "search" class="button">Chercher</button>
                    </form>
                    
                </div>
            </section>
            <!--/ Search Widget -->
            <!-- Categories Widget -->
            <section class="box wow fadeInDown" data-wow-duration="2s" id="categories-widget">
                <h3 class="heading">Chapitres</h3>
                <div class="content">
                    <?php foreach ($chapters AS $chapter) : ?>
                    <a href="<?= urlHtml('chapter/' . seo($chapter->name) . '/' . $chapter->id); ?>">
                        <span class="name"><?= $chapter->name; ?></span>
                        <span class="total-episodes pull-right icon-views" title="Episodes"><?= $chapter->total_episodes; ?><small><?= ($chapter->total_episodes>1)? ' Épisodes' : ' Épisode' ?></small></span>
                    </a>
                    <?php endforeach ?>
                </div>
            </section>
            <!--/ Categories Widget -->

            <!-- Related episodes Widget -->
            <section class="box wow fadeInDown" data-wow-duration="2s" id="popular-posts-widget">
                <h3 class="heading">Épisodes populaires</h3>
                <div class="content">
                    <?php if (isset($popular_episodes)): ?>
                        <?php foreach ($popular_episodes as $popular_episode): ?>
                        <a href="<?= urlHtml('/episode/' . seo($popular_episode->title) . '/' . $popular_episode->id); ?>">
                            <?= '<small>'.$popular_episode->chapter . '</small> / ' . read_more($popular_episode->title, 5); ?>  <span class="pull-right icon-views"><?= $popular_episode->views; ?> <i class="icon-views glyphicon glyphicon-eye-open"></i></span>
                        </a> 

                        <?php endforeach ?>
                    <?php endif ?>
                </div>
            </section>
            <!--/ Related episodes Widget -->
        </div>
        <!--/ Widget -->
