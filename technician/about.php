<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - TradeMaster</title>
    <link rel="icon" href="./images/TMIcon.png">
    <link rel="stylesheet" href="about.css">
    <style>
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, Helvetica, sans-serif;
}

body {
    display: flex;
    flex-direction: column;
    align-items: center;
    background-color: #fff;
}

.about-container {
    max-width: 800px;
    padding: 20px;
    margin: 100px auto 0;
    margin-top: 120px;
    background: #dcf1f8;
    border: 2px solid rgba(255, 255, 255, 2);
    box-shadow: 0 0 10px rgba(0, 0, 0, .2);
    color: #14213d;
    border-radius: 10px;
}

.about-container h1 {
    font-size: 36px;
    text-align: center;
    margin-bottom: 20px;
}

.about-container h2 {
    font-size: 24px;
    margin-top: 20px;
    margin-bottom: 10px;
}

.about-container p {
    font-size: 16px;
    margin-bottom: 10px;
    line-height: 1.5;
}

.about-container ul {
    margin-left: 20px;
    margin-bottom: 20px;
}

.about-container ul li {
    font-size: 16px;
    margin-bottom: 10px;
    list-style-type: disc;
}

.about-container a {
    color: #007BFF;
    text-decoration: none;
}

.about-container a:hover {
    text-decoration: underline;
}

    </style>
</head>
<body>
    <?php
        require('../template/headerAbout.php');
    ?>

    <div class="about-container">
        <h1>About TradeMaster</h1>
        <p>Welcome to TradeMaster, your go-to platform for connecting homeowners with skilled technicians. We understand the frustration of finding reliable and skilled professionals to fix various issues around your home. That's why we created TradeMaster - to make the process easier and more efficient for you.</p>

        <h2>Our Mission</h2>
        <p>Our mission is to bridge the gap between homeowners and technicians by providing a user-friendly platform where you can find trusted professionals for any job, big or small. We aim to create a community where homeowners feel confident in the services they receive and technicians can showcase their skills and grow their businesses.</p>

        <h2>Why Choose Us?</h2>
        <ul>
            <li><strong>Reliable Technicians:</strong> We thoroughly vet all our technicians to ensure they have the necessary skills and experience.</li>
            <li><strong>Easy to Use:</strong> Our platform is designed to be user-friendly, making it easy for you to find the right technician for your needs.</li>
            <li><strong>Transparent Reviews:</strong> Read reviews from other homeowners to make informed decisions.</li>
            <li><strong>Secure Payments:</strong> We offer secure payment options to give you peace of mind.</li>
        </ul>

        <h2>Our Team</h2>
        <p>TradeMaster was founded by a group of professionals who saw the need for a reliable and efficient way to connect homeowners with technicians. Our team is dedicated to providing excellent service and continuous improvement of our platform.</p>

        <h2>Contact Us</h2>
        <p>If you have any questions or feedback, feel free to <a href="contact.php">contact us</a>. We are always here to help!</p>
    </div>

    <?php
    // require('../template/footer.php');
    ?>
</body>
</html>
