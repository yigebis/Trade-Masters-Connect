<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="../template/header.css"> -->
    <style>
        header {
            position: fixed;
            left: 0;
            top: 0;
            z-index: 2;
            background-color: #eaf0fc;
            padding: 50px;
            width: 100%;
            height: 20px;
            display: flex;
            justify-content:space-between;
             

        }
                
        .links{
            display: flex;
            margin-left: -100px;
            gap:30px;
        }

        #logo-section {
            margin-top: -30px;
            margin-left: -40px;
            width: 400px;
            height: 80px;
            /* background-color: royalblue; */
        }

        #logo-section img {
            width: 100%;
            height: 100%;

            /* height : 50%; */
        }

        header a {
            text-decoration: none;
            cursor: pointer;
            color: black;
        }

        header p {
            align-items: center;
        }

        header p:hover {
            color: #14213d;
            text-shadow: -1px 2px 2px #14213d;
        }
    </style>
</head>

<body>
    <header>
        <div id="logo-section">
            <img src="../images/TradeMaster-01.png">
        </div>
        <div class="links">

            <p><a href="home.php">Home</a></p>
            <p><a style="margin-right: 100px;" href="about.php">About Us</a></p>
        </div>
    </header>
</body>

</html>