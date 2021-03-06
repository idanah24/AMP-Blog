<?php require APPROOT . '/views/inc/header.php'; ?>

<?php flash('post_added'); ?>
<?php flash('post_mod'); ?>
<div class="row">
    <div class="col-md-6">
        <h1>Posts</h1>

    </div>

    <div class="col-md-6">

        <a href="<?php echo URLROOT; ?>/posts/add" class="btn btn-primary pull-right">
            <i class="fa fa-pencil">Add post</i>
        </a>


    </div>

</div>
<?php foreach ($data['posts'] as $post) : ?>


    <div class="card card-body mb-3">

        <h4 class="card-title"><?php echo $post->title; ?></h4>

        <div class="bg-light p-2 mb-3">

            Written by <?php echo $post->name; ?> on <?php echo $post->postCreatedAt; ?>
        </div>
        <p class="card-text">
            <a href="<?php echo URLROOT; ?>/posts/show/<?php echo $post->postId; ?>" class="btn btn-dark">More</a>
            <?php if($post->userId == $_SESSION['user_id']) : ?>
            <a href="<?php echo URLROOT; ?>/posts/edit/<?php echo $post->postId; ?>" class="btn btn-dark">Edit</a>
            <a href="<?php echo URLROOT; ?>/posts/delete/<?php echo $post->postId; ?>" class="btn btn-dark">Delete</a>
            
            <?php endif; ?>
            
            
        </p>


    </div>

<?php endforeach; ?>

<?php require APPROOT . '/views/inc/footer.php'; ?>