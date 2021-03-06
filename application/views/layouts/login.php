<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <link rel="icon" href="<?php echo base_url('images/aimanage.ico') ?>">
    <title>AIMANAGE | Login</title>

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/bootstrap-social/bootstrap-social.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/izitoast/css/iziToast.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/components.css">

</head>

<body>
    <div id="appl">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="login-brand">
                        <img src="<?php echo base_url('images/AIMANAGE.png') ?>" alt="AiManage" style="width:100%;height:auto;">
                            <!-- <img src="assets/logo.jpg" width="100" class="shadow-light rounded-circle"> -->
                        </div>

                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Login</h4>
                            </div>

                            <div class="card-body">
                            
                                <form method="POST" id="form-login" class="needs-validation">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input id="username" type="text" class="form-control" name="username" required autofocus>
                                    </div>

                                    <div class="form-group">
                                        <div class="d-block">
                                            <label for="password" class="control-label">Password</label>
                                        </div>
                                        <input id="password" type="password" class="form-control" name="password" required>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                                            Login
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="<?php echo base_url(); ?>assets/modules/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/modules/popper.js"></script>
    <script src="<?php echo base_url(); ?>assets/modules/tooltip.js"></script>
    <script src="<?php echo base_url(); ?>assets/modules/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/modules/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/stisla.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/scripts.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
    <script src="<?php echo base_url(); ?>assets/modules/izitoast/js/iziToast.min.js"></script>

    <script>
        $(document).ready(function() {

            $('#form-login').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('auth/checking'); ?>",
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function(res) {

                        if (res.error) {

                            iziToast.error({
                                title: 'Error',
                                message: res.message,
                                position: 'topRight'
                            });

                        } else {

                            iziToast.info({
                                title: 'Success',
                                message: res.message,
                                position: 'topRight'
                            });
                            
                            window.location.href = '<?php echo base_url('home'); ?>';

                        }
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            });
        });
    </script>
</body>

</html>