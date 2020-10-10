<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="row">
            <?php
            if (check_route('countries', 'get')):
                ?>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <a href="<?= base_url() ?>countries">
                        <div class="card card-icon mb-4">
                            <div class="card-body text-center">
                                <span class="fa fa-globe"></span>
                                <p class="text-muted mt-2 mb-2">Total Countries</p>
                                <p class="text-primary text-24 line-height-1 m-0"><?= $total_countries ?></p>
                            </div>
                        </div>
                    </a>
                </div>
                <?php
            endif;
            if (check_route('states', 'get')):
                ?>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <a href="<?= base_url() ?>states">
                        <div class="card card-icon mb-4">
                            <div class="card-body text-center">
                                <span class="fa fa-globe"></span>
                                <p class="text-muted mt-2 mb-2">Total States</p>
                                <p class="text-primary text-24 line-height-1 m-0"><?= $total_states ?></p>
                            </div>
                        </div>
                    </a>
                </div>
                <?php
            endif;
            if (check_route('cities', 'get')):
                ?>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <a href="<?= base_url() ?>agent-locations">
                        <div class="card card-icon mb-4">
                            <div class="card-body text-center">
                                <span class="fa fa-globe"></span>
                                <p class="text-muted mt-2 mb-2">Locations</p>
                                <p class="text-primary text-24 line-height-1 m-0"><?= $total_locations ?></p>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endif;
            ?>
        </div>
    </div>

</div>
