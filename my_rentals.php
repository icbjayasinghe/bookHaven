<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My Rentals</title>
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
        <li><a href="./my_rentals.php" class="active">My Rentals</a></li>
        <li><a href="./add_new_rentals.php">Add New Rentals</a></li>
      </ul>
    </nav>

    <main>
      <div class="table-container">
        <h2>My Rented Books</h2>
        <input type="text" id="searchBar" placeholder="Search for a book..." />
        <table>
          <thead>
            <tr>
              <th>Title</th>
              <th>Author</th>
              <th>Return Due</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php include 'get_my_rentals.php';?>
          </tbody>
        </table>
      </div>
    </main>

    <footer>
      <p>&copy; 2025 Sharing Library</p>
    </footer>
  </body>
</html>
