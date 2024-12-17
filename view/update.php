<?php
include "../model/model.php";
include "../controller/ProductController.php";
$Category = new CategoryController();
$prod = $Category->CategoryList();
$product = null;
$error = "";

// Create an instance of the controller
$productController = new ProductController();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["id_product"]) && isset($_POST["name"]) && isset($_POST["price"]) && isset($_POST["id_cat"]) && isset($_POST["description"])) {
        if (!empty($_POST["id_product"]) && !empty($_POST["name"]) && !empty($_POST["price"]) && !empty($_POST["id_cat"]) && !empty($_POST["description"])) {
            // Create product object
            $product = new ProductM(
                null,
                htmlspecialchars($_POST['name']),
                floatval($_POST['price']),
                intval($_POST['id_cat']),
                htmlspecialchars($_POST['description'])
            );
            // Call the update function
            $productController->updateProduct($product, intval($_POST['id_product']));
            // Redirect after successful update
            header('Location: myitems.php');
            exit();
        } else {
            $error = "All fields are required!";
        }
    } else {
        $error = "Invalid data received!";
    }
}

// Fetch the product by ID
if (isset($_GET['id_product']) && is_numeric($_GET['id_product'])) {
    $product = $productController->getProductById(intval($_GET['id']));
} else {
    $error = "Product ID is invalid or missing.";
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Grow&Glow</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="../public/img/logo-bare.jpg" rel="icon">
  <link href="../public/img/logo-bare.jpg" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Marcellus:wght@400&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../public/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../public/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../public/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="../public/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="../public/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="../public/assets/css/store.css" rel="stylesheet">


</head>
  <body>
    <!DOCTYPE html>
    <html lang="en">
    
    <head>
      <meta charset="utf-8">
      <meta content="width=device-width, initial-scale=1.0" name="viewport">
    
      <title>Dashboard - NiceAdmin Bootstrap Template</title>
      <meta content="" name="description">
      <meta content="" name="keywords">
    
      <!-- Favicons -->
      <link href="../public/img/favicon.png" rel="icon">
      <link href="../public/img/apple-touch-icon.png" rel="apple-touch-icon">
    
      <!-- Google Fonts -->
      <link href="https://fonts.gstatic.com" rel="preconnect">
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    
      <!-- Vendor CSS Files -->
      <link href="../public/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <link href="../public/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
      <link href="../public/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
      <link href="../public/assets/vendor/quill/quill.snow.css" rel="stylesheet">
      <link href="../public/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
      <link href="../public/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
      <link href="../public/assets/vendor/simple-datatables/style.css" rel="stylesheet">
    
      <!-- Template Main CSS File -->
      <link href="../public/assets/css/style.css" rel="stylesheet">
    
      <!-- =======================================================
      * Template Name: NiceAdmin
      * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
      * Updated: Apr 20 2024 with Bootstrap v5.3.3
      * Author: BootstrapMade.com
      * License: https://bootstrapmade.com/license/
      ======================================================== -->
    </head>
    
    <body>
    
      <!-- ======= Header ======= -->
      <header id="header" class="header fixed-top d-flex align-items-center">
    
        <div class="d-flex align-items-center justify-content-between">
          <a href="home.html" class="logo d-flex align-items-center">
            <img src="../public/img/logo.jpg" alt="">
          </a>
          <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->
    
        <div class="search-bar">
          <form class="search-form d-flex align-items-center" method="POST" action="#">
            <input type="text" name="query" placeholder="Search" title="Enter search keyword">
            <button type="submit" title="Search"><i class="bi bi-search"></i></button>
          </form>
        </div><!-- End Search Bar -->
    
        <nav class="header-nav ms-auto">
          <ul class="d-flex align-items-center">
    
            <li class="nav-item d-block d-lg-none">
              <a class="nav-link nav-icon search-bar-toggle " href="#">
                <i class="bi bi-search"></i>
              </a>
            </li><!-- End Search Icon-->
    
            <li class="nav-item dropdown">
    
              <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                <i class="bi bi-bell"></i>
                <span class="badge bg-primary badge-number">4</span>
              </a><!-- End Notification Icon -->
    
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                <li class="dropdown-header">
                  You have 4 new notifications
                  <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                </li>
                <li>
                  <hr class="dropdown-divider">
                </li>
    
                <li class="notification-item">
                  <i class="bi bi-exclamation-circle text-warning"></i>
                  <div>
                    <h4>Lorem Ipsum</h4>
                    <p>Quae dolorem earum veritatis oditseno</p>
                    <p>30 min. ago</p>
                  </div>
                </li>
    
                <li>
                  <hr class="dropdown-divider">
                </li>
    
                <li class="notification-item">
                  <i class="bi bi-x-circle text-danger"></i>
                  <div>
                    <h4>Atque rerum nesciunt</h4>
                    <p>Quae dolorem earum veritatis oditseno</p>
                    <p>1 hr. ago</p>
                  </div>
                </li>
    
                <li>
                  <hr class="dropdown-divider">
                </li>
    
                <li class="notification-item">
                  <i class="bi bi-check-circle text-success"></i>
                  <div>
                    <h4>Sit rerum fuga</h4>
                    <p>Quae dolorem earum veritatis oditseno</p>
                    <p>2 hrs. ago</p>
                  </div>
                </li>
    
                <li>
                  <hr class="dropdown-divider">
                </li>
    
                <li class="notification-item">
                  <i class="bi bi-info-circle text-primary"></i>
                  <div>
                    <h4>Dicta reprehenderit</h4>
                    <p>Quae dolorem earum veritatis oditseno</p>
                    <p>4 hrs. ago</p>
                  </div>
                </li>
    
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li class="dropdown-footer">
                  <a href="#">Show all notifications</a>
                </li>
    
              </ul><!-- End Notification Dropdown Items -->
    
            </li><!-- End Notification Nav -->
    
            <li class="nav-item dropdown">
    
              <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                <i class="bi bi-chat-left-text"></i>
                <span class="badge bg-success badge-number">3</span>
              </a><!-- End Messages Icon -->
    
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
                <li class="dropdown-header">
                  You have 3 new messages
                  <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                </li>
                <li>
                  <hr class="dropdown-divider">
                </li>
    
                <li class="message-item">
                  <a href="#">
                    <img src="../public/img/messages-1.jpg" alt="" class="rounded-circle">
                    <div>
                      <h4>Maria Hudson</h4>
                      <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                      <p>4 hrs. ago</p>
                    </div>
                  </a>
                </li>
                <li>
                  <hr class="dropdown-divider">
                </li>
    
                <li class="message-item">
                  <a href="#">
                    <img src="../public/img/messages-2.jpg" alt="" class="rounded-circle">
                    <div>
                      <h4>Anna Nelson</h4>
                      <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                      <p>6 hrs. ago</p>
                    </div>
                  </a>
                </li>
                <li>
                  <hr class="dropdown-divider">
                </li>
    
                <li class="message-item">
                  <a href="#">
                    <img src="../public/img/messages-3.jpg" alt="" class="rounded-circle">
                    <div>
                      <h4>David Muldon</h4>
                      <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                      <p>8 hrs. ago</p>
                    </div>
                  </a>
                </li>
                <li>
                  <hr class="dropdown-divider">
                </li>
    
                <li class="dropdown-footer">
                  <a href="#">Show all messages</a>
                </li>
    
              </ul><!-- End Messages Dropdown Items -->
    
            </li><!-- End Messages Nav -->
    
            <li class="nav-item dropdown pe-3">
    
              <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                <img src="../public/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                <span class="d-none d-md-block dropdown-toggle ps-2">K. Anderson</span>
              </a><!-- End Profile Iamge Icon -->
    
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                <li class="dropdown-header">
                  <h6>Kevin Anderson</h6>
                  <span>Web Designer</span>
                </li>
                <li>
                  <hr class="dropdown-divider">
                </li>
    
                <li>
                  <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                    <i class="bi bi-person"></i>
                    <span>My Profile</span>
                  </a>
                </li>
                <li>
                  <hr class="dropdown-divider">
                </li>
    
                <li>
                  <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                    <i class="bi bi-gear"></i>
                    <span>Account Settings</span>
                  </a>
                </li>
                <li>
                  <hr class="dropdown-divider">
                </li>
    
                <li>
                  <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                    <i class="bi bi-question-circle"></i>
                    <span>Need Help?</span>
                  </a>
                </li>
                <li>
                  <hr class="dropdown-divider">
                </li>
    
                <li>
                  <a class="dropdown-item d-flex align-items-center" href="#">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Sign Out</span>
                  </a>
                </li>
    
              </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->
    
          </ul>
        </nav><!-- End Icons Navigation -->
    
      </header><!-- End Header -->
    
      <!-- ======= Sidebar ======= -->
      <aside id="sidebar" class="sidebar">
    
        <ul class="sidebar-nav" id="sidebar-nav">
    
          <li class="nav-item">
            <a class="nav-link " href="dashboard.php">
              <i class="bi bi-grid"></i>
              <span>Dashboard</span>
            </a>
          </li><!-- End Dashboard Nav -->
    
          <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
              <i class="bi bi-menu-button-wide"></i><span>manege items</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
             
              <li>
                <a href="myitems.php">
                  <i class="bi bi-circle"></i><span>my items</span>
                </a>
              </li>
              
            </ul>
          </li><!-- End Components Nav -->
        
          <li class="nav-heading">Pages</li>
    
          <li class="nav-item">
            <a class="nav-link collapsed" href="users-profile.html">
              <i class="bi bi-person"></i>
              <span>Profile</span>
            </a>
          </li><!-- End Profile Page Nav -->
    
          
    
          <li class="nav-item">
            <a class="nav-link collapsed" href="pages-contact.html">
              <i class="bi bi-envelope"></i>
              <span>Contact</span>
            </a>
          </li><!-- End Contact Page Nav -->
        </ul>
    
      </aside><!-- End Sidebar-->
    
      
      <div class="form-container">
        <h1>modifier un produit</h1>
      <?php
    // $_POST['id'] récupérer à partir du form relative au bouton update dans la page productList
    if (isset($_POST['id_product'])) {
        //récupération du produit à mettre à jour par son ID
        $product = $productController->getProductById($_POST['id_product']);
    ?>
        <!-- remplir le vormulaire par les données du produits à mettre à jour -->
        <form id="product" action="update.php" method="POST">
    <input type="hidden" id="id" name="id" value="<?php echo $product['id_product']; ?>">
    <label for="name">Product Name</label>
    <input class="form-control" type="text" id="name" name="name" value="<?php echo $product['name']; ?>" required>
    
    <label for="price">Price</label>
    <input class="form-control" type="text" id="price" name="price" value="<?php echo $product['price']; ?>" required>
    
    <select   name="id_cat">
                                        
                                          
                                        <?php
                                        foreach($prod as $caa){
                                          ?>
                                              <option value="<?php echo $caa['id_category'] ?>"><?php echo $caa['titre'] ?></option>
                                           <?php } ?>
                                                           </select>

    <label for="description">description</label>
    <input class="form-control" type="text" id="description" name="description" value="<?php echo $product['description']; ?>" required>
    
    <input class="btn btn-primary" type="submit" value="Save">
</form>

    <?php
    }
    ?>
    </div>
    
    
    
      <!-- ======= Footer ======= -->
      <footer id="footer" class="footer">
        <div class="copyright">
          &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
        </div>
        
      </footer><!-- End Footer -->
    
      <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    
      <!-- Vendor JS Files -->
      <script src="../public/assets/vendor/apexcharts/apexcharts.min.js"></script>
      <script src="../public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="../public/assets/vendor/chart.js/chart.umd.js"></script>
      <script src="../public/assets/vendor/echarts/echarts.min.js"></script>
      <script src="../public/assets/vendor/quill/quill.js"></script>
      <script src="../public/assets/vendor/simple-datatables/simple-datatables.js"></script>
      <script src="../public/assets/vendor/tinymce/tinymce.min.js"></script>
      <script src="../public/assets/vendor/php-email-form/validate.js"></script>
    
      <!-- Template Main JS File -->
      <script src="../public/assets/js/main.js"></script>
    
    </body>
    
    </html>
</body>
</html>