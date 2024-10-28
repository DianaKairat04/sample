<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Online Library</title>
  <link rel="stylesheet" href="project.css">
</head>
<body>
  <div class="container">
    <header>
      <h1>Online Library</h1>
      <p>Manage and explore your book collection.</p>
    </header>

    <!-- Кітап қосу формасы -->
    <section class="add-book">
      <h2>Add a Book</h2>
      <form id="addBookForm">
        <div class="form-group">
          <label for="title">Title:</label>
          <input type="text" id="title" name="title" required>
        </div>
        <div class="form-group">
          <label for="author">Author:</label>
          <input type="text" id="author" name="author" required>
        </div>
        <div class="form-group">
          <label for="rating">Rating:</label>
          <input type="number" id="rating" name="rating" min="1" max="5" required>
        </div>
        <button type="submit">Add Book</button>
      </form>
    </section>

    <!-- Кітаптар тізімі -->
    <section class="book-list">
      <h2>Book List</h2>
      <div id="books">
        <!-- Кітаптар динамикалық түрде осы жерде көрсетіледі -->
      </div>
    </section>
  </div>

  <script src="project.js"></script>
</body>
</html>
