<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="icon" href="./images/TMIcon.png">
    <style>
        .footer {
            display: flex;
            justify-content: space-between;
            background-color: #edf6f9;
            /* margin-top: 50px; */
            align-items: center;
            height: 120px;
            /* margin-bottom: 20px; */
            position: relative;
            width: 100%;
            bottom: -220px;
        }
        
        .footer h3 {
            opacity: 0.5;
        }
        
        .backToTop img {
            margin-left: 150px;
            margin-top: -2000px;
            width: 25px;
        }
        
        .contact {
            margin-right: 40px;
        }
        
        .contact h2 {
            margin-bottom: 5px;
            justify-content: center;
        }
        
        .icon {
            display: flex;
            justify-content: space-between;
            gap: 15px;
        }
        
        .icon img {
            width: 25px;
        }
        
        #footerlogo {
            padding: 20px 0 20px 50px;
        }
        
        #verticalbar {
            background-color: #f8b418;
            width: 1px;
            height: 100px;
            padding: 5px;
            margin-left: -300px;
        }
        
        .copyRight {
            margin-top: 25px;
        }
        
    </style>
</head>
<body> 
  <section>
        <div class="footer">
            <div id="footerlogo">
                <h2>TradeMaster <br>CONNECT</h2>
            </div>
            <div id="verticalbar"></div>
            <div class="copyRight">
                <h3>Copyright © 2024 TMC. All rights reserved.</h3>
            </div>
            <div class="contact">
                <div class="backToTop">
                    <a href="home.html"><img src="../PrePages/images/up.png" alt="BackToHome"></a>
                </div>
                <div>
                    <h2>Follow Us</h2>
                </div>
                <div class="icon">
                    <div>
                        <a href="https://www.instagram.com/" target="_blank"><img src="../PrePages/images/instagram.png" alt=""></a>
                    </div>
                    <div>
                        <a href="https://www.linkedin.com/" target="_blank"><img src="../PrePages/images/linkedin.png" alt=""></a>
                    </div>
                    <div>
                        <a href="https://www.facebook.com/" target="_blank"><img src="../PrePages/images/facebook.png" alt=""></a>
                    </div>
                    <div>
                        <a href="https://twitter.com/home" target="_blank"><img src="../PrePages/images/x.png" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
</section>
</body>
</html>