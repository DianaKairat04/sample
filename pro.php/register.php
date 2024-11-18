<?php
session_start();
include 'db.php'; // Деректер базасымен байланыс

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        header("Location: login.php");
        exit();
    } else {
        echo "Тіркеу қателігі.";
    }
}
?>
<form method="POST" action="">
    <label>Логин:</label><input type="text" name="username" required><br>
    <label>Құпиясөз:</label><input type="password" name="password" required><br>
    <button type="submit">Тіркелу</button>
</form>
