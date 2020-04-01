<section class="section">
   <div class="section-header">
      <h1>Database Employees</h1>
      <div class="section-header-breadcrumb">
         <div class="breadcrumb-item active"><a href="<?php echo base_url(); ?>">Dashboard</a></div>
         <div class="breadcrumb-item">Database Employees</div>
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
                              <th>Employee ID</th>
                              <th>Fullname</th>
                              <th>Gender</th>
                              <th>Title</th>
                              <th>Birthday</th>
                              <th>Hire Date</th>
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
   function getAllEmployees() {
      $('#t_master').DataTable({
         destroy: true,
         ajax: {
            url: "<?php echo base_url(); ?>databases/getAllEmployees",
            type: "POST",
            dataSrc: "data",
         },
         columns: [{
               data: 'USERID'
            },
            {
               data: 'NAME'
            },
            {
               data: 'GENDER'
            },
            {
               data: 'TITLE'
            },
            {
               data: 'BIRTHDAY'
            },
            {
               data: 'HIREDDAY'
            },
            // {
            //    data: 'id',
            //    render: function(d, t, r) {
            //       return '<button class="btn btn-sm btn-primary" onclick="editData(' + d + ')"> Edit </button> &nbsp; <button class="btn btn-sm btn-danger" onclick="delData(' + d + ')"> Delete </button>';
            //    }
            // }
         ],
         columnDefs: [{
            targets: [5],
            className: 'text-center'
         }],

      });

   }
   $(document).ready(function() {
   getAllEmployees();
   });
</script>