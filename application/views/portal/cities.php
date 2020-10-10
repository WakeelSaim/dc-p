<div class="row mb-3 ml-1">
    <?php
    if (check_route('add-city', 'post')):
        ?>
        <div class="col-xl-9 col-lg-6 col-md-4">
            <button class="btn btn-primary" data-toggle="modal" data-target="#add_city">Add City</button>
        </div>
    <?php endif; ?>
    <div class="col-xl-3 col-lg-6 col-md-8">
        <form>
            <div class="row">
                <div class="col-sm-8 mt-3 mt-md-0">
                    <input type="text" value="<?= $search ?>" name="name" class="form-control" placeholder="City or Country Name">
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
                        <th scope="col">City Name</th>
                        <th scope="col">Country</th>
                        <th scope="col">State</th>
                        <th scope="col">Status</th>
                        <th scope="col">Created By</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sr = $this->paginator->get_start_count();
                    foreach ($cities as $key => $value) {
                        ?>
                        <tr>
                            <th class="align-middle"><?= $sr++ ?></th>
                            <td class="align-middle"><?= $value->name ?></td>
                            <td class="align-middle"><?= $value->country_name ?></td>
                            <td class="align-middle"><?= $value->state_name ?></td>
                            <td class="align-middle"><?= ($value->active) ? 'Active' : 'Inactive' ?></td>
                            <td class="align-middle"><?= $value->created_by_user ?></td>
                            <td class="align-middle">
                                <?php
                                if (check_route('edit-city', 'post')):
                                    ?>
                                    <button class="btn btn-success" data-toggle="modal" data-target="#city_<?= $value->city_id ?>" title="Edit City">
                                        <span class="fa fa-pen"></span>
                                    </button>
                                    <?php
                                endif;
                                if (check_route('delete-city', 'post')):
                                    ?>
                                    <button class="btn btn-danger delete-city" data-id="<?= $value->city_id ?>" title="Delete City">
                                        <span class="fa fa-trash"></span>
                                    </button>
                                <?php endif;
                                ?>
                            </td>
                        </tr>

                    <div class="modal fade city_modal" id="city_<?= $value->city_id ?>" data-backdrop="static" data-keyboard="false">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form action="<?= base_url('edit-city') ?>" method="post">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit City</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12 form-group mb-3">
                                                <label>City Name</label>
                                                <input type="text" class="form-control" required="" name="name" value="<?= $value->name ?>">
                                                <div class="text-danger"><?= form_error('name'); ?></div>
                                            </div>
                                            <div class="col-md-12 form-group mb-3">
                                                <label>Country</label>
                                                <select class="form-control select2-country-ajax" required="" name="country_id" val="<?= $value->country_id ?>">
                                                    <option value="<?= $value->country_id ?>" selected="selected"><?= $value->country_name ?></option>
                                                </select>
                                                <div class="text-danger"><?= form_error('country_id'); ?></div>
                                            </div>
                                            <div class="col-md-12 form-group mb-3">
                                                <label>State</label>
                                                <select class="form-control select2 loaded-states" required="" name="state_id" val="<?= $value->state_id ?>"></select>
                                                <div class="text-danger"><?= form_error('state_id'); ?></div>
                                            </div>
                                            <div class="col-md-12 form-group mb-3">
                                                <label class="switch switch-primary mr-3">
                                                    <span>Status</span>
                                                    <input type="checkbox" name="active" <?= ($value->active) ? 'checked' : '' ?> value="1">
                                                    <span class="slider"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <input type="hidden" class="form-control" required="" name="city_id" value="<?= $value->city_id ?>">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Edit City</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                if (empty($cities)) {
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
        <div class="modal fade" id="add_city" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="<?= base_url('add-city') ?>" method="post">
                        <div class="modal-header">
                            <h5 class="modal-title">Add City</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 form-group mb-3">
                                    <label>City Name</label>
                                    <input type="text" class="form-control" required="" name="name" value="<?= set_value('name') ?>">
                                    <div class="text-danger"><?= form_error('name'); ?></div>
                                </div>
                                <div class="col-md-12 form-group mb-3">
                                    <label>Country</label>
                                    <select class="form-control select2-country-ajax" required="" name="country_id" value="<?= set_value('country_id') ?>"></select>
                                    <div class="text-danger"><?= form_error('country_id'); ?></div>
                                </div>
                                <div class="col-md-12 form-group mb-3">
                                    <label>State</label>
                                    <select class="form-control select2 loaded-states" required="" name="state_id" value="<?= set_value('state_id') ?>"></select>
                                    <div class="text-danger"><?= form_error('state_id'); ?></div>
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
                            <button type="submit" class="btn btn-primary">Add City</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.delete-city').click(function () {
            var city_id = $(this).data('id');
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
                $.post('<?= base_url() ?>delete-city',
                        {city_id: city_id},
                        function (data, status) {
                            if (status === 'success') {
                                swal({
                                    title: "Deleted!",
                                    text: "City has been deleted.",
                                    type: "success"
                                }).then(function () {
                                    window.location.href = '';
                                });
                            }
                        });

            })
        });

        $('.select2-country-ajax').change(function () {
            if ($(this).closest('.modal').hasClass('show')) {
                var country_id = $(this).val();
                var html_data = '<option value="">Select State</option>';
                var state_selector = $(this).closest('.row').find('.loaded-states');
                var val = $(state_selector).attr('val');
                if (country_id !== '' && country_id !== undefined) {
                    jQuery("#ajax-preloader").show();
                    $.post('<?= base_url() ?>get-states-by-country',
                            {country_id: country_id},
                            function (data) {
                                data = JSON.parse(data);
                                $.each(data, function (i, item) {
                                    if (val === item.state_id) {
                                        var selected = 'selected';
                                    } else {
                                        var selected = '';
                                    }
                                    html_data = html_data + '<option value="' + item.state_id + '" ' + selected + '>' + item.name + '</option>';
                                });
                                $(state_selector).html(html_data);
                                jQuery("#ajax-preloader").delay(500).fadeOut("slow");
                            });
                }
            }
        });

        $('.city_modal').on('shown.bs.modal', function () {
            $(this).find('.select2-country-ajax').trigger('change');
        });
    });
</script>