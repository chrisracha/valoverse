<?php
if (isset($_GET['agent_id'])) {
        $agentId = $_GET['agent_id'];
        $sql = "SELECT * FROM valorant_agent WHERE agent_id = '$agentId' AND ownerId = '$userid'";
        $result = $conn->query($sql);
        $agentRow = $result->fetch_assoc();
        if ($agentRow) {
            echo '<form action="index.php" method="POST" enctype="multipart/form-data">';
            echo '<input type="hidden" name="agent_id" value="' . $agentRow["agent_id"] . '">';
            echo 'Agent Name: <input type="text" name="name" value="' . $agentRow["name"] . '"><br>';
            echo 'Description: <br><textarea name="desc">' . $agentRow["desc"] . '</textarea><br>';
            echo 'Nickname: <input type="text" name="nickname" value="' . $agentRow["nickname"] . '"><br>';
            echo 'Real Name: <input type="text" name="realname" value="' . $agentRow["realname"] . '"><br>';
            echo 'Role: <select name="role">';
            echo '<option value="Controller" ' . ($agentRow["role"] === "Controller" ? "selected" : "") . '>Controller</option>';
            echo '<option value="Initiator" ' . ($agentRow["role"] === "Initiator" ? "selected" : "") . '>Initiator</option>';
            echo '<option value="Duelist" ' . ($agentRow["role"] === "Duelist" ? "selected" : "") . '>Duelist</option>';
            echo '<option value="Sentinel" ' . ($agentRow["role"] === "Sentinel" ? "selected" : "") . '>Sentinel</option>';
            echo '</select><br>';
            echo 'Origin: <input type="text" name="origin" value="' . $agentRow["origin"] . '"><br>';
            echo 'Race: <input type="text" name="race" value="' . $agentRow["race"] . '"><br>';
            echo 'Gender: <input type="text" name="gender" value="' . $agentRow["gender"] . '"><br>';
            echo 'Basic Ability 1: <input type="text" name="basic1" value="' . $agentRow["basic1"] . '"><br>';
            echo 'Basic Ability 2: <input type="text" name="basic2" value="' . $agentRow["basic2"] . '"><br>';
            echo 'Basic Ability 3: <input type="text" name="basic3" value="' . $agentRow["basic3"] . '"><br>';
            echo 'Signature Ability: <input type="text" name="signature" value="' . $agentRow["signature"] . '"><br>';
            echo 'Ultimate Ability: <input type="text" name="ultimate" value="' . $agentRow["ultimate"] . '"><br>';
            echo 'Ultimate Points: <input type="number" name="ultipoints" value="' . $agentRow["ultipoints"] . '"><br>';
            echo 'Icon: <input type="file" name="icon"><br>';
            echo 'Bust: <input type="file" name="bust"><br>';
            echo '<input type="submit" value="Update" name="update">';
            echo '<input type="submit" value="Delete" name="delete">';
            echo '</form>';
        }
    }

    if (isset($_POST['delete'])) {
        $agentId = $_POST['agent_id'];
        $sql = "DELETE FROM valorant_agent WHERE agent_id = '$agentId' AND ownerId = '$userid'";
        $result = $conn->query($sql);
        if ($result) {
            echo '<script>alert("Agent deleted successfully");</script>';
        } else {
            echo '<script>alert("Error deleting agent: ' . $conn->error . '");</script>';
        }
        echo '<script>window.location.href = window.location.pathname;</script>';
    }

?>