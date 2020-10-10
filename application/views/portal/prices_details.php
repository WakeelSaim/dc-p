<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="table-responsive">
            <table class="display table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Service</th>
                        <th scope="col">Price</th>
                        <th scope="col">Updated At</th>
                        <th scope="col">Updated By</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($service_details as $key => $value) {
                        ?>
                        <tr>
                            <th class="align-middle"><?= $key + 1 ?></th>
                            <td class="align-middle"><?= $value->subservice_name ?></td>
                            <td class="align-middle">
                                <div class="row">
                                    <div class="col-sm-10">
                                        <input readonly="" class="form-control price price-<?= $value->service_price_id ?>" value="<?= $value->service_price ?>">
                                    </div>
                                    <div class="col-sm-2">
                                        <button class="btn btn-primary edit-price edit-price-<?= $value->service_price_id ?>" data-id="<?= $value->service_price_id ?>"><span class="fas fa-pen"></span></button>
                                        <button class="btn btn-success save-price save-price-<?= $value->service_price_id ?> d-none" data-id="<?= $value->service_price_id ?>"><span class="fas fa-check"></span></button>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle updated-at-<?= $value->service_price_id ?>"><?= $value->updated_at ?></td>
                            <td class="align-middle updated-by-<?= $value->service_price_id ?>"><?= $value->updated_by_user ?></td>
                        </tr>
                    <?php }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.edit-price').click(function () {
            var id = $(this).data('id');
            $('.price-' + id).prop('readonly', false).focus();
            $(this).addClass('d-none');
            $('.save-price-'+id).removeClass('d-none');
        });
        $('.save-price').click(function () {
            var id = $(this).data('id');
            swal({
                title: 'Are you sure?',
                text: "The price will be updated for all future requests!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, update it!'
            }).then(function () {
                $('.price-' + id).prop('readonly', true);
                var price = $('.price-' + id).val();
                $('.save-price-'+id).addClass('d-none');
                $('.edit-price-'+id).removeClass('d-none');
                $.post('<?= base_url() ?>update-price',
                        {service_price_id: id, service_price: price},
                        function (data, status) {
                            if (status === 'success') {
                                swal({
                                    title: "Updated!",
                                    text: "Price has been deleted.",
                                    type: "success"
                                }).then(function () {
                                    data = JSON.parse(data);
                                    $('.updated-at-' + data.id).html(data.updated_at);
                                    $('.updated-by-' + data.id).html(data.name);
                                });
                            }
                        });

            })
        });
    });
</script>
