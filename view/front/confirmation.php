<?php
session_start();
require_once '../../config.php';
require_once '../../controller/commandeController.php';
require_once '../../controller/ligneCommandeeController.php';
use Twilio\Rest\Client;

require_once "../../vendor/autoload.php";

// Check if user is logged in
if (!isset($_SESSION['id_user'])) {
    header('Location: login.php');
    exit();
}

// Fetch user details
$id_user = $_SESSION['id_user'];
try {
    $db = config::getConnexion();
    $query = $db->prepare("SELECT * FROM utilisateur WHERE id = :id_user");
    $query->bindValue(':id_user', $id_user, PDO::PARAM_INT);
    $query->execute();
    $user = $query->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo "Error: User not found.";
        exit();
    }
} catch (Exception $e) {
    echo "Error fetching user details: " . $e->getMessage();
    exit();
}

// Order details
$totalPrice = $_SESSION['total_price']; // Save total price during checkout
$dateCommande = date('Y-m-d');

// Check if `panier` exists in the session
if (!isset($_SESSION['panier']) || !is_array($_SESSION['panier'])) {
    echo 'Error: Panier is not set or is not an array.';
    exit();
}

// SMS functionality (example using Twilio or other SMS gateway)
function sendSMS($phoneNumber, $message) {
    $account_id = "AC1336758df3984458f51e4fbb011ec000";
    $auth_token = "205f898a92b3aa3500ede329b2a89802";

    $client = new Client($account_id, $auth_token);

    $twilio_number = "+12293215755";

    // Ensure phone number is in E.164 format
    if (!preg_match('/^\+/', $phoneNumber)) {
        $phoneNumber = '+216' . ltrim($phoneNumber, '0'); // Add Tunisia country code
    }

    try {
        $client->messages->create(
            $phoneNumber,
            [
                "from" => $twilio_number,
                "body" => $message
            ]
        );

        echo "SMS sent to $phoneNumber: $message";
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

$smsMessage = "Thank you, " . $user['prenom'] . "! Your order of " . number_format($totalPrice, 2) . " DT has been received.";
sendSMS($user['telephone'], $smsMessage);

// Start output buffering to prevent TCPDF errors
ob_start();

// PDF receipt generation (using TCPDF library)
require_once '../../vendor/tecnickcom/tcpdf/tcpdf.php';

$pdf = new TCPDF();
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Grow & Glow');
$pdf->SetTitle('Order Receipt');
$pdf->SetHeaderData('', 0, 'Grow & Glow - Order Receipt', "Date: $dateCommande");
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetMargins(15, 27, 15);
$pdf->SetHeaderMargin(5);
$pdf->SetFooterMargin(10);
$pdf->SetAutoPageBreak(TRUE, 25);
$pdf->SetFont('helvetica', '', 12);

$pdf->AddPage();
$pdf->Write(0, "Thank you for your order, " . $user['prenom'] . " " . $user['nom'] . "!", '', 0, 'L', true, 0, false, false, 0);
$pdf->Ln();
$pdf->Write(0, "Order Details:", '', 0, 'L', true, 0, false, false, 0);
$pdf->Ln();

$html = "<table border='1' cellpadding='5'>
<tr>
    <th>Product Name</th>
    <th>Quantity</th>
    <th>Unit Price</th>
    <th>Total</th>
</tr>";

foreach ($_SESSION['panier'] as $product) {
    $html .= "<tr>
        <td>" . htmlspecialchars($product['name']) . "</td>
        <td>" . htmlspecialchars($product['quantity']) . "</td>
        <td>" . number_format($product['price'], 2) . " DT</td>
        <td>" . number_format($product['price'] * $product['quantity'], 2) . " DT</td>
    </tr>";
}

$html .= "</table><br/><br/>Total Price: " . number_format($totalPrice, 2) . " DT";
$pdf->writeHTML($html, true, false, true, false, '');

/*// Output PDF and stop buffering
$pdf->Output('order_receipt.pdf', 'D'); // Force download

// Clear session after receipt is generated
unset($_SESSION['panier']);
unset($_SESSION['total_price']);*/
///////////////////////////////////////////////////////////////////////////////
// Generate the PDF to a temporary file
$tempFile = tempnam(sys_get_temp_dir(), 'receipt') . '.pdf';
$pdf->Output($tempFile, 'F'); // Save PDF to file

// Force download
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="order_receipt.pdf"');
readfile($tempFile);

// Delete the temporary file
unlink($tempFile);

// Clear session after receipt is generated
unset($_SESSION['panier']);
unset($_SESSION['total_price']);
//////////////////////////////////////////////////////////////////////////////////

// End output buffering and send buffer output
ob_end_flush();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="../../public/assets/css/style1.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Grow & Glow - Order Confirmation</h1>
        </header>
        <main>
            <p>Thank you, <?php echo htmlspecialchars($user['prenom']); ?>! Your order has been successfully placed.</p>
            <p>You will receive a confirmation message on your phone shortly.</p>
            <p>Your receipt is being downloaded. Check your downloads folder.</p>
            <a href="products.php">Continue Shopping</a>
        </main>
    </div>
</body>
</html>
