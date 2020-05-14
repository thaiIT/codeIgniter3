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
        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#myModal">Add User</button>
        <br>
        <br>
        <?php if (!empty($dataUser)) : ?>
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
                    <?php foreach ($dataUser as $_user) : ?>
                        <tr>
                            <td><?php echo $_user->username ?></td>
                            <td><?php echo $_user->fullname ?></td>
                            <td><?php echo $_user->dob ?></td>
                            <td><?php echo $_user->created_time ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        <?php endif ?>
    </div>
    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="false">
        <div class="toast-header">
            <span class="rounded mr-2">...</span>
            <strong class="mr-auto">Bootstrap</strong>
            <small class="text-muted">11 mins ago</small>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body"></div>
    </div>
    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Modal Heading</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form id="form-user" class="was-validated" method="post" action="<?php echo base_url('user/addAjax'); ?>">
                        <div class="form-group row">
                            <label class="control-label col-md-3" for="username">Name</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="username" placeholder="Enter Name" name="username" value="" required />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3" for="fullname">Full Name</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="fullname" placeholder="Enter Full Name" name="fullname" value="" required />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3" for="dob">Date of Birth</label>
                            <div class="col-md-9">
                                <input name="dob" id="dob" placeholder="2000-05-20" class="form-control datepicker" type="text" value="" required/>
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

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
    <!-- The End Modal -->

    <script src="<?php echo base_url('assets/jquery/jquery-3.4.1.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js') ?>"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('[name="dob"]').datepicker({
                format: "yyyy-mm-dd",
                todayBtn: true,
                todayHighlight: true,
                orientation: "top auto",
                autoclose: true
            });
            $('#form-user button').click(function(event) {
                event.preventDefault();
                $('.toast').toast('hide')
                var formData = $('#form-user').serialize();
                var url = "<?php echo base_url('user/addAjax') ?>";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: formData,
                    dataType: "JSON",
                    success: function(responses) {
                        $('.toast-body').html(responses.content);
                        $('.toast').toast('show');
                        $("#myModal").modal('hide');
                    }
                });
            });
        });
    </script>
</body>

</html>