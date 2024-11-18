<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header("Location: index.php");
        exit();
    } else {
        echo "Қате логин немесе құпиясөз.";
    }
}
?>
<form method="POST" action="">
    <label>Логин:</label><input type="text" name="username" required><br>
    <label>Құпиясөз:</label><input type="password" name="password" required><br>
    <button type="submit">Кіру</button>
</form>
