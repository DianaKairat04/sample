<?php
session_start();
include 'db.php';

$filter = $_GET['filter'] ?? '';
$sort = $_GET['sort'] ?? 'created_at';

$query = "SELECT * FROM books";
if ($filter) {
    $query .= " WHERE genre = ?";
}
$query .= " ORDER BY $sort";

$stmt = $conn->prepare($query);
if ($filter) {
    $stmt->bind_param("s", $filter);
}
$stmt->execute();
$result = $stmt->get_result();
?>
<h1>Кітаптарды сүзу және сұрыптау</h1>
<form method="GET" action="">
    <label>Жанр:</label>
    <input type="text" name="filter" placeholder="Мысалы, Фантастика">
    <label>Сұрыптау:</label>
    <select name="sort">
        <option value="created_at">Қосылған уақыты</option>
        <option value="title">Атауы</option>
        <option value="author">Автор</option>
    </select>
    <button type="submit">Қолдану</button>
</form>
<ul>
    <?php while ($book = $result->fetch_assoc()): ?>
        <li><a href="book_details.php?id=<?= $book['id'] ?>">
            <?= htmlspecialchars($book['title']) ?> (<?= htmlspecialchars($book['author']) ?>)
        </a></li>
    <?php endwhile; ?>
</ul>
