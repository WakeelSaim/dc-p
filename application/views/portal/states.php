<div class="row mb-3 ml-1">
    <?php if (check_route('add-state', 'post')): ?>
        <div class="col-xl-9 col-lg-6 col-md-4">
            <button class="btn btn-primary" data-toggle="modal" data-target="#add_state">Add State</button>
        </div>
    <?php endif; ?>
    <div class="col-xl-3 col-lg-6 col-md-8">
        <form>
            <div class="row">
                <div class="col-sm-8 mt-3 mt-md-0">
                    <input type="text" value="<?= $search ?>" name="name" class="form-control" placeholder="State or Country Name">
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
                        <th scope="col">State Name</th>
                        <th scope="col">Country</th>
                        <th scope="col">Tax Type</th>
                        <th scope="col">Tax Rate %</th>
                        <th scope="col">Status</th>
                        <th scope="col">Created By</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sr = $this->paginator->get_start_count();
                    foreach ($states as $key => $value) {
                        ?>
                        <tr>
                            <th class="align-middle"><?= $sr++ ?></th>
                            <td class="align-middle"><?= $value->name ?></td>
                            <td class="align-middle"><?= $value->country_name ?></td>
                            <td class="align-middle"><?= ($value->tax_type) ? $value->tax_type : '-' ?></td>
                            <td class="align-middle"><?= ($value->tax_rate) ? $value->tax_rate : '0' ?></td>
                            <td class="align-middle"><?= ($value->active) ? 'Active' : 'Inactive' ?></td>
                            <td class="align-middle"><?= $value->created_by_user ?></td>
                            <td class="align-middle">
                                <?php if (check_route('edit-state', 'post')): ?>
                                    <button class="btn btn-success" data-toggle="modal" data-target="#state_<?= $value->state_id ?>" title="Edit State">
                                        <span class="fa fa-pen"></span>
                                    </button>
                                    <?php
                                endif;
                                if (check_route('delete-state', 'post')):
                                    ?>
                                    <button class="btn btn-danger delete-state" data-id="<?= $value->state_id ?>" title="Delete State">
                                        <span class="fa fa-trash"></span>
                                    </button>
                                <?php endif; ?>
                            </td>
                        </tr>

                    <div class="modal fade" id="state_<?= $value->state_id ?>" data-backdrop="static" data-keyboard="false">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form action="<?= base_url('edit-state') ?>" method="post">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit State</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12 form-group mb-3">
                                                <label>State Name</label>
                                                <input type="text" class="form-control" required="" name="name" value="<?= $value->name ?>">
                                                <div class="text-danger"><?= form_error('name'); ?></div>
                                            </div>
                                            <div class="col-md-12 form-group mb-3">
                                                <label>Country</label>
                                                <select class="form-control select2-country-ajax" required="" name="country_id" value="<?= set_value('country_id') ?>">
                                                    <option value="<?= $value->country_id ?>" selected="selected"><?= $value->country_name ?></option>
                                                </select>
                                                <div class="text-danger"><?= form_error('country_id'); ?></div>
                                            </div>
                                            <div class="col-md-5 form-group mb-3">
                                                <label>Tax Type</label>
                                                <div class="row">
                                                    <div class="col-sm-5">
                                                        <label class="radio radio-primary">
                                                            <input type="radio" required="" <?= ($value->tax_type == 'GST') ? 'checked' : '' ?> name="tax_type" value="GST">
                                                            <span>GST</span>
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <label class="radio radio-primary">
                                                            <input type="radio" required="" <?= ($value->tax_type == 'HST') ? 'checked' : '' ?> name="tax_type" value="HST">
                                                            <span>HST</span>
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-7 form-group mb-3">
                                                <label>Tax Rate %</label>
                                                <input type="number" min="0" max="100" class="form-control" required="" name="tax_rate" value="<?= $value->tax_rate ?>">
                                                <div class="text-danger"><?= form_error('tax_rate'); ?></div>
                                            </div>
                                            <div class="col-md-12 form-group mb-3">
                                                <label class="switch switch-primary mr-3">
                                                    <span>Active Status</span>
                                                    <input type="checkbox" name="active" <?= ($value->active) ? 'checked' : '' ?> value="1">
                                                    <span class="slider"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <input type="hidden" class="form-control" required="" name="state_id" value="<?= $value->state_id ?>">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Edit State</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                if (empty($states)) {
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
        <div class="modal fade" id="add_state" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="<?= base_url('add-state') ?>" method="post">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add State</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 form-group mb-3">
                                    <label>State Name</label>
                                    <input type="text" class="form-control" required="" name="name" value="<?= set_value('name') ?>">
                                    <div class="text-danger"><?= form_error('name'); ?></div>
                                </div>
                                <div class="col-md-12 form-group mb-3">
                                    <label>Country</label>
                                    <select class="form-control select2-country-ajax" required="" name="country_id" value="<?= set_value('country_id') ?>"></select>
                                    <div class="text-danger"><?= form_error('country_id'); ?></div>
                                </div>
                                <div class="col-md-5 form-group mb-3">
                                    <label>Tax Type</label>
                                    <div class="row">
                                        <div class="col-sm-5">
                                            <label class="radio radio-primary">
                                                <input type="radio" required="" checked="" name="tax_type" value="GST">
                                                <span>GST</span>
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="col-sm-5">
                                            <label class="radio radio-primary">
                                                <input type="radio" required="" name="tax_type" value="HST">
                                                <span>HST</span>
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7 form-group mb-3">
                                    <label>Tax Rate %</label>
                                    <input type="number" min="0" max="100" class="form-control" required="" name="tax_rate">
                                    <div class="text-danger"><?= form_error('tax_rate'); ?></div>
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
                            <button type="submit" class="btn btn-primary">Add State</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.delete-state').click(function () {
            var state_id = $(this).data('id');
            swal({
                title: 'Are you sure?',
                text: "Its cities will also be deleted.",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
                $.post('<?= base_url() ?>delete-state',
                        {state_id: state_id},
                        function (data, status) {
                            if (status === 'success') {
                                swal({
                                    title: "Deleted!",
                                    text: "State has been deleted.",
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