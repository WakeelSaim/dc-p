<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title><?= $page_title ?></title>
        <link rel="icon" href="<?= base_url('assets') ?>/images/ssg-favicon.png" sizes="32x32" />
        <link rel="icon" href="<?= base_url('assets') ?>/images/ssg-favicon.png" sizes="192x192" />
        <link rel="apple-touch-icon-precomposed" href="<?= base_url('assets') ?>/images/ssg-favicon.png" />
        <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
        <link rel="stylesheet" href="<?= base_url('assets') ?>\styles\css\themes\lite-purple.min.css">
        <link rel="stylesheet" href="<?= base_url('assets') ?>\styles\css\themes\custom.css">
    </head>

    <body>
        <div class="auth-layout-wrap" style="background-image: url(<?= base_url('assets') ?>/images/login.jpg)">
            <div class="auth-content" style="width: 100%; max-width: 70%">
                <div class="card o-hidden text-center" style="background:none; box-shadow:none">
                    <div class="row">
                        <div class="col-md-8"></div>
                        <div class="col-md-4" style="background: #fff">
                            <div class="p-4 pt-5 pb-5">
                                <div class="auth-logo text-center mb-4">
                                    <img src="<?= base_url('assets') ?>\images\logo.jpg" style="width: 140px">
                                </div>
                                <h1 class="mb-3 text-18">Forgot Password</h1>
                                <?php if ($this->session->flashdata('no_admin_access')) { ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?= $this->session->flashdata('no_admin_access') ?>
                                    </div>
                                <?php } ?>
                                <?php if ($this->session->flashdata('signup_success')) { ?>
                                    <div class="alert alert-success" role="alert">
                                        <?= $this->session->flashdata('signup_success') ?>
                                    </div>
                                <?php } ?>
                                <form method="post" action="<?= base_url('forgot-password') ?>">
                                    <div class="form-group">
                                        <label for="email">Email address</label>
                                        <input id="email" name="email" placeholder="Enter your email" class="form-control form-control-rounded" type="email">
                                    </div>
                                    <button class="btn btn-rounded btn-primary btn-block mt-2">Request Password Reset</button>

                                </form>

                                <div class="mt-3 text-center">
                                    <a href="<?= base_url('admin') ?>" class="text-muted"><u>Login</u></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <style>
            .pt-5{
                padding-top: 6rem !important;
            }
            .pb-5{
                padding-bottom: 6rem !important;
            }
        </style>
        <script src="<?= base_url('assets') ?>\js\vendor\jquery-3.3.1.min.js"></script>
        <script src="<?= base_url('assets') ?>\js\vendor\bootstrap.bundle.min.js"></script>
        <script src="<?= base_url('assets') ?>\js\es5\script.min.js"></script>
    </body>

</html>