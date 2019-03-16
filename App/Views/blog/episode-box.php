<!-- Post Box -->
<div class="box post-box wow fadeIn" data-wow-duration="3s">
    <div class="post-content">
        <div class="social-icons pull-right">
            <a href="#" class="facebook">
                <span class="fa fa-facebook"></span>
            </a>
            <a href="#" class="twitter">
                <span class="fa fa-twitter"></span>
            </a>
            <a href="#" class="google">
                <span class="fa fa-google-plus"></span>
            </a>
        </div>
        <h1 class="heading">
            <a href="<?= urlHtml('/episode/' . seo($episode->title) . '/' . $episode->id); ?>"><?= $episode->title; ?></a>
        </h1>
        <div class="date-container">
            <span class="fa fa-calendar"></span>
            <span class="date"><?= date('d-m-Y H:i');?></span>
        </div>
        <div class="clearfix"></div>
        <a href="<?= urlHtml('/episode/' . seo($episode->title) . '/' . $episode->id); ?>" class="image-box">
            <img class="img-responsive img-rounded thumbnail" src="<?= assets('uploads/images/episodes/' . $episode->image); ?>" alt="<?= $episode->title; ?>" />
        </a>
        <p class="details">
            <?= html_entity_decode(read_more($episode->details, 20)) ;?>...
        </p>
        <a href="<?= urlHtml('/episode/' . seo($episode->title) . '/' . $episode->id); ?>" class="pull-right read-more">
            Lire la suite
            <span class="fa fa-long-arrow-right"></span>
        </a>
    </div>

    <div class="post-box-footer">
        <a class="user">
            Par:
            <span class="main"><?= $episode->first_name . ' ' . $episode->last_name; ?></span>
        </a>
        <a href="<?= urlHtml('chapter/' . seo($episode->chapter) . '/' . $episode->chapter_id); ?>" class="category">
            Dans:
            <span class="main"><?= $episode->chapter; ?></span>
        </a>
        <a href="<?= urlHtml('/episode/' . seo($episode->title) . '/' . $episode->id); ?>#comment-form" class="comments">
            <span class="main"><?= $episode->total_comments; ?></span>
            Commentaires
        </a>
    </div>
</div>
<!--/ episode Box -->