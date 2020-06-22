<?php require APPROOT . '/views/inc/header.php' ?>

<?php flash('post_message'); ?>
<div class="row py-3">
    <div class="col-md-6">
        <h1>Posts</h1>
    </div>
    <div class="col-md-6">
        <a href="<?php echo URLROOT; ?>/posts/add" class="btn btn-primary float-right">
            <i class="fas fa-pencil-alt mr-1"></i>Add Post
        </a>
    </div>
</div>

<?php foreach ($data['posts'] as $post) : ?>
    <div class="card card-body mb-3">
        <h4 class="card-title"><?php echo $post->title ?></h4>
        <div class="d-flex d-inline bg-light p-2 mb-3">written by: <?php echo $post->name ?> on <?php echo $post->postCreated; ?></div>
        <p class="card-text"><?php echo $post->body; ?></p>
        <a class="btn btn-dark" href="<?php echo URLROOT; ?>/posts/show/<?php echo $post->postId; ?>">More</a>
    </div>
<?php endforeach; ?>

<?php require APPROOT . '/views/inc/footer.php' ?>