<?php
$FLname = $_POST['FLname'];
$email = $_POST['email'];
$number = $_POST['number'];
$comment = $_POST['comment'];
$time = $_POST['time'];


if (empty($FLname) || empty($email) || empty($number)) {
    echo "Please fill in all the required fields.";
} else {
    
    if (preg_match('/^05\d{8}$/', $number)) {
        // Database connection
        $conn = new mysqli('localhost', 'root', '', 'Coffee_ShopCustomers');
        if ($conn->connect_error) {
            die('Connection Failed: ' . $conn->connect_error);
        } else {
            $stmt = $conn->prepare("INSERT INTO Customers (FLname, mail, number, comment, time) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $FLname, $email, $number, $comment, $time);
            if ($stmt->execute()) {
                echo "Thank you for your review and for taking the time to send us your valuable feedback.";
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
            $conn->close();
        }
    } else {
        echo "Invalid phone number format. Phone number should start with '05' and have 10 digits.";
    }
}
?>
