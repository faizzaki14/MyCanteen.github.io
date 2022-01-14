<?php
  //error_reporting(E_ALL ^ E_WARNING);
  include "../config.php";
  session_start();

  if ($_SESSION['status']!="login"){
    //header("location:../index.php?pesan=belum_login");
    echo "<script>alert('Login First!');document.location='../login.php'</script>";

  } else  if ((time() - $_SESSION['last_login_timestamp']) > 18000) { // 18000 seconds = 5 * 3600    
    //header("location:functions/logout.php");  
    $_SESSION['status'] = "logout";
    echo "<script>alert('Session Timed out!');document.location='../login.php'</script>";

  } else {
    $user = $_SESSION['username'];

    $pick=mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$user'");
    $fetch=mysqli_fetch_array($pick);
    $id_owner = $fetch['id'];

    $queryMenu = mysqli_query($koneksi, "SELECT * FROM menu ORDER BY id_menu Asc") or die (mysqli_error());   
    
    $queryCanten = mysqli_query($koneksi, "SELECT * FROM cafetaria WHERE id_owner = '$id_owner'") or die (mysqli_error());  
    $check = mysqli_fetch_array($queryCanten);

  }

  if ($fetch['role'] != "own") {
    echo "<script>alert('You are logged as a Reguler User');document.location='index.php'</script>";
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>My Canteen</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" />
    <link href="../css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/Style2.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
  </head>

  <body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-danger">
      <!-- Navbar Brand-->
      <a class="navbar-brand ps-3 fw-bold" href="../index.php">My Canteen</a>
      <!-- Sidebar Toggle-->
      <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
      <!-- Navbar Search-->
      <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
          <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
          <button class="btn" id="btnNavbarSearch" type="button" style="background-color: rgb(253, 47, 88)"><i class="fas fa-search" style="color: white"></i></button>
        </div>
      </form>
      <!-- Navbar-->
      <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            <!-- <li><a class="dropdown-item" href="#!">Settings</a></li> -->
           <!--  <li><a class="dropdown-item" href="#!">Activity Log</a></li> -->
            <li><a class="dropdown-item" href="profile_owner.php">Update Profile</a></li>
            <li><a class="dropdown-item" href="updateCanteen.php">Update Canten</a></li>
            <li><hr class="dropdown-divider" /></li>
            <li><a class="dropdown-item" href="../functions/logout.php">Logout</a></li>
          </ul>
        </li>
      </ul>
    </nav>
    <div id="layoutSidenav">
      <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
          <div class="sb-sidenav-menu">
            <div class="nav">
              <div class="sb-sidenav-menu-heading">Canteen</div>
              <?php 
                $idCheck = $check['id_cafet'];
                if($idCheck === null) {
                  echo "<a class='nav-link' href='add_canten.php'>
                        <div class='sb-nav-link-icon'><i class='fas fa-tachometer-alt'></i></div>
                        Add New Canteen
                      </a>";
                }
              ?>              
              <a class="nav-link" href="add_menu.php">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Add New Menu
              </a>
              <div class="sb-sidenav-menu-heading">Keranjang</div>
              <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                Keranjang
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
              </a>
              <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                  <a class="nav-link" href="layout-static.html">CheckOut</a>
                  <a class="nav-link" href="layout-sidenav-light.html">Riwayat Transaksi</a>
                </nav>
              </div>
              <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                <div class="sb-naFsettingv-link-icon"><i class="fas fa-book-open"></i></div>
                 Favorite
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
              </a>
              <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                  <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                    Warung Makan
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                  </a>
                  <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                    <nav class="sb-sidenav-menu-nested nav">
                      <a class="nav-link" href="login.html">Login</a>
                      <a class="nav-link" href="register.html">Register</a>
                      <a class="nav-link" href="password.html">Forgot Password</a>
                    </nav>
                  </div>
                  <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                    Menu
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                  </a>
                  <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                    <nav class="sb-sidenav-menu-nested nav">
                      <a class="nav-link" href="401.html">401 Page</a>
                      <a class="nav-link" href="404.html">404 Page</a>
                      <a class="nav-link" href="500.html">500 Page</a>
                    </nav>
                  </div>
                </nav>
              </div>
              <!-- <div class="sb-sidenav-menu-heading">Addons</div>
              <a class="nav-link" href="charts.html">
                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                Charts
              </a>
              <a class="nav-link" href="tables.html">
                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                Tables
              </a> -->
            </div>
          </div>
          <div class="sb-sidenav-footer">
            <div class="small">Logged in as: <?php echo $fetch['username']; ?></div> 
            <div class="small">ID User: <?php echo $fetch['id']; ?></div> 
            <div class="small">ID Canteen: <?php echo $check['id_cafet']; ?></div> 
            <div class="small">Role: <?php echo $fetch['role']; ?></div>            
          </div>
        </nav>
      </div>
      <div id="layoutSidenav_content">
        <main class="ps-3">
          <br />
          <div class="container">
            <div class="col-lg-12 col-sm-12 col-md-12 row">
              <div class="row">
                <h3 class="fw-bold mt-2 mb-2" style="width: 50%;">Manage Menu</h3>
                <br><br><p></p>
                <!-- <div class="col-lg-12 col-sm-12 col-md-3 mt-2 mb-2 p-2 border" id="owned_canten">
                  <h2 class="display-4">Display 4</h2>
                </div> -->
                <?php

                  while ($fetchCanten = mysqli_fetch_array($queryMenu)) {
                    if ($fetchCanten['id_canteen'] == $fetch['id']) {
                
                ?>
                <div class="card p-0 mb-4 ml-5" style="width: 20rem; margin-left: 0.8rem;">
                  <img src="../img/<?php  echo $fetchCanten['img_menu'];?>" width="80" height="80">
                  <div class="card-body">
                    <div class="judulmenu d-flex">
                      <div class="col-10 text-start">
                        <h5 class="card-title fw-bold">
                            <?php echo $fetchCanten['nama_menu']; ?> <span style="font-size: small; color: gray"><p class="pt-2 m-0">Rp <?php echo $fetchCanten['price_menu']; ?></p></span>
                        </h5>
                      </div>
                    </div>
                    <p class="card-text pt-2">"<?php echo $fetchCanten['desc_menu']; ?>"</p>
                    <div class="formcheck">
                      <form action="">
                        <div class="button-click row pt-3 ps-2">
                          <a href="updateMenu.php?id_c=<?php echo $fetchCanten['id_menu']; ?>" class="btn btn-primary mb-2">Update</a> 
                          <!-- <a href="../functions/delete_menu_process.php?id_c=<?php echo $fetchCanten['id_menu']; ?>" class="btn btn-danger">Delete</a> -->
                          <?php  echo "<td><a onClick=\"javascript: return confirm('Please confirm deletion');\" href='../functions/delete_menu_process.php?id_c=".$fetchCanten['id_menu']."' class='btn btn-danger'>Delete</a></td><tr>"; //use double quotes for js inside php!  ?>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <?php
                    }
                  }
                ?>
              </div>
            </div>
          </div>
        </main>
        <footer class="py-4 bg-light mt-auto">
          <div class="container-fluid px-4">
            <div class="d-flex align-items-center justify-content-between small">
              <div class="text-muted">Copyright &copy; My Canteen 2021</div>
              <div>
                <a href="#">Privacy Policy</a>
                &middot;
                <a href="#">Terms &amp; Conditions</a>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <script src="js/datatables-simple-demo.js"></script>
    <script type="module">
      var swiper = new Swiper(".swiper-container", {
        slidesPerView: 4,
        spacebetween: 100,
        loop: true,
        navigation: {
          nextEl: ".swiper-button-next-unique",
          prevEl: ".swiper-button-prev-unique",
        },
      });
    </script>
    <script>
      function toggle1(id) {
        var x = document.getElementById(id);
        if (x.style.color === "red") {
          x.style.color = "grey";
        } else {
          x.style.color = "red";
        }
      }
    </script>
  </body>
</html>
