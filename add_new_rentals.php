<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Rental</title>
    <link rel="stylesheet" href="css/Add_new_rentals.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <h1>Add New Rental</h1>
    </header>

    <nav>
        <ul>
            <li><a href="./borrowing.php">Borrowing</a></li>
            <li><a href="./view_borrowed.php">View Borrowed</a></li>
            <li><a href="./my_rentals.php">My Rentals</a></li>
            <li><a href="./add_new_rentals.php" class="active">Add New Rentals</a></li>
        </ul>
    </nav>

    <main>
      <div class="table-container">
        <form action="create.php" method="POST">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" placeholder="Enter book title" required>

            <label for="author">Author</label>
            <input type="text" id="author" name="author" placeholder="Enter author name" required>

            <label for="genre">Genre</label>
            <select id="genre" name="genre" required>
                <option value="1">Computer Science</option>
                <option value="3">Management</option>
                <option value="4">Law</option>
            </select>

            <button type="submit">Add New Books</button>
        </form>
      </div>
    </main>

    <footer>
        <p>&copy; 2025 Sharing Library</p>
    </footer>
</body>
</html>

