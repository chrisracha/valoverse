<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project_beta1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM accounts WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $storedPassword = $row["password"];

        if (password_verify($password, $storedPassword)) {
            $_SESSION["username"] = $username;
            $_SESSION["password"] = $password;
            $_SESSION["loggedin"] = true;
        } else {
            echo "<script>alert('Invalid username or password');</script>";
        }
    } else {
        echo "<script>alert('Invalid username or password');</script>";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["logout"])) {
    session_unset();
    session_destroy();
    echo "<script>alert('Logout successful');</script>";
}

$conn->close();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    echo '<div class="account_form" id="loginSection">';
    echo '<form class="accounts_header" id="loginForm" method="post" action="index.php">';
    echo '<h1>Welcome, ' . $_SESSION["username"] . '</h1>';
    echo '<input type="submit" value="Log Out" name="logout">';
    echo '</form>';
    include 'account_dashboard.php';
    echo '</div>';
} else {
    echo '<div class="account_form" id="loginSection">';
    echo '<form class="accounts_header" id="loginForm" method="post" action="index.php">';
    echo '<h1>Log In</h1>';
    echo '<input type="text" name="username" placeholder="USERNAME" required>';
    echo '<input type="password" name="password" placeholder="PASSWORD" required>';
    echo '<input type="submit" value="Log In" name="login">';
    echo '</form>';
    echo '<p id="signupLink" class="accounts_header">Don\'t have an account? Sign up <a href="#" id="signupTrigger" class="form-a">here</a></p>';
    echo '</div>';
}
?>