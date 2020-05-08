<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?></title>
    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" />
    <link href="<?php echo base_url('assets/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') ?>" rel="stylesheet" />
</head>

<body>
    <div class="container">
        <h1><?php echo $heading; ?></h1>
        <hr />
        <form method="post" action="<?php echo base_url('user/post'); ?>">
            <?php
            if ($this->session->has_userdata('validation_errors')) {
                echo $this->session->userdata('validation_errors');
                $this->session->unset_userdata('validation_errors');
            }
            ?>
            <div class="form-group row">
                <label class="control-label col-md-3" for="username">Name</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" id="username" placeholder="Enter Name" name="username" value="<?php echo $username; ?>" />
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label col-md-3" for="fullname">Full Name</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" id="fullname" placeholder="Enter Full Name" name="fullname" value="<?php echo $fullname; ?>" />
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label col-md-3" for="dob">Date of Birth</label>
                <div class="col-md-9">
                    <input name="dob" id="dob" placeholder="05/08/2020" class="form-control datepicker" type="text" value="<?php echo $dob; ?>" />
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-3"></div>
                <div class="col-md-9">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
    <script src="<?php echo base_url('assets/jquery/jquery-3.4.1.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js') ?>"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('[name="dob"]').datepicker();
        });
    </script>
</body>

</html>