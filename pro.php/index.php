<?php
session_start();
include 'db.php';

$query = "SELECT books.*, users.username FROM books JOIN users ON books.created_by = users.id ORDER BY created_at DESC";
$result = $conn->query($query);
?>
<h1>Кітаптар тізімі</h1>
<ul>
    <?php while ($book = $result->fetch_assoc()): ?>
        <li>
            <strong><?= htmlspecialchars($book['title']) ?></strong>  
            (<?= htmlspecialchars($book['author']) ?>)  
            - Жанр: <?= htmlspecialchars($book['genre']) ?>  
            [Қосқан: <?= htmlspecialchars($book['username']) ?>]
        </li>
    <?php endwhile; ?>
</ul>
