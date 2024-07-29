<?php
session_start();
require("UpdateProfileCode.php");
require("../configDB/configDatabase.php");

$oldUsername = $result['UserName'];
$custCredSql = "SELECT * FROM technician_credentials where UserName = '$username';";
$credResult = mysqli_query($conn, $custCredSql);
$credResult = mysqli_fetch_assoc($credResult);


$errors = array('password' => '', 'passwordsDontMatch' => '', 'samePassword' => '');

if (isset($_POST['submit'])) {
  $passed = true;
  if ($_POST['password'] !== "" || $_POST['NewPassword'] !== "" || $_POST['confirmPassword'] !== "") {
    // check if old password is correct;
    $password = $_POST['password'];
    $newPassword = $_POST['NewPassword'];
    $conPassword = $_POST['confirmPassword'];
    // echo "inside this";

    if (password_verify($password, $credResult['PassHash'])) { // passwords match

      if ($newPassword != $conPassword) {
        // passwords dont match!
        $passed = false;
        $errors['passwordsDontMatch'] = "Passwords Don't Match!";
      } else if (password_verify($newPassword, $credResult['PassHash'])) {
        $passed = false;
        $errors['samePassword'] = "Password same as old password!";
      } else {
        $passhash = password_hash($newPassword, PASSWORD_DEFAULT);

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
    $newUsername = htmlspecialchars($_POST['username']);
    $phone = htmlspecialchars($_POST['phoneNumber']);

    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {

      // Get file details
      $fileName = $_FILES['file']['name'];  // Original filename
      $fileTmpName = $_FILES['file']['tmp_name'];
      $fileSize = $_FILES['file']['size'];
      $fileType = $_FILES['file']['type'];

      // Generate a unique filename with extension
      $uniqueFileName = $newUsername . "_ProfilePic" . '.' . pathinfo($fileName, PATHINFO_EXTENSION);

      // Define upload directory with subfolder
      $uploadDir = "TechnicianProfilePics/" . $uniqueFileName;
      unlink($photoLink);
      move_uploaded_file($fileTmpName, "../PrePages/" . $uploadDir);
      $sql = "UPDATE technician SET Photo = '$uploadDir' where UserName = '$oldUsername';";
      mysqli_query($conn, $sql);
    }


    $techSql = "UPDATE technician 
    SET UserName = '$newUsername', `First Name` = '$fname', `Father Name` = '$mname', `Grand Father Name` = '$lname', `Phone Number` = '$phone'
    WHERE UserName = '$oldUsername';";

    // $sql = "UPDATE technician_credentials SET UserName = '$newUsername' WHERE UserName = '$oldUsername';";

    if (mysqli_query($conn, $techSql)) {
      header('Location: technicianPP.php'); // redirect to technician home page
    } else {
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

  <form class="technician-form-container" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
    <div class="Technician-container">
      <div class="profile">

        <img src="<?php echo $photoLink; ?>" alt="profilePIc" id="image">

        <div class="rightRound" id="upload">
          <input type="file" name="file" id="fileImg" accept=".jpg, .jpeg, .png">
          <i class="fa fa-camera"></i>
        </div>
        <div class="leftRound" id="cancel" style="display: none;">
          <i class="fa fa-times"></i>
        </div>
        <div class="rightRound" id="confirm" style="display: none;">
          <input type="submit" name="" value="">
          <i class="fa fa-check"></i>
        </div>
        <div class="paragraph">
          <p id="Technician_UserName"><?php echo $result['First Name'] . $result['Grand Father Name']; ?></p>
          <br>
        </div>

      </div>

      <div class="technician-form">
        <div class="add-form">
          <div class="input-box">
            <label for="firstName">First Name</label>
            <input type="text" name="firstName" value="<?php echo isset($_POST['firstName']) ? htmlspecialchars($_POST['firstName']) : htmlspecialchars($result['First Name']); ?>" />
            <i class='bx bxs-phone'></i>
          </div>
          <div class="input-box">
            <label for="middleName">Middle Name</label>
            <input type="text" name="middleName" value="<?php echo isset($_POST['middleName']) ? htmlspecialchars($_POST['middleName']) : htmlspecialchars($result['Father Name']); ?>" />
            <i class='bx bxs-phone'></i>
          </div>
          <div class="input-box">
            <label for="lastName">Last Name</label>
            <input type="text" name="lastName" value="<?php echo isset($_POST['lastName']) ? htmlspecialchars($_POST['lastName']) : htmlspecialchars($result['Grand Father Name']); ?>" />
            <i class='bx bxs-phone'></i>
          </div>
          <div class="input-box">
            <label for="username">Username</label>
            <input type="text" name="username" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : htmlspecialchars($result['UserName']); ?>" />
            <i class='bx bxs-phone'></i>
          </div>
          <div class="input-box">
            <label for="change_phoneNumber">Phone Number</label>
            <input type="tel" id="change_phoneNumber" name="phoneNumber" value="<?php echo isset($_POST['phoneNumber']) ? htmlspecialchars($_POST['phoneNumber']) : htmlspecialchars($result['Phone Number']); ?>" />
            <i class='bx bxs-phone'></i>
          </div>
          <div class="change_password">
            <button type="button" id="toggle-password-fields">Change Password</button>

            <div class="modify-pass">
              <div class="input-box password-field">
                <label class="errors">
                  <?php echo $errors['password']; ?>
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

  </form>

  </div>

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
<!-- this is for if the person click the rightRound submit button it will be automatically stored in the database -->
<!-- <?php
      if (isset($_FILES["fileImg"]["name"])) {
        $id = $_POST["id"];
        $src = $_FILES["fileImg"]["tmp_name"];
        $imageName = uniqid() . $_FILES["fileImg"]["name"];
        $target = "img/" . $imageName;

        move_uploaded_file($src, $target);

        $query = "UPDATE tb_user SET image = '$imageName' WHERE id = $id";
        mysqli_query($conn, $query);

        header("Location: index.php");
      }
      ?> -->