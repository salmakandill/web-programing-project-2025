<?php
require('database.php');

$email = $_POST['email'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT * FROM signup WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password'])) {
         echo "Welcome Back , " . htmlspecialchars($user['fullname']) . " ! 🙋‍♀️";

    } else {
        echo "❌ Incorrect password!";
    }
} else {
    echo "❌ Email not found!";
}

$stmt->close();
$conn->close();
?>
