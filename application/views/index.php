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

      <script src="<?php echo base_url(); ?>assets/main/js/jquery.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>

      <script src="<?php echo base_url(); ?>assets/dist/js/knockout.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/dist/js/knockout.mapping-latest.js"></script>
      <script src="<?php echo base_url(); ?>assets/dist/js/knockout.mapping-latest.debug.js"></script>


      <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/vendor/kendo-ui/styles/kendo.common.min.css">
      <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/vendor/kendo-ui/styles/kendo.rtl.min.css">
      <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/vendor/kendo-ui/styles/kendo.default.min.css">
      <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/vendor/kendo-ui/styles/kendo.default.mobile.min.css">
      <script src="<?php echo base_url(); ?>assets/vendor/kendo-ui/js/kendo.all.min.js"></script>

      <!-- KO Kendo -->
      <script src="<?php echo base_url(); ?>assets/dist/js/knockout-kendo.min.js"></script>

      <!-- SWAL -->
      <script src="<?php echo base_url(); ?>assets/vendor/sweetalert2/sweetalert2.all.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/vendor/sweetalert2/sweetalert2.min.js"></script>
      <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/vendor/sweetalert2/sweetalert2.min.css">

      <!-- MOMENT -->
      <script src="<?php echo base_url(); ?>assets/vendor/moment/moment.js"></script>
      <script src="<?php echo base_url(); ?>assets/vendor/moment/moment.min.js"></script>

      <!-- LODASH -->
      <script src="<?php echo base_url(); ?>assets/dist/js/lodash.js"></script>

      <!-- inputmask -->
      <script src="<?php echo base_url(); ?>assets/vendor/inputmask/inputmask.js"></script>
      <script src="<?php echo base_url(); ?>assets/vendor/inputmask/inputmask.regex.extensions.js"></script>
      <script src="<?php echo base_url(); ?>assets/vendor/inputmask/jquery.inputmask.js"></script>
      
      <script src="<?php echo base_url(); ?>assets/dist/js/common.js"></script>
      <script>var base_url = '<?php echo base_url() ?>';</script>
   </head>
   <body>

      <!-- <script type="text/javascript">
        $(document).ready(function(){
              Date.prototype.addHours = function(h){
                  this.setHours(this.getHours()+h);
                  return this;
              }
          });
      </script> -->
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

      <nav class="navbar navbar-inverse navbar-fixed-top">
          <div class="container-fluid">
              <div class="navbar-header"><a class="navbar-brand navbar-link" href="<?php echo base_url(); ?>index.php/home">Travel<strong>Online</strong></a>
                  <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
              </div>
              <div class="collapse navbar-collapse" id="navcol-1">
                  <ul class="nav navbar-nav navbar-right">
                      <?php if ($this->uri->segment(1)=="home") { ?>
                        <li role="presentation"><a href="" data-toggle="modal" data-target="#search">Search</a></li>
                      <?php } ?>
                      <?php 
                        if($this->session->userdata('logged_in') == true && !is_null($this->session->userdata('ID_MEMBER')))
                      { ?>
                        <script type="text/javascript">
                          $(function() {
                            getTunggakan()
                          })
                        </script>
                         <li role="presentation"><a href="<?php echo base_url(); ?>index.php/tanggungan">Transaction Charges<span id="Tanggugan" class="badge"></span></a></li>
                         <li role="presentation"><a href="<?php echo base_url(); ?>index.php/history/">History </a></li>
                     <?php 
                        } 
                     ?>
                      <li role="presentation">
                          <a class="dropdown-toggle" data-toggle="dropdown" href="#">My Account </a>
                          <ul class="dropdown-menu">
                              <?php 
                           if ($this->session->userdata('logged_in') == TRUE && !is_null($this->session->userdata('ID_MEMBER'))) {
                             echo '
                               <li><a href="" disabled>Welcome, '.$this->session->userdata('USERNAME').'</a></li>
                               <li><a href="'.base_url().'index.php/login/logout">Logout</a></li>
                             ';
                           } else {
                             echo '
                             <li><a href="" data-toggle="modal" data-target="#login">Login</a></li>
                             <li><a href="'.base_url().'index.php/register/">Register</a></li>
                           ';
                           }
                           
                           ?>
                          </ul>
                      </li>
                  </ul>
              </div>
          </div>
      </nav>

      

      <!-- CONTENT -->
      <?php 
         $this->load->view($main_view);
       ?>

      <footer id="contact">
         <div class="container">
            <div class="row">
               <div class="col-md-4 col-sm-6 footer-navigation">
                  <h3><a href="#">Travel_Online</a></h3>
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
      
      <script>
          getTunggakan = function() {
            url = base_url+"/index.php/home/GetTunggakan"
            ajaxPost(url,{},function(res) {
              result = JSON.parse(res)
              $("#Tanggugan").text(result[0].JUMLAH_TANGGUNGAN);
            })
          }
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

          ko.applyBindings()
        </script>
      
   </body>
</html>