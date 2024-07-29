<?php

    require('checkCredentials.php');

    $sql = "select * from requests where TechUserName = '$username' and status = 'P' ORDER BY Date DESC";
    $result = $conn -> query($sql);

?>

<!DOCTYPE html>
<html>
    <head>
        <title>New Requests</title>
        <link rel="stylesheet" href="home.css">
        <link rel="stylesheet" href="requests.css"
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
                <ul id="pending-requests">
                    <h1>Work Requests</h1>
                    
                    <?php
                        if ($result -> num_rows == 0){
                            echo "You don't have any new requests.";
                        }
                    ?>
                    <?php while ($row = $result -> fetch_assoc()){ ?>
                        <li>
                            <?php 
                                // print_r($row);
                                $date = $row['Date'];
                                $date = DateTime :: createFromFormat('Y-m-d H:i:s', $date);
                                $date = $date -> format('F d Y h:i A');
                                $jobTitle = $row['Skill Title'];
                                $custUserName = $row['CustUserName'];
                                $sql = "select * from Customer where UserName = '$custUserName'";
                                $subResult = $conn -> query($sql);
                                $details = $subResult -> fetch_assoc();
                                // print_r($details);
                                $firstName = $details['First Name'];
                                $fatherName = $details['Father Name'];
                                $gfName = $details['Grand Father Name'];
                                $location = $row['Location'];
                            ?>
                            <div class="left-detail">
                                <h2><?php echo $jobTitle ?></h2>
                                <p class="name"><span>User: </span><?php echo  $firstName ." ". $fatherName ." ". $gfName ?></p>
                                <p class="job-date"><span>Date: </span><?php echo $date;?></p>
                                <p><span>Location: </span><?php echo $location ?> </p>
                                <button class="details" onclick="viewRequestDetails('<?php echo $row['Date'] ?>', '<?php echo $username ?>', '<?php echo $row['CustUserName'] ?>', '<?php echo $jobTitle ?>')" >View Details</button>
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