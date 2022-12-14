<?php require APP_ROOT . "/views/inc/header.php" ?>
   <div class="container">
        <?php flash("post_message"); ?>
        <div class="row mb-5">
            <div class="col-md-6">
                <h1>Posts</h1>
            </div>
            <div class="col-md-6">
                <a href="<?php echo URL_ROOT; ?>/posts/add" class="btn btn-primary float-end">
                    <i class="fa fa-pencil"></i> Add Post
                </a>
            </div>
        </div>
   </div>
   <?php foreach($data['posts'] as $post) : ?>
    <div class="card card-body mb-3">
        <h4 class="card-title"><?php echo $post->title; ?></h4>
        <div class="bg-light p-2 mb-3">
            Writting By "<?php echo $post->name; ?>" on, <?php echo $post->postCreated; ?>
        </div>
        <p class="card-text"><?php echo $post->body; ?></p>
        <a href="<?php echo URL_ROOT; ?>/posts/show/<?php echo $post->postId; ?>" class="btn btn-dark">MORE</a>
    </div>
   <?php endforeach; ?>
<?php require APP_ROOT . "/views/inc/footer.php" ?>