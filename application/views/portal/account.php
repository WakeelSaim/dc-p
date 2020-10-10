<div class="row">
    <div class="col-md-4">
        <div class="card bg-dark text-white o-hidden mb-4">
            <img class="card-img" src="<?= admin_profile_image() ?>" alt="Card image">
        </div>
    </div>
    <div class="col-md-8">
        <form action="<?= base_url('account') ?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-8 form-group mb-3">
                    <div class="row">
                        <div class="col-md-6">
                            <label>First Name</label>
                            <input type="text" class="form-control" required="" name="first_name" value="<?= $account->first_name ?>">
                            <div class="text-danger"><?= form_error('first_name'); ?></div>
                        </div>
                        <div class="col-md-6">
                            <label>Surname</label>
                            <input type="text" class="form-control" required="" name="last_name" value="<?= $account->last_name ?>">
                            <div class="text-danger"><?= form_error('last_name'); ?></div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 form-group mb-3">
                    <label>Change Image</label>
                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <input type="file" accept="image/*" class="custom-file-input" name="profile_image" id="profile_image">
                            <label class="custom-file-label" for="profile_image">Choose file</label>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 form-group mb-3">
                    <label>Current Password</label>
                    <input type="password" class="form-control" name="current_password" value="">
                    <div class="text-danger"><?= form_error('current_password'); ?></div>
                </div>

                <div class="col-md-8 form-group mb-3">
                    <label>New Password</label>
                    <input type="password" class="form-control" name="new_password" value="">
                    <div class="text-danger"><?= form_error('new_password'); ?></div>
                </div>

                <div class="col-md-8 form-group mb-3">
                    <label>Confirm Password</label>
                    <input type="password" class="form-control" name="confirm_password" value="">
                    <div class="text-danger"><?= form_error('confirm_password'); ?></div>
                </div>

                <div class="col-md-12">
                    <button class="btn btn-primary" type="submit">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $('input[type=file]').on('change', function (e) {
        $('.card-img').attr('src',URL.createObjectURL(e.target.files[0]));
    });
</script>