<section class="section">
    <div class="section-header">
        <h3>Welcome to AIMANAGE Attendance Interface Application</h3>
    </div>
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-8 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Admin</h4>
                    </div>
                    <div class="card-body">
                        <div id="count_admin">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-8 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="far fa-id-card"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Employee</h4>
                    </div>
                    <div class="card-body">
                        <div id="count_employee">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-8 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="far fa-newspaper"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Devices</h4>
                    </div>
                    <div class="card-body">
                        <div id="count_machines">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-8 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="far fa-check-square"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Daily Attendance</h4>
                    </div>
                    <div class="card-body">
                        <div id="count_att">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-8 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="far fa-file-excel"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Files Transfers</h4>
                    </div>
                    <div class="card-body">
                        <div id="count_files">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-8 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="fas fa-upload"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Data Transfers</h4>
                    </div>
                    <div class="card-body">
                        <div id="count_datas">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

<script src="<?php echo base_url(); ?>assets/modules/chart.min.js"></script>

<script>
    function countAdmin() {
        $.ajax({
            type: "GET",
            url: "<?php echo base_url(); ?>home/countAdmin",
            dataType: "json",
            success: function(response) {
                var count = response.data.length;
                console.log(count);
                $('#count_admin').append(count);
            }
        });
    }

    function countEmployee() {
        $.ajax({
            type: "GET",
            url: "<?php echo base_url(); ?>home/countEmployee",
            dataType: "json",
            success: function(response) {
                var count = response.data.length;
                console.log(count);
                $('#count_employee').append(count);
            }
        });
    }

    function countMachines() {
        $.ajax({
            type: "GET",
            url: "<?php echo base_url(); ?>home/countMachines",
            dataType: "json",
            success: function(response) {
                var count = response.data.length;
                console.log(count);
                $('#count_machines').append(count);
            }
        });
    }

    function countFiles() {
        $.ajax({
            type: "GET",
            url: "<?php echo base_url(); ?>home/countFiles",
            dataType: "json",
            success: function(response) {
                var count = response.data.length;
                console.log(count);
                $('#count_files').append(count);
            }
        });
    }

    function countDailyAtt() {
        $.ajax({
            type: "GET",
            url: "<?php echo base_url(); ?>home/countDailyAtt",
            dataType: "json",
            success: function(response) {
                var count = response.data.length;
                console.log(count);
                $('#count_att').append(count);
            }
        });
    }
    
    function countDatas() {
        $.ajax({
            type: "GET",
            url: "<?php echo base_url(); ?>home/countDatas",
            dataType: "json",
            success: function(response) {
                var count = response.data.length;
                console.log(count);
                $('#count_datas').append(count);
            }
        });
    }

    $(document).ready(function() {
        countAdmin();
        countEmployee();
        countFiles();
        countMachines();
        countDatas();
        countDailyAtt();
    })
</script>