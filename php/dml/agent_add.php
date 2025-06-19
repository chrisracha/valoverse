<?php
if (isset($_POST['add'])) {
        echo '<form action="index.php" autocomplete="off" method="POST" enctype="multipart/form-data">';
        echo '<input type="hidden" name="agent_id" value="">';
        echo 'Agent Name: <input type="text" name="name" required><br>';
        echo 'Description: <br><textarea name="desc" required></textarea><br>';
        echo 'Nickname: <input type="text" name="nickname"><br>';
        echo 'Real Name: <input type="text" name="realname" required><br>';
        echo 'Role: <select name="role" required>';
        echo '<option value="Controller">Controller</option>';
        echo '<option value="Initiator">Initiator</option>';
        echo '<option value="Duelist">Duelist</option>';
        echo '<option value="Sentinel">Sentinel</option>';
        echo '</select><br>';
        echo 'Origin: <input type="text" name="origin" required><br>';
        echo 'Race: <input type="text" name="race" required><br>';
        echo 'Gender: <input type="text" name="gender" required><br>';
        echo 'Basic Ability 1: <input type="text" name="basic1" required><br>';
        echo 'Basic Ability 2: <input type="text" name="basic2" required><br>';
        echo 'Basic Ability 3: <input type="text" name="basic3"><br>';
        echo 'Signature Ability: <input type="text" name="signature" required><br>';
        echo 'Ultimate Ability: <input type="text" name="ultimate" required><br>';
        echo 'Ultimate Points: <input type="number" name="ultipoints" required><br>';
        echo 'Icon: <input type="file" name="icon" required><br>';
        echo 'Bust: <input type="file" name="bust" required><br>';
        echo '<input type="submit" value="Add Agent" name="insert">';
        echo '</form>';
    }
?>