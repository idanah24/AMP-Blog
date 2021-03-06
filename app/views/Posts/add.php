<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo URLROOT; ?>/posts" class="btn btn-light"><i class="fa fa-backword"></i> Back</a>
<div class="row">
    <div class="col-md-6 mx-auto">

        <div class="card card-body bg-light mt-5">
            <h2>Add post</h2>
            <p>Share a post with other users</p>
            <form action="<?php echo URLROOT; ?>/posts/add" method="POST">
                
                <div class="form-group">
                    <label for="title">Title: <sup>*</sup></label>
                    <input type="text" name="title" class="form-control form-control-lg 
                           <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['title']; ?>">
                    <span class="invalid-feedback"> <?php echo $data['title_err']; ?></span>
                </div>
                
                
                <div class="form-group">
                    <label for="body">Content: <sup>*</sup></label>
                    <textarea name="body" class="form-control form-control-lg 
                           <?php echo (!empty($data['body_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['body']; ?>"></textarea>
                    <span class="invalid-feedback"> <?php echo $data['body_err']; ?></span>
                </div>
                
                
                    <div class="col">
                        <input type="submit" value="Add" class="btn btn-success btn-block">
                    </div>
                    

            </form>

        </div>
    </div>
</div>


<?php require APPROOT . '/views/inc/footer.php'; ?>
