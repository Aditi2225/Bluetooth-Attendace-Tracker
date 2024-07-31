<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: index2.php");
    exit();
}
$email = $_SESSION['email'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VIT Choices</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #d7e8f0;
        }

        header {
            background-color: #007acc;
            padding: 3px 0;
            color: #fff;
            text-align: center;
        }

        .header-logo {
            width: 80px;
            height: auto;
            margin-right: 10px;
        }

        header h1 {
            font-size: 36px;
            margin: 0;
        }

        .container {
            max-width: 800px;
            margin: 25px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .button-container {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-top: 20px;
        }

        .button {
            background-color: #b4e8ed;
            color: #0b0909;
            padding: 15px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 18px;
            text-align: center;
            text-decoration: none;
            display: block;
            transition: background-color 0.3s ease-in-out;
            display: flex;
            align-items: center;
        }

        .button:hover {
            background-color: #90a8da;
        }

        .button-icon {
            width: 30px;
            height: 30px;
            margin-right: 10px;
        }

        .button-text {
            flex-grow: 1;
        }

        .content {
            margin-top: 30px;
            text-align: left;
        }

        .content p {
            font-size: 16px;
            line-height: 1.5;
            margin-bottom: 15px;
        }

        footer {
            background-color: #007acc;
            color: #fff;
            text-align: center;
            padding: 0px 0;
            position: absolute;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <h1><img src="img/vit-logo.png" alt="VIT Logo" class="header-logo"> Vellore Institute Of Technology</h1>
    </header>
    <div class="container">
        <div class="button-container">
            <a href="facultyslot.php" class="button">
                <img src="img/attendance-icon.png" alt="Attendance" class="button-icon">
                <span class="button-text">Take Attendance</span>
            </a>
            <a href="#" class="button">
                <img src="img/datasheet-icon.jpeg" alt="Data Sheet" class="button-icon">
                <span class="button-text">View Data Sheet</span>
            </a>
            <a href="#" class="button">
                <img src="img/live-data-icon.png" alt="Live Data" class="button-icon">
                <span class="button-text">View Live Data</span>
            </a>
            <a href="#" class="button">
                <img src="img/proxy-icon.png" alt="Proxy Detection" class="button-icon">
                <span class="button-text">Proxy Detection</span>
            </a>
        </div>
    </div>
    <footer>
        <p>&copy; 2023 Software Development Cell, VIT, Chennai-600 127. All rights reserved.</p>
    </footer>
</body>
</html>