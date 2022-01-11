<?php
  include "config.php";
  session_start();

  if ($_SESSION['status']!="login"){
    //header("location:../index.php?pesan=belum_login");
    echo "<script>alert('Login First!');document.location='login.php'</script>";

  } else  if ((time() - $_SESSION['last_login_timestamp']) > 18000) { // 18000 seconds = 5 * 3600    
    //header("location:functions/logout.php");  
    $_SESSION['status'] = "logout";
    echo "<script>alert('Session Timed out!');document.location='login.php'</script>";

  } else {
    $user = $_SESSION['username'];
    $pick=mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$user'");
    $fetch=mysqli_fetch_array($pick);

  }

  if ($fetch['role'] != "user") {
    echo "<script>alert('You are logged as an Canteen owner');document.location='owner/index_owner.php'</script>";
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
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/Style2.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
  </head>

  <body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-danger">
      <!-- Navbar Brand-->
      <a class="navbar-brand ps-3 fw-bold" href="index.php">WELCOME \(￣︶￣*\))</a>
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
            <li><a class="dropdown-item" href="#!">Settings</a></li>
            <li><a class="dropdown-item" href="#!">Activity Log</a></li>
            <li><a class="dropdown-item" href="add_canten.php">Add Canten</a></li>
            <li><hr class="dropdown-divider" /></li>
            <li><a class="dropdown-item" href="functions/logout.php">Logout</a></li>
          </ul>
        </li>
      </ul>
    </nav>
    <div id="layoutSidenav">
      <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
          <div class="sb-sidenav-menu">
            <div class="nav">
              <div class="sb-sidenav-menu-heading">Home</div>
              <a class="nav-link" href="index.php">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                HomePage
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
              <div class="sb-sidenav-menu-heading">Addons</div>
              <a class="nav-link" href="charts.html">
                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                Charts
              </a>
              <a class="nav-link" href="tables.html">
                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                Tables
              </a>
            </div>
          </div>
          <div class="sb-sidenav-footer">
            <div class="small">Logged in as: <?php echo $fetch['username']; ?></div> 
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
                <div class="bestdeal mx-auto">
                  <h3 class="fw-bold">Best Deal</h3>
                  <br /><br />
                  <div class="container">
                    <div class="bestDealMenu d-flex">
                      <div class="swiper-button-prev-unique">
                        <button class="border-0 bg-transparent">
                          <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="white" class="bi bi-chevron-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
                          </svg>
                        </button>
                      </div>
                      <div class="swiper">                       
                        <div class="swiper-container">
                          <div class="swiper-wrapper gap-3" style="display: flex">
                            <!-- Menu Makan 1 --> 
                            <?php  
                               $pickMenu = mysqli_query($koneksi, "SELECT * FROM menu ORDER BY id_menu asc") or die (mysqli_error());
                                while ($fetchMenu=mysqli_fetch_array($pickMenu)) { 
                            ?>                            
                            <div class="swiper-slide">                          
                              <div class="card p-0 mr-3 ml-3" style="width: 20rem;">
                                <img src="img/<?php echo $fetchMenu['img_menu']; ?>" class="card-img-top" alt="..." />
                                <div class="card-body">
                                  <div class="judulmenu d-flex">
                                    <div class="col-10 text-start">
                                      <h5 class="card-title fw-bold">
                                        <?php echo $fetchMenu['nama_menu']; ?> <span style="font-size: small; color: gray"><p class="pt-2 m-0">Rp <?php echo $fetchMenu['price_menu']; ?></p></span>
                                      </h5>
                                    </div>
                                    <div class="col-2 text-end">
                                      <button id="btns1" class="btnfav" onclick="toggle1('btns1')"><i class="bi bi-heart-fill"></i></button>
                                    </div>
                                  </div>
                                  <p class="card-text pt-2"><?php echo $fetchMenu['nama_menu']; ?></p>
                                  <div class="formcheck">
                                    <form action="">
                                      <div class="button-click row pt-3 ps-2">
                                        <a href="Cafetaria1.html" class="btn btn-click d-flex align-content-center">
                                          <div class="col"><p style="font-size: 0.8em" class="text-start">Pesan</p></div>
                                          <span class="text-end"><i class="bi bi-cart-plus"></i></span
                                        ></a>
                                      </div>
                                    </form>
                                  </div>
                                </div>
                              </div>                           
                            </div>
                          <?php } ?>
                            
                             <!-- Menu Makan 1 akhir -->                              
                              <!-- Menu Makan 2 -->
                           <!--  <div class="swiper-slide">                           
                              <div class="card p-0">
                                <img src="assets/img/mie kuah.jpg" class="card-img-top" alt="..." />
                                <div class="card-body">
                                  <div class="judulmenu d-flex">
                                    <div class="col-10 text-start">
                                      <h5 class="card-title fw-bold">
                                        Mie Kuah <span style="font-size: small; color: gray"><p class="pt-2 m-0">Rp 5.000</p></span>
                                      </h5>
                                    </div>
                                    <div class="col-2 text-end">
                                      <button id="btns2" class="btnfav" onclick="toggle1('btns2')"><i class="bi bi-heart-fill"></i></button>
                                    </div>
                                  </div>
                                  <p class="card-text pt-2">Menyediakan makanan khas padang dan minuman.</p>
                                  <div class="formcheck">
                                    <form action="">
                                      <div class="button-click row pt-3 ps-2">
                                        <a href="Cafetaria1.html" class="btn btn-click d-flex align-content-center">
                                          <div class="col"><p style="font-size: 0.8em" class="text-start">Pesan</p></div>
                                          <span class="text-end"><i class="bi bi-cart-plus"></i></span
                                        ></a>
                                      </div>
                                    </form>
                                  </div>
                                </div>
                              </div>                             
                            </div> -->
                             <!-- Menu Makan 2 akhir -->
                              <!-- Menu Makan 3 -->
                           <!--  <div class="swiper-slide">                             
                              <div class="card p-0">
                                <img src="assets/img/mie ayam.jpg" class="card-img-top" alt="..." />
                                <div class="card-body">
                                  <div class="judulmenu d-flex">
                                    <div class="col-10 text-start">
                                      <h5 class="card-title fw-bold">
                                        Mie Ayam <span style="font-size: small; color: gray"><p class="pt-2 m-0">Rp 13.000</p></span>
                                      </h5>
                                    </div>
                                    <div class="col-2 text-end">
                                      <button id="btns3" class="btnfav" onclick="toggle1('btns3')"><i class="bi bi-heart-fill"></i></button>
                                    </div>
                                  </div>
                                  <p class="card-text pt-2">Menyediakan makanan khas padang dan minuman.</p>
                                  <div class="formcheck">
                                    <form action="">
                                      <div class="button-click row pt-3 ps-2">
                                        <a href="Cafetaria1.html" class="btn btn-click d-flex align-content-center">
                                          <div class="col"><p style="font-size: 0.8em" class="text-start">Pesan</p></div>
                                          <span class="text-end"><i class="bi bi-cart-plus"></i></span
                                        ></a>
                                      </div>
                                    </form>
                                  </div>
                                </div>
                              </div>                             
                            </div> -->
                            <!-- Menu Makan 3 akhir -->
                             <!-- Menu Makan 4 -->
                           <!--  <div class="swiper-slide">                             
                              <div class="card p-0">
                                <img src="assets/img/perkedel + sayur.jpg" class="card-img-top" alt="..." />
                                <div class="card-body">
                                  <div class="judulmenu d-flex">
                                    <div class="col-10 text-start">
                                      <h5 class="card-title fw-bold">
                                        Nasi + Lauk <span style="font-size: small; color: gray"><p class="pt-2 m-0">Rp 5.000</p></span>
                                      </h5>
                                    </div>
                                    <div class="col-2 text-end">
                                      <button id="btns4" class="btnfav" onclick="toggle1('btns4')"><i class="bi bi-heart-fill"></i></button>
                                    </div>
                                  </div>
                                  <p class="card-text pt-2">Menyediakan makanan khas padang dan minuman.</p>
                                  <div class="formcheck">
                                    <form action="">
                                      <div class="button-click row pt-3 ps-2">
                                        <a href="Cafetaria1.html" class="btn btn-click d-flex align-content-center">
                                          <div class="col"><p style="font-size: 0.8em" class="text-start">Pesan</p></div>
                                          <span class="text-end"><i class="bi bi-cart-plus"></i></span
                                        ></a>
                                      </div>
                                    </form>
                                  </div>
                                </div>
                              </div>                              
                            </div> -->
                            <!-- Menu Makan 4akhir -->
                            <!-- Menu Makan 5 -->
                            <!-- <div class="swiper-slide">                             
                              <div class="card p-0">
                                <img src="assets/img/es teh.jpg" class="card-img-top" alt="..." />
                                <div class="card-body">
                                  <div class="judulmenu d-flex">
                                    <div class="col-10 text-start">
                                      <h5 class="card-title fw-bold">
                                        Ice Tea <span style="font-size: small; color: gray"><p class="pt-2 m-0">Rp 3.000</p></span>
                                      </h5>
                                    </div>
                                    <div class="col-2 text-end">
                                      <button id="btns5" class="btnfav" onclick="toggle1('btns5')"><i class="bi bi-heart-fill"></i></button>
                                    </div>
                                  </div>
                                  <p class="card-text pt-2">Menyediakan makanan khas padang dan minuman.</p>
                                  <div class="formcheck">
                                    <form action="">
                                      <div class="button-click row pt-3 ps-2">
                                        <a href="Cafetaria1.html" class="btn btn-click d-flex align-content-center">
                                          <div class="col"><p style="font-size: 0.8em" class="text-start">Pesan</p></div>
                                          <span class="text-end"><i class="bi bi-cart-plus"></i></span
                                        ></a>
                                      </div>
                                    </form>
                                  </div>
                                </div>
                              </div>                              
                            </div> -->
                            <!-- Menu Makan 5 akhir -->
                            <!-- Menu Makan 6 -->
                            <!-- <div class="swiper-slide">
                              <div class="card p-0">
                                <img src="assets/img/jus alpukat.jpg" class="card-img-top" alt="..." />
                                <div class="card-body">
                                  <div class="judulmenu d-flex">
                                    <div class="col-10 text-start">
                                      <h5 class="card-title fw-bold">
                                        Jus Alpukat <span style="font-size: small; color: gray"><p class="pt-2 m-0">Rp 10.000</p></span>
                                      </h5>
                                    </div>
                                    <div class="col-2 text-end">
                                      <button id="btns6" class="btnfav" onclick="toggle1('btns6')"><i class="bi bi-heart-fill"></i></button>
                                    </div>
                                  </div>
                                  <p class="card-text pt-2">Menyediakan makanan khas padang dan minuman.</p>
                                  <div class="formcheck">
                                    <form action="">
                                      <div class="button-click row pt-3 ps-2">
                                        <a href="Cafetaria1.html" class="btn btn-click d-flex align-content-center">
                                          <div class="col"><p style="font-size: 0.8em" class="text-start">Pesan</p></div>
                                          <span class="text-end"><i class="bi bi-cart-plus"></i></span
                                        ></a>
                                      </div>
                                    </form>
                                  </div>
                                </div>
                              </div>                              
                            </div> -->
                            <!-- Menu Makan 6 akhir -->
                          </div>
                        </div>
                      </div>
                      <div class="swiper-button-next-unique">
                        <button class="border-0 bg-transparent">
                          <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="white" class="bi bi-chevron-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
                          </svg>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>

                 <?php 
                                $pickMenu = mysqli_query($koneksi, "SELECT * FROM menu ORDER BY id_menu aSC") or die (mysqli_error());
                                while ($fetchMenu=mysqli_fetch_array($pickMenu)) { 
                              ?>                              
                              <div class="card p-0 mt-5 mb-4" style="width: 20rem; margin-left: 2rem;">
                                <img src="img/<?php echo $fetchMenu['img_menu']; ?>" class="card-img-top" alt="..." />
                                <div class="card-body">
                                  <div class="judulmenu d-flex">
                                    <div class="col-10 text-start">
                                      <h5 class="card-title fw-bold">
                                        <?php echo $fetchMenu['nama_menu']; ?> <span style="font-size: small; color: gray"><p class="pt-2 m-0">Rp <?php echo $fetchMenu['price_menu']; ?></p></span>
                                      </h5>
                                    </div>
                                    <div class="col-2 text-end">
                                      <button id="btns1" class="btnfav" onclick="toggle1('btns1')"><i class="bi bi-heart-fill"></i></button>
                                    </div>
                                  </div>
                                  <p class="card-text pt-2"><?php echo $fetchMenu['desc_menu']; ?></p>
                                  <div class="formcheck">
                                    <form action="">
                                      <div class="button-click row pt-3 ps-2">
                                        <a href="Cafetaria1.html" class="btn btn-click d-flex align-content-center">
                                          <div class="col"><p style="font-size: 0.8em" class="text-start">Pesan</p></div>
                                          <span class="text-end"><i class="bi bi-cart-plus"></i></span
                                        ></a>
                                      </div>
                                    </form>
                                  </div>
                                </div>
                              </div>   
                              <?php } ?>   

                <?php  
                  $queryCanten = mysqli_query($koneksi, "SELECT * FROM cafetaria ORDER BY id_cafet DESC") or die (mysqli_error());
                ?>

                <div class="toko">
                  <br /><br /><br /><br />
                  <h3 class="fw-bold m-0">Canteen</h3>
                  <br /><br />
                  <div class="kantin row gap-4 mx-auto">
                    <!-- Rumah Makan 1 -->
                    <?php 
                      while ($fetchCanten = mysqli_fetch_array($queryCanten))
                      {
                    ?>
                    <div class="card p-0" style="width: 15rem; height: 22rem">
                      <img src="assets/img/Resto1.jpg" class="card-img-top" alt="..." />
                      <div class="card-body">
                        <h5 class="card-title fw-bold"><?php echo $fetchCanten['nama_cafet']; ?></h5>
                        <p class="card-text"><?php echo $fetchCanten['cafet_desc']; ?></p>
                        <div class="button-click row pt-4 ps-2">
                          <!-- <a href="Cafetaria_info.php<?php $id=$fetchCanten['id_cafet']; ?>" class="btn btn-click"> -->
                          <?php 
                            echo "<a href='Cafetaria_info.php?id_c=$fetchCanten[id_owner]' class='btn btn-click'>";
                          ?>
                            Lihat <span><i class="fas fa-angle-right" style="width: 32"></i></span>
                          </a>
                        </div>
                      </div>
                    </div>
                    <?php 
                      }
                    ?>
                    <!-- Rumah Makan 1 akhir -->
                    <!-- Rumah Makan 2 -->
                    <!-- <div class="card p-0" style="width: 15rem; height: 22rem">
                      <img src="assets/img/Resto2.jpg" class="card-img-top" alt="..." />
                      <div class="card-body">
                        <h5 class="card-title fw-bold">Cafetaria 2</h5>
                        <p class="card-text">Menyediakan makanan khas padang dan minuman.</p>
                        <div class="button-click row pt-4 ps-2">
                          <a href="Cafetaria1.html" class="btn btn-click"
                            >Lihat <span><i class="fas fa-angle-right" style="width: 32"></i></span
                          ></a>
                        </div>
                      </div>
                    </div> -->
                    <!-- Rumah Makan 2 akhir -->
                    <!-- Rumah Makan 3 -->
                    <!-- <div class="card p-0" style="width: 15rem; height: 22rem">
                      <img src="assets/img/Resto3.jpg" class="card-img-top" alt="..." />
                      <div class="card-body">
                        <h5 class="card-title fw-bold">Cafetaria 3</h5>
                        <p class="card-text">Menyediakan makanan khas padang dan minuman.</p>
                        <div class="button-click row pt-4 ps-2">
                          <a href="Cafetaria1.html" class="btn btn-click"
                            >Lihat <span><i class="fas fa-angle-right" style="width: 32"></i></span
                          ></a>
                        </div>
                      </div>
                    </div> -->
                    <!-- Rumah Makan 3 akhir -->
                    <!-- Rumah Makan 4 -->
                    <!-- <div class="card p-0" style="width: 15rem; height: 22rem">
                      <img src="assets/img/Resto4.jpg" class="card-img-top" alt="..." />
                      <div class="card-body">
                        <h5 class="card-title fw-bold">Cafetaria 4</h5>
                        <p class="card-text">Menyediakan makanan khas padang dan minuman.</p>
                        <div class="button-click row pt-4 ps-2">
                          <a href="Cafetaria1.html" class="btn btn-click"
                            >Lihat <span><i class="fas fa-angle-right" style="width: 32"></i></span
                          ></a>
                        </div>
                      </div>
                    </div> -->
                    <!-- Rumah Makan 4 akhir -->
                  </div>
                </div>
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
