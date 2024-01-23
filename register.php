
<?php 
session_start();
 $_SESSION['judul'] = "Halaman Register";
  include 'asset/headerakses.php';
  include 'class_controller.php';

  if(isset($_POST['submit']))
  {
    $regis = new laptop();
    $regis->registrasi($_POST);;
   
    
    
  }
; ?>


          <div class="row">
            <div class="col-lg-12">
              <div class="p-5">
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4">Registrasi</h1>
                </div>
                <form class="user" action="" method="post">
               
                  <div class="form-group">
                    <input type="email" class="form-control form-control-user" id="exampleInputEmail" name="email" placeholder="Email Address" required/>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <input type="password" class="form-control form-control-user" id="exampleInputPassword" name="pass1" placeholder="Password" required />
                    </div>
                    <div class="col-sm-6">
                      <input type="password" class="form-control form-control-user" id="exampleRepeatPassword" name="pass2" placeholder="Konfirm Password" re\ />
                    </div>
                  </div>
                  
                  <button type="submit" name="submit" class="btn btn-primary btn-user btn-block">Register</button>
                  <hr />
                  
                </form>
                <hr />
                
                <div class="text-center">
                  <a class="small" href="index.php">Already have an account? Login!</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php 
  include 'asset/footerakses.php';
; ?>
