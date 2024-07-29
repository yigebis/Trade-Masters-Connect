<?php
    require("checkCredentials.php");
    require("UpdateProfileCode.php");
?>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        header('Location: logout.php');
        exit;
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TradeMaster</title>
    <link rel="icon" href="./images/TMIcon.png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="customerPP.css">
</head>

<body>
    <div class="Technician-container">
        <div class="profile">
            <div class="profile_picture"> 
                <img src="<?php echo $photoLink; ?>" alt="profilePIc">
            </div>
            <p id="Technician_UserName"><?php echo $custStatusRow['UserName']; ?></p>
            <br>
        </div>

        <div class="technician-form">
            <div class="technician-profile">
                <div class="output-box">
                    <p>Date of Birth:</p>
                    <span><?php echo $custStatusRow['DOB']; ?></span>
                </div>
                <div class="output-box">
                    <p>Gender:</p>
                    <span><?php echo $custStatusRow['Gender']; ?></span>
                </div>
                <div class="button">
                    <button onclick="redirect()" type="submit" id="technician_update">Update</button>
                    <form onsubmit="confirmLogout()" method="post" action="customerPP.php">
                        <button name="logout" type="submit" id="technician_logout">Log Out</button>
                    </form>
                </div>
                
                
            </div>
        </div>

    </div>
    <script>
        function redirect() {
            window.location.href = "customerUPP.php";
        }
        function confirmLogout(){
            if (!window.confirm("Are you sure you want to log out?")){
                event.preventDefault();
            }
        }
    </script>
</body>