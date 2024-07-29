<?php
    require('checkCredentials.php');


    function rejectRequest($techusername, $custusername, $skill, $date){
        global $conn;
        $reject = 'R';
        $newDate = (new DateTime()) -> format('Y-m-d H:i:s');
        $sql = "update requests set status = ?, Date = ? where TechUserName = '$techusername' and CustUserName = '$custusername' and `Skill Title` = '$skill' and Date = '$date' ";
        $stmt = $conn -> prepare($sql);
        $stmt -> bind_param("ss", $reject, $newDate);

        $stmt -> execute();
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        $custusername = $_POST['custusername'];
        $date = $_POST['date'];
        $skill = $_POST['skill'];
        rejectRequest($username, $custusername, $skill, $date); 

        header('Location: rejected.php');
        exit;
    }

    $sql = "select * from requests where TechUserName = '$username' and status = 'A'";
    $result = $conn -> query($sql);
    

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Accepted Jobs</title>
        <link rel="stylesheet" href="home.css">
        <link rel="stylesheet" href="requests.css">
    </head>
    <body>
        <!-- Doing the header -->
        <?php
            require('../template/headerNoSearch.php');
        ?>

        <div id="central">
            <?php
                require('technicianNav.php');
            ?>
            <!-- The main contents -->
            <main>
                <ul id="accepted-requests">
                    <h1>Accepted Requests</h1>
                    <?php if ($result -> num_rows == 0){
                        echo "You don't have accepted requests";
                    }
                    ?>
                    <?php while ($row = $result -> fetch_assoc()){ ?>
                        <li>
                            <?php 
                                $date = $row['Date'];
                                $jobTitle = $row['Skill Title'];
                                $custUsername = $row['CustUserName'];
                                $sql = "select * from Customer where UserName = '$custUsername'";
                                $subResult = $conn -> query($sql);
                                $details = $subResult -> fetch_assoc();
                                // print_r($details);
                                $firstName = $details['First Name'];
                                $fatherName = $details['Father Name'];
                                $gfName = $details['Grand Father Name'];
                                // $phone = $details['Phone Number'];
                            ?>
                            <div class="left-detail">
                                <p class="name"><?php echo $firstName ." ". $fatherName ." ". $gfName ?></p>
                                <p class="job-date">
                                    <span class="job-title"><?php echo $jobTitle ?></span>
                                    <span>&middot;</span>
                                    <span class="date">
                                        <!-- March&nbsp;4&nbsp;2016 -->
                                        <?php 
                                            echo $date;
                                        ?>
                                    </span>   
                                </p>
                            </div>
                            <div class="right-detail">
                                <form action="accepted.php" method="post" onsubmit="viewConfirmReject(event)">
                                    <button type="submit" class="bg-red" id="reject">Reject</button>
                                    <input hidden name="custusername" value="<?php echo $custUsername ?>">
                                    <input hidden name="date" value="<?php echo $date ?>">
                                    <input hidden name="skill" value="<?php echo $jobTitle ?>">
                                </form>
                                
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </main>
        </div>

        <?php
            require('../template/footer.php');
        ?>
        
        <script src="requests.js"></script>
    </body>
</html>