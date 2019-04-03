    <!-- Breadcrumb -->
    <ul class="breadcrumb box">
        <li>
            <a href="<?= urlHtml('/'); ?>">Home</a>
        </li>
        <li class="active"><?= $chapter->name; ?></li>
    </ul>
    <!-- /Breadcrumb -->
    <!-- Main Content -->
    <div class="col-sm-9 col-xs-12" id="main-content">
        <!-- chapter Page -->
        <?php if ($chapter->episodes): ?>
        <div id="category-page" >
            <?php foreach ($chapter->episodes AS $chunked_episodes) : ?>
                <?php foreach ($chunked_episodes AS $episode) : $episode->chapter = $chapter->name; ?>
                <div class="col-sm-3">
                    <?= $episode_box($episode);?>
                </div>
                <?php endforeach ?>
            <?php endforeach ?>
        </div>
        <!--/ chapter Page -->
        <div class="clearfix"></div>
        <!-- Pagination Links -->
        <nav aria-label="Page navigation" class="text-center">
          <ul class="pagination">
            <li>
                <a href="<?= $url . 1; ?>" title="First Page">
                    <span class="fa fa-angle-double-left"></span>
                </a>
            </li>
            <li>
              <a href="<?= $url . $pagination->prev(); ?>" aria-label="Previous" title="Previous Page">
                    <span class="fa fa-angle-left"></span>
              </a>
            </li>
            <?php for ($page = 1; $page <= $pagination->last(); $page++) : ?>
                <li<?= $page == $pagination->page() ? ' class="active"': false; ?>>
                    <a href="<?= $url . $page; ?>"><?= $page; ?></a>
                </li>
            <?php endfor ?>
            <li>
              <a href="<?= $url . $pagination->next(); ?>" aria-label="Next">
                <span class="fa fa-angle-right"></span>
              </a>
            </li>
            <li>
              <a href="<?= $url . $pagination->last(); ?>" aria-label="Next">
                <span class="fa fa-angle-double-right"></span>
              </a>
            </li>
          </ul>
        </nav>
        <!--/ Pagination Links -->
        <?php   else : ?>
            <div class="box" style="padding: 10px;">
                <h1 class="bold">Aucun épisode dans ce chapitre</h1>
            </div>
        <?php endif ?>
    </div>
    <!--/ Main Content -->