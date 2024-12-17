<?php
session_start();
require_once '../../config.php';
require_once '../../controller/commandeController.php';
require_once '../../controller/ligneCommandeeController.php';
require_once '../../model/commande.php';
require_once '../../model/ligneCommandee.php';

// If the user is not logged in, redirect to login page
if (!isset($_SESSION['id_user'])) {
    header('Location: login.php');
    exit();
}

// Initialize the CommandeController
$commandeController = new CommandeController();

// Retrieve products from the session (panier)
$panier = isset($_SESSION['panier']) ? $_SESSION['panier'] : [];

/*// Debugging: Print session data
echo '<pre>';
echo 'Initial Panier: ';
print_r($panier);
echo '</pre>';*/

// Calculate total price of the panier
$totalPrice = 0;
foreach ($panier as $product) {
    $totalPrice += $product['price'] * $product['quantity'];
}

// Store total price in session
$_SESSION['total_price'] = $totalPrice;

// Handle quantity changes in the panier
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_cart'])) {
    if (isset($_POST['quantity']) && is_array($_POST['quantity'])) {
        foreach ($_POST['quantity'] as $productId => $quantity) {
            if ($quantity <= 0) {
                foreach ($panier as $key => $product) {
                    if ($product['id_product'] == $productId) {
                        unset($panier[$key]); // Remove the product if quantity is 0 or less
                    }
                }
            } else {
                foreach ($panier as &$product) {
                    if ($product['id_product'] == $productId) {
                        $product['quantity'] = (int)$quantity; // Update the quantity
                    }
                }
            }
        }
        $_SESSION['panier'] = $panier; // Save updated panier back to session
    }
}

// Handle product removal from panier
if (isset($_GET['remove'])) {
    $productIdToRemove = $_GET['remove'];
    foreach ($panier as $key => $product) {
        if ($product['id_product'] == $productIdToRemove) {
            unset($panier[$key]);
            break;
        }
    }
    $_SESSION['panier'] = $panier;
    header('Location: checkout.php');
    exit();
}

// Handle checkout process
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirm_order'])) {
    try {
        // Debugging: Print session data
        echo '<pre>';
        echo 'Session Data at Confirm Order: ';
        print_r($_SESSION);
        echo '</pre>';

        if (!isset($_SESSION['id_user']) || !isset($_SESSION['panier']) || !isset($_SESSION['total_price'])) {
            throw new Exception('Session data is missing.');
        }

        $dateCommande = date('Y-m-d');
        $totalPrice = $_SESSION['total_price'];
        $id_user = $_SESSION['id_user'];

        // Create a new Commande (order)
        $commande = new Commande(null, $id_user, $dateCommande, $totalPrice);
        $id_commande = $commandeController->addCommande($commande);

        if (!$id_commande) {
            throw new Exception('Failed to create commande.');
        }

        // Add each product from the panier to the ligne_commande table
        foreach ($_SESSION['panier'] as $product) {
            $lineTotalPrice = $product['quantity'] * $product['price'];
            $ligneCommandee = new LigneCommandee(
                null,
                $id_commande,
                $product['id_product'],
                $product['quantity'],
                $product['price'],
                $lineTotalPrice
            );

            $result = LigneCommandeeController::addLigneCommandee($ligneCommandee);

            if (!$result) {
                throw new Exception("Failed to insert product ID {$product['id_product']} into ligne_commande.");
            }
        }

        //unset($_SESSION['panier']);
        header('Location: confirmation.php');
        exit();

    } catch (Exception $e) {
        echo '<p style="color: red;">Error: ' . htmlspecialchars($e->getMessage()) . '</p>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Grow & Glow</title>
    <link rel="stylesheet" href="../../public/assets/css/style1.css">
</head>
<body>

    <div class="container">
        <header>
            <h1>Grow & Glow - Checkout</h1>
        </header>

        <main>
            <h2>Your Cart</h2>

            <form method="POST" action="checkout.php">
                <table>
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($panier)): ?>
                            <tr>
                                <td colspan="5">Your cart is empty.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($panier as $productId => $product): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($product['name']); ?></td>
                                    <td><?php echo number_format($product['price'], 2); ?> dt</td>
                                    <td><?php echo number_format($product['quantity']); ?></td>
                                    <td><?php echo number_format($product['price'] * $product['quantity'], 2); ?> dt</td>
                                    <td>
                                        <a href="checkout.php?remove=<?php echo $product['id_product']; ?>" class="remove">🗑️</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>

                <div class="total-price">
                    <p>Total Price: <?php echo number_format($totalPrice, 2); ?> dt</p>
                </div>

                <div class="actions">
                    <a href="../items.php">Continue Shopping</a>
                    <button type="submit" name="confirm_order">Place Order</button>
                </div>
            </form>
        </main>
    </div>
    <script>
function validateForm() {
    const inputs = document.querySelectorAll('input[type="number"]');
    for (const input of inputs) {
        if (input.value <= 0) {
            alert('Quantities must be greater than 0.');
            return false;
        }
    }
}
</script>
</body>
</html>
