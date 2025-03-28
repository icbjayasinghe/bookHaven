<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Rental</title>
    <link rel="stylesheet" href="css/Add_new_rentals.css">
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
        <h1>Add New Book to Rent</h1>
    </header>

    <nav>
    <ul>
        <li><a href="./borrowing.php">Books to Borrow</a></li>
        <li><a href="./view_borrowed.php">Requests on Borrowed</a></li>
        <li><a href="./my_rentals.php">My Contirbutions</a></li>
        <li><a href="./rental_requests.php">Requests for My Books</a></li>
        <li><a href="./add_new_rentals.php" class="active">Add New Book</a></li>
      </ul>
    </nav>

    <main>
      <div class="table-container">
        <form action="./functions/create_book.php" method="POST">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" placeholder="Enter book title" required>

            <label for="author">Author</label>
            <input type="text" id="author" name="author" placeholder="Enter author name" required>

            <input type="text" id="user_id" name="user_id" value="" hidden>

            <label for="genre">Genre</label>
            <select id="genre" name="genre" required>
                <?php 
                    include './functions/get_genre_options.php';
                ?>
            </select>

            <label for="author">Rental Price</label>
            <input type="number" id="price" name="price" min="0" max="1000" step="0.01" placeholder="Enter Rental Price" required>

            <button type="submit">Add New Book</button>
        </form>
      </div>
    </main>


</body>
<script>
    document.getElementById('user_id').value = localStorage.getItem('user_id');

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
</script>
<!-- <footer>
    <p>&copy; 2025 Sharing Library</p>
</footer> -->
</html>

