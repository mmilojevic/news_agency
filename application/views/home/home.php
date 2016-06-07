<section>
    <div class="main-container container">

        <div class="row">

                <?php foreach ($posts as $post): ?>
                <div class="col-md-12 margin-bottom-20">
                        <div class="col-md-2 text-center">
                                <img  alt="" class="img-responsive" src="<?= WWW_PATH . 'public/upload/' . $post["image"] ?>">
                        </div>
                        <div class="col-md-8">
                                <small class="block"><?= $post["edited"] ?></small>
                                <h4><a target="_blank" href="<?= WWW_PATH . 'home/single/' . $post["id"] ?>"><?= $post["title"] ?></a></h4> 
                                <p>
                                        <?= shrink_post($post["body"]) ?>
                                </p>
                        </div>
                        <div class="col-md-2 text-center">
                            <form id="download_pdf" method="post" name="download_pdf" action="<?=WWW_PATH ?>home/downloadPdf" >
                                <input name="id" type="hidden" value="<?=$post["id"]?>" >
                                <button type="submit" class="download-pdf btn btn-xlg btn-green" id_post="<?=$post["id"]?>">
                                        <span>DOWNLOAD PDF</span>
                                </button>  
                            </form>
                        </div>
                </div>
                <?php endforeach; ?>
        </div>
    </div>
</section>