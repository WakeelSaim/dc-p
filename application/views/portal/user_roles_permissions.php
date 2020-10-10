<div class="row">
    <div class="col-md-12 col-lg-12">
        <h3 class="text-theme">User Role: <strong><?= $user_role_name ?></strong></h3>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-lg-6">
        <form method="post" action="<?= base_url()?>add-user-roles-permissions">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Permission Name</th>
                            <th scope="col">Access</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($user_permissions as $value) { ?>
                            <tr>
                                <td><?= $value->user_permission_name ?></td>
                                <td>
                                    <label class="switch switch-primary mr-3">
                                        <input type="checkbox" name="user_role_permission[]" value="<?= $value->user_permission_id ?>" <?= use_role_permission_checkbox($value->user_permission_id, $user_role_id) ?>>
                                        <span class="slider"></span>
                                    </label>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <input type="hidden" name="user_role_id" value="<?= $user_role_id ?>">
            <div>
                <button type="submit" class="btn btn-primary">Update User Role's Permission</button>
            </div>
        </form>
    </div>
</div>