<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project_beta1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    $username = $_SESSION["username"];
    $sql = "SELECT userid FROM accounts WHERE username = '$username'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $userid = $row["userid"];
    $sql = "SELECT * FROM valorant_agent WHERE ownerId = '$userid'";
    $result = $conn->query($sql);
    $numAgents = $result->num_rows;

    echo '<div class="dashboard">';
    echo '<div class="account_details">';
    echo '<h2>' . $numAgents . ' SUBMISSION(S)</h2>';
    echo '<ul>';
    while ($row = $result->fetch_assoc()) {
        echo '<li><a class="list-a" href="?agent_id=' . $row["agent_id"] . '">' . $row["name"] . '</a></li>';
    }
    echo '</ul>';
    echo '<form action="index.php?add" method="POST">';
    echo '<input type="submit" value="ADD" name="add" class="list-button">';
    echo '</form>';
    echo '</div>';
    echo '<div class="account_update">';
    include 'dml/agent_manipulation.php';
    include 'dml/agent_add.php';
    echo '</div>';
    echo '</div>';
}

if (isset($_POST['update'])) {
    include 'dml/update.php';
}

if (isset($_POST['insert'])) {
    include 'dml/insert.php';
}
?>
