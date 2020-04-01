<section class="section">
   <div class="section-header">
      <h1>Attendance Logs</h1>
      <div class="section-header-breadcrumb">
         <div class="breadcrumb-item active"><a href="<?php echo base_url(); ?>">Dashboard</a></div>
         <div class="breadcrumb-item">Attendance Logs</div>
      </div>
   </div>
   <div class="section-body">
      <div class="row">
         <div class="col-12">
            <div class="card">
               <div class="card-header">
                  <div class="pull-right">
                     <div class="form-group">
                        <label class="d-block">Date Range Attendance Log</label>
                        <div id="logrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                           <i class="fa fa-calendar"></i>&nbsp;
                           <span id="logvalue"></span> <i class="fa fa-caret-down"></i>
                        </div>
                        <div id="gen_log">
                           <button type="button" id="genBtn" class="btn btn-primary">Generate Log</button>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="card-body">
                  <div class="table-responsive">
                     <table class="table table-striped table-hover" style="white-space:nowrap;" id="t_master">
                        <thead>
                           <tr>
                              <th>Employee No</th>
                              <th>Attendance Time</th>
                              <th>Status</th>
                              <th>POS</th>
                              <th>Machine Code</th>
                              <!-- <th class="text-center">Action</th> -->
                           </tr>
                        </thead>
                        <tfoot>
                           <tr>
                              <th>Employee No</th>
                              <th>Attendance Time</th>
                              <th>Status</th>
                              <th>POS</th>
                              <th>Machine Code</th>
                              <!-- <th class="text-center">Action</th> -->
                           </tr>
                        </tfoot>

                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>

