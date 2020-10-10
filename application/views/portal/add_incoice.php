
<!--<div class="d-sm-flex mb-5" data-view="print">
    <span class="m-auto"></span>
    <button class="btn btn-primary mb-sm-0 mb-3 print-invoice">Print Invoice</button>
</div>-->
<!---===== Print Area =======-->
<div id="print-area">
    <!--    <div class="row">
            <div class="col-md-6">
                <h4 class="font-weight-bold">Invoice ID</h4>
                <p>#106</p>
            </div>
            <div class="col-md-6 text-sm-right">
                <p><strong>Order date: </strong> 10 Dec, 2018</p>
            </div>
        </div>-->
    <form action="<?= base_url() ?>add-invoice-save" method="post">
        <div class="mt-3 mb-4"></div>
        <div class="row mb-5">
            <div class="col-md-6 mb-3 mb-sm-0">
                <h5 class="font-weight-bold">Bill From</h5>
                <p>Global Avenues Consulting Inc.</p>
                <span style="white-space: pre-line">
                    admin@gac.com
                    +202-555-0170
                </span>
            </div>
            <div class="col-md-6 text-sm-right">
                <h5 class="font-weight-bold">Bill To</h5>
                <p><?= $user_data->first_name . ' ' . $user_data->last_name ?></p>
                <span style="white-space: pre-line">
                    <?= $user_data->email ?>
                </span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 table-responsive">
                <table class="table mb-4">
                    <thead class="bg-gray-300">
                        <tr>
                            <th scope="col">Service</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($name_based_total) {
                            ?>
                            <tr>
                                <td>
                                    <input value="Name Based Check" type="text" readonly="" class="form-control" name="name[]">
                                </td>
                                <td>
                                    <input value="<?= $name_based_count ?>" readonly="" name="quantity[]" type="number" class="form-control" placeholder="Quantity">
                                </td>
                                <td>
                                    <input value="<?= $name_based_total ?>" name="total[]" type="number" class="form-control" placeholder="Total">
                                </td>

                            </tr>
                        <?php } ?>
                        <?php
                        if ($digital_total) {
                            ?>
                            <tr>
                                <td>
                                    <input value="Digital Fingerprinting" type="text" readonly="" class="form-control" name="name[]">
                                </td>
                                <td>
                                    <input value="<?= $digital_count ?>" readonly="" name="quantity[]" type="number" class="form-control" placeholder="Quantity">
                                </td>
                                <td>
                                    <input value="<?= $digital_total ?>" name="total[]" type="number" class="form-control" placeholder="Total">
                                </td>

                            </tr>
                        <?php } ?>
                        <?php
                        if ($record_total) {
                            ?>
                            <tr>
                                <td>
                                    <input value="Record Suspension" type="text" readonly="" class="form-control" name="name[]">
                                </td>
                                <td>
                                    <input value="<?= $record_count ?>" readonly="" name="quantity[]" type="number" class="form-control" placeholder="Quantity">
                                </td>
                                <td>
                                    <input value="<?= $record_total ?>" name="total[]" type="number" class="form-control" placeholder="Total">
                                </td>

                            </tr>
                        <?php } ?>
                        <?php
                        if ($entry_total) {
                            ?>
                            <tr>
                                <td>
                                    <input value="U.S. Entry Waiver" type="text" readonly="" class="form-control" name="name[]">
                                </td>
                                <td>
                                    <input value="<?= $entry_count ?>" readonly="" name="quantity[]" type="number" class="form-control" placeholder="Quantity">
                                </td>
                                <td>
                                    <input value="<?= $entry_total ?>" name="total[]" type="number" class="form-control" placeholder="Total">
                                </td>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <div class="col-md-12">
                <div class="invoice-summary">
                    <h5 class="font-weight-bold">Grand Total: <span> $<?= $name_based_total + $digital_total + $record_total + $entry_total ?></span></h5>
                    <button class="btn btn-primary" type="submit">Save</button>
                </div>
                <div>

                </div>
            </div>
        </div>
    </form>
</div>
<!--==== / Print Area =====-->
