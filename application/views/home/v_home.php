<section>
    <div class="container">

        <div class="row">

                <?php foreach ($posts as $post): ?>
                <div class="col-md-12 margin-bottom-20">
                        <div class="col-md-2 text-center">
                                <img width="300" height="300" alt="" class="img-responsive" src="<?= WWW_PATH . 'public/upload/' . $post["image"] ?>">
                        </div>
                        <div class="col-md-8">
                                <small class="block"><?= $post["edited"] ?></small>
                                <h4><a href="<?= WWW_PATH . 'home/single/' . $post["id"] ?>"><?= $post["title"] ?></a></h4> 
                                <p>
                                        <?= shrink_post($post["body"]) ?>
                                </p>
                        </div>
                        <div class="col-md-2 text-center">
                            <button class="download-pdf btn btn-xlg btn-green" id_post="<?=$post["id"]?>">
                                        <span>DOWNLOAD PDF</span>
                                </button>  
                        </div>
                </div>
                <?php endforeach; ?>
        </div>
    </div>
</section>