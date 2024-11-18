<?php
session_start();
include 'db.php';

$book_id = $_GET['id']; // URL арқылы кітап ID алу
$query = "SELECT * FROM books WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $book_id);
$stmt->execute();
$result = $stmt->get_result();
$book = $result->fetch_assoc();

if (!$book) {
    echo "Кітап табылмады.";
    exit();
}

// Пікірлерді алу
$reviews_query = "SELECT reviews.*, users.username FROM reviews 
                  JOIN users ON reviews.user_id = users.id 
                  WHERE book_id = ?";
$reviews_stmt = $conn->prepare($reviews_query);
$reviews_stmt->bind_param("i", $book_id);
$reviews_stmt->execute();
$reviews_result = $reviews_stmt->get_result();
?>
<h1><?= htmlspecialchars($book['title']) ?></h1>
<p><strong>Автор:</strong> <?= htmlspecialchars($book['author']) ?></p>
<p><strong>Жанр:</strong> <?= htmlspecialchars($book['genre']) ?></p>
<p><strong>Сипаттама:</strong> <?= htmlspecialchars($book['description']) ?></p>

<h2>Пікірлер</h2>
<ul>
    <?php while ($review = $reviews_result->fetch_assoc()): ?>
        <li>
            <strong><?= htmlspecialchars($review['username']) ?>:</strong> 
            <?= htmlspecialchars($review['content']) ?>
        </li>
    <?php endwhile; ?>
</ul>

<!-- Пікір қосу -->
<?php if (isset($_SESSION['user_id'])): ?>
<form method="POST" action="add_review.php">
    <input type="hidden" name="book_id" value="<?= $book_id ?>">
    <textarea name="content" placeholder="Пікіріңізді жазыңыз..." required></textarea><br>
    <button type="submit">Пікір қосу</button>
</form>
<?php else: ?>
<p>Пікір қалдыру үшін <a href="login.php">кіру</a> қажет.</p>
<?php endif; ?>
