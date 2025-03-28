<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Borrow a Book</title>
    <link rel="stylesheet" href="css/borrow.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body>
    <header>
      <div style = "float:right; margin-right: 20px;">
         <div onClick = "logoutPopup()">
          <img src="./assets/user-yellow-circle-20550.png" class="img-circle" alt="Cinque Terre" width="30" height="30">
          <div id="name_div" style = "font-size:Large" data-tooltip="Click to log out"></div>
         </div>
        
        <a class="btn" style="display: none; cursor: pointer;" id="logout_btn" onClick = "logout()">
          <span class="fa fa-sign-out"></span>Log out
        </a>
      </div>
      </div>
      <!-- <img src="./assets/dal-logo-vertical-colour.png" class="img-circle" width="30" height="30"> -->
        <h1>Borrow a Book</h1> 
      </div>
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
          <button onclick="resetTable()" style = "float: right;"> <i class="fa fa-refresh"></i> Reset</button>
        </div>

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
          if(typeof(Storage) !== "undefined") { 
            document.getElementById("name_div").innerHTML =  
            localStorage.getItem("first_name")+ " " +localStorage.getItem("last_name"); 
          }

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

    var logoutFlag = false;
    function logoutPopup() {
      if(logoutFlag) {
        document.querySelector('a.btn').style.display = 'none';
        logoutFlag = false;
      } else {
        document.querySelector('a.btn').style.display = 'block';
        logoutFlag = true;
      }
    }

    function logout() {
      localStorage.removeItem("user_id");
      localStorage.removeItem("first_name");
      localStorage.removeItem("last_name");
      window.location.href = "./index.html";
    }
</script>
<!-- <footer>
  <p>&copy; 2025 Sharing Library</p>
</footer> -->
</html>
