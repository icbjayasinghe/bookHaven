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
      <h1>Requests Made by Borrowers on My Books</h1>
    </header>

    <nav>
      <ul>
        <li><a href="./borrowing.php">Books to Borrow</a></li>
        <li><a href="./view_borrowed.php">Requests on Borrowed</a></li>
        <li><a href="./my_rentals.php">My Contirbutions</a></li>
        <li><a href="./rental_requests.php" class="active">Requests for My Books</a></li>
        <li><a href="./add_new_rentals.php">Add New Book</a></li>
      </ul>
    </nav>

    <main>
      <dialog id='modal_dialog_review'>
          <div class='title'>
            Accept the request and lend the book?
          </div>
          <button value='yes' id='btnYes' onClick='acceptToLend(borrow_id)'>Accept</button>
          <button value='no' id='btnNo' onClick='rejectToLend(borrow_id,book_id)'>Reject</button>
      </dialog>

      <dialog id='modal_dialog_confirm'>
          <div class='title'>
            Confirm returning the book?
          </div>
          <button value='yes' id='btnYes' onClick='confirmRetun(borrow_id,book_id)'>Yes</button>
          <button value='no' id='btnNo' onClick='closeDialog()'>No</button>
      </dialog>

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
            // include './functions/get_my_rental_requests.php';
            ?>
          </tbody>
        </table>
      </div>
    </main>
  </body>

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  
  <script> 
    var borrow_id = 0;
    var book_id = 0;
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

        // Review Request
        const dialog_review = document.getElementById('modal_dialog_review');
        function confAlert_rev(borrow,book) {
          dialog_review.showModal();
          borrow_id = borrow;
          book_id = book;
          // user_id =  localStorage.getItem("user_id"); // need to get the user id from the session
        }

        function acceptToLend(borrow) {
          $.ajax({
            type: "POST",
            url: './functions/accept_borrowing_request.php',
            data: {
              borrow_id: borrow
            },
            cache: false,
            success: function(data) {
              alert("Borrowing request accepted!");
              dialog_review.close();
            },
            error: function(xhr, status, error) {
              alert(xhr.responseText);
              console.error(xhr);
            }
          });
        }

        function rejectToLend(borrow,book) {
          $.ajax({
            type: "POST",
            url: './functions/reject_borrowing_request.php',
            data: {
              borrow_id: borrow,
              book_id: book
            },
            cache: false,
            success: function(data) {
              alert(data);
              dialog_review.close();
            },
            error: function(xhr, status, error) {
              alert(xhr.responseText);
              console.error(xhr);
            }
          });
        }

        // Confirm Return
        const dialog_ret = document.getElementById('modal_dialog_confirm');
        function confAlert_ret(borrow,book) {
          dialog_ret.showModal();
          borrow_id = borrow;
          book_id = book;
          // user_id =  localStorage.getItem("user_id"); // need to get the user id from the session
        }
        function confirmRetun(borrow,book) {
          $.ajax({
            type: "POST",
            url: './functions/confirm_return.php',
            data: {
              borrow_id : borrow,
              book_id : book
            },
            cache: false,
            success: function(data) {
              alert("Return confirmed! Book is ready for borrowing again");
              dialog_ret.close();
            },
            error: function(xhr, status, error) {
              alert(xhr.responseText);
              console.error(xhr);
            }
          });
        }


    function closeDialog() {
      dialog_ret.close();
    }

  </script>
  <!-- <footer>
    <p>&copy; 2025 Sharing Library</p>
  </footer> -->
</html>
