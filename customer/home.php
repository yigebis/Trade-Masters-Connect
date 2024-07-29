<?php
    require('checkCredentials.php');

    

    //array which associates skills with each technician data
    $tech_skills = [];

    $technicians = []; //associative array used to store the data from technicians table

    $condition1 = "1=1";
    $condition2 = "1=1";

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $names = explode(" ", $_POST["searchWord"]);
        $firstName = $names[0];
        $fatherName = $names[1];
        $grandFatherName = $names[2];

        $condition1 = "`First Name` = '$firstName' and `Father Name` = '$fatherName' and `Grand Father Name` = '$grandFatherName'";
    }
    
    $onlyUserName = "";

    $sql = "select * from technician where $condition1";
    $result = $conn -> query($sql);

    while ($row = $result -> fetch_assoc()){
        $technicians[$row['UserName']] = $row;
        $onlyUserName = $row['UserName'];
    }

    if (count($technicians) == 1){
        $condition2 = "TechUserName = '$onlyUserName'";
    }

    $sql = "select * from technician_skill where $condition2";
    $result = $conn -> query($sql);

    while ($row = $result -> fetch_assoc()){
        $tech_skills[$row['SkillTitle']][] = $row;

    }
 
    
    $_SESSION['technicians'] = $technicians;
    $_SESSION['techSkills'] = $tech_skills;

    
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Customer</title>
        <link rel="stylesheet" href="home.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    </head>
    <body>
        <!-- Hiding the json information -->
         <div style="display: none;">
            <?php include('jsonCreator.php'); ?>
         </div>
        <!-- Doing the header -->
        <header>
            <div id="logo-section">
                <img src="../images/TradeMaster-01.png">
            </div>
            <p><a href="home.php">Home</a></p>
            <p><a href="about.php">About Us</a></p>
            <form action="home.php" method="post">
                <div id="search-bar">
                    <input name="searchWord" id="search-input" type="text" placeholder="Search Technicians" autocomplete="off">
                    <button type="submit" name="search" id="search-btn">
                        <img id="search-icon" src="../images/Search Icon.png">
                    </button>
                </div>
                <div id="suggested-words">
                    <!-- <img src="../images/Search Icon.png"> -->
                </ul>
            </form>
                        
        </header>
        
        <div id="central">
            <?php
                require('customerNav.php');
            ?>

            <!-- The main contents -->
            <main>
                <!-- <legend>Plumbers</legend> -->
                
                <?php foreach ($tech_skills as $skill => $info){ ?>
                    <fieldset>
                        <legend><?php echo $skill //the skill title ?></legend>
                        <?php foreach($info as $row){ ?>
                            <div class="cards" onclick="viewTechnician('<?php echo $row['TechUserName'] ?>')" >
                                <div class="photo-container">
                                    <?php 
                                        $techUserName = $row['TechUserName'];
                                        $firstPath = "../PrePages/"
                                    ?>
                                    <img src="<?php echo $firstPath.$technicians[$techUserName]['Photo'] ?>" alt="tech-pic">
                                </div>
                                <div class="technician-info">
                                    
                                    <p class="technician-name">
                                        <?php 
                                            
                                            $firstName = $technicians[$techUserName]['First Name'];
                                            $fatherName = $technicians[$techUserName]['Father Name'];
                                            echo $firstName . " " . $fatherName;
                                        ?> 
                                    </p>

                                    <?php 
                                        $rating = $row['Rating'];
                                        $fulls = floor($rating);
                                        $portion = $rating - $fulls;
                                        $empty = 5 - ceil($rating);
                                    ?>
                                    <div class="rating">
                                    <span class="value">(<?php echo number_format($row["Rating"], 1) ?>)</span>
                                        <?php for($i = 0; $i < $fulls; $i++){?>                 
                                            <!-- <img src="../images/TradeMaster-01.png">                -->
                                            <!-- <img class="rating-images" src="../images/filled-rating.png"> -->
                                            <span class="fas fa-star full-star"></span>
                                        <?php } ?>

                                        <?php if ($portion > 0){?>
                                            <span class="fas fa-star-half-alt half-star"></span>
                                            <!-- <img class="rating-images" src="../images/half-filled-rating.png"> -->
                                        <?php } ?>

                                        <?php for($i = 0; $i < $empty; $i++){?>                 
                                            <!-- <img src="../images/TradeMaster-01.png">                -->
                                            <span class="fas fa-star empty-star"></span>
                                            <!-- <img class="rating-images" src="../images/unfilled-rating.png"> -->
                                        <?php } 
                                            
                                        ?>
                                    </div>

                                    <?php
                                        
                                    ?>
                                </div>
                            </div>
                        <?php }?>
                    </fieldset>
                <?php }?>
            </main>
        </div>

        <?php
            require('../template/footer.php');
        ?>

        <script src="home.js"></script>
    </body>
</html>
