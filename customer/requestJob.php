<?php 
    session_start();
    if (!isset($_SESSION['username'])){
        header('Location: ../PrePages/login.php');
    }
    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        $jobTitle = $_POST['job-title'];
        $location = $_POST['address'];
        $desc = $_POST['desc'];
        $date = (new DateTime()) -> getTimestamp();
        $rating = 0;
        $status = 'Pending';
        
        print_r([$jobTitle, $location, $desc, $date]);
        header("Location: requestJob.php?techUserName='$techUserName'");

    }
    $username = $_SESSION['username'];
    $techUserName = $_GET['techUserName'];
    if ($techUserName == ""){
        header('Location: home.php?');
        exit;
    }
    $thisTechnician = $_SESSION['thisTechnician'];
    // print_r($thisTechnician);

    
?>

<?php
    //validate the form
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Job</title>
    <link rel="stylesheet" href="requestJob.css">
</head>
<body onunload = "confirmUser()">
    <?php require('../template/headerNoSearch.php');?>
    <div id="central">
        
        <form action="test.php" method="POST" >
            <input type="text" hidden  name="tech-username" value="<?php echo $techUserName ?>">
            <h1><?php echo $_SESSION['technicians'][$techUserName]['First Name'] ?></h1>
            <label for="skill">Select a job type</label>
            <select name="job-title" required>
                <?php foreach ($thisTechnician as $skill => $details) { ?>
                    <option value="<?php echo $skill ?>"><?php echo $skill ?></option>
                <?php } ?>                
            </select>
            <label for="desc">Describe the problem happened Briefly</label>
            <textarea name="desc" id="desc" required></textarea>
            <label for="address">Your Location</label>
            <input name="address" type="text" id="address" required>
            <input type="submit" name="submit" id="submit" value="Send Request">
        </form>
    </div>

    <?php require('../template/footer.php') ?>
    <script>
        function confirmUser(){
            window.alert("Your request has been sent successfully");
        }
    </script>
</body>
</html>