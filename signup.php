<?php
require('database.php');

$fullname = $_POST['fullname'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirm_password'];

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "❌ Invalid email format!";
    exit;
}

if ($password !== $confirmPassword) {
    echo "❌ Passwords do not match!";
    exit;
}

$checkStmt = $conn->prepare("SELECT id FROM signup WHERE email = ?");
if (!$checkStmt) {
    echo "❌ Prepare failed: " . $conn->error;
    exit;
}
$checkStmt->bind_param("s", $email);
$checkStmt->execute();
$checkStmt->store_result();

if ($checkStmt->num_rows > 0) {
    echo "❌ Email already exists!";
    $checkStmt->close();
    exit;
}
$checkStmt->close();

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO signup (fullname, email, password) VALUES (?, ?, ?)");
if (!$stmt) {
    echo "❌ Prepare failed: " . $conn->error;
    exit;
}
$stmt->bind_param("sss", $fullname, $email, $hashedPassword);

if ($stmt->execute()) {
    echo "✅ Account created successfully!";
} else {
    echo "❌ Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
