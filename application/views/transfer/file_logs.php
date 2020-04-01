<style>
td {
   font-size: 10px;
}
th {
   font-size: 11px;
}
</style>
<section class="section">
   <div class="section-header">
      <h1>File Logs</h1>
      <div class="section-header-breadcrumb">
         <div class="breadcrumb-item active"><a href="<?php echo base_url(); ?>">Dashboard</a></div>
         <div class="breadcrumb-item">File Logs</div>
      </div>
   </div>
   <div class="section-body">
      <div class="row">
         <div class="col-12">
            <div class="card">

               <div class="card-body">
                  <div class="table-responsive">
                     <table class="table table-striped table-hover" style="white-space:nowrap;" id="t_master">
                        <thead>
                           <tr>
                              <th>ID Transaction</th>
                              <th>File Name</th>
                              <th>Period Start</th>
                              <th>Period End</th>
                              <th>Data Uploaded</th>
                              <th>Transfer By</th>
                              <th>Time Transfer</th>
                              <th>Status</th>
                              <!-- <th class="text-center">Action</th> -->
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

<script>
   function getFileTransfer() {
      $('#t_master').DataTable({
         stateSave: true,
         destroy: true,
         ajax: {
            url: "<?php echo base_url(); ?>transfers/getFilesTransfer",
            type: "POST",
            dataSrc: "data",
         },
         columns: [{
               data: 'id_trx'
            },
            {
               data: 'name_file'
            },
            {
               data: 'start_from'
            },
            {
               data: 'start_to'
            },
            {
               data: 'data_sum'
            },
            {
               data: 'transfer_by'
            },
            {
               data: 'timestamps'
            },
            {
               data: 'status',
               render: function(d, t, r) {
                  if (d == '2') {
                     return '<button class="badge badge-success">Sent</button>';
                  } else if (d == '1') {
                     return '<button class="badge badge-danger" onclick="resendFTP('+ r.id_trx +')">Not Sent</button>';
                  } else {
                     return '<button class="badge badge-warning" onclick="resendFTP('+ r.id_trx +')">Not-connected</button>';
                  }
               }
            },
            // {
            //    data: 'id',
            //    render: function(d, t, r) {
            //       return '<button class="btn btn-sm btn-primary" onclick="editData(' + d + ')"> Edit </button> &nbsp; <button class="btn btn-sm btn-danger" onclick="delData(' + d + ')"> Delete </button>';
            //    }
            // }
         ],
         columnDefs: [{
            targets: [7],
            className: 'text-center'
         }],

      });

   }

   function resendFTP(id) {
      console.log('id:' +id);
      $.ajax({
         type: "POST",
         url: "<?php echo base_url(); ?>transfers/resendFTP",
         data: {id: id},
         dataType: "json",
         success: function (response) {
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
               getFilesTransfer();
         }
      });
   }

   $(document).ready(function() {
   getFileTransfer();
   });
</script>