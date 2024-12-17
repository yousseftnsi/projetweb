<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
if (!isset($_SESSION['id_user'])) {
    header('Location: login.php');
    exit();
}

// Include the controller to fetch `$lignesPanier`
require_once '../../controller/panierController.php';
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../../public/assets/css/style1.css">
    <title>Cart</title>
</head>
<body>
    <div class="container">
        <h1>Welcome, <?= htmlspecialchars($_SESSION['name_user']) ?>!</h1>
        <h2>Your Cart</h2>

        <?php if (empty($lignesPanier)): ?>
            <p>Your cart is empty.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total Price</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lignesPanier as $item): ?>
                        <tr>
                            <td><?= htmlspecialchars($item['id_product']) ?></td>
                            <td><?= htmlspecialchars($item['name']) ?></td>
                            <td>
                                <form method="POST" action="../../controller/panierController.php">
                                    <input type="number" name="new_quantity" value="<?= $item['quantity'] ?>">
                                    <button type="submit" name="update_quantity">Update</button>
                                    <input type="hidden" name="id_product" value="<?= $item['id_product'] ?>">
                                </form>
                            </td>
                            <td><?= number_format($item['price'], 2) ?> dt</td>
                            <td><?= number_format($item['price'] * $item['quantity'], 2) ?> dt</td>
                            <td>
                                <form method="POST" action="../../controller/panierController.php" style="display:inline;">
                                    <button type="submit" name="remove_item">
                                        <i class="fa fa-trash"></i> Remove
                                    </button>
                                    <input type="hidden" name="id_product" value="<?= $item['id_product'] ?>">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <div style="margin-top: 20px;">
            <a href="checkout.php" class="button">Proceed to Checkout</a>
            <a href="../items.php" class="button" style="margin-left: 10px;">Add Product</a>
        </div>
    </div>
</body>
</html>
