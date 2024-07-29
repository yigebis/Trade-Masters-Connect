<?php
require("checkCredentials.php");
require("UpdateProfileCode.php");

$oldUsername = $techStatusRow['UserName'];
$credSql = "SELECT * FROM technician_credentials where UserName = '$username';";
$credResult = $conn -> query($credSql);
$credRow = $credResult -> fetch_assoc();

$errors = array('password' => '', 'passwordsDontMatch' => '', 'samePassword' => '');

if (isset($_POST['submit'])) {
  // "<script>document.querySelector('.change_password').style.display = 'block'</script>";
  $passed = true;
  if ($_POST['password'] !== "" || $_POST['NewPassword'] !== "" || $_POST['confirmPassword'] !== "") {
    // check if old password is correct;
    $password = $_POST['password'];
    $newPassword = $_POST['NewPassword'];
    $conPassword = $_POST['confirmPassword'];
    // echo "inside this";

    if (password_verify($password, $credRow['PassHash'])) { // passwords match

      if ($newPassword != $conPassword) {
        // passwords dont match!
        $passed = false;
        $errors['passwordsDontMatch'] = "Passwords Don't Match!";
      } else if (password_verify($newPassword, $credRow['PassHash'])) {
        $passed = false;
        $errors['samePassword'] = "Password same as old password!";
      } else {
        $passhash = password_hash($newPassword, PASSWORD_BCRYPT);

        $sql = "UPDATE technician_credentials SET PassHash = '$passhash' WHERE UserName = '$oldUsername';";
        mysqli_query($conn, $sql);
        echo "Updated password!!";
      }
    } else {
      $passed = false;
      $errors['password'] = "Incorrect Password";
    }
  }

  // echo "outside";
  if ($passed === true) {
    // echo "inside";
    $fname = htmlspecialchars($_POST['firstName']);
    $mname = htmlspecialchars($_POST['middleName']);
    $lname = htmlspecialchars($_POST['lastName']);
    $phone = htmlspecialchars($_POST['phoneNumber']);

    // $sql = "UPDATE technician_credentials SET UserName = '$newUsername' WHERE UserName = '$oldUsername';";

if (isset($_FILES['fileImg']) && $_FILES['fileImg']['error'] === UPLOAD_ERR_OK) {
    // Get file details
    $fileName = $_FILES['fileImg']['name'];  // Original filename
    $fileTmpName = $_FILES['fileImg']['tmp_name'];
    $fileSize = $_FILES['fileImg']['size'];
    $fileType = $_FILES['fileImg']['type'];

    // Generate a unique filename with extension
    $uniqueFileName = $oldUsername . "_ProfilePic" . '.' . pathinfo($fileName, PATHINFO_EXTENSION);

    // Define upload directory with subfolder
    $uploadDir = "TechnicianProfilePics/";
    $uploadPath = "../PrePages/" . $uploadDir . $uniqueFileName;

    // Check if the upload directory exists, if not create it
    if (!is_dir("../PrePages/" . $uploadDir)) {
        mkdir("../PrePages/" . $uploadDir, 0777, true);
    }

    // Remove the old profile picture if it exists
    if (file_exists($photoLink)) {
        unlink($photoLink);
    }

    // Move the uploaded file
    if (move_uploaded_file($fileTmpName, $uploadPath)) {
        // Use prepared statements to avoid SQL injection
        $sql = "UPDATE technician SET Photo = ? WHERE UserName = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            $proPicPath = $uploadDir . $uniqueFileName;
            mysqli_stmt_bind_param($stmt, "ss", $proPicPath , $oldUsername);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            
            header('Location: home.php');
        } else {
            echo "Error preparing SQL statement: " . mysqli_error($conn);
        }
    } else {
        echo "Error moving uploaded file.";
    }
} else {
    print_r($_FILES);
    // echo "File upload error: " . $_FILES['file']['error'];
}


    $techSql = "UPDATE technician 
    SET `First Name` = '$fname', `Father Name` = '$mname', `Grand Father Name` = '$lname', `Phone Number` = '$phone'
    WHERE UserName = '$oldUsername';";

    if(mysqli_query($conn, $techSql)){
      // header('Location: technicianPP.php'); // redirect to technician home page
      // echo "dnjsa";
    } else{
      echo 'query error ' . mysqli_error($conn);
    }
    
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TradeMaster</title>
  <link rel="icon" href="./images/TMIcon.png">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="technicianUPP.css">
</head>

<body>
  <form method="post" action="technicianUPP.php" enctype="multipart/form-data">
    <div class="Technician-container">
      <div class="profile">

        <img src="<?php echo $photoLink; ?>" alt="profilePic" id="image">

        <div class="rightRound" id="upload">
          <input type="file" name="fileImg" id="fileImg" accept="image/jpg, image/jpeg, image/png">
          <i class="fa fa-camera"></i>
        </div>
        <div class="leftRound" id="cancel" style="display: none;">
          <i class="fa fa-times"></i>
        </div>
        <div class="rightRound" id="confirm" style="display: none;">
          <input type="submit" name="submit" value="">
          <i class="fa fa-check"></i>
        </div>
        <div class="paragraph">
          <p id="Technician_UserName"><?php echo $techStatusRow['First Name'] . " " . $techStatusRow['Father Name'] . " " . $techStatusRow['Grand Father Name']; ?></p>
          <br>
          <p id="Technician_skills">
                <?php while($skillRow = $skillResult -> fetch_assoc()){
                    echo "|" . $skillRow['SkillTitle'] . "|";
                }?>
          </p>
        </div>

      </div>
      <div class="technician-form-container">
        <div class="technician-form">
          <div class="add-form">
            <div class="input-box">
              <label for="firstName">First Name</label>
              <input type="text" name="firstName" value="<?php echo isset($_POST['firstName']) ? htmlspecialchars($_POST['firstName']) : htmlspecialchars($techStatusRow['First Name']); ?>" />
              <i class='bx bxs-phone'></i>
            </div>
            <div class="input-box">
              <label for="middleName">Father Name</label>
              <input type="text" name="middleName" value="<?php echo isset($_POST['middleName']) ? htmlspecialchars($_POST['middleName']) : htmlspecialchars($techStatusRow['Father Name']); ?>" />
              <i class='bx bxs-phone'></i>
            </div>
            <div class="input-box">
              <label for="lastName">Grand Father Name</label>
              <input type="text" name="lastName" value="<?php echo isset($_POST['lastName']) ? htmlspecialchars($_POST['lastName']) : htmlspecialchars($techStatusRow['Grand Father Name']); ?>" />
              <i class='bx bxs-phone'></i>
            </div>
            <div class="input-box">
              <label for="change_phoneNumber">Phone Number</label>
              <input type="tel" id="change_phoneNumber" name="phoneNumber" value="<?php echo isset($_POST['phoneNumber']) ? htmlspecialchars($_POST['phoneNumber']) : htmlspecialchars($techStatusRow['Phone Number']); ?>" />
              <i class='bx bxs-phone'></i>
            </div>
            <div class="change_password">
              <button type="button" id="toggle-password-fields">Change Password</button>

              <div class="modify-pass" style="display: <?php if ($_SERVER["REQUEST_METHOD"] == "POST") echo "block"; else echo "none"; ?>;">
                <div class="input-box password-field">
                  <label class="errors">
                    <?php echo $errors['password'] ?>
                  </label>
                  <input type="password" id="tecnician-old-password" name="password" placeholder="Old Password" />
                  <i class='bx bxs-lock-alt'></i>
                </div>
                <div class="input-box password-field">
                  <label class="errors">
                    <?php
                    echo $errors['passwordsDontMatch'];
                    echo $errors['samePassword'];
                    ?>
                  </label>
                  <input type="password" id="tecnician-new-password" name="NewPassword" placeholder="New Password" />
                  <i class='bx bxs-lock-alt'></i>
                </div>
                <div class="input-box password-field">

                  <input type="password" id="tecnician-confirm-password" name="confirmPassword" placeholder="Confirm Password" />
                  <i class='bx bxs-lock-alt'></i>
                </div>
              </div>
            </div>
            <div class="button">
              <button type="submit" id="technician_update" name="submit">Save</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>

  <script>
    document.getElementById("fileImg").onchange = function() {
      document.getElementById("image").src = URL.createObjectURL(fileImg.files[0]); // Preview new image
      document.getElementById("cancel").style.display = "block";
      document.getElementById("confirm").style.display = "block";
      document.getElementById("upload").style.display = "none";
    };

    var userImage = document.getElementById('image').src;

    document.getElementById("cancel").onclick = function() {
      document.getElementById("image").src = userImage; // Back to previous image
      document.getElementById("cancel").style.display = "none";
      document.getElementById("confirm").style.display = "none";
      document.getElementById("upload").style.display = "block";
    };
    document.getElementById('toggle-password-fields').addEventListener('click', function() {
      let passwordFields = document.getElementsByClassName('modify-pass');
      if (passwordFields[0].style.display == 'none') {
        passwordFields[0].style.display = 'block';
      } else {
        passwordFields[0].style.display = 'none';
      }
    });
  </script>

</body>

</html>
