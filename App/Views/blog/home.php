        <!-- Slideshow -->
        <div id="slideshow" class="carousel slide wow fadeInDown"  data-wow-duration="3s" data-ride="carousel">
          <!-- Indicators -->
          <ol class="carousel-indicators">
            <li data-target="#slideshow" data-slide-to="0" class="active"></li>
            <li data-target="#slideshow" data-slide-to="1"></li>
            <li data-target="#slideshow" data-slide-to="2"></li>
            <li data-target="#slideshow" data-slide-to="3"></li>
            <li data-target="#slideshow" data-slide-to="4"></li>
            <li data-target="#slideshow" data-slide-to="5"></li>
            <li data-target="#slideshow" data-slide-to="6"></li>
          </ol>

          <!-- Wrapper for slides -->
          <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="<?= assets('blog/images/slides/Slider-01.jpg'); ?>" alt="...">
            </div>
            <div class="item">
                <img src="<?= assets('blog/images/slides/Slider-02.jpg'); ?>" alt="...">
            </div>
            <div class="item">
                <img src="<?= assets('blog/images/slides/Slider-03.jpg'); ?>" alt="...">
            </div>
            <div class="item">
                <img src="<?= assets('blog/images/slides/Slider-04.jpg'); ?>" alt="...">
            </div>
            <div class="item">
                <img src="<?= assets('blog/images/slides/Slider-05.jpg'); ?>" alt="...">
            </div>
            <div class="item">
                <img src="<?= assets('blog/images/slides/Slider-06.jpg'); ?>" alt="...">
            </div>
          </div>

          <!-- Controls -->
          <a class="left carousel-control" href="#slideshow" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Précédente</span>
          </a>
          <a class="right carousel-control" href="#slideshow" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Suivante</span>
          </a>
        </div>
        <!--/ Slideshow -->
        <!-- Main Content -->
        <div class="col-sm-9 col-xs-12" id="main-content">
          <div class="row">
            <?php foreach ($episodes AS $episode): ?>
              <span class="col-sm-6">
                <?= $episode_box($episode);?>
                </span>
             <?php endforeach ?>
          </div>
        </div>
        <!--/ Main Content -->