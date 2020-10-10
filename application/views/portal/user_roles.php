<div class="row mb-3 ml-1">
    <div class="col-xl-9 col-lg-6 col-md-4">
        <button class="btn btn-primary" data-toggle="modal" data-target="#add_user_roles">Add User Role</button>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="table-responsive">
            <table id="zero_configuration_table" class="display table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Created By</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($user_roles as $key => $value) {
                        ?>
                        <tr>
                            <th class="align-middle"><?= $key + 1 ?></th>
                            <td class="align-middle"><?= $value->user_role_name ?></td>
                            <td class="align-middle"><?= $value->created_by_user ?></td>
                            <td class="align-middle">
                                <button class="btn btn-success" data-toggle="modal" data-target="#user_roles_<?= $value->user_role_id ?>" title="Edit User Permission">
                                    <span class="fa fa-pen"></span>
                                </button>
                                <a class="btn btn-primary" href="<?= base_url() . 'user-roles-permissions/' . $value->user_role_id ?>" title="Assign User Role's Permission">
                                    <span class="fa fa-lock-alt"></span>
                                </a>
                                <button class="btn btn-danger delete-user_roles" data-id="<?= $value->user_role_id ?>" title="Delete User Permission">
                                    <span class="fa fa-trash"></span>
                                </button>
                            </td>
                        </tr>

                    <div class="modal fade" id="user_roles_<?= $value->user_role_id ?>" data-backdrop="static" data-keyboard="false">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form action="<?= base_url('edit-user-role') ?>" method="post">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit User Role</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12 form-group mb-3">
                                                <label>Name</label>
                                                <input type="text" class="form-control" required="" name="user_role_name" value="<?= $value->user_role_name ?>">
                                                <div class="text-danger"><?= form_error('user_role_name'); ?></div>
                                            </div>
                                        </div>
                                        <input type="hidden" class="form-control" required="" name="user_role_id" value="<?= $value->user_role_id ?>">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Edit User Role</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
        <div class="modal fade" id="add_user_roles" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="<?= base_url('add-user-role') ?>" method="post">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add User Role</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 form-group mb-3">
                                    <label>Name</label>
                                    <input type="text" class="form-control" required="" name="user_role_name" value="<?= set_value('user_role_name') ?>">
                                    <div class="text-danger"><?= form_error('user_role_name'); ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add User Role</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.delete-user_roles').click(function () {
            var user_role_id = $(this).data('id');
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
                $.post('<?= base_url() ?>delete-user-role',
                        {user_role_id: user_role_id},
                function (data, status) {
                    if (status === 'success') {
                        swal({
                            title: "Deleted!",
                            text: "User Permission has been deleted.",
                            type: "success"
                        }).then(function () {
                            window.location.href = '';
                        });
                    }
                });

            })
        });
    });
</script>