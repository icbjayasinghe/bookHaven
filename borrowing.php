<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Borrow a Book</title>
    <link rel="stylesheet" href="css/borrow.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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
            <?php include 'get_borrowing.php';?>
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

  <script>
    function confAlert(book_id) {
      let text = "Send borrowing request to the owner?";
      var book_id = book_id;
      var user_id = 1;
      if (confirm(text) == true) {

        $.post("create_borrowing_request.php", {
          book_id: book_id, 
          user_id: user_id
        }, function(data, status) {
          alert("Borrowing request sent!");

          alert(status);
        });
        text = "You pressed OK!";
      } else {
        window.location.href = '/borrowing.php';
        text = "You canceled!";
      }
      // document.getElementById("demo").innerHTML = text;
    }
</script>
</html>
