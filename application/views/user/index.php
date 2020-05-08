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
        <a style="float: right" class="btn btn-primary" href="<?php echo base_url('user/add') ?>">ADD</a>
        <br />
        <br />
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Full Name</th>
                    <th>Date of Birth</th>
                    <th>Created Time</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dataUser as $key => $_user) : ?>
                    <tr>
                        <td><?php echo $_user->username ?></td>
                        <td><?php echo $_user->fullname ?></td>
                        <td><?php echo $_user->dob ?></td>
                        <td><?php echo $_user->created_time ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <script src="<?php echo base_url('assets/jquery/jquery-3.4.1.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js') ?>"></script>
</body>

</html>