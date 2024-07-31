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
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            background-color: #007acc;
            padding: 3px 0;
            color: #fff;
            text-align: center;
            width: 100%;
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
            margin: 105px auto;
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
            display: flex;
            align-items: center;
            transition: background-color 0.3s ease-in-out;
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
            padding: 10px 0;
            position: relative;
            width: 100%;
            margin-top: auto;
        }
    </style>
</head>
<body>
    <header>
        <h1> <img src="img/vit-logo.png" alt="VIT Logo" class="header-logo"> Vellore Institute Of Technology</h1>
    </header>
    <div class="container">
        <div class="button-container">
            <a href="index1.php" class="button">
                <img src="img/student.png" alt="Student" class="button-icon">
                <span class="button-text">Student</span>
            </a>
            <a href="index2.php" class="button">
                <img src="img/faculty.png" alt="Faculty" class="button-icon">
                <span class="button-text">Faculty</span>
            </a>
        </div>
        <div class="content">
        </div>
    </div>
    <footer>
        <p>&copy; 2023 Software Development Cell, VIT, Chennai-600 127. All rights reserved.</p>
    </footer>
</body>
</html>