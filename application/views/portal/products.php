<div class="row mb-3 ml-1">
    <?php if (check_route('add-product', 'post')): ?>
        <div class="col-xl-9 col-lg-6 col-md-4">
            <button class="btn btn-primary" data-toggle="modal" data-target="#add_product">Add Product</button>
        </div>

    <?php endif; ?>
    <div class="col-xl-3 col-lg-6 col-md-8">
        <form>
            <div class="row">
                <div class="col-sm-8 mt-3 mt-md-0">
                    <input type="text" value="<?= $search ?>" name="product_name" class="form-control" placeholder="Product Name">
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
                        <th scope="col">Product Name</th>
                        <th scope="col">Purchase Rate</th>
                        <th scope="col">Retail Rate</th>
                        <th scope="col">Status</th>
                        <th scope="col">Created By</th>
                        <th scope="col">Updated By</th>
                        <th scope="col">Updated At</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sr = $this->paginator->get_start_count();
                    foreach ($products as $key => $value) {
                        ?>
                        <tr>
                            <th class="align-middle"><?= $sr++ ?></th>
                            <td class="align-middle"><?= $value->product_name ?></td>
                            <td class="align-middle"><?= $value->product_purchaserate ?></td>
                            <td class="align-middle"><?= $value->product_retailrate ?></td>
                            <td class="align-middle"><?= ($value->is_active) ? 'Active' : 'Inactive' ?></td>
                            <td class="align-middle"><?= $value->created_by_user ?></td>
                            <td class="align-middle">
                                <?php if (check_route('edit-product', 'post')): ?>
                                    <button class="btn btn-success" data-toggle="modal" data-target="#product_<?= $value->product_id ?>" title="Edit Product">
                                        <span class="fa fa-pen"></span>
                                    </button>
                                    <?php
                                endif;
                                if (check_route('delete-product', 'post')):
                                    ?>
                                    <button class="btn btn-danger delete-product" data-id="<?= $value->product_id ?>" title="Delete Product">
                                        <span class="fa fa-trash"></span>
                                    </button>
                                <?php endif; ?>
                            </td>
                        </tr>

                    <div class="modal fade" id="product_<?= $value->product_id ?>" data-backdrop="static" data-keyboard="false">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form action="<?= base_url('edit-product') ?>" method="post">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12 form-group mb-3">
                                                <label>Product Name</label>
                                                <input type="text" class="form-control" required="" name="product_name" value="<?= $value->product_name ?>">
                                                <div class="text-danger"><?= form_error('product_name'); ?></div>
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
                                        <input type="hidden" class="form-control" required="" name="product_id" value="<?= $value->product_id ?>">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Edit Product</button>
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
        <div class="modal fade" id="add_product" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="<?= base_url('add-product') ?>" method="post">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 form-group mb-3">
                                    <label>Product Name</label>
                                    <input type="text" class="form-control" required="" name="product_name" value="<?= set_value('product_name') ?>">
                                    <div class="text-danger"><?= form_error('product_name'); ?></div>
                                </div>
                                <div class="col-md-12 form-group mb-3">
                                    <label>Purchase Rate</label>
                                    <input type="number" class="form-control" required="" name="product_purchaserate" value="<?= set_value('product_purchaserate') ?>">
                                    <div class="text-danger"><?= form_error('product_purchaserate'); ?></div>
                                </div>
                                <div class="col-md-12 form-group mb-3">
                                    <label>Purchase Rate</label>
                                    <input type="number" class="form-control" required="" name="product_purchaserate" value="<?= set_value('product_purchaserate') ?>">
                                    <div class="text-danger"><?= form_error('product_purchaserate'); ?></div>
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
                            <button type="submit" class="btn btn-primary">Add Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.delete-product').click(function () {
            var product_id = $(this).data('id');
            swal({
                title: 'Are you sure?',
                text: "Its states & cities will also be deleted.",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
                $.post('<?= base_url() ?>delete-product',
                        {product_id: product_id},
                        function (data, status) {
                            if (status === 'success') {
                                swal({
                                    title: "Deleted!",
                                    text: "Product has been deleted.",
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