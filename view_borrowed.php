<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>View Borrowed</title>
    <link rel="stylesheet" href="css/view_borrowed.css" />
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
      <h1>View and Return Borrowed Books</h1>
    </header>

    <nav>
    <ul>
        <li><a href="./borrowing.php">Books to Borrow</a></li>
        <li><a href="./view_borrowed.php" class="active">Requests on Borrowed</a></li>
        <li><a href="./my_rentals.php">My Contirbutions</a></li>
        <li><a href="./rental_requests.php">Requests for My Books</a></li>
        <li><a href="./add_new_rentals.php">Add New Book</a></li>
      </ul>
    </nav>

    <main>
    <dialog id='modal_dialog'>
          <div class='title'>
            Notify lender that you are ready to return?
          </div>
          <button value='yes' id='btnYes' onClick='readyToReturn(borrow_id)' >Yes</button>
          <button value='no' id='btnNo' onClick='closeDialog()'>No</button>
      </dialog>

      <div class="table-container">
        <h2>My Borrowed Books</h2>
        <!-- <div class="search-container"><input type="text" id="searchInput" placeholder="Search for books..."/></div> -->
        <!-- Borrowed Books Table -->
        <table id="borrowedBooksTable">
          <thead>
            <tr>
              <th>Title</th>
              <th>Author</th>
              <th>Return Date</th>
              <th>Lender</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            // include './functions/get_my_borrowing_requests.php';
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

  var borrow_id = 0;
  var user_id = localStorage.getItem("user_id");

    $.ajax({
        type: "POST",
        url: './functions/get_my_borrowing_requests.php',
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
    function confAlert(borrow) {
      dialog.showModal();
      borrow_id = borrow;
      // user_id =  localStorage.getItem("user_id"); // need to get the user id from the session
    }

    
    function readyToReturn(borrow) {
      $.ajax({
        type: "POST",
        url: './functions/create_return.php',
        data: {
          borrow_id: borrow
        },
        cache: false,
        success: function(data) {
          alert("Return request sent!");
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
