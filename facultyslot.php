<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: index2.php");
    exit();
}
$email = $_SESSION['email'];

include("connect.php");
$slots = [];
$sql = "SELECT slot FROM fslot WHERE facultyemailid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $slots[] = $row['slot'];
}
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Web Page</title>
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
            max-width: 400px;
            margin: 83px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }

        .input-container {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"], select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        #output {
            margin-top: 20px;
            font-weight: bold;
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
        <h1> <img src="img/vit-logo.png" alt="VIT Logo" class="header-logo"> Vellore Institute Of Technology</h1>
    </header>
    <div class="container">
        <div class="input-container">
            <label for="date">Date</label>
            <input type="text" id="date" name="date" readonly>
        </div>
        <div class="input-container">
            <label for="time">Time</label>
            <input type="text" id="time" name="time" readonly>
        </div>
        <div class="input-container">
            <label for="output">Slot Name</label>
            <select id="output" name="output">
                <?php foreach ($slots as $slot): ?>
                    <option value="<?php echo htmlspecialchars($slot); ?>"><?php echo htmlspecialchars($slot); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="input-container">
            <label for="email">Email</label>
            <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" readonly>
        </div>
    </div>

    <script>
        window.onload = function () {
            var currentDate = new Date();
            var dateField = document.getElementById("date");
            var timeField = document.getElementById("time");

            var formattedDate = currentDate.toISOString().split('T')[0];
            dateField.value = formattedDate;

            var formattedTime = currentDate.toLocaleTimeString();
            timeField.value = formattedTime;
        };
    </script>
    <footer>
        <p>&copy; 2023 Software Development Cell, VIT, Chennai-600 127. All rights reserved.</p>
    </footer>
</body>
</html>