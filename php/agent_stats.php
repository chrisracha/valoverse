<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project_beta1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['agent'])) {
    $agent = $_GET['agent'];
} else {
    $sql = "SELECT agent_id FROM valorant_agent";
    $result = $conn->query($sql);
    $numAgents = $result->num_rows;
    $agent = rand(1, $numAgents);
    while ($result->num_rows == 0) {
        $agent = rand(1, $numAgents);
        $sql = "SELECT agent_id FROM valorant_agent WHERE agent_id = '$agent'";
        $result = $conn->query($sql);
    }
}

$sql = "SELECT * FROM valorant_agent WHERE agent_id = '$agent'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo '<div class="agent_preview">';
    echo '<div class="agent_preview_image">';
    echo '<img src="data:image/png;base64,' . base64_encode($row["bust"]) . '"/>';
    echo '</div>';
    echo '<div class="agent_preview_text">';
    echo '<h2 .class="agents_header"> // ' . str_pad($row["agent_id"], 3, '0', STR_PAD_LEFT) . '</h2>';
    echo '<h1 class="agents_header">' . $row["name"] . '</h1>';
    echo '<h3 class="agents_header">' . $row["realname"] . ' // ' . $row["origin"] . '</h3>';
    echo '<h4 class="agents_header">' . $row["desc"] . '</h4>';
    echo '<div  class="agent_role_icon"><img src="images/roleicons/' . $row["role"] . '.png" /></div>';
    echo '<h5 class="agents_header">Abilities</h5>';
    echo '<h2 class="agents_header">' . $row["basic1"] . '</h2>';
    echo '<h2 class="agents_header">' . $row["basic2"] . '</h2>';
    echo '<h2 class="agents_header">' . $row["basic3"] . '</h2>';
    echo '<h2 class="agents_header">' . $row["signature"] . '</h2>';
    echo '<h6 style="margin: 40px 0 10px; line-height: 20px;" class="agents_header">' . $row["ultimate"] . '</h6>';
    echo '<h5 class="agents_header">Ultimate</h5>';
    echo '<h2 class="agents_header">';
    for ($i = 0; $i < $row["ultipoints"]; $i++) {
        echo '♦';
    }
    echo '</h2>';
    echo '</div>';
    echo '</div>';
} else {
    echo " ";
}
?>