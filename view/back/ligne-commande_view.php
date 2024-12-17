<?php
session_start();

// Include database connection and necessary files
require_once '../../config.php';
require_once '../../controller/ligneCommandeeController.php';

// Check if user is logged in
if (!isset($_SESSION['id_user'])) {
    header('Location: login.php');
    exit();
}

// Get the id of the commande (order) from the query string
if (isset($_GET['id_commande'])) {
    $idCommande = $_GET['id_commande'];

    // Initialize LigneCommandeController to fetch the lignes de commande for the given id_commande
    $ligneCommandeController = new LigneCommandeeController();
    $lignesCommande = $ligneCommandeController->getLignesByCommandeId($idCommande);
} else {
    echo "Commande ID is missing!";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $idLigneCommande = $_POST['id_ligne_commande'];
    require_once '../../controller/LigneCommandeController.php'; // Adjust the path as needed
    LigneCommandeController::deleteLigneById($idLigneCommande);

    // Redirect to the same page to refresh the table
    header("Location: ligne-commande_view.php?id_commande=" . htmlspecialchars($idCommande));
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lignes de Commande - Grow & Glow</title>
    <link rel="stylesheet" href="../../public/assets/css/style1.css">
    <style>
        /* General styling */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f9f9f9;
    color: #333;
    display: flex;
    flex-direction: column;
    align-items: center;
    min-height: 100vh; /* Full height of the viewport */
}

/* Header */
header {
    text-align: center;
    margin-top: 20px;
}

header h1 {
    font-size: 2rem;
    color: #4CAF50;
    margin: 0;
}

/* Main container */
main {
    width: 90%; /* Adjust for responsiveness */
    max-width: 900px;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-top: 20px;
}

main h2 {
    font-size: 1.6rem;
    color: #555;
    margin-bottom: 20px;
    text-align: center;
}

/* No products message */
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
    text-align: left;
}

tbody tr:nth-child(even) {
    background-color: #f2f2f2;
}

/* Footer */
footer {
    text-align: center;
    padding: 15px;
    margin-top: 20px;
    background-color: transparent;
    color: #555;
    font-size: 0.9rem;
}

/* Responsive design */
@media (max-width: 600px) {
    main {
        padding: 10px;
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
    .delete {
    background-color: #e74c3c;
    color: white;
    border: none;
    padding: 8px 12px;
    border-radius: 4px;
    cursor: pointer;
}

.delete:hover {
    background-color: #c0392b;
}

}

    </style>
</head>
<body>
    <header>
        <h1>Commande #<?php echo htmlspecialchars($idCommande); ?> - Lignes de Commande</h1>
    </header>

    <main>
    <h2>Details of Commande #<?php echo htmlspecialchars($idCommande); ?></h2>

<?php if (empty($lignesCommande)): ?>
    <p>No products found in this order.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Total Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($lignesCommande as $ligne): ?>
                <tr>
                    <td><?php echo htmlspecialchars($ligne['id_product']); ?></td>
                    <td><?php echo htmlspecialchars($ligne['quantity']); ?></td>
                    <td><?php echo number_format($ligne['unit_price'], 2); ?> dt</td>
                    <td><?php echo number_format($ligne['total_price'], 2); ?> dt</td>
                    <td>
                        <form action="ligne-commande_view.php" method="POST" style="display:inline;">
                            <input type="hidden" name="id_ligne_commande" value="<?php echo $ligne['id_ligne_commande']; ?>">
                            <button type="submit" name="delete" class="delete">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

    </main>

    <footer>
        <p>&copy; 2024 Grow & Glow. All rights reserved.</p>
    </footer>
</body>
</html>
