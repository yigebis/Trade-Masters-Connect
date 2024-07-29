
<?php
    require("UpdateProfileCode.php");

    $query_accepted_count = "select COUNT(*) AS count from requests where status = 'A' and CustUserName = '$username' and CustSeen = 'N'";
    $result_accepted_count = $conn -> query($query_accepted_count);
    $row_accepted_count = $result_accepted_count -> fetch_assoc();

    $accepted = $row_accepted_count["count"];

    $query_unrated_count = "select COUNT(*) AS count from requests where status = 'A' and CustUserName = '$username' and Rating = '0'";
    $result_unrated_count = $conn -> query($query_unrated_count);
    $row_unrated_count = $result_unrated_count -> fetch_assoc();

    $unrated = $row_unrated_count["count"];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Navigation</title>
</head>
<body>
    <nav>
        <div class="profile" onclick="viewProfile()">
            <div class="profile_picture">
                <img src="<?php echo $photoLink; ?>" alt="profile pic">                 
            </div>
            <p id="profile-name">
                <?php echo $username ?>
            </p>
            <p>Customer</p>
        </div>
        <button class="accepted-more">
            Accepted Requests
            <?php 
                if ($accepted > 0)
                echo '<div id="request-number">' . 
                $accepted . '</div>'
             ?>
        </button>
        <button class="pending-more">Pending Requests</button>
        <button class="rate-technicians" onclick="rateTechnicians()">
            Rate Technicians
            <?php 
                if ($unrated > 0)
                echo '<div id="request-number">' . 
                $unrated . '</div>'
             ?>
        </button>
    </nav>
    <script src="customerNav.js"></script>
</body>
</html>