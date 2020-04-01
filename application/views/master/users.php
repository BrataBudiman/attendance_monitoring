<section class="section">

    <div class="section-header">
        <h1>Data Users</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?php echo base_url(); ?>">Dashboard</a></div>
            <div class="breadcrumb-item">Data Users</div>
        </div>
    </div>

    <div class="section-body">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="pull-right">
                            <button data-toggle="modal" data-target="#modal-action" class="btn btn-info">
                                <i class="fa fa-refresh"></i> Add New
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" style="white-space:nowrap;" id="t_master">
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Level</th>
                                        <th>Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- MODAL BOOTSTRAP -->
<div class="modal fade" id="modal-action" tabindex="-1" role="dialog" aria-labelledby="modal-action" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalRegistrasi">Add Data User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-action">
                <input type="hidden" id="id" name="id">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Username:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" name="username" id="username" required autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Email:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-at"></i>
                                </div>
                            </div>
                            <input type="email" class="form-control" name="email" id="email" required autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Password:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-key"></i>
                                </div>
                            </div>
                            <input type="password" class="form-control" name="password" id="password" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Level:</label>
                        <select name="level_user" id="level_user" class="form-control">
                            <option value=""></option>
                            <option value="1"> Admin </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status:</label>
                        <select name="status_user" id="status_user" class="form-control">
                            <option value=""></option>
                            <option value="1"> Active </option>
                            <option value="2"> Inactive </option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btnAdd"> Save </button>
                    <button class="btn btn-warning" data-dismiss="modal"> Cancel </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function getAllUsers() {

        $('#t_master').DataTable({
            stateSave: true,
            destroy: true,
            ajax: {
                url: "<?php echo base_url(); ?>users/getAllUsers",
                type: "POST",
                dataSrc: "data",
            },
            columns: [{
                    data: 'username'
                },
                {
                    data: 'email'
                },
                {
                    data: 'level_user'
                },
                {
                    data: 'status_user',
                    render: function(d, t, r) {
                        if (d == '1') {
                            return '<span class="badge badge-success">Active</span>';
                        } else {
                            return '<span class="badge badge-danger">Inactive</span>';
                        }
                    }
                },
                {
                    data: 'id',
                    render: function(d, t, r) {
                        return '<button class="btn btn-sm btn-primary" onclick="editData(' + d + ')"> Edit </button> &nbsp; <button class="btn btn-sm btn-danger" onclick="delData(' + d + ')"> Delete </button>';
                    }
                }
            ],
            columnDefs: [{
                targets: [4],
                className: 'text-center'
            }],

        });
    }

    function editData(id) {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>users/getUser",
            data: {
                id: id
            },
            dataType: "json",
            success: function(res) {
                if (res.error) {
                    iziToast.error({
                        title: 'Error!',
                        message: res.message,
                        position: 'topRight',
                    });
                } else {
                    $("#id").val(res.data.id);
                    $("#username").val(res.data.username);
                    $("#email").val(res.data.email);
                    $("#password").val(res.data.password);
                    $("#level_user").val(res.data.level_user);
                    $("#status_user").val(res.data.status_user);

                    $("#modal-action").modal("show");
                }
            }
        });
    }

    function delData(id) {
        if (confirm("Are you sure to delete it ?")) {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>users/delete",
                data: {
                    id: id
                },
                dataType: "json",
                success: function(res) {
                    if (res.error) {
                        iziToast.error({
                            title: 'Error!',
                            message: res.message,
                            position: 'topRight',
                        });
                    } else {
                        iziToast.success({
                            title: 'Success!',
                            message: res.message,
                            position: 'topRight',
                        });

                        getAllUsers();
                    }
                }
            });
        }
    }

    $(document).ready(function() {
        getAllUsers();

        $("#form-action").submit(function(e) {
            e.preventDefault();
            var inputData = $("#form-action").serialize();

            let id = $('input[name="id"]').val();

            if (id != '') {

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('users/update'); ?>",
                    data: inputData,
                    dataType: "json",
                    success: function(res) {
                        if (res.error) {
                            iziToast.error({
                                title: 'Error!',
                                message: res.message,
                                position: 'topRight',
                            });
                        } else {
                            iziToast.success({
                                title: 'Success!',
                                message: res.message,
                                position: 'topRight',
                            });
                            $("#form-action").trigger("reset");
                            $("#modal-action").modal("hide");
                            getAllUsers();
                        }
                    }
                });

            } else {

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('users/add'); ?>",
                    data: inputData,
                    dataType: "json",
                    success: function(res) {
                        if (res.error) {
                            iziToast.error({
                                title: 'Error!',
                                message: res.message,
                                position: 'topRight',
                            });
                        } else {
                            iziToast.success({
                                title: 'Success!',
                                message: res.message,
                                position: 'topRight',
                            });
                            $("#form-action").trigger("reset");
                            $("#modal-action").modal("hide");
                            getAllUsers();
                        }
                    }
                });

            }
        });

    });
</script>