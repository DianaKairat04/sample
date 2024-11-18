<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $book_id = $_POST['book_id'];
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id'];

    $query = "INSERT INTO reviews (book_id, user_id, content) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iis", $book_id, $user_id, $content);

    if ($stmt->execute()) {
        echo "Пікір қосылды.";
    } else {
        echo "Қате.";
    }
}
?>
