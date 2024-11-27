<?php

include "../controller/ProductController.php";
$productC = new ProductController();
$list = $productC->productList();
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Blog - AgriCulture Bootstrap Template</title>
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
  <link href="../public/assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: AgriCulture
  * Template URL: https://bootstrapmade.com/agriculture-bootstrap-website-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center position-relative">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="home.html" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="../public/img/logo.jpg" alt="AgriCulture">
        <!-- <h1 class="sitename">AgriCulture</h1>  -->
      </a>

      

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="home.html" class="active">Home</a></li>
          <li><a href="#about">About Us</a></li>
          <li><a href="services.html">home grown</a></li>
          <li><a href="testimonials.html">news</a></li>
          <li><a href="blog.html">reviews</a></li>
          <li class="dropdown"><a href="items.php"><span>store</span></i></a>
            <li><a href="dashboard.php">MySpace</a></li>
          </li>
        </ul>
        
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
      <div class="login-container">
        <a href="#loginModal" class="login-button">
          <span>Log In</span>
          <i class="bi bi-person-circle"></i>
        </a>
      </div>

    </div>
    
    
  </header>

  <main class="main">

    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade" style="background-image: url(../public/img/page-title-bg.webp);">
      <div class="container position-relative">
        <h1>Blog</h1>
        <p>
          Home
          /
          Blog</p>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.html">Home</a></li>
            <li class="current">Blog</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->


    <div class="product-list">
    <!-- Add Product Link at the top -->
    
    <!-- Grid layout for products -->
    <div class="product-grid">
        <?php foreach ($list as $product) { ?>
        <div class="product-item">
            <div class="product-name"><?= $product['name']; ?></div>
            <div class="product-price">$<?= $product['price']; ?></div>
            <div class="product-category"><?= $product['category']; ?></div>
            
        </div>
        <?php } ?>
    </div>
</div>






 

    <!-- Blog Pagination Section -->
    <section id="blog-pagination" class="blog-pagination section">

      <div class="container">
        <div class="d-flex justify-content-center">
          <ul>
            <li><a href="#"><i class="bi bi-chevron-left"></i></a></li>
            <li><a href="#">1</a></li>
            <li><a href="#" class="active">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li>...</li>
            <li><a href="#">10</a></li>
            <li><a href="#"><i class="bi bi-chevron-right"></i></a></li>
          </ul>
        </div>
      </div>

    </section><!-- /Blog Pagination Section -->

    

  </main>

 

          
   




  

  <!-- Preloader -->
  <div id="preloader"></div>

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