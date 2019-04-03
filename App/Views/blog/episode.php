    <!-- Breadcrumb -->
    <ul class="breadcrumb box">
        <li>
            <a href="<?= urlHtml('/'); ?>">Home</a>
        </li>
        <li>
            <a href="<?= urlHtml('/chapter/' . seo($episode->chapter) . '/' . $episode->chapter_id); ?>"><?= $episode->chapter; ?></a>
        </li>
        <li class="active"><?= $episode->title; ?></li>
    </ul>
    <!-- /Breadcrumb -->
    <!-- Main Content -->
    <div class="col-xs-12" id="main-content">
        <!-- episode Page -->
        <div id="post-page">
            <!-- episode Box -->
            <div class="box post-box wow fadeIn" data-wow-duration="3s">
                <div class="post-content container">
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
                    <h1 class="heading"><?= $episode->title; ?></h1>
                    <div class="date-container">
                        <span class="fa fa-calendar"></span>
                        <span class="date"><?= date('d/m/Y à H:i', $episode->created); ?></span>
                    </div>
                    <div class="clearfix"></div>
                    <a href="#" class="episode-image">
                        <img class="img-responsive img-rounded thumbnail" src="<?= assets('uploads/images/episodes/' . $episode->image); ?>" alt="<?= $episode->title; ?>" />
                    </a>
                    <p class="details">
                        <div class="text-responsive episodedetails">
                        <?= htmlspecialchars_decode($episode->details); ?>
                        </div>
                    </p>
                    <!--Navigation episodes-->
                    <div class=" row clearheight">
                        <?php if (isset($previousEpisode) && $previousEpisode): ?>
                        <div class="pull-left col-sm-2">
                            <a href="<?= urlHtml('/episode/' . seo($previousEpisode->title) . '/' . $previousEpisode->id); ?>" class="btn btn-default">
                            <span class="fa fa-angle-double-left"></span>
                            <span class="hidden-xs">L'épisode précédente</span>
                          </a>
                        </div>                        
                        <?php endif ?>
                        <?php if (isset($nextEpisode) && $nextEpisode): ?>
                        <div class="pull-right col-sm-2">
                            <a href="<?= urlHtml('/episode/' . seo($nextEpisode->title) . '/' . $nextEpisode->id); ?>" class="btn btn-default">
                            <span class="hidden-xs">L'épisode suivante</span>
                            <span class="fa fa-angle-double-right"></span>
                          </a>
                        </div>                        
                        <?php endif ?>
                    </div>
                </div>
                <?php if ($related_episodes): ?>
                <section id="blog" class="similaires">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 col-lg-offset-3 text-center">
                                <h2 class="text-center text-responsive">
                                    <span class="ion-minus fa fa-minus"> </span> Épisodes similaires <span class="fa fa-minus"> </span>
                                </h2>
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis  dis parturient montes, nascetur ridiculus </p><br>
                            </div> 
                        </div> 
                        <div class="row">
                            <div id="slider" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#slider" data-slide-to="0" class="active"></li>
                                    <?php $number = 0; foreach ($related_episodes as $related_episode): ?>
                                    <?php $number++; endforeach ?>
                                    <?php $slider = 1;$i=3; while($i < $number) { ?>
                                    <li data-target="#slider" data-slide-to="<?= $slider;?>"></li>
                                    <?php $slider++;  $i=$i+3;} ?>
                                </ol>
                                <!-- Carousel items -->
                                <div class="carousel-inner">
                                    <?php $caresoul = 0; ?>
                                    <div class="item active">
                                        <div class="row">
                                        <?php foreach ($related_episodes as $related_episode): ?>
                                            <?php if ($caresoul == 3): ?>
                                    <div class="item">
                                        <div class="row">
                                            <?php $caresoul = 0; endif ?>
                                            <div class="col-sm-4 col-xs-6">
                                                <div class="card text-center">
                                                    <img class="card-img-top" src="<?= assets('uploads/images/episodes/' . $related_episode->image); ?>" alt="" width="100%">
                                                    <div class="card-block">
                                                        <h4 class="card-title"> <?= $related_episode->title?></h4>
                                                        <p class="card-text"><?= html_entity_decode(read_more($related_episode->details, 20)) ;?></p>
                                                        <a class="btn btn-default" href="<?= urlHtml('/episode/' . seo($related_episode->title) . '/' . $related_episode->id); ?>">lire la suite</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php $caresoul++;  ?>
                                            <?php if ($caresoul == 3): ?>
                                        </div>
                                    </div>
                                            <?php endif ?>
                                        <?php endforeach ?>
                                        </div> <!-- row -->
                                    </div> <!-- item -->
                                </div>
                            </div>
                        </div>
                    </section>
                <?php endif ?>
            </div>
            <!--/ episode Box -->

            <!-- Comments -->
            <div id="comments" class="box">
                <!-- Total Comments -->
                <div id="total-comments">
                    <i class="fa fa-comments"></i> <?= count($episode->comments); ?> </span> Commentaires
                </div>
                <!--/ Total Comments -->
                <?php $visitor = 1; foreach ($episode->comments AS $comment): ?>
                <div class="container">
                    <div class="comment ">
                        <div class="author-image">
                            <img src="<?= ($comment->userID)? assets('uploads/images/users/' . $comment->userImage) : assets('uploads/images/users/profile-42914_960_720.png'); ?> " alt="Visiteur" />
                        </div>
                        <div class="comment-container">
                            <div class="author-name">
                                <?= ($comment->userID)? $comment->first_name . ' ' . $comment->last_name : 'Visiteur ' . $visitor++ ; ?>
                            </div>
                            <div class="comment-date">
                                <?= date('d-m-Y H:i', $comment->created); ?>
                                <?php if ($comment->reported>0): ?>
                                <acronym title="Nombre de signalement">
                                    <span class="fa fa-flag icon-flag pull-right"> <?= $comment->reported ?></span>
                                </acronym>
                                <?php endif ?>
                            </div>
                            <div class="comment-text">
                                <?= htmlspecialchars_decode($comment->comment); ?>
                            </div>
                        </div>
                        <div class="pull-right">
                            <form class="form-group" action="<?= urlHtml('/episode/comment/' . $comment->id); ?>" method="post">
                                <button type="submit" class="btn btn-xs btn-danger"  onclick="return confirm('Signaler le commentaire suivant ?\n<?= $comment->first_name; ?> : <?= $comment->comment; ?>')" >Signaler le commentaire</button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endforeach ?>
            <!--/ Comments -->

                <!-- Comment Form -->
                <form action="<?= urlHtml('/episode/' . seo($episode->title) . '/' . $episode->id . '/add-comment'); ?>" method="post" id="comment-form" class="box">
                    <h3 class="heading">Laisser un commentaire</h3>
                    <?php if ($errors): ?>
                        <div id="form-results" class="alert alert-danger">
                            <?= $errors;?>
                        </div>
                    <?php endif ?> 
                    <?php if ($success): ?>
                        <div id="form-results" class="alert alert-success">
                            <?= $success;?>
                        </div>
                    <?php endif ?>
                    <?php if (!$login): ?>
                    <div class="message-input form-group col-sm-12">
                      <label for="email">Votre adresse E-mail</label>
                      <input type="email" class="form-control" name="email" id="email" placeholder="ex@mail.fr"/>
                    </div>
                    <?php else: ?>
                        <div class="comment-text message-input form-group col-sm-12"><?= $user->first_name . ' ' .  $user->last_name  ; ?>
                        </div>
                    <?php endif ?>
                    <div class="message-input form-group col-sm-12">
                        <label for="comment">Votre commentaire</label>
                        <textarea name="comment" id="comment" class="input" placeholder="Laisser votre commentaire" cols="30" rows="10" required="required"></textarea>
                    </div>
                    <button class="comment-button">Envoyer</button>
                </form>
                <!--/ Comment Form -->
            </div>
            <!--/ episode Page  -->
        </div> 
    <!--/ Main Content -->
    </div>