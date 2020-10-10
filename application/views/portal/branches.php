<div class="row mb-3 ml-1">
    <?php if (check_route('add-branch', 'post')): ?>
        <div class="col-xl-9 col-lg-6 col-md-4">
            <button class="btn btn-primary" data-toggle="modal" data-target="#add_branch">Add Branch</button>
        </div>

    <?php endif; ?>
    <div class="col-xl-3 col-lg-6 col-md-8">
        <form>
            <div class="row">
                <div class="col-sm-8 mt-3 mt-md-0">
                    <input type="text" value="<?= $search ?>" name="name" class="form-control" placeholder="Branch Name">
                </div>
                <div class="col-sm-4 mt-3 mt-md-0">
                    <button type="submit" class="btn btn-primary btn-block">Search</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="table-responsive">
            <table class="display table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Branch Name</th>
                        <th scope="col">Address</th>
                        <th scope="col">Contact</th>
                        <th scope="col">Created By</th>
                        <th scope="col">Updated At</th>
                        <th scope="col">Updated By</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sr = $this->paginator->get_start_count();
                    foreach ($branches as $key => $value) {
                        ?>
                        <tr>
                            <th class="align-middle"><?= $sr++ ?></th>
                            <td class="align-middle"><?= $value->branch_name ?></td>
                            <td class="align-middle"><?= $value->branch_address ?></td>
                            <td class="align-middle"><?= $value->branch_contact ?></td>
                            <td class="align-middle"><?= $value->created_by_user ?></td>
                            <td class="align-middle"><?= $value->updated_at ?></td>
                            <td class="align-middle"><?= get_admin_name_by_id($value->updated_by) ?></td>
                            <td class="align-middle">
                                <?php if (check_route('edit-branch', 'post')): ?>
                                    <button class="btn btn-success" data-toggle="modal" data-target="#branch_<?= $value->branch_id ?>" title="Edit Branch">
                                        <span class="fa fa-pen"></span>
                                    </button>
                                    <?php
                                endif;
                                if (check_route('delete-branch', 'post')):
                                    ?>
                                    <button class="btn btn-danger delete-branch" data-id="<?= $value->branch_id ?>" title="Delete Branch">
                                        <span class="fa fa-trash"></span>
                                    </button>
                                <?php endif; ?>
                            </td>
                        </tr>

                    <div class="modal fade" id="branch_<?= $value->branch_id ?>" data-backdrop="static" data-keyboard="false">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form action="<?= base_url('edit-branch') ?>" method="post">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Branch</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12 form-group mb-3">
                                                <label>Branch Name</label>
                                                <input type="text" class="form-control" required="" name="branch_name" value="<?= $value->branch_name ?>">
                                                <div class="text-danger"><?= form_error('branch_name'); ?></div>
                                            </div>
                                            <div class="col-md-12 form-group mb-3">
                                                <label>Branch Address</label>
                                                <input type="text" class="form-control" required="" name="branch_address" value="<?= $value->branch_address ?>">
                                                <div class="text-danger"><?= form_error('branch_address'); ?></div>
                                            </div>
                                            <div class="col-md-12 form-group mb-3">
                                                <label>Branch Contact</label>
                                                <input type="text" class="form-control" required="" name="branch_contact" value="<?= $value->branch_contact ?>">
                                                <div class="text-danger"><?= form_error('branch_contact'); ?></div>
                                            </div>
                                        </div>
                                        <input type="hidden" class="form-control" required="" name="branch_id" value="<?= $value->branch_id ?>">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Edit Branch</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                if (empty($branches)) {
                    ?>
                    <tr>
                        <td colspan="100" class="text-center">No Record Found</td>
                    </tr>
                <?php }
                ?>
                </tbody>
            </table>
        </div>
        <?php echo $this->paginator->get_links(); ?>
        <div class="modal fade" id="add_branch" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="<?= base_url('add-branch') ?>" method="post">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Branch</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 form-group mb-3">
                                    <label>Branch Name</label>
                                    <input type="text" class="form-control" required="" name="branch_name" value="<?= set_value('branch_name') ?>">
                                    <div class="text-danger"><?= form_error('branch_name'); ?></div>
                                </div>
                                <div class="col-md-12 form-group mb-3">
                                    <label>Branch Address</label>
                                    <input type="text" class="form-control" required="" name="branch_address" value="<?= set_value('branch_address') ?>">
                                    <div class="text-danger"><?= form_error('branch_address'); ?></div>
                                </div>
                                <div class="col-md-12 form-group mb-3">
                                    <label>Branch Contact</label>
                                    <input type="text" class="form-control" required="" name="branch_contact" value="<?= set_value('branch_contact') ?>">
                                    <div class="text-danger"><?= form_error('branch_contact'); ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Branch</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.delete-branch').click(function () {
            var branch_id = $(this).data('id');
            swal({
                title: 'Are you sure?',
                text: "Its states & cities will also be deleted.",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
                $.post('<?= base_url() ?>delete-branch',
                        {branch_id: branch_id},
                function (data, status) {
                    if (status === 'success') {
                        swal({
                            title: "Deleted!",
                            text: "Branch has been deleted.",
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