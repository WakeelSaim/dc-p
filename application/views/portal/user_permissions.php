<div class="row mb-3 ml-1">
    <div class="col-xl-9 col-lg-6 col-md-4">
        <button class="btn btn-primary" data-toggle="modal" data-target="#add_user_permissions">Add User Permission</button>
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
                        <th scope="col">Route</th>
                        <th scope="col">URL</th>
                        <th scope="col">Type</th>
                        <th scope="col">Created By</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($user_permissions as $key => $value) {
                        ?>
                        <tr>
                            <th class="align-middle"><?= $key + 1 ?></th>
                            <td class="align-middle"><?= $value->user_permission_name ?></td>
                            <td class="align-middle"><?= $value->user_permission_route ?></td>
                            <td class="align-middle"><?= $value->user_permission_url ?></td>
                            <td class="align-middle"><?= $value->user_permission_type ?></td>
                            <td class="align-middle"><?= $value->created_by_user ?></td>
                            <td class="align-middle">
                                <button class="btn btn-success" data-toggle="modal" data-target="#user_permissions_<?= $value->user_permission_id ?>" title="Edit User Permission">
                                    <span class="fa fa-pen"></span>
                                </button>
                                <button class="btn btn-danger delete-user_permissions" data-id="<?= $value->user_permission_id ?>" title="Delete User Permission">
                                    <span class="fa fa-trash"></span>
                                </button>
                            </td>
                        </tr>

                    <div class="modal fade" id="user_permissions_<?= $value->user_permission_id ?>" data-backdrop="static" data-keyboard="false">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form action="<?= base_url('edit-user-permission') ?>" method="post">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit User Permission</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12 form-group mb-3">
                                                <label>Name</label>
                                                <input type="text" class="form-control" required="" name="user_permission_name" value="<?= $value->user_permission_name ?>">
                                                <div class="text-danger"><?= form_error('user_permission_name'); ?></div>
                                            </div>
                                            <div class="col-md-12 form-group mb-3">
                                                <label>Route</label>
                                                <input type="text" class="form-control" required="" name="user_permission_route" value="<?= $value->user_permission_route ?>">
                                                <div class="text-danger"><?= form_error('user_permission_route'); ?></div>
                                            </div>
                                            <div class="col-md-12 form-group mb-3">
                                                <label>URL</label>
                                                <input type="text" class="form-control" required="" name="user_permission_url" value="<?= $value->user_permission_url ?>">
                                                <div class="text-danger"><?= form_error('user_permission_url'); ?></div>
                                            </div>
                                            <div class="col-md-12 form-group mb-3">
                                                <label>Type</label>
                                                <input type="text" class="form-control" required="" name="user_permission_type" value="<?= $value->user_permission_type ?>">
                                                <div class="text-danger"><?= form_error('user_permission_type'); ?></div>
                                            </div>
                                        </div>
                                        <input type="hidden" class="form-control" required="" name="user_permission_id" value="<?= $value->user_permission_id ?>">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Edit User Permission</button>
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
        <div class="modal fade" id="add_user_permissions" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="<?= base_url('add-user-permission') ?>" method="post">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add User Permission</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 form-group mb-3">
                                    <label>User Permission Name</label>
                                    <input type="text" class="form-control" required="" name="user_permission_name" value="<?= set_value('user_permission_name') ?>">
                                    <div class="text-danger"><?= form_error('user_permission_name'); ?></div>
                                </div>
                                <div class="col-md-12 form-group mb-3">
                                    <label>Route</label>
                                    <input type="text" class="form-control" required="" name="user_permission_route" value="<?= set_value('user_permission_route') ?>">
                                    <div class="text-danger"><?= form_error('user_permission_route'); ?></div>
                                </div>
                                <div class="col-md-12 form-group mb-3">
                                    <label>URL</label>
                                    <input type="text" class="form-control" required="" name="user_permission_url" value="<?= set_value('user_permission_url') ?>">
                                    <div class="text-danger"><?= form_error('user_permission_url'); ?></div>
                                </div>
                                <div class="col-md-12 form-group mb-3">
                                    <label>Type</label>
                                    <input type="text" class="form-control" required="" name="user_permission_type" value="<?= set_value('user_permission_type') ?>">
                                    <div class="text-danger"><?= form_error('user_permission_type'); ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add User Permission</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.delete-user_permissions').click(function () {
            var user_permission_id = $(this).data('id');
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
                $.post('<?= base_url() ?>delete-user-permission',
                        {user_permission_id: user_permission_id},
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