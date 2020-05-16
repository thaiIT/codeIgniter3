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

    <!-- List Users -->
    <div class="container">
        <h1><?php echo $heading; ?></h1>
        <hr />
        <button type="button" class="btn btn-primary float-right" id="btn-add-user">Add User</button>
        <br>
        <br>
        <div id="table-user">
            <?php if (!empty($dataUser)) : ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Full Name</th>
                            <th>Date of Birth</th>
                            <th>Created Time</th>
                            <th style="width: 50px;text-align: center;">Edit</th>
                            <th style="width: 50px;text-align: center;">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dataUser as $_user) : ?>
                            <tr>
                                <td class="username"><?php echo $_user->username ?></td>
                                <td class="fullname"><?php echo $_user->fullname ?></td>
                                <td class="dob"><?php echo $_user->dob ?></td>
                                <td><?php echo $_user->created_time ?></td>
                                <td style="width: 50px;text-align: center;"><a data-id="<?php echo $_user->id ?>" class="edit ajax" href="<?php echo base_url('user/updateAjax/'.$_user->id); ?>">Edit</a></td>
                                <td style="width: 50px;text-align: center;"><a class="remove ajax" href="<?php echo base_url('user/deleteAjax/'.$_user->id); ?>">X</a></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="alert alert-warning" role="alert">
                    Have not User!
                </div>
            <?php endif ?>
        </div>
    </div>
    <!-- End List Users -->

    <!-- The Toast -->
    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="false" style="position: fixed; top: 30px; right: 30px;min-width: 350px;">
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
    <!-- The End Toast -->

    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form id="form-user" method="post" action="<?php echo base_url(); ?>">
                        <div class="form-group row">
                            <label class="control-label col-md-3" for="username">Name</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="username" placeholder="Enter Name" name="username" value="" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3" for="fullname">Full Name</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="fullname" placeholder="Enter Full Name" name="fullname" value="" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3" for="dob">Date of Birth</label>
                            <div class="col-md-9">
                                <input name="dob" id="dob" placeholder="2000-05-20" class="form-control datepicker" type="text" value=""/>
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

            $('#btn-add-user').click(function(event) {
                event.preventDefault();
                $('.modal-title').text('Add User');
                $('#form-user').trigger("reset");
                $('#form-user').attr('action', "<?php echo base_url('user/addAjax') ?>");
                $('#myModal').modal('show');
            });

            $('body').on('click', '.edit.ajax', function(event) {
                event.preventDefault();
                var form = $('#form-user');
                $('.modal-title').text('Edit User');
                form.attr('action',"<?php echo base_url('user/updateAjax') ?>");
                var username = $(this).closest('tr').find('.username').text();
                var fullname = $(this).closest('tr').find('.fullname').text();
                var dob = $(this).closest('tr').find('.dob').text();
                form.find('input[name="username"]').val(username);
                form.find('input[name="fullname"]').val(fullname);
                form.find('input[name="dob"]').val(dob);
                var userId = $(this).attr('data-id');
                $('.useridhidden').remove();
                $('<input>').attr({
                    type: 'hidden',
                    name: 'id',
                    class: 'useridhidden',
                    value: userId
                }).appendTo('#form-user');
                $('#myModal').modal('show');
            });

            $('body').on('click', '.remove.ajax', function(event) {
                event.preventDefault();
                if(confirm('Are you sure delete this data?')) {
                    var url = $(this).attr('href');
                    $.ajax({
                        url: url,
                        type: "POST",
                        dataType: "JSON",
                        success: function(responses) {
                            $('.toast-body').html(responses.content);
                            $('.toast').toast('show');
                            if(responses.success) {
                                reloadHtmlContent();
                            }
                        }
                    });
                }
            });

            $('#form-user button').click(function(event) {
                event.preventDefault();
                var form = $('#form-user');
                var url =  form.attr('action');
                $.ajax({
                    url: url,
                    type: "POST",
                    data: form.serialize(),
                    dataType: "JSON",
                    success: function(responses) {
                        $('.toast-body').html(responses.content);
                        $('.toast').toast('show');
                        $("#myModal").modal('hide');
                        if(responses.success) {
                            reloadHtmlContent();
                        }
                    }
                });
            });

            function reloadHtmlContent() {
                $.ajax({
                    url: 'user/reloadDataContent',
                    type: "POST",
                    success: function(responses) {
                        if(!responses) {
                            $("#table-user").html('<div class="alert alert-warning" role="alert">Have not User!</div>');
                        } else {
                            var htmlContent = '';
                            $.each(JSON.parse(responses), function(index){
                                htmlContent += '<tr><td class="username">' + this.username + '</td><td class="fullname">' + this.fullname + '</td><td class="dob">' + this.dob + '</td><td>' + this.created_time + '</td><td style="width: 50px;text-align: center;"><a data-id="' + this.id + '" class="edit ajax" href="<?php echo base_url('user/updateAjax/'); ?>' + this.id + '">Edit</a></td></td><td style="width: 50px;text-align: center;"><a  class="remove ajax" href="<?php echo base_url('user/deleteAjax/'); ?>' + this.id + '">X</a></td></tr>';
                            });
                            setTimeout(function() {
                                $("#table-user").html('<table class="table"><thead><tr><th>Name</th><th>Full Name</th><th>Date of Birth</th><th>Created Time</th><th style="width: 50px;text-align: center;">Edit</th><th style="width: 50px;text-align: center;">Delete</th></tr></thead><tbody>' + htmlContent + '</tbody></table>');
                            }, 500);

                        }
                    }
                });
            }
        });
    </script>
</body>

</html>