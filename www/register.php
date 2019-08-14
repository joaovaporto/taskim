<!DOCTYPE html>
<html>
  <head>
    <title>Register</title>
    <link rel='stylesheet' href='css/register.css' type='text/css' />
  </head>
  <body>
    <div id="header"><h1>Taskim</h1></div><br>
    <div id="register-fields">
      <form name="register-form" action="register.php" method="post">
    Name<br>
	<input type="name" name="name"></input><br>
	E-mail<br>
	<input type="text" name="email"></input><br>
	Password<br>
	<input type="password" name="password"></input><br>
	<input type="submit" name="register" value="register"></input>
      </form>
    </div>
                
    <script src="js/jquery-3.4.1.js"></script>
    <script src="js/register.js"></script>
<?php
include 'db_connection.php';

$conn = openConn();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM user WHERE email = \"" . $email . "\"";

    $result = mysqli_query($conn, $query);
    $result_grid = mysqli_fetch_array($result);

    if (mysqli_num_rows($result) != 0) { ?>
        <div id="register-result">E-mail already used. Please, register with another e-mail.</div>
<?php
    } else {
        $pw_hashed = password_hash($password, PASSWORD_DEFAULT);
        
        $query = "INSERT INTO user (name, email, password) VALUES (\"" . $name . "\", \"" . $email . "\", \"" . $pw_hashed . "\");";

        $result = mysqli_query($conn, $query);

        if (!$result) { ?>
            <div id="register-result">Problem in server. Please, try again later.</div>
<?php
        } else { ?>
        <div id="register-result">
        Register done!
            <a href=index.php> Click here to login</a>
        </div>
<?php
        }
    }
}

closeConn($conn);
?>

  </body>
</html>