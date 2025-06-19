<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project_beta1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $checkQuery = "SELECT * FROM accounts WHERE username = '$username'";
    $checkResult = $conn->query($checkQuery);
    if ($checkResult->num_rows > 0) {
        echo "<script>alert('Username already exists. Please choose a different username.');</script>";
        echo "<script>window.location.href = '../index.php';</script>";
    } else {
        $sql = "INSERT INTO accounts (username, password) VALUES ('$username', '$hashedPassword')";

        if ($conn->query($sql) === true) {
            echo "<script>alert('Signup successful!');</script>";
            echo "<script>window.location.href = '../index.php';</script>";
        } else {
            echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
            echo "<script>window.location.href = '../index.php';</script>";
        }
    }
}

$conn->close();
?>

<div class="account_form" id="signupSection">
  <form class="accounts_header" id="signupForm" method="post" action="php/signup.php">
    <h1>Signup</h1>
    <input type="text" name="username" id="username" placeholder="USERNAME" required>
    <input type="password" name="password" id="password" placeholder="PASSWORD" required>
    <input type="submit" value="Signup" id="signupBtn">
  </form>
  <p id="backToLogin" class="accounts_header">Already have an account? <a href="#" id="loginTrigger" class="form-a">Go back to login</a></p>
</div>