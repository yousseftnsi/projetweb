<?php
session_start();

// Include necessary files
require_once '../../config.php';
require_once '../../controller/commandeController.php';

// Check if the user is logged in
if (!isset($_SESSION['id_user'])) {
    header('Location: login.php');
    exit();
}

// Initialize the CommandeController
$commandeController = new CommandeController();

// Handle delete request
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete']) && isset($_POST['id_commande'])) {
    $id_commande = $_POST['id_commande'];

    try {
        $commandeController->deleteCommande($id_commande);
        header('Location: commandes_view.php'); // Refresh the page after deletion
        exit();
    } catch (Exception $e) {
        echo 'Error: ' . htmlspecialchars($e->getMessage());
    }
}

// Fetch all commandes for the logged-in user
$commandes = $commandeController->getAllCommandesByUserId($_SESSION['id_user']);
?>

    <!DOCTYPE html>
    <html lang="en">
    
    <head>
      <meta charset="utf-8">
      <meta content="width=device-width, initial-scale=1.0" name="viewport">
    
      
      <meta content="" name="description">
      <meta content="" name="keywords">
    
      <!-- Favicons -->
      <link href="../../public/img/favicon.png" rel="icon">
      <link href="../../public/img/apple-touch-icon.png" rel="apple-touch-icon">
    
      <!-- Google Fonts -->
      <link href="https://fonts.gstatic.com" rel="preconnect">
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    
      <!-- Vendor CSS Files -->
      <link href="../../public/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <link href="../../public/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
      <link href="../../public/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
      <link href="../../public/assets/vendor/quill/quill.snow.css" rel="stylesheet">
      <link href="../../public/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
      <link href="../../public/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
      <link href="../../public/assets/vendor/simple-datatables/style.css" rel="stylesheet">
    
      <!-- Template Main CSS File -->
      <link href="../../public/assets/css/style.css" rel="stylesheet">
    
      <!-- =======================================================
      * Template Name: NiceAdmin
      * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
      * Updated: Apr 20 2024 with Bootstrap v5.3.3
      * Author: BootstrapMade.com
      * License: https://bootstrapmade.com/license/
      ======================================================== -->
      <style>/* General styling */
/* General styling */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f9f9f9;
    color: #333;
}

/* Main container */
main {
    max-width: 900px;
    margin: 30px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-left: 320px; /* Adjust this value to leave space for the sidebar */
}

/* Heading */
h2 {
    font-size: 1.8rem;
    color: #555;
    text-align: center;
    margin-bottom: 20px;
}

/* No orders message */
p {
    font-size: 1rem;
    color: #888;
    text-align: center;
    margin-top: 20px;
}

/* Table styling */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

thead th {
    background-color: #4CAF50;
    color: white;
    padding: 12px;
    text-align: left;
    border-bottom: 2px solid #ddd;
}

tbody td {
    padding: 12px;
    border-bottom: 1px solid #ddd;
}

tbody tr:nth-child(even) {
    background-color: #f2f2f2;
}

/* Buttons and links */
form .delete,
a {
    font-size: 0.9rem;
    text-decoration: none;
    margin-right: 10px;
    border: none;
    padding: 8px 12px;
    border-radius: 4px;
    cursor: pointer;
}

form .delete {
    background-color: #e74c3c;
    color: white;
    transition: background-color 0.3s;
}

form .delete:hover {
    background-color: #c0392b;
}





/* Responsive design */
@media (max-width: 600px) {
    main {
        margin-left: 0;
    }

    table, thead, tbody, th, td, tr {
        display: block;
        width: 100%;
    }

    tr {
        margin-bottom: 15px;
        border: 1px solid #ddd;
    }

    thead {
        display: none;
    }

    td {
        text-align: right;
        padding: 12px;
        position: relative;
    }

    td::before {
        content: attr(data-label);
        position: absolute;
        left: 12px;
        font-weight: bold;
        text-align: left;
    }
}

</style>
    </head>
    <body>
    
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
  
      <div class="d-flex align-items-center justify-content-between">
        <a href="home.html" class="logo d-flex align-items-center">
          <img src="../../public/img/logo.jpg" alt="">
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
                  <img src="../../public/img/messages-1.jpg" alt="" class="rounded-circle">
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
                  <img src="../../public/img/messages-2.jpg" alt="" class="rounded-circle">
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
              <img src="../../public/img/profile-img.jpg" alt="Profile" class="rounded-circle">
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
              <a href="../myitems.php">
                <i class="bi bi-circle"></i><span>my items</span>
              </a>
            </li>
            <li>
              <a href="commandes_view.php">
                <i class="bi bi-circle"></i><span>my commands</span>
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

        <li class="nav-heading">Admin</li>
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-person"></i><span>Settings</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        
        <li>
          <a href="..\mycategory.php">
            <i class="bi bi-circle"></i><span>manage Categories</span>
          </a>
        </li>
        </li> 
      </ul>
    </li><!-- End Components Nav -->
      </ul>
  
    </aside><!-- End Sidebar-->

    <main>
        <h2>All Your Orders</h2>

        <?php if (empty($commandes)): ?>
            <p>You have no orders yet.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Commande ID</th>
                        <th>Date</th>
                        <th>Total Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($commandes as $commande): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($commande['id_user']); ?></td>
                            <td><?php echo htmlspecialchars($commande['id_commande']); ?></td>
                            <td><?php echo htmlspecialchars($commande['date_commande']); ?></td>
                            <td><?php echo number_format($commande['total_price'], 2); ?> dt</td>
                            <td>
                                <form action="commandes_view.php" method="POST" style="display: inline;">
                                    <input type="hidden" name="id_commande" value="<?php echo $commande['id_commande']; ?>">
                                    <button type="submit" name="delete" class="delete">Delete</button>
                                </form>
                                <a href="ligne-commande_view.php?id_commande=<?php echo $commande['id_commande']; ?>">View</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </main>
  
    


  
  
  
    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
     
     
    </footer><!-- End Footer -->
  
    
  
    <!-- Vendor JS Files -->
    <script src="../../public/assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../../public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../public/assets/vendor/chart.js/chart.umd.js"></script>
    <script src="../../public/assets/vendor/echarts/echarts.min.js"></script>
    <script src="../../public/assets/vendor/quill/quill.js"></script>
    <script src="../../public/assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../../public/assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../../public/assets/vendor/php-email-form/validate.js"></script>
  
    <!-- Template Main JS File -->
    <script src="../../public/assets/js/main.js"></script>
  
  </body>
  
  </html>
</body>
</html>    