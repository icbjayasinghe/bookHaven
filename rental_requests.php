<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Rentals Requests</title>
    <link rel="stylesheet" href="./css/My_rentals.css" />
  </head>
  <body>
    <header>
      <h1>My Rentals</h1>
    </header>

    <nav>
      <ul>
        <li><a href="./borrowing.php">Borrowing</a></li>
        <li><a href="./view_borrowed.php">View Borrowed</a></li>
        <li><a href="./my_rentals.php">My Rentals</a></li>
        <li><a href="./rental_requests.php" class="active">Rental Requests</a></li>
        <li><a href="./add_new_rentals.php">Add New Rentals</a></li>
      </ul>
    </nav>

    <main>
      <div class="table-container">
        <h2>Rental Requests for My Books</h2>
        <table>
          <thead>
            <tr>
              <th>Title</th>
              <th>Author</th>
              <th>Requested By</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            // include './functions/get_my_rental_requests.php';?>
          </tbody>
        </table>
      </div>
    </main>

    <footer>
      <p>&copy; 2025 Sharing Library</p>
    </footer>
  </body>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script> 
    var user_id = localStorage.getItem("user_id");
      $.ajax({
          type: "POST",
          url: './functions/get_my_rental_requests.php',
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
  </script>
</html>
