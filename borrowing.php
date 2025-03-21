<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Borrow a Book</title>
    <link rel="stylesheet" href="css/borrow.css" />
    <script defer src="js/search.js"></script>
  </head>
  <body>
    <header>
      <h1>Borrow a Book</h1>
    </header>

    <nav>
      <ul>
        <li><a href="./borrowing.php" class="active">Borrowing</a></li>
        <li><a href="./view_borrowed.php">View Borrowed</a></li>
        <li><a href="./my_rentals.php">My Rentals</a></li>
        <li><a href="./add_new_rentals.php">Add New Rentals</a></li>
      </ul>
    </nav>

    <main>
      <!-- Table container with search box, title, and table -->
      <div class="table-container">
        <h2>Available Books</h2>

        <!-- 搜索框 -->
        <input
          type="text"
          id="searchBar"
          placeholder="Search for a book..."
          onkeyup="searchBooks()"
        />

        <!-- Genre search buttons -->
        <div class="genre-buttons">
          <button onclick="filterByGenre('Computer Science')">Computer Science</button>
          <button onclick="filterByGenre('Management')">Management</button>
          <button onclick="filterByGenre('Law')">Law</button>
        </div>
        <button onclick="resetTable()">Reset</button>

        <table id="bookTable">
          <thead>
            <tr>
              <th>Book Title</th>
              <th>Author</th>
              <th>Genre</th>
              <th>Availability</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr data-genre="Computer Science">
              <td>The Catcher in the Rye</td>
              <td>J.D. Salinger</td>
              <td>Computer Science</td>
              <td>Available</td>
              <td><button>Borrow</button></td>
            </tr>
            <tr data-genre="Management">
              <td>Brave New World</td>
              <td>Aldous Huxley</td>
              <td>Management</td>
              <td>Available</td>
              <td><button>Borrow</button></td>
            </tr>
            <tr data-genre="Law">
              <td>The Hobbit</td>
              <td>J.R.R. Tolkien</td>
              <td>Law</td>
              <td>Available</td>
              <td><button>Borrow</button></td>
            </tr>
            <tr data-genre="Law">
              <td>The Catcher in the Rye</td>
              <td>J.R.R. Tolkien</td>
              <td>Law</td>
              <td>Available</td>
              <td><button>Borrow</button></td>
            </tr>
          </tbody>
        </table>
        <script>
          let selectedGenre = 'All';

          function searchBooks() {
            const searchTerm = document.getElementById('searchBar').value.toLowerCase();
            const rows = document.querySelectorAll('#bookTable tbody tr');
            rows.forEach(row => {
              const title = row.cells[0].textContent.toLowerCase();
              const genre = row.getAttribute('data-genre');
              if ((title.includes(searchTerm) || searchTerm === '') && (genre === selectedGenre || selectedGenre === 'All')) {
                row.style.display = '';
              } else {
                row.style.display = 'none';
              }
            });
          }

          function filterByGenre(genre) {
            selectedGenre = genre;
            searchBooks(); // Reapply the search filter with the new genre
          }

          function resetTable() {
            document.getElementById('searchBar').value = '';
            selectedGenre = 'All';
            searchBooks(); // Reset the table to show all rows
          }
        </script>

      </div>
    </main>

    <footer>
      <p>&copy; 2025 Sharing Library</p>
    </footer>
  </body>
</html>
