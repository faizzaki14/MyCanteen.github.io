<?php
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

  }

  if ($fetch['role'] != "own") {
    echo "<script>alert('You are logged as a Reguler User');document.location='../index.php'</script>";
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
      <a class="navbar-brand ps-3 fw-bold" href="index.php">My Canteen</a>
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
              <div class="sb-sidenav-menu-heading">Home</div>
              <a class="nav-link" href="index_owner.php">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                HomePage
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
            <div class="col-lg-12 col-sm-12 col-md-3 row">
              <div class="row">
                <h3 class="fw-bold mt-2 mb-2" style="width: 50%;">Add Menu</h3>
                <div class="col-lg-12 col-sm-12 col-md-3 mt-2 mb-2 p-2 border" id="owned_canten">
                  <form action="../functions/add_menu_process.php" method="post" enctype="multipart/form-data" class="form-group">
                    <input type="hidden" name="id_owner" value="<?php echo $fetch['id']; ?>">
                    <div class="form-group mb-3">
                      <label for="menuName">Menu Name</label>
                      <input type="text" class="form-control" id="menuName" name="menuName" aria-describedby="emailHelp" placeholder="Enter Menu Name">                     
                    </div>
                    <div class="form-group mb-3">
                      <label for="menuDesc">Menu Description</label>
                      <textarea class="form-control" id="menuDesc" name="menuDesc" rows="3"></textarea>
                    </div>
                    <div class="form-group mb-3">
                      <label for="menuPrice">Menu Price</label>
                      <input type="text" class="form-control" id="menuPrice" name="menuPrice" aria-describedby="emailHelp" placeholder="Enter Price Amount">                     
                    </div>
                    <div class="form-group mb-3">
                      <label for="exampleFormControlSelect1">Menu Type</label>
                      <select class="form-control" id="exampleFormControlSelect1" name="menuType">
                        <option selected disabled>Pilih</option>
                        <option>food</option>
                        <option>drinks</option>
                      </select>
                    </div>
                    <div class="form-group mb-3">
                      <input type="file" class="form-control" name="menuPic"  required="true">
                      <span style="color:red; font-size:12px;">Only jpg / jpeg/ png /gif format allowed.</span>
                    </div> 
                    <br>
                    <button type="submit" name="submitAdd" class="btn btn-primary">Submit</button>
                  </form>
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
