<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My Rentals</title>
    <link rel="stylesheet" href="./css/My_rentals.css" />
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
      <h1>My Books and Rental History</h1>
    </header>

    <nav>
    <ul>
        <li><a href="./borrowing.php">Books to Borrow</a></li>
        <li><a href="./view_borrowed.php">Requests on Borrowed</a></li>
        <li><a href="./my_rentals.php" class="active">My Contirbutions</a></li>
        <li><a href="./rental_requests.php">Requests for My Books</a></li>
        <li><a href="./add_new_rentals.php">Add New Book</a></li>
      </ul>
    </nav>

    <main>
      <div class="table-container">
        <h2>My Books</h2>
        <!-- <input type="text" id="searchBar" placeholder="Search for a book..." /> -->
        <table>
          <thead>
            <tr>
              <th>Title</th>
              <th>Author</th>
            </tr>
          </thead>
          <tbody id="my_books">
            <?php 
            // include './functions/get_my_books.php';
            ?>
          </tbody>
        </table>
        <h2>My Rental History</h2>
        <table>
          <thead>
            <tr>
              <th>Title</th>
              <th>Author</th>
              <th>Return Date</th>
              <th>Borrower</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody id="my_rentals">
            <?php 
            // include './functions/get_my_rentals.php';
            ?>
          </tbody>
        </table>
      </div>
    </main>
  </body>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

  <script>

    if(typeof(Storage) !== "undefined") { 
        document.getElementById("name_div").innerHTML =  
        localStorage.getItem("first_name")+ " " +localStorage.getItem("last_name"); 
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

    var user_id = localStorage.getItem("user_id");
    $.ajax({
        type: "POST",
        url: './functions/get_my_books.php',
        data: {
          user_id: user_id
        },
        cache: false,
        success: function(data) {
          document.querySelector('#my_books').innerHTML = data;
        },
        error: function(xhr, status, error) {
          alert(xhr.responseText);
          console.error(xhr);
        }
      });

      $.ajax({
        type: "POST",
        url: './functions/get_my_rentals.php',
        data: {
          user_id: user_id
        },
        cache: false,
        success: function(data) {
          document.querySelector('#my_rentals').innerHTML = data;
        },
        error: function(xhr, status, error) {
          alert(xhr.responseText);
          console.error(xhr);
        }
      });

  </script>
  <!-- <footer>
   <p>&copy; 2025 Sharing Library</p>
  </footer> -->
</html>
