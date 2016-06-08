<section>
    <div class="container">
            <h1 class="blog-post-title"><?= $post["title"]?></h1>
            <ul class="blog-post-info list-inline">
                <li>
                        <i class="fa fa-clock-o"></i> 
                        <span class="font-lato">Date: <?= $post["edited"] ?>, Author: <?= $post["editor_name"] ?> (<?= $post["editor_email"] ?>) </span>
                </li>
            </ul>
            <!-- article content -->
            <p>
                <img class="img-responsive" src="<?= WWW_PATH . 'public/upload/' . $post["image"] ?>">
            </p>
            <!-- /article content -->
            <!-- article content -->
            <p><?= $post["body"] ?></p>
            <!-- /article content -->
</section>