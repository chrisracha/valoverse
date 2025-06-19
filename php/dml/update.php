<?php
if (isset($_POST['update'])) {
$agentId = $_POST['agent_id'];
$name = $_POST['name'];
$desc = $_POST['desc'];
$nickname = $_POST['nickname'];
$realname = $_POST['realname'];
$role = $_POST['role'];
$origin = $_POST['origin'];
$race = $_POST['race'];
$gender = $_POST['gender'];
$basic1 = $_POST['basic1'];
$basic2 = $_POST['basic2'];
$basic3 = $_POST['basic3'];
$signature = $_POST['signature'];
$ultimate = $_POST['ultimate'];
$ultipoints = $_POST['ultipoints'];

$sql = "UPDATE valorant_agent SET 
    `name` = ?, 
    `desc` = ?, 
    nickname = ?, 
    realname = ?, 
    `role` = ?, 
    origin = ?, 
    race = ?, 
    gender = ?, 
    basic1 = ?, 
    basic2 = ?, 
    basic3 = ?, 
    `signature` = ?, 
    ultimate = ?, 
    ultipoints = ?
    WHERE agent_id = ? AND ownerId = ?";

$stmt = $conn->prepare($sql);
if ($stmt) {
    $stmt->bind_param(
        "sssssssssssssiii",
        $name,
        $desc,
        $nickname,
        $realname,
        $role,
        $origin,
        $race,
        $gender,
        $basic1,
        $basic2,
        $basic3,
        $signature,
        $ultimate,
        $ultipoints,
        $agentId,
        $userid
    );

    if ($stmt->execute()) {
    } else {
        echo '<script>alert("Error executing query: ' . $stmt->error . '");</script>';
    }

    $stmt->close();
} else {
    echo '<script>alert("Error preparing query: ' . $conn->error . '");</script>';
}

if (!empty($_FILES['icon']['name'])) {
    $iconFileName = $_FILES['icon']['name'];
    $iconFilePath = 'uploads/' . $iconFileName;
    
    if (move_uploaded_file($_FILES['icon']['tmp_name'], $iconFilePath)) {
        $iconContent = file_get_contents($iconFilePath);
        $stmt = $conn->prepare("UPDATE valorant_agent SET icon = ? WHERE agent_id = ? AND ownerId = ?");
        if ($stmt) {
            $stmt->bind_param("bii", $iconContent, $agentId, $userid);
            $stmt->send_long_data(0, $iconContent);
            if ($stmt->execute()) {
            } else {
                echo '<script>alert("Error executing icon update query: ' . $stmt->error . '");</script>';
            }
            $stmt->close();
        } else {
            echo '<script>alert("Error preparing icon update query: ' . $conn->error . '");</script>';
        }
    } else {
        echo '<script>alert("Error moving icon file to the uploads folder.");</script>';
    }
}

if (!empty($_FILES['bust']['name'])) {
    $bustFileName = $_FILES['bust']['name'];
    $bustFilePath = 'uploads/' . $bustFileName;
    
    if (move_uploaded_file($_FILES['bust']['tmp_name'], $bustFilePath)) {
        $bustContent = file_get_contents($bustFilePath);
        $stmt = $conn->prepare("UPDATE valorant_agent SET bust = ? WHERE agent_id = ? AND ownerId = ?");
        if ($stmt) {
            $stmt->bind_param("bii", $bustContent, $agentId, $userid);
            $stmt->send_long_data(0, $bustContent);
            if ($stmt->execute()) {
            } else {
                echo '<script>alert("Error executing bust update query: ' . $stmt->error . '");</script>';
            }
            $stmt->close();
        } else {
            echo '<script>alert("Error preparing bust update query: ' . $conn->error . '");</script>';
        }
    } else {
        echo '<script>alert("Error moving bust file to the uploads folder.");</script>';
    }
}

$sql .= " WHERE agent_id = '$agentId' AND ownerId = '$userid'";

if ($conn->query($sql) === TRUE) {
    echo '<script>alert("Agent details updated successfully.");</script>';
} else {
    echo '<script>alert("Error updating agent details: ' . $conn->error . '");</script>';
}
echo '<script>window.location.href = window.location.pathname;</script>';
}
?>