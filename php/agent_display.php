<?php
session_start();

header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project_beta1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
$roleFilter = isset($_GET['role']) ? $_GET['role'] : [];

$sql = "SELECT agent_id, icon FROM valorant_agent WHERE 1=1";

if (!empty($searchQuery)) {
    $sql .= " AND name LIKE '" . $searchQuery . "%'";
}

if (!empty($roleFilter)) {
    $roles = implode("','", $roleFilter);
    $sql .= " AND role IN ('$roles')";
}

$result = $conn->query($sql);

if ($result) {
    if ($result->num_rows > 0) {
        echo '<ul style="padding: 30px;">';
        $i = 0;
        while ($row = $result->fetch_assoc()) {
            $id = $row["agent_id"];
            $iconData = $row["icon"];
            echo '<a href="#" onclick="event.preventDefault();loadAgentStats(\'' . $id . '\')">';
            echo '<img src="data:image/png;base64,' . base64_encode($iconData) . '"/>';
            echo '</a>';
            if ($i % 5 == 4) {
                echo '<br>';
            }
            $i++;
        }
        echo '</ul>';
    } else {
        echo '<p class="noresults">NO RESULTS</p>';
    }
} else {
    echo "Query Error: " . $conn->error;
}

$conn->close();
?>

<form action="" method="GET">
        <input type="text" name="search" placeholder="SEARCH AGENTS / LEAVE BLANK TO DISPLAY ALL">
        <label>
            <input type="checkbox" name="role[]" value="initiator">
            Initiator
        </label>
        <label>
            <input type="checkbox" name="role[]" value="sentinel">
            Sentinel
        </label>
        <label>
            <input type="checkbox" name="role[]" value="duelist">
            Duelist
        </label>
        <label>
            <input type="checkbox" name="role[]" value="controller">
            Controller
        </label>
        <br>
        <button type="submit">Search</button>
</form>
