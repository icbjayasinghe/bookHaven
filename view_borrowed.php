<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>View Borrowed</title>
    <link rel="stylesheet" href="css/view_borrowed.css" />
  </head>
  <body>
    <header>
      <h1>View Borrowed Books</h1>
    </header>

    <nav>
      <ul>
        <li><a href="./borrowing.php">Borrowing</a></li>
        <li><a href="./view_borrowed.php" class="active">View Borrowed</a></li>
        <li><a href="./my_rentals.php">My Rentals</a></li>
        <li><a href="./add_new_rentals.php">Add New Rentals</a></li>
      </ul>
    </nav>

    <main>
      <div class="table-container">
        <h2>My Borrowed Books</h2>
        <!-- Search bar -->
        <div class="search-container">
          <input
            type="text"
            id="searchInput"
            placeholder="Search for books..."
          />
        </div>

        <!-- Borrowed Books Table -->
        <table id="borrowedBooksTable">
          <thead>
            <tr>
              <th>Title</th>
              <th>Return Due</th>
              <th>Lender</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>The Catcher in the Rye</td>
              <td>March 5, 2025</td>
              <td>John Doe</td>
              <td>Borrowed</td>
              <td><button class="return-btn">Return</button></td>
            </tr>
            <tr>
              <td>Brave New World</td>
              <td>March 10, 2025</td>
              <td>Jane Smith</td>
              <td>Borrowed</td>
              <td><button class="return-btn">Return</button></td>
            </tr>
            <tr>
              <td>1984</td>
              <td>March 15, 2025</td>
              <td>Tom Brown</td>
              <td>Borrowed</td>
              <td><button class="return-btn">Return</button></td>
            </tr>
          </tbody>
        </table>
      </div>
    </main>

    <footer>
      <p>&copy; 2025 Sharing Library</p>
    </footer>
  </body>
</html>
