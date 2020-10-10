<div class="row mb-3 ml-1">
    <div class="col-xl-9 col-lg-6 col-md-4">
        <button class="btn btn-primary" data-toggle="modal" data-target="#add_office_desk">Add Document</button>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-8">
        <form>
            <div class="row">
                <div class="col-sm-8 mt-3 mt-md-0">
                    <input type="text" value="<?= $search ?>" name="name" class="form-control" placeholder="Document Name">
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
                        <th scope="col">Document Name</th>
                        <th scope="col">Created By</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sr = $this->paginator->get_start_count();
                    foreach ($office_desk as $key => $value) {
                        ?>
                        <tr>
                            <th class="align-middle"><?= $sr++ ?></th>
                            <td class="align-middle"><?= $value->office_desk_name ?></td>
                            <td class="align-middle"><?= $value->created_by_user ?></td>
                            <td class="align-middle"><?= $value->created_at ?></td>
                            <td class="align-middle">
                                <button class="btn btn-success" data-toggle="modal" data-target="#office_desk_<?= $value->office_desk_id ?>" title="Edit Document">
                                    <span class="fa fa-pen"></span>
                                </button>
                                <a class="btn btn-primary" href="<?= base_url() ?>download-office-desk-document/<?= $value->office_desk_id ?>" title="Download Document">
                                    <span class="fa fa-download"></span>
                                </a>
                                <button class="btn btn-danger delete-office-desk" data-id="<?= $value->office_desk_id ?>" title="Delete Document">
                                    <span class="fa fa-trash"></span>
                                </button>
                            </td>
                        </tr>

                    <div class="modal fade" id="office_desk_<?= $value->office_desk_id ?>" data-backdrop="static" data-keyboard="false">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form action="<?= base_url('edit-office-desk') ?>" method="post">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Document</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12 form-group mb-3">
                                                <label>Document Name</label>
                                                <input type="text" class="form-control" required="" name="office_desk_name" value="<?= $value->office_desk_name ?>">
                                                <div class="text-danger"><?= form_error('office_desk_name'); ?></div>
                                            </div>
                                        </div>
                                        <input type="hidden" class="form-control" required="" name="office_desk_id" value="<?= $value->office_desk_id ?>">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Edit Document</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                if (empty($office_desk)) {
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
        <div class="modal fade" id="add_office_desk" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="<?= base_url('add-office-desk') ?>" method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Document</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 form-group mb-3">
                                    <label>Document Name</label>
                                    <input type="text" class="form-control" required="" name="office_desk_name" value="<?= set_value('office_desk_name') ?>">
                                    <div class="text-danger"><?= form_error('office_desk_name'); ?></div>
                                </div>
                                <div class="col-md-12 form-group mb-3">
                                    <label>File</label>
                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <input type="file" required="" class="custom-file-input" name="office_desk_file" id="office_desk_file">
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Document</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.delete-office-desk').click(function () {
            var office_desk_id = $(this).data('id');
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
                $.post('<?= base_url() ?>delete-office-desk',
                        {office_desk_id: office_desk_id},
                        function (data, status) {
                            if (status === 'success') {
                                swal({
                                    title: "Deleted!",
                                    text: "Document has been deleted.",
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