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
    // alert(localStorage.getItem('user_id'))
    document.getElementById('user_id').value = localStorage.getItem('user_id');
</script>
<!-- <footer>
    <p>&copy; 2025 Sharing Library</p>
</footer> -->
</html>

