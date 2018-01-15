<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Travel Online | Log in</title>
      <!-- Tell the browser to be responsive to screen width -->
      <link href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <link href="<?php echo base_url();?>assets/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
      <link href="<?php echo base_url(); ?>assets/dist/css/sb-admin-2.css" rel="stylesheet">
      <link href="<?php echo base_url(); ?>assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
      <style>
         .spacing {
         padding-top:7px;
         padding-bottom:7px;
         }
      </style>
   </head>
   <body class="hold-transition login-page" style="background-color: #f5f8fa">
      <div class="row" style="margin-top: 100px">
         <div class="col-md-6 col-md-offset-3">
            <div class="page-header">
                  <h1 class="logo" style="color: #1e3948">Teknik Informasi <small>TRAVEL ONLINE</small></h1>
            </div>
            <div class="panel panel-info">
               <div class="panel-heading">
                  <h3 class="panel-title">Please Sign In</h3>
               </div>
               <div class="panel-body">
                  <div class="row">
                     <div class="col-md-5" style="text-align: center;margin-bottom: 35px;color: #1e3948">
                        <h1 style="margin-bottom: -20px;font-weight: 600;letter-spacing: 4px;font-size: 33pt">Welcome</h1>
                        <br>
                        <h2 style="margin-top: 0px;">to Admin Panel</h2>
                     </div>
                     <div class="col-md-7" style="border-left:1px solid #ccc;height:160px">
                        <form class="form-horizontal" action="<?php echo base_url(); ?>index.php/admin_auth/login_admin_submit" id="login-form" method="post">
                           <div class="has-feedback">
                              <input type="text" class="form-control" placeholder="Enter Username" id="username" name="username" value="<?php echo $this->session->flashdata('username_error'); ?>" required>
                              <span class="glyphicon glyphicon-user form-control-feedback"></span>
                           </div>
                           <div class="has-feedback">
                              <input type="password" class="form-control" placeholder="Enter Password" id="password" name="password" style="margin-top: 18px" value="<?php echo $this->session->flashdata('password_error'); ?>" required>
                              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                           </div>
                           <div class="spacing"><a href="#" data-toggle="modal" data-target="#forget"><small> Forgot Password?</small></a><br/></div>
                           <button type="submit" class="btn btn-info btn-sm pull-right">Sign In</button>
                        </form>
                     </div>
                  </div>
               </div>
               <div class="panel-footer">
                  <strong>Copyright &copy; 2017 <a href="#">SMK TELKOM</a>.</strong> All rights
                  reserved. 
               </div>
            </div>
         </div>
      </div>
      <?php

         $failed = $this->session->flashdata('failed');
         if ($failed == 'failed') {
           echo '
            <script types="text/javascript\">
                $(document).ready(function(){
                    swal(
                      "Login Gagal!",
                      "Silahkan Cek Lagi Username & Password Anda!",
                      "error"
                    )
                });
              </script>
           ';
         } 

       ?> 

      <div class="modal fade" id="forget">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Forget Password</h4>
               </div>
               <div class="modal-body">
                  <div class="container">
                     <h3 style="font-weight: 600; color: red;">Please Contact Your Administrator !</h3>
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
               </div>
            </div>
            <!-- /.modal-content -->
         </div>
         <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->  
      <!-- jQuery 3 -->
      <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/vendor/metisMenu/metisMenu.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/dist/js/sb-admin-2.js"></script>
   </body>
</html>