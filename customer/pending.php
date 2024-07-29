<?php
    require('checkCredentials.php');

    $sql = "select * from requests where CustUserName = '$username' and status = 'P' order by date desc";
    $result = $conn -> query($sql);
    

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Home Owner</title>
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
                require('customerNav.php');
            ?>
            <!-- The main contents -->
            <main>
                <ul id="pending-requests">
                    <h1>Pending Requests</h1>
                    
                    <?php
                        if ($result -> num_rows == 0){
                            echo "You don't have any pending requests.";
                        }
                    ?>
                    <?php while ($row = $result -> fetch_assoc()){ ?>
                        <li onclick="pendingDetails('<?php echo $row['Date'] ?>')">
                            <?php 
                                $date = $row['Date'];
                                $date = DateTime :: createFromFormat('Y-m-d H:i:s', $date);
                                $date = $date -> format('F d Y h:i A');
                                $jobTitle = $row['Skill Title'];
                                $techUserName = $row['TechUserName'];
                                $sql = "select * from Technician where UserName = '$techUserName'";
                                $subResult = $conn -> query($sql);
                                $details = $subResult -> fetch_assoc();
                                // print_r($details);
                                $firstName = $details['First Name'];
                                $fatherName = $details['Father Name'];
                                $gfName = $details['Grand Father Name'];
                                $phone = $details['Phone Number'];
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