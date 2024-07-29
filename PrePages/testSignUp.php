<?php
    // $serverName = "localhost";
    // $userName = "root";
    // $password = "";
    // $dbName = "trade masters connect";

    // $conn = new mysqli($serverName, $userName, $password, $dbName);
    // if ($conn) echo "success";
?>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $phone = $_POST["phone"];
        function validateEthiopianPhoneNumber($phone) { 
            // Regular expression for valid Ethiopian phone numbers 
            $pattern = '/^(?:\+251)?(?:9|09)[0-9]{8}$/'; 
           
            // Validate the phone number using preg_match 
            return preg_match($pattern, $phone); 
          } 
           
          // Validate the phone number 
          if (validateEthiopianPhoneNumber($phone)) { 
            echo "Valid Ethiopian phone number."; 
            // ... (further processing if phone number is valid) 
          } else { 
            echo "Invalid phone number. Please enter a valid Ethiopian phone number starting with +2519 or 09 followed by 8 digits."; 
          } 
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" action="testsignup.php">
        <input name="phone" type="tel" placeholder="date">
        <input name="password" type="password" placeholder="Password">
        <input type="submit" name="submit" value="Submit">
    </form>
    
</body>
</html>