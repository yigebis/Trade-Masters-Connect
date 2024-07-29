<?php
    require("UpdateProfileCode.php");

    $query_request_count = "select COUNT(*) AS count from requests where status = 'P' and TechUserName = '$username' and TechSeen = 'N'";
    $result_request_count = $conn -> query($query_request_count);
    $row_request_count = $result_request_count -> fetch_assoc();

    $newRequests = $row_request_count["count"];
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trade Master</title>
    <link rel="stylesheet" href="home.css">
</head>

<body>
    <nav>
        <div id="profile" onclick="viewProfile()">
            <div class="profile">
                <div class="profile_picture">
                    <button id="profile-photo"><img src="<?php echo $photoLink; ?>" alt="profile pic"></button>
                </div>
            </div>
            <span id="profile-name">
                <?php echo $username ?>
            </span>
            <p>Technician</p>
        </div> 
        <button class="requests" onclick="viewRequests()">
            Requests
            <?php 
                if ($newRequests > 0)
                echo '<div id="request-number">' . 
                $newRequests . '</div>'
             ?>
        </button>
        <button class="accepted-jobs" onclick="viewAcceptedJobs()">Accepted Jobs</button>
        <button class="Rejected-requests" onclick="viewRejectedRequests()">Rejected Requests</button>
    </nav>
    <script src="technicianNav.js"></script>
</body>

</html>