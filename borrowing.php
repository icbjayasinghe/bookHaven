<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Borrow a Book</title>
    <link rel="stylesheet" href="css/borrow.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- <script defer src="js/search.js"></script> -->
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
      <dialog id='modal_dialog'>
          <div class='title'>
            Send borrowing request to the owner?
          </div>
          <button value='yes' id='btnYes' onClick='acceptBorrowingRequest(book_id, user_id)' >Yes</button>
          <button value='no' id='btnNo' onClick='closeDialog()'>No</button>
      </dialog>

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
              <th>Rental Price ($)</th>
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

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

  <script>
    const dialog = document.getElementById('modal_dialog');
    var book_id = 0;
    var user_id = 0;

    function confAlert(book) {
      dialog.showModal();
      book_id = book;
      user_id = 1;
    }

    function acceptBorrowingRequest(book, user) {
      $.ajax({
        type: "POST",
        url: 'create_borrowing_request.php',
        data: {
          book_id: book,
          user_id: user
        },
        cache: false,
        success: function(data) {
          alert("Borrowing request sent!");
          dialog.close();
        },
        error: function(xhr, status, error) {
          alert(xhr.responseText);
          console.error(xhr);
        }
      });
    }

    function closeDialog() {
      dialog.close();
    }
</script>
</html>
