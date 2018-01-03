<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Welcome</title>
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap3/bootstrap.min.css">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cookie">
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/font-awesome/css/font-awesome.min.css">
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/main/css/register.css">
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/main/css/home_page.css">
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/main/css/history.css">
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/main/css/transaction.css">
      
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/main/css/Pretty-Footer.css">


   </head>
   <body>


      <!-- MODAL LOGIN -->
      <div id="login" class="modal fade" role="dialog">
         <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Login</h4>
               </div>
               <div class="modal-body">
                  <?php 
                    $failed = $this->session->flashdata('failed');
                    if(!empty($failed)){
                      echo '<div class="alert alert-danger alert-dismissable">';
                      echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
                      echo '<i class="icon fa fa-warning"></i>';
                      echo $failed;
                      echo '</div>';
                    }
                  ?>
                  <form action="<?php echo base_url(); ?>index.php/login/masuk" method="post">
                     <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" name="username" required>
                     </div>
                     <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" required>
                     </div>
                     <input type="submit" id="login" value="submit" onclick="notice()" style="width: 100%; background-color:#29B6F6; " class=" btn btn-sm btn-primary">
                  </form>
               </div>
            </div>
         </div>
      </div>

      

      <!-- CONTENT -->
      <?php 
         $this->load->view($main_view);
       ?>

      <footer id="contact">
         <div class="container">
            <div class="row">
               <div class="col-md-4 col-sm-6 footer-navigation">
                  <h3><a href="#">Travel__</a></h3>
                  <p class="links"><a href="http://www.smktelkom-mlg.sch.id/" target="_blank">SMK Telkom Malang</a></p>
                  <p class="company-name">Project Work© 2017 </p>
               </div>
               <div class="col-md-4 col-sm-6 footer-contacts">
                  <div>
                     <span class="fa fa-map-marker footer-contacts-icon"> </span>
                     <p><span class="new-line-span">Jl. Danau Ranau Sawojajar</span> Malang, Jawa timur, Indonesia</p>
                  </div>
                  <div>
                     <i class="fa fa-phone footer-contacts-icon"></i>
                     <p class="footer-center-info email text-left">(0341) 712 500</p>
                  </div>
                  <div>
                     <i class="fa fa-envelope footer-contacts-icon"></i>
                     <p> <a href="#" target="_blank">smktelkom-mlg.sch.id</a></p>
                  </div>
               </div>
               <div class="clearfix visible-sm-block"></div>
               <div class="col-md-4 footer-about">
                  <h4>Know Me More!</h4>
                  <div class="social-links social-icons"><a href="https://www.facebook.com/ilham.izzul.3" target="_blank"><i class="fa fa-facebook"></i></a><a href="https://www.instagram.com/ilhamizzul/" target="_blank"><i class="fa fa-instagram"></i></a><a href="https://github.com/ilhamizzul"
                     target="_blank"><i class="fa fa-github"></i></a></div>
               </div>
            </div>
         </div>
      </footer>
      <script src="<?php echo base_url(); ?>assets/main/js/jquery.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
      <script>
         $(document).ready(function(){
             $('#note').click(function(){
                 $(this).fadeOut();
             });
         });

         $(document).ready(function(){
             $('#close').click(function(){
                 $(this).fadeOut();
             });
         });
        
          $(document).ready(function(){
              $('#login').click(function(){
                  $('#choose').modal('hide');
              });
          });




        </script>
      
   </body>
</html>