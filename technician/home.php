<?php

    require('checkCredentials.php');
    
    $techSql = "SELECT * FROM technician WHERE UserName = '$username'";
    $techResult = $conn->query($techSql);
 
    if ($techResult->num_rows > 0) {
        $technician = $techResult->fetch_assoc();

        // Fetch skills associated with the technician
        $techSkills = [];
        $sqlSkills = "SELECT * FROM technician_skill WHERE TechUserName = '$username'";
        $resultSkills = $conn->query($sqlSkills);

        while ($row = $resultSkills->fetch_assoc()) {
            $techSkills[] = [$row['SkillTitle'], $row['Rating'], $row['RatedBy'], $row["Experience"]];
        }

    // Fetch ratings associated with the technician
    }
    else {
        echo "Technician data not found.";
    }
    
?>  


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Techinician</title>
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>
    <?php
        require('../template/headerNoSearch.php');
    ?>

    <div id="central">
        <?php
            require('technicianNav.php');
        ?>
        <main>
            <h1>Welcome, <?php echo $technician['First Name']; ?></h1>

            <section>
                <h2>My Skills</h2>
                <ul>
                    <?php foreach ($techSkills as $skill) { ?>
                        <li>
                            <?php echo $skill[0] . ":    " . $skill[3] . " years of experience"; ?>
                            <?php     
                                $rating = $skill[1];
                                $fulls = floor($rating);
                                $portion = $rating - $fulls;
                                $empty = 5 - ceil($rating);
                            ?>
                            <div class="rating">
                            <span class="value">(<?php echo number_format($rating, 1) ?>)</span>
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
                             
                            <?php echo "Rated by " . $skill[2] . " people"; ?>
                        </li>
                    <?php } ?>
                </ul>
            </section>

            <section id="addSkill" onclick="addSkill()">
                <button id="plus-btn">+</button> 
                <span>Add New Skill</span>
            </section>
        </main>
    </div>
    

    <?php
        require('../template/footer.php');
    ?>
    <script>
        function addSkill(){
            window.location.href = "addSkill.php";
        }
    </script>
</body>
</html>