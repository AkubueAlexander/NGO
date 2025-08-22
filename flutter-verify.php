<?php
session_start();

if (!isset($_GET['transaction_id'])) {
    die("No transaction ID.");
}
 include_once 'inc/database.php';
 include_once 'inc/method.php';

$transaction_id = $_GET['transaction_id'];

// Step 1: Verify payment
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.flutterwave.com/v3/transactions/{$transaction_id}/verify",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CAINFO => "C:/wamp64/bin/php/php8.2.18/extras/ssl/cacert.pem",
    CURLOPT_HTTPHEADER => [
        "Authorization: Bearer FLWSECK_TEST-c239aaf7c99ab1fa37b71a622e528ca4-X",
        "Content-Type: application/json"
    ],
));
$response = curl_exec($curl);
curl_close($curl);

$res = json_decode($response);




if ($res && $res->status === 'success') {
    // Step 2: Retrieve the form data from session
    if (isset($_SESSION['formData'])) {
        $data = $_SESSION['formData'];
        $fullName = $data['fullName'];
        $amount = $data['amount'];
        $email = $data['email'];
        $phone = $data['phone'];

        $sql = "INSERT INTO donation (amount, fullName, email, phone) VALUES (:amount, :fullName, :email, :phone)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['amount' => $amount,'fullName' => $fullName,'email' => $email,'phone' => $phone]);


        header('location: index?donation=success');

         
       
    } else {
        echo "Session expired or data not found.";
    }

    // Clear session
    unset($_SESSION['formData']);
} else {
    echo "Payment not successful.";
}
