<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="row dashboard-sevices">
            <?php
            if (check_route('security-screening', 'get')):
                ?>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <a href="<?= base_url() ?>security-screening">
                        <div class="card card-icon mb-4">
                            <div class="card-body text-center">
                                <img src="<?= base_url() ?>assets/images/services/criminal-record-check.png">
                                <p class="text-primary text-20 m-0">Security Screening</p>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>

</div>
