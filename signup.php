<!DOCTYPE html>
<html lang="en">
<!-- NOT ADDED ANY PAGES -->
<?php 

include('./db_connect.php');
include 'topbar_2.php' ;

$error_message = "";
?>
<?php 
if(isset($_SESSION['login_id'])){
  header("location:index.php?page=home");
}else{
  session_start();

}

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Form</title>

    <style>
        form {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            max-width: 400px;
            margin: auto;
            margin-top: 20px;
        }

        h2 {
            text-align: center;
            color: #45a049;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: black;
        }

        input, select {
            width: calc(100% - 16px);
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }


       input[type="submit"] {
            background-color: #007bff;
            color: black;
            cursor: pointer;
            width: 40%;
            display: inline-block;
            margin-top: 10px;
            margin-left: 30%;
            border-radius:5px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
		
        p, a {
            display: inline-block;
            color: black;
            text-align: center;
        }
		/* Apply a clearfix to the container to clear floats */
        .form-container::after {
            content: "";
            display: table;
            clear: both;
        }

        /* Style for each column */
        .form-column {
            width: 48%; /* Adjust the width as needed */
            float: left;
            margin-right: 2%;
        }

        /* Style for the input fields */
        .form-column input {
            width: 100%;
            box-sizing: border-box;
            margin-bottom: 10px;
        }
		.form-signup {
            width: 50%;
            box-sizing: border-box;
            margin-bottom: 10px;
            color: black;
			      border-radius:5px;
            cursor: pointer;
        
        }
    .signup-button{
      background-color: #007bff;
            color: black;
            cursor: pointer;
            width: 40%;
            display: inline-block;
            margin-top: 10px;
            margin-left: 30%;
            border-radius:5px;
    }

    /* Modal styles */
    .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 40%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,.close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
	
    </style>
	

</head>

<body>
    
  <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Database connection
     try {

        if ($conn->connect_error) {
          throw new mysqli_sql_exception("Connection failed: " . $conn->connect_error);
        }

        $type =3;
        // Form data
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
		    $s_id = $_POST['s_id'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        
        $dept = $_POST['dept'];

        // Password validation
        if ($password !== $confirm_password) {
          $error_message= "Passwords do not match";
          $URL="signup.php";
            echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL .'">';
          die("Password not match");

        }else{
          // Hash the password
          $hashed_password = md5($_POST['password']);
               // Insert data into the database with md5 password
        }

        $sql = "INSERT INTO students (firstname, lastname, email, password, type,dept,s_id) VALUES ('$firstname', '$lastname', '$email','$hashed_password','$type','$dept', '$s_id')";
        if ($conn->query($sql) === TRUE) {
          $error_message = "New Student created successfully";
        } else {
           $error_message = "Error: " . $sql . "<br>" . $conn->error;
              // Check if the error is due to a duplicate key (unique constraint violation)
            if ($conn->errno == 1062) {
              $error_message = "Duplicate key error: Some data already exists";
            }else{
              throw new mysqli_sql_exception("Error: " . $conn->error);
          }
        }

        $conn->close();

      } catch (mysqli_sql_exception $e) {
        $error_message = "Error: " . $e->getMessage();
      }
    }
  ?>
	
	

 <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
    <h2><u>Register as Student</u></h2>
	 <div class="form-container">
		<div class="form-column">
			<label for="firstname">First Name:</label>
			<input type="text" name="firstname" placeholder="Enter First Name" required><br>

			<label for="lastname">Last Name:</label>
			<input type="text" name="lastname" placeholder="Enter Last Name" required><br>
			
			<label for="s_id">User ID:</label>
			<input type="number" name="s_id" placeholder="20221057010" maxlength="15" required><br>
			
			<label for="dept">Department:</label>
			<select name="dept">
				<option value="1" selected>CSE</option>
				<option value="2">EEE</option>
        <option value="3">CE</option>
			</select><br>

		</div>
		
		 <div class="form-column">
			<label for="email">Email:</label>
			<input type="email" name="email" placeholder="Enter  email" required><br>

			<label for="password">Password:</label>
			<input type="password" name="password" placeholder="Enter password" required><br>

			<label for="confirm_password">Confirm Password:</label>
			<input type="password" name="confirm_password" placeholder="Confirm password" required><br>

      <label for="">User Type:</label>
			<select name="">
				<option value="3" disabled selected>Student</option>
			</select>
							
			</div>
    

      
			<div class="form-signu">
			<input type="submit" class="signup-button" value="Register">
			</div>
      <p>Already registered ? <a href="login.php">Sign in here </a></p>
	</div>	
 </form>

<!-- Modal -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <label id="errorMessage"></label>
        <button class="btn signup-button" onclick="window.location.href='index.php?page=login' ">Login</button>
    </div>
</div>
<!-- ---end model--- -->
</body>
<script>
 // Get the modal
 var modal = document.getElementById("myModal");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the page is loaded, display the modal with the error message
window.onload = function() {
    var errorMessage = "<?php echo addslashes($error_message); ?>";
    if (errorMessage) {
        document.getElementById("errorMessage").innerHTML = errorMessage;
        modal.style.display = "block";
    }
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";

}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
		
		</script>

</html>
