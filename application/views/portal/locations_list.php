<div class="row mb-3 ml-1">
    <?php
    if (check_route('add-location', 'post')):
        ?>
        <div class="col-xl-9 col-lg-6 col-md-4">
            <button class="btn btn-primary" data-toggle="modal" data-target="#add_location">Add Location</button>
        </div>
    <?php endif; ?>
    <div class="col-xl-3 col-lg-6 col-md-8">
        <form>
            <div class="row">
                <div class="col-sm-8 mt-3 mt-md-0">
                    <input type="text" value="<?= $search ?>" name="name" class="form-control" placeholder="Location or Country Name">
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
                        <th scope="col">State</th>
                        <th scope="col">Location</th>
                        <th scope="col">Location</th>
                        <th scope="col">Created By</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sr = $this->paginator->get_start_count();
                    foreach ($locations as $key => $value) {
                        ?>
                        <tr>
                            <th class="align-middle"><?= $sr++ ?></th>
                            <td class="align-middle"><?= $value->state_name ?></td>
                            <td class="align-middle"><?= $value->name ?></td>
                            <td class="align-middle"><?= $value->address ?></td>
                            <td class="align-middle"><?= $value->created_by_user ?></td>
                            <td class="align-middle">
                                <?php
                                if (check_route('edit-location', 'post')):
                                    ?>
<!--                                    <button class="btn btn-success" data-toggle="modal" data-target="#location_<?= $value->location_id ?>" title="Edit Location">
                                        <span class="fa fa-pen"></span>
                                    </button>-->
                                    <?php
                                endif;
                                if (check_route('delete-location', 'post')):
                                    ?>
                                    <button class="btn btn-danger delete-location" data-id="<?= $value->location_id ?>" title="Delete Location">
                                        <span class="fa fa-trash"></span>
                                    </button>
                                <?php endif;
                                ?>
                            </td>
                        </tr>

                    <div class="modal fade location_modal" id="location_<?= $value->location_id ?>" data-backdrop="static" data-keyboard="false">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form action="<?= base_url('edit-location') ?>" method="post">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Location</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-md-12 form-group mb-3">
                                            <label>State</label>
                                            <select class="form-control " required="" name="state_id" val="<?= $value->state_id ?>">
                                                <?php foreach ($states as $st) { ?>
                                                    <option value="<?= $st->state_id ?>"><?= $st->name ?></option>
                                                <?php } ?>
                                            </select>
                                            <div class="text-danger"><?= form_error('state_id'); ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 form-group mb-3">
                                                <label>City</label>
                                                <input type="text" class="form-control" required="" name="name" value="<?= $value->name ?>">
                                                <div class="text-danger"><?= form_error('name'); ?></div>
                                            </div>
                                            <div class="col-md-12 form-group mb-3">
                                                <label>Agent</label>
                                                <select class="form-control select2-country-ajax" required="" name="agent_id" val="<?= $value->id ?>">
                                                    <option value="<?= $value->id ?>" selected="selected"><?= $value->first_name . ' ' . $value->last_name ?></option>
                                                </select>
                                                <div class="text-danger"><?= form_error('agent_id'); ?></div>
                                            </div>
                                        </div>
                                        <input type="hidden" class="form-control" required="" name="location_id" value="<?= $value->location_id ?>">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Edit Location</button>
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
        <div class="modal fade" id="add_location" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="<?= base_url('add-location') ?>" method="post">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Location</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 form-group mb-3">
                                    <label>State</label>
                                    <select class="form-control add-states" id="" required="" name="state_id">
                                        <option value="">Select State</option>
                                        <?php foreach ($states as $st) { ?>
                                            <option value="<?= $st->state_id ?>"><?= $st->name ?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="text-danger"><?= form_error('state_id'); ?></div>
                                </div>
                                <div class="col-md-12 form-group mb-3">
                                    <label>City</label>
                                    <select class="form-control add-cities" id="" required="" name="city_id" >

                                    </select>
                                    <div class="text-danger"><?= form_error('city_id'); ?></div>
                                </div>
                                <div class="col-md-12 form-group mb-3">
                                    <label>Agent</label>
                                    <select class="form-control add-agents" required="" name="agent_id">

                                    </select>
                                    <div class="text-danger"><?= form_error('agent_id'); ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Location</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.delete-location').click(function () {
            var location_id = $(this).data('id');
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
                $.post('<?= base_url() ?>delete-location',
                        {location_id: location_id},
                        function (data, status) {
                            if (status === 'success') {
                                swal({
                                    title: "Deleted!",
                                    text: "Location has been deleted.",
                                    type: "success"
                                }).then(function () {
                                    window.location.href = '';
                                });
                            }
                        });

            });

        });

        $('.add-states').on('change', function () {
            var state_id = $(this).val();
            $.post('<?= base_url() ?>get-city-by-state',
                    {state_id: state_id},
                    function (data) {
                        $('.add-cities').html(data);
                    });
        });

        $('.add-cities').on('change', function () {
            var city_id = $(this).val();
            $.post('<?= base_url() ?>get-agent-by-city',
                    {city_id: city_id},
                    function (data) {
                        $('.add-agents').html(data);
                    });
        });

    });
</script>