// Кітаптар тізімі
const books = [];

// Кітапты қосу функциясы
document.getElementById("addBookForm").addEventListener("submit", function (e) {
  e.preventDefault();
  
  const title = document.getElementById("title").value;
  const author = document.getElementById("author").value;
  const rating = document.getElementById("rating").value;

  const newBook = {
    id: Date.now(),
    title,
    author,
    rating
  };

  books.push(newBook);
  renderBooks();
  this.reset();
});

// Кітаптарды көрсету функциясы
function renderBooks() {
  const bookContainer = document.getElementById("books");
  bookContainer.innerHTML = "";

  books.forEach(book => {
    const bookElement = document.createElement("div");
    bookElement.classList.add("book");

    bookElement.innerHTML = `
      <h3>${book.title}</h3>
      <p>Author: ${book.author}</p>
      <p>Rating: ${book.rating}</p>
      <button class="delete-button" onclick="deleteBook(${book.id})">Delete</button>
    `;

    bookContainer.appendChild(bookElement);
  });
}

// Кітапты өшіру функциясы
function deleteBook(id) {
  const bookIndex = books.findIndex(book => book.id === id);
  if (bookIndex !== -1) {
    books.splice(bookIndex, 1);
    renderBooks();
  }
}
