<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo URLROOT; ?>/posts" class="btn btn-light"><i class="fa fa-backword"></i> Back</a>
<div class="row">
    <div class="col-md-6 mx-auto">

        <div class="card card-body bg-light mt-5">
            <h2><?php echo $data['post']->title; ?></h2>
            <p><?php echo $data['post']->body; ?></p>
            <div class="bg-light p-2 mb-3">

            Written by <?php echo $data['user']->name; ?> on <?php echo $data['post']->created_at; ?>
        </div>

        </div>
    </div>
</div>


<?php require APPROOT . '/views/inc/footer.php'; ?>
