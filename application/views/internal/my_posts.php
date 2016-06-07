<section>
    <div class="container">

        <div class="row">

            <div class="panel panel-default">
                <div class="panel-heading panel-heading-transparent">
                    <h2 class="panel-title bold">Add Post</h2>
                </div>

                <div class="panel-body">
                    <form id="add_post" method="post" name="add_post" action="<?=WWW_PATH ?>internal/addPost" enctype="multipart/form-data"> 
                        <div class="fancy-form">
                            <input class="custom-file-upload custom-file-upload-hidden" type="file" id="file" name="image" data-btn-text="Select a File" tabindex="-1" style="position: absolute; left: -9999px;">
                        </div>
                        <br/>
                        <div class="fancy-form">
                                <input name="title" type="text" class="form-control" placeholder="Title...">
                        </div>
                        <br/>
                        <div class="fancy-form"><!-- textarea -->
                            <textarea name="post" rows="10" class="form-control word-count"  data-info="textarea-words-info" placeholder="Enter post text here..."></textarea>
                        </div><!-- /textarea -->
                        <br/>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Add Post</button>
                    </form>
                </div>
            </div>
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
                            <form id="delete_post" method="post" name="delete_post" action="<?=WWW_PATH ?>internal/deletePost" >
                                <input name="id" type="hidden" value="<?=$post["id"]?>" >
                                <button type="submit" class="delete-post btn btn-3d btn-xlg btn-reveal btn-red">
                                            <i class="et-basket"></i>
                                            <span>DELETE POST</span>
                                    </button>  
                            </form>
                        </div>
                </div>
                <?php endforeach; ?>
        </div>
    </div>
</section>