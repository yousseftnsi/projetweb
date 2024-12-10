<?php
include "../controller/ProductController.php";

$productC = new ProductController();
$list = $productC->productList1();

$categoryC = new CategoryController();
$liste = $categoryC->CategoryList();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Store - AgriCulture Bootstrap Template</title>

  <!-- Favicons -->
  <link href="../public/img/logo-bare.jpg" rel="icon">
  <link href="../public/img/logo-bare.jpg" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../public/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../public/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="../public/assets/css/main.css" rel="stylesheet">
<style>
/* Category Filter */
.category-filters {
  display: flex;
  justify-content: center; /* Horizontally center */
  align-items: center;     /* Vertically center */
  flex-wrap: wrap;
  margin: 2rem 0;          /* Adds space above and below the filter */
}

.form-check-inline {
  margin-right: 15px;
}

.form-check-label {
  font-family: 'Open Sans', sans-serif;
  font-size: 14px;
  color: #444444;
  cursor: pointer;
}

.form-check-input {
  margin-right: 8px;
  cursor: pointer;
}

/* Active and Hover States for Filters */
.form-check-input:checked {
  background-color: #4154f1;
  border-color: #4154f1;
}

.form-check-input:checked + .form-check-label {
  color: #4154f1;
}

/* Hover effect for labels */
.form-check-label:hover {
  color: #717ff5;
}

/* Responsive Design */
@media (max-width: 768px) {
  .category-filters {
    justify-content: center;
  }
  
  .form-check-inline {
    margin-bottom: 10px;
  }
}


</style>

</head>

<body>

<header id="header" class="header d-flex align-items-center position-relative">
  <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

    <nav id="navmenu" class="navmenu">
      <ul>
        <li><a href="home.html" >Home</a></li>
        <li><a href="#about">About Us</a></li>
        <li><a href="services.html">Home Grown</a></li>
        <li><a href="testimonials.html">News</a></li>
        <li><a href="blog.html">Reviews</a></li>
        <li class="dropdown"><a class="active" href="items.php"><span>Store</span></a></li>
        <li><a href="dashboard.php">MySpace</a></li>
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

  <!-- Search Bar -->
  <div class="search-bar ">
    <input type="text" id="myInput" placeholder="Search for products..." >
  </div>

  <!-- Category Filters -->
  <div class="category-filters mb-4">
    <div class="form-check form-check-inline">
      <input 
        class="form-check-input category-filter" 
        type="radio" 
        name="categoryFilter" 
        id="category-all" 
        value="all" 
        checked>
      <label class="form-check-label" for="category-all">All</label>
    </div>

    <?php if (!empty($liste)) {
      foreach ($liste as $category) { 
          $categoryId = isset($category['id_category']) ? $category['id_category'] : '';
          $categoryTitle = isset($category['titre']) ? $category['titre'] : 'Unnamed Category';
    ?>
    <div class="form-check form-check-inline">
      <input 
        class="form-check-input category-filter" 
        type="radio" 
        name="categoryFilter" 
        id="category-<?= htmlspecialchars($categoryId); ?>" 
        value="<?= htmlspecialchars($categoryId); ?>">
      <label class="form-check-label" for="category-<?= htmlspecialchars($categoryId); ?>">
        <?= htmlspecialchars($categoryTitle); ?>
      </label>
    </div>
    <?php } } else { ?>
      <p>No categories available.</p>
    <?php } ?>
  </div>

  <!-- Product List -->
  <div class="product-grid row" id="myTable">
  <?php foreach ($list as $product) { 
    $productImage = isset($product['image']) ? htmlspecialchars($product['image']) : 'default.jpg';
    $productName = isset($product['name']) ? htmlspecialchars($product['name']) : 'Unnamed Product';
    $productPrice = isset($product['price']) ? htmlspecialchars($product['price']) : '0.00';
    $productCategory = isset($product['category_name']) ? htmlspecialchars($product['category_name']) : 'Uncategorized';
    // Now, using category_id from the category table
    $productCategoryId = isset($product['id_category']) ? htmlspecialchars($product['id_category']) : '0';
?>
<!-- Debugging output -->
<div class="product-item col-md-4 mb-4" data-category-id="<?= $productCategoryId; ?>">
    <div class="card">
        <img src="../uploads/<?= $productImage; ?>" class="card-img-top" alt="<?= $productName; ?>">
        <div class="card-body">
            <h5 class="product-name card-title"><?= $productName; ?></h5>
            <p class="product-price card-text">$<?= $productPrice; ?></p>
            <p class="product-category text-muted"><?= $productCategory; ?></p>
        </div>
    </div>
</div>
<?php } ?>

  </div>

</main>

<!-- Vendor JS Files -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Custom JS -->
<script>
 $(document).ready(function () {
  // Filter products based on category
  $(".category-filter").on("change", function () {
    const selectedCategory = $("input[name='categoryFilter']:checked").val();
    console.log("Selected Category:", selectedCategory);  // Debugging log

    $(".product-item").each(function () {
      const productCategoryId = $(this).data("category-id");
      console.log("Product Category ID:", productCategoryId);  // Debugging log

      if (selectedCategory === "all" || productCategoryId == selectedCategory) {
        $(this).show(); // Show products with matching category
      } else {
        $(this).hide(); // Hide non-matching products
      }
    });
  });

  // Search functionality
  $("#myInput").on("keyup", function () {
    const value = $(this).val().toLowerCase();
    $("#myTable .product-item").filter(function () {
      const name = $(this).find(".product-name").text().toLowerCase();
      $(this).toggle(name.indexOf(value) > -1);
    });
  });
});

</script>

</body>
</html>
