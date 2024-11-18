<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];
    $description = $_POST['description'];
    $user_id = $_SESSION['user_id'];

    $query = "INSERT INTO books (title, author, genre, description, created_by) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssi", $title, $author, $genre, $description, $user_id);

    if ($stmt->execute()) {
        echo "Кітап сәтті қосылды.";
    } else {
        echo "Қате.";
    }
}
?>
<form method="POST" action="">
    <label>Кітап атауы:</label><input type="text" name="title" required><br>
    <label>Автор:</label><input type="text" name="author" required><br>
    <label>Жанр:</label><input type="text" name="genre"><br>
    <label>Сипаттама:</label><textarea name="description"></textarea><br>
    <button type="submit">Қосу</button>
</form>
