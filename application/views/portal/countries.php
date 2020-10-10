<div class="row mb-3 ml-1">
    <?php if (check_route('add-country', 'post')): ?>
        <div class="col-xl-9 col-lg-6 col-md-4">
            <button class="btn btn-primary" data-toggle="modal" data-target="#add_country">Add Country</button>
        </div>

    <?php endif; ?>
    <div class="col-xl-3 col-lg-6 col-md-8">
        <form>
            <div class="row">
                <div class="col-sm-8 mt-3 mt-md-0">
                    <input type="text" value="<?= $search ?>" name="name" class="form-control" placeholder="Country Name">
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
                        <th scope="col">Country Name</th>
                        <th scope="col">Phone Code</th>
                        <th scope="col">Status</th>
                        <th scope="col">Created By</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sr = $this->paginator->get_start_count();
                    foreach ($countries as $key => $value) {
                        ?>
                        <tr>
                            <th class="align-middle"><?= $sr++ ?></th>
                            <td class="align-middle"><?= $value->name ?></td>
                            <td class="align-middle"><?= $value->phonecode ?></td>
                            <td class="align-middle"><?= ($value->active) ? 'Active' : 'Inactive' ?></td>
                            <td class="align-middle"><?= $value->created_by_user ?></td>
                            <td class="align-middle">
                                <?php if (check_route('edit-country', 'post')): ?>
                                    <button class="btn btn-success" data-toggle="modal" data-target="#country_<?= $value->country_id ?>" title="Edit Country">
                                        <span class="fa fa-pen"></span>
                                    </button>
                                    <?php
                                endif;
                                if (check_route('delete-country', 'post')):
                                    ?>
                                    <button class="btn btn-danger delete-country" data-id="<?= $value->country_id ?>" title="Delete Country">
                                        <span class="fa fa-trash"></span>
                                    </button>
                                <?php endif; ?>
                            </td>
                        </tr>

                    <div class="modal fade" id="country_<?= $value->country_id ?>" data-backdrop="static" data-keyboard="false">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form action="<?= base_url('edit-country') ?>" method="post">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Country</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12 form-group mb-3">
                                                <label>Country Name</label>
                                                <input type="text" class="form-control" required="" name="name" value="<?= $value->name ?>">
                                                <div class="text-danger"><?= form_error('name'); ?></div>
                                            </div>
                                            <div class="col-md-12 form-group mb-3">
                                                <label>Phone Code</label>
                                                <input type="text" class="form-control" required="" name="phonecode" value="<?= $value->phonecode ?>">
                                                <div class="text-danger"><?= form_error('phonecode'); ?></div>
                                            </div>
                                            <div class="col-md-12 form-group mb-3">
                                                <label class="switch switch-primary mr-3">
                                                    <span>Status</span>
                                                    <input type="checkbox" name="active" <?= ($value->active) ? 'checked' : '' ?> value="1">
                                                    <span class="slider"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <input type="hidden" class="form-control" required="" name="country_id" value="<?= $value->country_id ?>">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Edit Country</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                if (empty($countries)) {
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
        <div class="modal fade" id="add_country" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="<?= base_url('add-country') ?>" method="post">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Country</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 form-group mb-3">
                                    <label>Country Name</label>
                                    <input type="text" class="form-control" required="" name="name" value="<?= set_value('name') ?>">
                                    <div class="text-danger"><?= form_error('name'); ?></div>
                                </div>
                                <div class="col-md-12 form-group mb-3">
                                    <label>Phone Code</label>
                                    <input type="text" class="form-control" required="" name="phonecode" value="<?= set_value('phonecode') ?>">
                                    <div class="text-danger"><?= form_error('phonecode'); ?></div>
                                </div>
                                <div class="col-md-12 form-group mb-3">
                                    <label class="switch switch-primary mr-3">
                                        <span>Status</span>
                                        <input type="checkbox" name="active" checked value="1">
                                        <span class="slider"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Country</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.delete-country').click(function () {
            var country_id = $(this).data('id');
            swal({
                title: 'Are you sure?',
                text: "Its states & cities will also be deleted.",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
                $.post('<?= base_url() ?>delete-country',
                        {country_id: country_id},
                        function (data, status) {
                            if (status === 'success') {
                                swal({
                                    title: "Deleted!",
                                    text: "Country has been deleted.",
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