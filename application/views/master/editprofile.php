<section class="section">
   <div class="section-header">
      <h1>Profile</h1>
      <div class="section-header-breadcrumb">
         <div class="breadcrumb-item active"><a href="<?php echo base_url();?>">Home</a></div>
         <div class="breadcrumb-item">Profile</div>
      </div>
   </div>
   <div class="section-body">
      <h2 class="section-title">Hi, <?php echo $this->session->userdata('username') ?></h2>
      <p class="section-lead">
         Change information about yourself on this page.
      </p>

      <div class="row mt-sm-4">
         <div class="col-12 col-md-12 col-lg-7">
            <div class="card">
               <form id="form-action" class="needs-validation" novalidate="">
                  <input type="hidden" id="id" name="id" value="<?php echo $this->session->userdata('id_account') ?>">
                  <div class="card-body">
                     <div class="row">
                        <div class="form-group col-md-6 col-12">
                           <label>Username</label>
                           <input type="text" class="form-control" id="username" name="username" required>
                           <div class="invalid-feedback">
                              Please fill in the username
                           </div>
                        </div>
                        <div class="form-group col-md-6 col-12">
                           <label>Email</label>
                           <input type="email" class="form-control" id="email" name="email" required>
                           <div class="invalid-feedback">
                              Please fill in the email
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="form-group col-md-6 col-12">
                           <label>Password</label>
                           <input type="password" class="form-control" id="password" name="password">
                           <div class="invalid-feedback">
                              Please fill in the password
                           </div>
                        </div>
                        <div class="form-group col-md-6 col-12">
                           <label>Verify Password</label>
                           <input type="password" class="form-control" id="ver_pass" name="ver_pass">
                        </div>
                     </div>
                     <div class="row">
                        <div class="form-group col-md-6 col-12">
                           <label>Level User</label>
                           <select name="level_user" id="level_user" class="form-control" required>
                              <option value=""></option>
                              <option value="1"> Admin </option>
                           </select>
                           <div class="invalid-feedback">
                              Please fill in the Level user
                           </div>
                        </div>
                        <div class="form-group col-md-6 col-12">
                           <label>Status</label>
                           <select name="status_user" id="status_user" class="form-control">
                              <option value=""></option>
                              <option value="1"> Active </option>
                              <option value="2"> Inactive </option>
                           </select>
                           <div class="invalid-feedback">
                              Please fill in the Status
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="card-footer text-right">
                     <button class="btn btn-primary">Save Changes</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</section>

<script>
   function getData() {
      var id = $('#id').val();
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
               //   $("#password").val(res.data.password);
               $("#level_user").val(res.data.level_user);
               $("#status_user").val(res.data.status_user);

               $("#modal-action").modal("show");
            }
         }
      });
   }

   $(document).ready(function() {
      getData();

      $("#form-action").submit(function(e) {
         e.preventDefault();
         var inputData = $("#form-action").serialize();

         let id = $('input[name="id"]').val();
         var pass = $('#password').val();
         var vpass = $('#ver_pass').val();

         // if (pass !== vpass && pass != "") {
         // 
         // }

         if (pass == vpass) {
            $.ajax({
               type: "POST",
               url: "<?php echo base_url('users/update_profile'); ?>",
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
                     getData();
                  }
               }
            });

         } else {
            iziToast.error({
               title: 'Error!',
               message: 'Please verify your password!',
               position: 'topRight',
            });
            return false;
         }


      });
   })
</script>