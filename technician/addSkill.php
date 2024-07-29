<?php 
    require('checkCredentials.php');

    $pkError = "";

    $skillTitle = $_POST["skillTitle"];
    $exp = $_POST["experience"];
    $rating = 0;
    $ratedBy = 0;

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
            // Get file details
            $fileName = $_FILES['file']['name'];
            $fileTmpName = $_FILES['file']['tmp_name'];
            $fileSize = $_FILES['file']['size'];
            $fileType = $_FILES['file']['type'];
            $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
        
            // Validate file type (PDF only)
            if ($fileExtension !== 'pdf') {
                die("Only PDF files are allowed.");
            }
        
            // Generate a unique filename
            $uniqueFileName = $username . "_".$skillTitle."_Certificate.pdf";
        
            // Define upload directory and path
            $uploadDir = "../PrePages/TechnicianCertificates/";
            $uploadPath = $uploadDir . $uniqueFileName;
        
            // Check if the upload directory exists, if not create it
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
        
            // Move the uploaded file
            if (move_uploaded_file($fileTmpName, $uploadPath)) {
                // Use prepared statements to avoid SQL injection
                $checkQuery = "select * from technician_skill where TechUserName = '$username' and SkillTitle = '$skillTitle'";
                $checkResult = $conn -> query($checkQuery);
                if ($checkResult -> num_rows > 0){
                    $pkError = "Skill already exists.";
                }
                else{
                    $sql = "Insert into technician_skill Values(?, ?, ?, ?, ?, ?)";
                    $stmt = $conn->prepare($sql);
                    if ($stmt) {
                        $proPicPath = "TechnicianCertificates/" . $uniqueFileName;
                        $stmt->bind_param("ssidis", $username, $skillTitle, $exp, $rating, $ratedBy, $proPicPath);
                        $stmt->execute();
                        $stmt->close();
                        
                        header('Location: home.php');
                        exit;
                        
                    } else {
                        echo "Error preparing SQL statement: " . $conn->error;
                    }
                }
            } else {
                echo "Error moving uploaded file.";
            }
        } else {
            echo "File upload error: " . $_FILES['file']['error'];
        }
        
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Skill</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        #central{
        display: flex;
        background-color: #ffffff;
        position : relative;
        top : 190px;
        left : 0;
        width: 100%;
        height : 400px;
        justify-content: center;
    }
        .input-box{
            width : 70%;
            margin-bottom: 20px;
            border-radius: 5px;
            height : 50px;
            outline: none;
            border: none;
            background-color: #dcf1f8;
        }
        #addSkill{
            height : 30px;
            width : 100px;
            margin-top: 30px;
            background-color: #dcf1f8;
            border: none;
            cursor: pointer;
        }
        .errors{
            color : red;
        }

    </style>
</head>
<body>
    <?php require('../template/headerNoSearch.php'); ?>
    <div id="central">
        <form action="addSkill.php" method="post" enctype="multipart/form-data">
            <div>
                <div class="skill-list">
                <select required class="input-box" type="text" id="technician-skills" name="skillTitle" placeholder="Skills" value="<?php echo isset($_POST['custFirstName']) ? htmlspecialchars($_POST['custFirstName']) : ""; ?>">
                    <option <?php echo isset($_POST['techSkills']) && ($_POST['techSkills'] == '') ? 'selected' : '' ?> value="" disabled selected>Select Skills</option>
                    <option <?php echo isset($_POST['techSkills']) && ($_POST['techSkills'] == 'Carpentry') ? 'selected' : '' ?> value="Carpentry">Carpentry</option>
                    <option <?php echo isset($_POST['techSkills']) && ($_POST['techSkills'] == 'Plumbing') ? 'selected' : '' ?> value="Plumbing">Plumbing</option>
                    <option <?php echo isset($_POST['techSkills']) && ($_POST['techSkills'] == 'Electrical') ? 'selected' : '' ?> value="Electrical">Electrical</option>
                    <option <?php echo isset($_POST['techSkills']) && ($_POST['techSkills'] == 'HVAC') ? 'selected' : '' ?> value="HVAC">HVAC</option>
                    <option <?php echo isset($_POST['techSkills']) && ($_POST['techSkills'] == 'Painting') ? 'selected' : '' ?> value="Painting">Painting</option>
                    <option <?php echo isset($_POST['techSkills']) && ($_POST['techSkills'] == 'Dish Network') ? 'selected' : '' ?> value="Dish Network">Dish Network</option>
                    <option <?php echo isset($_POST['techSkills']) && ($_POST['techSkills'] == 'Masonry') ? 'selected' : '' ?> value="Masonry">Masonry</option>
                    <option <?php echo isset($_POST['techSkills']) && ($_POST['techSkills'] == 'Cementing') ? 'selected' : '' ?> value="Cementing">Cementing</option>
                    <option <?php echo isset($_POST['techSkills']) && ($_POST['techSkills'] == 'Pest Control') ? 'selected' : '' ?> value="Pest Control">Pest Control</option>
                </select>
                </div>
                <p class="errors"><?php echo $pkError ?></p>
            </div>
            <div>
                <input class="input-box" type="number" id="technician-experience" name="experience" placeholder="Experience in years" required value="<?php echo isset($_POST['techExperience']) ? htmlspecialchars($_POST['techExperience']) : ""; ?>" />
            </div>
            <div class="file-box">
                <div class="certificate">
                <label for="technician-certificate">Upload Education Certificate (PDF)</label>
                <?php echo $username; ?>
                <input type="file" id="technician-certificate" name="file" accept="application/pdf" required />
                </div>
            </div>
            
            <button type="submit" id="addSkill" name="technicianSubmitButton">Add Skill</button>

        </form>
    </div>
</body>
</html>