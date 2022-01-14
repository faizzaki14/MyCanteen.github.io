<?php
  include "config.php";
  session_start();
  $_SESSION['status'] = "logout";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/style3.css" />
    <title>My Canteen</title>
  </head>

  <body style="background-color: #f87b7b38">

    <!-- Pesan Login -->
    <?php
      // if(isset($_GET['pesan'])){
      //   if($_GET['pesan'] == "gagal"){
      //     echo "<script>alert('Invalid Email or Password')</script>";
      //   }else if($_GET['pesan'] == "logout"){
      //     echo "<script>alert('Anda telah berhasil logout')</script>";
      //   }else if($_GET['pesan'] == "belum_login"){
      //     echo "<script>alert('Anda harus login untuk mengakses halaman admin')</script>";
      //   } 
      // } 
      // header("?pesan=nol")
    ?>

    <!-- Main Content -->
    <div class="container-fluid">

      <div class="row main-content bg-warning text-center">
        
        <div class="col-md-4 text-center company__info" style="background-color: crimson">
          <span class="company__logo"
            ><h2><span class="fa fa-android"></span></h2
          ></span>
          <h4 class="company_title">My Canteen</h4>
        </div>

        <div class="col-md-8 col-xs-12 col-sm-12 login_form">
          <div class="container-fluid">
            <div class="row pt-2">
              <h2>Log In As Canteen Owners</h2>
            </div>
            <div class="row">

              <form method="post" class="form-group" action="functions/login_check.php">
                <div class="row">
                  <input type="text" name="username" id="username" class="form__input" placeholder="Username" />
                </div>
                <div class="row">
                  <!-- <span class="fa fa-lock"></span> -->
                  <input type="password" name="password" id="password" class="form__input" placeholder="Password" />
                </div>
                <center>
                  <div class="login d-flex flex-column justify-content-center">
                    <div class="d-flex align-items-center">
                      <input type="checkbox" name="remember_me" id="remember_me" class="" />
                      <label for="remember_me" class="ps-2">Remember Me!</label>
                    </div>
                    <div class="row justify-content-center">
                      <!-- <input type="submit" value="Login Me" class="btn" onclick="window.location.href='MainMenu.html'" /> -->
                      <input type="submit" name="submit_login_owner" value="Login" class="btn"/>
                    </div>
                  </div>
                </center>
              </form>
              
            </div>

            <div class="row">
              <p>Don't have an account? <a href="signUp_canten.php">Register Here</a></p>
              <br>              
            </div>
            <div class="form-group col-lg-12 mx-auto d-flex align-items-center my-4">
              <div class="border-bottom w-100 ml-5"></div>
              <span class="px-2 small text-muted font-weight-bold text-muted">OR</span>
              <div class="border-bottom w-100 mr-5"></div>
            </div>
            <div class="row sosmedicon text-center">
              <ul class="d-flex list-unstyled justify-content-between text-center">
                <li class="google text-center pt-2">
                  <a href="" class="text-decoration-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="white" class="bi bi-google" viewBox="0 0 16 16">
                      <path
                        d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z"
                      />
                    </svg>
                  </a>
                </li>
                <li class="github text-center pt-2">
                  <a href="" class="text-decoration-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="white" class="bi bi-github" viewBox="0 0 16 16">
                      <path
                        d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z"
                      />
                    </svg>
                  </a>
                </li>
                <li class="facebook text-center pt-2">
                  <a href="" class="text-decoration-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="white" class="bi bi-facebook" viewBox="0 0 16 16">
                      <path
                        d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"
                      />
                    </svg>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>

      </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
