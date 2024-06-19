<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <nav>
        <div id="profile">
            <button id="profile-photo">P</button>
            <span id="profile-name">
                <?php echo $_SESSION['username'] ?>
            </span>
            <p>Customer</p>
        </div>
        <button class="accepted-more">Accepted Requests</button>
        <button class="pending-more">Pending Requests</button>
        <button>Rate Technicians</button>
    </nav>
    <script src="customerNav.js"></script>
</body>
</html>