<?php
    session_start();
    $techUserName = $_GET['techUserName'];
    if (!isset($_SESSION['username'])){
        header('Location: ../PrePages/login.php');
    }
    if ($techUserName == ""){
        header('Location: home.php');
        exit;
    }

    $thisTechnician = [];
    
    foreach($_SESSION['techSkills'] as $skill => $details){
        foreach ($details as $detail){
            if ($detail['TechUserName'] == $techUserName){
                $thisTechnician[$skill] = $detail;
                break;
            }
        }        
    }

    $_SESSION['thisTechnician'] = $thisTechnician;

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Technician Information</title>
    <link rel="stylesheet" href="technicianInfo.css">
</head>
<body>

    <?php require('../template/headerNoSearch.php'); ?>

    <div id="central">
        <div class="technician-status">
            <div class="photo-container"></div>
            <p>
                <?php
                    echo $_SESSION['technicians'][$techUserName]['First Name']. " ";
                    echo $_SESSION['technicians'][$techUserName]['Father Name']. " ";
                    echo $_SESSION['technicians'][$techUserName]['Grand Father Name']. " ";
                ?>
            </p>
            <p>
                <?php 
                    $birthDate = new DateTime($_SESSION['technicians'][$techUserName]['DOB']);
                    $age = date("Y") - $birthDate -> format("Y");
                    echo  $age;
                ?>
            </p>
            <p>
                <?php 
                    $sex = $_SESSION['technicians'][$techUserName]['Gender'];
                    if ($sex == 'M')
                        echo "Male";
                    else
                        echo "Female";
                ?>
            </p>
        </div>

        <div class="technician-skills">
            <h1>Skills</h1>
            <ul>
                <?php foreach($thisTechnician as $skill => $details){ ?>
                    <h1><?php echo $skill ?></h1>
                    <li><?php echo $details['Experience'] ?> yrs of Experience</li>
                    <li>
                        <?php 
                            $rating = $details['Rating'];
                            $fulls = floor($rating);
                            $portion = $rating - $fulls;
                            $empty = 5 - ceil($rating);
                        ?>
                        <div class="rating-container">
                            <?php for($i = 0; $i < $fulls; $i++){?>                 
                                <!-- <img src="../images/TradeMaster-01.png">                -->
                                <img class="rating-images" src="../images/filled-rating.png">
                            <?php } ?>

                            <?php if ($portion > 0){?>
                                <img class="rating-images" src="../images/half-filled-rating.png">
                            <?php } ?>

                            <?php for($i = 0; $i < $empty; $i++){?>                 
                                <!-- <img src="../images/TradeMaster-01.png">                -->
                                <img class="rating-images" src="../images/unfilled-rating.png">
                            <?php } ?>

                        </div>
                        <?php
                            if ($rating > 0)
                                echo "<b>$rating</b>";
                            else {
                                echo "<b>unrated</b>";
                            }
                        ?>
                    </li>
                    <li>
                        <h3>Certificate</h3>
                    </li>
                <?php }?>
            </ul>
        </div>

        <div class="technician-bio">
            <h1>Bio</h1>
            <div class="bio-div">
                <?php
                    $bio = $_SESSION['technicians'][$techUserName]['Bio'];
                    echo $bio;
                ?>
            </div>
        </div>

        <button id="request-btn" onclick="requestJob('<?php echo $techUserName ?>')">Request a job</button>
        
    </div>
    

    <?php require('../template/footer.php');?>

    <script src="technicianInfo.js"></script>
</body>
</html>