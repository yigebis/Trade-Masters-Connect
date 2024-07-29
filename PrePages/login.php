<?php
    $serverName = "localhost";
    $userName = "root";
    $password = "";
    $dbName = "trade masters connect";

    $conn = new mysqli($serverName, $userName, $password, $dbName);
    // if ($conn) echo "success";
?>

<?php
    $username = "";
    $password = "";
    $error = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $role = $_POST['role'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        function logCustomer(){
            global $conn, $username, $password, $error;

            $sql = "select PassHash from customer_credentials where UserName = '$username'";
            $result = $conn -> query($sql);
            $row = $result -> fetch_assoc();

            if (!$row){
                $error = "Incorrect username or password";
            }
            else{
                $username = $row['username'];
                $hashed = $row['PassHash'];
                if (! password_verify($password, $hashed)){
                    $error = "Incorrect username or password";
                }
                else{
                    // $error = "Success";
                    session_start();
                    $cookie_name = "cust_session_id";
                    $session_id = session_create_id();
                    // echo $session_id;

                    $recordUserQuery = "insert into login_customer values (?, ?)";
                    $recordUserStmt = $conn -> prepare($recordUserQuery);
                    $recordUserStmt -> bind_param("ss", $session_id, $username);
                    $recordUserStmt -> execute();

                    setcookie($cookie_name, $session_id, time() + (86400 * 30), "/");
                    header('Location: ../customer/home.php');
                }
            }
        }

        function logTechnician(){
            global $conn, $username, $password, $error;

            $sql = "select PassHash from technician_credentials where UserName = '$username'";
            $result = $conn -> query($sql);
            $row = $result -> fetch_assoc();

            if (!$row){
                $error = "Incorrect username or password";
            }
            else{
                $hashed = $row['PassHash'];
                if (! password_verify($password, $hashed)){
                    $error = "Incorrect username or password";
                }
                else{
                    // $error = "Success";
                    session_start();
                    $cookie_name = "tech_session_id";
                    $session_id = session_create_id();
                    // echo $session_id;

                    $recordUserQuery = "insert into login_technician values (?, ?)";
                    $recordUserStmt = $conn -> prepare($recordUserQuery);
                    $recordUserStmt -> bind_param("ss", $session_id, $username);
                    $recordUserStmt -> execute();

                    setcookie($cookie_name, $session_id, time() + (86400 * 30), "/");
                    header('Location: ../technician/home.php');
                }
            }
        }
        
        if ($role == 'customer'){
            logCustomer();
        }
        else{
            logTechnician();
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
    <link rel="stylesheet" href="./login.css">
</head>

<body>
    <div class="wrapper">
        <form action="login.php" method="POST">
            <h1>Welcome to TradeMaster</h1>
            <h1>Login</h1>

            <div class="radio">
                <label>
                    <input type="radio" name="role" value="customer" required>Customer
                </label>
                <label>
                    <input type="radio" name="role" value="technician" required>Technician
                </label>
            </div>

            <div class="input-box">
                <input name="username" type="text" placeholder="Username" value="<?php echo htmlspecialchars($username) ?>" required>
            </div>
            <div class="input-box">
                <input name="password" type="password" id="password" placeholder="Password" value="<?php echo htmlspecialchars($password) ?>" required>

                <span class="toggle-password" onclick="togglePassword()">
                    <i id="eye-icon" class='bx bx-hide'></i>
                </span>
            </div>
            <div class="show-password">
                <label>
                    <input type="checkbox" id="show-password-checkbox" onclick="togglePassword()"> Show password
                </label>
                <!-- <a href="#">Forget password</a> -->
            </div>

            <div class="error-message">
                <?php echo $error; ?>
            </div>

            <button type="submit" class="btn">Login</button>

            <div class="info-text">
                <p>Don't have an account? <a href="signUp.php">Sign up here.</a></p>
                <p>By logging in, you agree to our <a href="privacy.html">privacy statement.</a></p>
            </div>
        </form>
    </div>

    <script>
        function togglePassword() {
            const passwordField = document.getElementById("password");
            const showPasswordCheckbox = document.getElementById("show-password-checkbox");
            const eyeIcon = document.getElementById("eye-icon");

            if (showPasswordCheckbox.checked) {
                passwordField.type = "text";
                eyeIcon.classList.remove("bx-hide");
                eyeIcon.classList.add("bx-show");
                showPasswordCheckbox.nextSibling.textContent = " Hide password";
            } else {
                passwordField.type = "password";
                eyeIcon.classList.remove("bx-show");
                eyeIcon.classList.add("bx-hide");
                showPasswordCheckbox.nextSibling.textContent = " Show password";
            }
        }
    </script>
</body>

</html>