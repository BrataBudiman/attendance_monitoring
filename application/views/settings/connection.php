<style>
   .profile-img {
      width: 100%;
      height: auto;
   }
</style>
<section class="section">
   <div class="section-header">
      <h1>Connection Setting</h1>
      <div class="section-header-breadcrumb">
         <div class="breadcrumb-item active"><a href="<?php echo base_url(); ?>">Home</a></div>
         <div class="breadcrumb-item"><a href="#">Setting</a></div>
         <div class="breadcrumb-item">Connection</div>
      </div>
   </div>
   <div class="section-body">
      <div class="row">
         <div class="col-12">
            <div class="card">
               <div class="card-header">
                  <div class="pull-right">
                     <button id="editBtn" class="btn btn-info" onclick="editAcc();" hidden>
                        <i class="fa fa-pencil"></i> Edit Data
                     </button>
                  </div>
               </div>
               <div class="form-group">
                  <label class="form-label">Connection Type</label>
                  <div class="selectgroup w-100" id="conn_type">
                     <label class="selectgroup-item">
                        <input type="radio" name="value" value="1" class="selectgroup-input" id="sftp" onclick="showSftp();">
                        <span class="selectgroup-button">SFTP ACcount</span>
                     </label>
                     <label class="selectgroup-item" dissabled>
                        <input type="radio" name="value" value="2" class="selectgroup-input" id="api" onclick="showApi();">
                        <span class="selectgroup-button">REST API</span>
                     </label>
                  </div>
               </div>
               <div class="card-body">
                  <div id="form-sftp" hidden>
                     <form id="form-action">
                        <input type="hidden" id="id" name="id">
                        <div class="modal-body">
                           <div class="form-group">
                              <label>Connection Name:</label>
                              <div class="input-group">
                                 <div class="input-group-prepend">
                                    <div class="input-group-text">
                                       <i class="fas fa-link"></i>
                                    </div>
                                 </div>
                                 <input type="text" class="form-control" name="conn_name" id="conn_name" autocomplete="off">
                              </div>
                           </div>
                           <div class="form-group">
                              <label>Host:</label>
                              <div class="input-group">
                                 <div class="input-group-prepend">
                                    <div class="input-group-text">
                                       <i class="fas fa-home"></i>
                                    </div>
                                 </div>
                                 <input type="text" class="form-control" name="hostname" id="hostname" autocomplete="off">
                              </div>
                           </div>
                           <div class="form-group">
                              <label>Username:</label>
                              <div class="input-group">
                                 <div class="input-group-prepend">
                                    <div class="input-group-text">
                                       <i class="fas fa-user"></i>
                                    </div>
                                 </div>
                                 <input type="text" class="form-control" name="username" id="username" autocomplete="off">
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
                                 <input type="password" class="form-control" name="password" id="password">
                              </div>
                           </div>
                           <div class="form-group">
                              <label>Port:</label>
                              <div class="input-group">
                                 <div class="input-group-prepend">
                                    <div class="input-group-text">
                                       <i class="fas fa-plug"></i>
                                    </div>
                                 </div>
                                 <input type="number" class="form-control" name="port" id="port">
                              </div>
                           </div>
                           <div class="form-group">
                              <label>Status:</label>
                              <div class="input-group">
                                 <div class="input-group-prepend">
                                    <div class="input-group-text">
                                       <i class="fas fa-flag"></i>
                                    </div>
                                 </div>
                                 <input type="text" class="form-control" name="status" id="status" placeholder="Click Test Connection" required readonly>
                              </div>
                           </div>
                           <div class="card-footer">
                              <button type="submit" class="btn btn-primary" id="btnAdd"> Save </button>
                              <button class="btn btn-warning" id="btnTest" onclick="testConnection();"> Test Connection </button>
                           </div>
                        </div>
                     </form>

                  </div>
                  <div id="form-api" hidden>
                     <img class="profile-img" src="<?php echo base_url() . 'images/under_construction.png'; ?>" alt="under construction">
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>

<script>
   function showSftp() {
      $('#form-sftp').prop('hidden', false);
      $('#form-api').prop('hidden', true);
      var inputData = $("#form-action").serialize();
      let id = $('input[name="id"]').val();
      $.ajax({
         type: "POST",
         url: "<?php base_url(); ?>getSftp",
         data: inputData,
         dataType: "json",
         success: function(response) {
            $('#id').val(response.data.id);
            $('#conn_name').val(response.data.conn_name).prop('readonly', true);
            $('#hostname').val(response.data.hostname).prop('readonly', true);
            $('#username').val(response.data.username).prop('readonly', true);
            $('#password').val(response.data.password).prop('readonly', true);
            $('#port').val(response.data.port).prop('readonly', true);
            $('#editBtn').prop('hidden', false);
            $('#btnAdd').prop('disabled', true);
         }
      });
   }

   function editAcc() {
      $('#conn_name').prop('readonly', false);
      $('#hostname').prop('readonly', false);
      $('#username').prop('readonly', false);
      $('#password').prop('readonly', false);
      $('#port').prop('readonly', false);
      $('#btnAdd').prop('disabled', false);
      $('#status').val("");
   }

   function showApi() {
      $('#form-sftp').prop('hidden', true);
      $('#form-api').prop('hidden', false);
   }

   function testConnection() {
      $('#btnTest').text('Loading...').prop('disabled', true);
      var host = $('#hostname').val();
      var username = $('#username').val();
      var password = $('#password').val();
      var port = $('#port').val();
      $.ajax({
         type: "POST",
         url: "<?php base_url(); ?>testSftp",
         data: {
            host: host,
            username: username,
            password: password
         },
         dataType: "json",
         success: function(response) {
            $('#btnTest').text('Test Connection').prop('disabled', false);
            if (response.error) {
               $('#status').val('Not Connected');
               iziToast.error({
                  title: 'Error!',
                  message: response.message,
                  position: 'topRight',
               });
            } else {
               $('#status').val('Connected');
               iziToast.success({
                  title: 'Success!',
                  message: response.message,
                  position: 'topRight',
               });
            }
         }
      });
   }
   $(document).ready(function() {

      $("#form-action").submit(function(e) {
         e.preventDefault();
         var inputData = $("#form-action").serialize();
         let id = $('input[name="id"]').val();

         if (id != "") {
            $.ajax({
               type: "POST",
               url: "<?php base_url() ?>updateSftp",
               data: inputData,
               dataType: "json",
               success: function(response) {
                  if (response.error) {
                     editAcc();
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
                     showSftp();
                  }
               }
            });
         } else {
            $.ajax({
               type: "POST",
               url: "<?php base_url(); ?>addSftp",
               data: inputData,
               dataType: "json",
               success: function(response) {
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
               }
            });
         showSftp();
         }
      })

   });
</script>