<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="row dashboard-sevices">
            <?php
            if (check_route('security-screening/name-based-check', 'get')):
                ?>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <a href="<?= base_url() ?>security-screening/name-based-check">
                        <div class="card card-icon mb-4">
                            <div class="card-body text-center">
                                <img src="<?= base_url('assets') ?>/images/services/name-based-check.png">
                                <p class="text-primary text-20 m-0">Name Based Check</p>
                            </div>
                        </div>
                    </a>
                </div>
                <?php
            endif;
            if (check_route('security-screening/digital-fingerprinting', 'get')):
                ?>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <a href="<?= base_url() ?>security-screening/digital-fingerprinting">
                        <div class="card card-icon mb-4">
                            <div class="card-body text-center">
                                <img src="<?= base_url('assets') ?>/images/services/fingerprint-based-check.png">
                                <p class="text-primary text-20 m-0">Digital Fingerprinting</p>
                            </div>
                        </div>
                    </a>
                </div>
                <?php
            endif;
            if (check_route('security-screening/record-suspension', 'get')):
                ?>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <a href="<?= base_url() ?>security-screening/record-suspension">
                        <div class="card card-icon mb-4">
                            <div class="card-body text-center">
                                <img src="<?= base_url('assets') ?>/images/services/record-suspension.png">
                                <p class="text-primary text-20 m-0">Record Suspension</p>
                            </div>
                        </div>
                    </a>
                </div>
                <?php
            endif;
            if (check_route('security-screening/us-entry-waiver', 'get')):
                ?>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <a href="<?= base_url() ?>security-screening/us-entry-waiver">
                        <div class="card card-icon mb-4">
                            <div class="card-body text-center">
                                <img src="<?= base_url('assets') ?>/images/services/us-entry-waiver.png">
                                <p class="text-primary text-20 m-0">U.S. Entry Waiver</p>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>

</div>
