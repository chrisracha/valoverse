<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>ValoVerse | Valorant Universe</title>
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <script src="js/jquery.min.js"></script>
    <script src="script.js"></script>
</head>
<body>
    <nav>
        <img src="images/logo.png" />
        <ul>
            <li><a href="javascript:void(0);" onclick="smoothScroll('#agents')">Agents</a></li>
            <li><a href="javascript:void(0);" onclick="smoothScroll('#account')">Account</a></li>
            <li><a href="javascript:void(0);" onclick="smoothScroll('#about')">About</a></li>
        </ul>
    </nav>
    <div class="banner">
        <img src="images/banner.jpg" />
        <div class="banner-text">
            <h1 id="agents">AGENTS</h1>
        </div>
    </div>
    <main>
        <div class="agents" id="agents">
            <div class="agent_list"><?php include 'php/agent_display.php'; ?></div>
            <div class="agent_stats"><?php include 'php/agent_stats.php'; ?></div>
        </div>
        <div class="accounts" id="account"><?php include 'php/login.php'; ?></div>
        </div>
    </main>
    <footer id="about">
        <img src="images/logo.png" />
        <p class="footer_text">ValoVerse is a <a href="https://www.riotgames.com/en" target="_blank">Riot Games</a> fan site and is not affiliated with Riot Games. Riot Games, and all associated properties are trademarks or registered trademarks of Riot Games, Inc.
        </p>
    </footer>
</body>
</html>