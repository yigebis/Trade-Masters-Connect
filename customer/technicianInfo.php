<?php
    require('checkCredentials.php');
    
    $techUserName = $_GET['techUserName'];

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>

<?php require('../template/headerNoSearch.php'); ?>

<div id="central">
    <div class="technician-status">
        <div class="photo-container" style="background-image: url('<?php echo "../PrePages/".$_SESSION['technicians'][$techUserName]['Photo']; ?>'); background-repeat : no-repeat;"></div>
        <div class="technician-info">
            <p><span class="label">Name:</span> 
                <?php
                    echo $_SESSION['technicians'][$techUserName]['First Name'] . " ";
                    echo $_SESSION['technicians'][$techUserName]['Father Name'] . " ";
                    echo $_SESSION['technicians'][$techUserName]['Grand Father Name'];
                ?>
            </p>
            <p><span class="label">Age:</span>
                <?php 
                    $birthDate = new DateTime($_SESSION['technicians'][$techUserName]['DOB']);
                    $age = date("Y") - $birthDate->format("Y");
                    echo $age;
                ?>
            </p>
            <p><span class="label">Gender:</span>
                <?php 
                    $sex = $_SESSION['technicians'][$techUserName]['Gender'];
                    echo $sex == 'M' ? "Male" : "Female";
                ?>
            </p>
        </div>
    </div>

    <div class="technician-details">
        <div class="technician-skills">
            <h1>Skills</h1>
            <ul>
                <?php foreach($thisTechnician as $skill => $details){ ?>
                    <li>
                        <h2><?php echo $skill ?></h2>
                        <p><?php echo $details['Experience'] ?> yrs of Experience</p>
                        <p>
                            <?php 
                                $rating = number_format($details['Rating'], 1);
                                $fulls = floor($rating);
                                $portion = $rating - $fulls;
                                $empty = 5 - ceil($rating);
                            ?>
                            <div class="rating-container">
                                <?php for($i = 0; $i < $fulls; $i++){?>                 
                                    <span class="fas fa-star full-star"></span>
                                <?php } ?>

                                <?php if ($portion > 0){?>
                                    <span class="fas fa-star-half-alt half-star"></span>
                                <?php } ?>

                                <?php for($i = 0; $i < $empty; $i++){?>                 
                                    <span class="fas fa-star empty-star"></span>
                                <?php } ?>
                            </div>
                            <?php echo $rating > 0 ? "<b>$rating</b>" : "<b>unrated</b>"; ?>
                        </p>
                        <p>
                            <h3>Certificate</h3>
                            <a href="<?php echo "../PrePages/".$details['CertificateLink']; ?>" download alt="Certificate" style="max-width:100%;">Download</a>
                        </p>
                    </li>
                <?php }?>
            </ul>
        </div>

        <div class="technician-bio">
            <h1>Bio</h1>
            <div class="bio-div">
                <?php
                    echo $_SESSION['technicians'][$techUserName]['Bio'];
                ?>
            </div>
        </div>

        <button id="request-btn" onclick="requestJob('<?php echo $techUserName ?>')">Request a job</button>
    </div>
</div>

<!-- <?php require('../template/footer.php');?> -->

    <script src="technicianInfo.js"></script>
</body>
</html>