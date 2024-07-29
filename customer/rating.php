<?php
    require('checkCredentials.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $techUserName = $_POST["techUserName"];
        $skillTitle = $_POST["skillTitle"];
        $date = $_POST["date"];
        $rating = $_POST["rating"];
        // echo $rating;
        // print_r($_POST);
        
        //Begining transaction
        $conn -> begin_transaction();

        try{
            $sql = "update requests set Rating = ? and date = ? where TechUserName = ? and `Skill Title` = ? and date = ? and CustUserName = ?";
            $stmt = $conn -> prepare($sql);
            $stmt -> bind_param("isssss", $rating, $date, $techUserName, $skillTitle, $date, $username);
            if ($stmt -> execute()){
                echo " Requests table!";
            }
            else{
                throw new Exception("Error updating requests table : " . $conn -> error);
            }

            $rating_query = "select Rating, RatedBy from technician_skill where TechUserName = '$techUserName' and SkillTitle = '$skillTitle'";
            $result = $conn -> query($rating_query);
            $row = $result -> fetch_assoc();
            
            $avgRating = $row["Rating"];
            $ratedBy = $row["RatedBy"];

            $totalRating = $avgRating * $ratedBy + $rating;
            
            $ratedBy += 1;
            $avgRating = $totalRating / $ratedBy;

            $sql = "update technician_skill set Rating = ?, RatedBy = ? where TechUserName = ? and SkillTitle = ?";
            $stmt = $conn -> prepare($sql);
            $stmt -> bind_param("diss", $avgRating, $ratedBy, $techUserName, $skillTitle);

            if ($stmt -> execute()){
                echo "technician_skill";
            }
            else{
                throw new Exception("Error updating table technician_skill " . $conn -> error);
            }

            $conn -> commit();

        }
        catch(Exception $e){
            echo "Transaction rollled back : " . $e -> getMessage() . "\n";
            $conn -> rollback();
        }
        
        header('Location: home.php');
        exit;
    }
    else{
        if (!isset($_GET["techUserName"]) || !isset($_GET["skillTitle"]) || !isset($_GET["date"])){
            header("Location: accepted.php");
            exit;
        }
        $techUserName = $_GET["techUserName"];
        $skillTitle = $_GET["skillTitle"];
        $date = $_GET["date"];

        $sql = "select `First Name`, `Father Name` from technician where UserName = '$techUserName'";
        $result = $conn -> query($sql);
        $row = $result -> fetch_assoc();

        $firstName = $row["First Name"];
        $fatherName = $row["Father Name"];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Star Rating</title>
    <link rel="stylesheet" href="rating.css">
</head>
<body>
    <h1>Rate <?php echo $firstName . " " . $fatherName . " for his performance as a " . $skillTitle ?></h1>
    <form id="ratingForm" method="post" action="rating.php">
        <div class="star-rating">
            <span class="star" data-value="1">&#9734;</span>
            <span class="star" data-value="2">&#9734;</span>
            <span class="star" data-value="3">&#9734;</span>
            <span class="star" data-value="4">&#9734;</span>
            <span class="star" data-value="5">&#9734;</span>
        </div>
        <input type="hidden" name="rating" id="ratingValue" value="0">
        <input type="hidden" name="techUserName" value="<?php echo $techUserName ?>">
        <input type="hidden" name="skillTitle" value="<?php echo $skillTitle ?>">
        <input type="hidden" name="date" value="<?php echo $date ?>">
        <button type="submit">Rate</button>
    </form>

    <script src="rating.js"></script>
</body>
</html>