<script>
   $(function() {

      var time = "08:00";
      var start = moment().subtract(29, 'days');
      var end = moment();
      var showStart = start + ' ' + time;

      function cb(start, end) {
         $('#logrange span').html(start.format('M/D/YYYY hh:mm A') + ' - ' + end.format('M/D/YYYY hh:mm A'));
      }

      $('#logrange').daterangepicker({
         startDate: start,
         endDate: end,
         timePicker: true,
         timePickerIncrement: 1,
         timePicker12Hour: true,
         ranges: {
            'Today': [moment().startOf('days'), moment().endOf('days')],
            'Yesterday': [moment().subtract(1, 'days').startOf('days'), moment().subtract(1, 'days').endOf('days')],
            'Last 3 Days': [moment().subtract(2, 'days').startOf('days'), moment().endOf('days')],
            'Last 7 Days': [moment().subtract(6, 'days').startOf('days'), moment().endOf('days')],
            'Last 30 Days': [moment().subtract(29, 'days').startOf('days'), moment().endOf('days')],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
         }
      }, cb);

      cb(start, end);
      // getAllAtts();
      $('#genBtn').on('click', function() {
         // generate_log();
         getAllAtts();
      });

   });

   function generate_log() {
      var dt = $('#logrange span').html();
      var split = dt.split(" - ");
      var start = split[0];
      var end = split[1];
      $.ajax({
         type: "post",
         url: "<?php echo base_url(); ?>attendances/getAtt",
         data: {
            start: start,
            end: end
         },
         dataType: "json",
         success: function(response) {}
      });
      getAllAtts();
   }

   function getAllAtts() {
      var dt = $('#logrange span').html();
      var split = dt.split(" - ");
      var start = split[0];
      var end = split[1];
      var currentdate = new Date();
      var date_time = currentdate.getDate() + "/" +
         (currentdate.getMonth() + 1) + "/" +
         currentdate.getFullYear() + " @ " +
         currentdate.getHours() + ":" +
         currentdate.getMinutes() + ":" +
         currentdate.getSeconds();
      var filename = "Att_log_" + currentdate.getDate() + "" +
         (currentdate.getMonth() + 1) + "" +
         currentdate.getFullYear() + "" +
         currentdate.getHours() + "" +
         currentdate.getMinutes() + "" +
         currentdate.getSeconds();
      var file = filename + ".xls";
      var datetime = "Date log :" + date_time;
      var table = $('#t_master').DataTable({
         clear: true,
         destroy: true,
         dom: 'Blfrtip',
         processing: true,
         // serverSide: true,
         ajax: {
            url: "<?php echo base_url(); ?>attendances/getDevAtt",
            type: "POST",
            data: {
               start: start,
               end: end,
            },
            dataSrc: "data",
         },
         columns: [{
               data: 'EmpNo'
            },
            {
               data: 'Attend_Time'
            },
            {
               data: 'Status'
            },
            {
               data: 'Pos'
            },
            {
               data: 'MachineCode'
            },
            // {
            //    data: 'id',
            //    render: function(d, t, r) {
            //       return '<button class="btn btn-sm btn-primary" onclick="editData(' + d + ')"> Edit </button> &nbsp; <button class="btn btn-sm btn-danger" onclick="delData(' + d + ')"> Delete </button>';
            //    }
            // }
         ],
         columnDefs: [{
            targets: [4],
            className: 'text-center'
         }],
         buttons: [
            // {
            //    title: "Attendance Log " + date_time,
            //    extend: 'pdfHtml5',
            //    exportOptions: {
            //       columns: [0, 1, 2, 3, 4]
            //    },
            //    pageSize: 'A4',
            //    className: 'btn btn-success',
            //    customize: function(doc) {
            //       doc.defaultStyle.fontSize = 8; //<-- set fontsize to 16 instead of 10 
            //    },
            //    footer: false,
            //    messageTop: datetime,
            // },
            // {
            //    title: "Attendance Log from: " + start + " until: " + end,
            //    filename: filename,
            //    extension: ".xls",
            //    extend: 'excelHtml5',
            //    exportOptions: {
            //       columns: [0, 1, 2, 3, 4]
            //    },
            //    className: 'btn btn-success',
            //    messageTop: datetime,
            //    // render: getAllAtts(),
            // },
            // {
            //    title: "Attendance Log " + date_time,
            //    extend: 'csvHtml5',
            //    exportOptions: {
            //       columns: [0, 1, 2, 3, 4]
            //    },
            //    className: 'btn btn-success',
            //    messageTop: datetime,
            // },
            {
               text: 'Upload Data',
               className: 'btnExcel btn-success',
               action: function(e, dt, node, config) {
                  $('.btnExcel').text('Loading..').prop('disabled', true);
                  sendFTP(file);
               }
            },
         ],
         initComplete: function() {
            this.api().columns().every(function() {
               var column = this;
               var select = $('<select><option value=""></option></select>')
                  .appendTo($(column.footer()).empty())
                  .on('change', function() {
                     var val = $.fn.dataTable.util.escapeRegex(
                        $(this).val()
                     );

                     column
                        .search(val ? '^' + val + '$' : '', true, false)
                        .draw();
                  });

               column.data().unique().sort().each(function(d, j) {
                  select.append('<option value="' + d + '">' + d + '</option>')
               });
            });
         }
      });

      // $("#t_master_wrapper > div.dt-buttons.btn-group > button.btn.btn-secondary.buttons-excel.buttons-html5.btn-success").on('click', function() {
      //    sendFTP(file);
      // });
   }

   function sendFTP(name) {
      var dt = $('#logrange span').html();
      var split = dt.split(" - ");
      var start = split[0];
      var end = split[1];
      var info = $('#t_master_info').html();
      var sp_info = info.split(" ");
      var data_sum = sp_info[5];
      var currentdate = new Date();
      $.ajax({
         type: "POST",
         url: "<?php base_url() ?>attendances/sendFTP",
         data: {
            name: name,
            start: start,
            end: end,
            data_sum: data_sum,
            current: currentdate
         },
         dataType: "json",
         success: function(response) {
            $('.btnExcel').text('Upload Data').prop('disabled', false);

            if (response.error) {
               iziToast.error({
                  title: 'Error!',
                  message: response.message,
                  position: 'topRight',
               });
            } else {
               iziToast.success({
                  title: 'Success!',
                  message: response.message,
                  position: 'topRight',
               });

            }
               fetch('<?php echo base_url(); ?>uploads/'+ name)
                  .then(resp => resp.blob())
                  .then(blob => {
                     const url = window.URL.createObjectURL(blob);
                     const a = document.createElement('a');
                     a.style.display = 'none';
                     a.href = url;
                     // the filename you want
                     a.download = name;
                     document.body.appendChild(a);
                     a.click();
                     window.URL.revokeObjectURL(url);
                     // alert('your file has downloaded!'); // or you know, something with better UX...
                  })
                  .catch(() => alert('Download failed!'));
         }
      });
   }
   $(document).ready(function() {
      // getAllAtts();
   });
</script>