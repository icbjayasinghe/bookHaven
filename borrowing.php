<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Borrow a Book</title>
    <link rel="stylesheet" href="css/borrow.css" />
    <!-- <script defer src="js/search.js"></script> -->
  </head>
  <body>
    <header>
      <h1>Borrow a Book</h1>
    </header>

    <nav>
    <ul>
        <li><a href="./borrowing.php" class="active">Books to Borrow</a></li>
        <li><a href="./view_borrowed.php">Requests on Borrowed</a></li>
        <li><a href="./my_rentals.php">My Contirbutions</a></li>
        <li><a href="./rental_requests.php">Requests for My Books</a></li>
        <li><a href="./add_new_rentals.php">Add New Book</a></li>
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
        <input type="text" id="searchBar" placeholder="Search for a book..." onkeyup="searchBooks()"/>

        <!-- Genre search buttons -->
        <div class="genre-buttons">
          <button onclick="filterByGenre('Computer')">Computer Science</button>
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
            <?php 
            // include './functions/get_borrowing.php';
            ?>
          </tbody>
        </table>
        <script>
          let selectedGenre = 'All';

          function searchBooks() {
            const searchTerm = document.getElementById('searchBar').value.toLowerCase();
            const rows = document.querySelectorAll('#bookTable tbody tr');
            rows.forEach(row => {
              const title = row.cells[0].textContent.toLowerCase();
              const genre = row.getAttribute('data-genre').toLowerCase().trim();
              if ((title.includes(searchTerm) || searchTerm === '') && (genre === selectedGenre || selectedGenre === 'All')) {
                row.style.display = '';
              } else {
                row.style.display = 'none';
              }
            });
          }

          function filterByGenre(genre) {
            selectedGenre = genre.toLowerCase().trim();
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
  </body>

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

  <script>
    var book_id = 0;
    var user_id = localStorage.getItem("user_id");

    // fetch('./functions/get_my_rentals.php', {
    //   method: 'POST',
    //   headers: {
    //     'Content-Type': 'application/json',
    //   },
    //  \
    // })
    //   .then((response) => response.text())
    //   .then((data) => {
    //     console.log('Response from server:', data);
    //     // Optionally, update the table with the response
    //     document.querySelector('tbody').innerHTML = data;
    //   })
    //   .catch((error) => console.error('Error:', error));

    $.ajax({
        type: "POST",
        url: './functions/get_borrowing.php',
        data: {
          user_id: user_id
        },
        cache: false,
        success: function(data) {
          document.querySelector('tbody').innerHTML = data;
        },
        error: function(xhr, status, error) {
          alert(xhr.responseText);
          console.error(xhr);
        }
      });

    const dialog = document.getElementById('modal_dialog');
    function confAlert(book) {
      dialog.showModal();
      book_id = book;
      // user_id =  localStorage.getItem("user_id"); // need to get the user id from the session
    }

    function acceptBorrowingRequest(book, user) {
      $.ajax({
        type: "POST",
        url: './functions/create_borrowing_request.php',
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
<!-- <footer>
  <p>&copy; 2025 Sharing Library</p>
</footer> -->
</html>
