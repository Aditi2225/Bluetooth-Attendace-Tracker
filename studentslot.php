<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: index1.php");
    exit();
}
$email = $_SESSION['email'];

include("connect.php");
$slots = [];
$sql = "SELECT slot FROM sslot WHERE studentemailid = ?";
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
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            background-color: #007acc;
            padding: 10px 0;
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
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }

        .input-container {
            margin-bottom: 20px;
            text-align: left;
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

        button {
            background-color: #007acc;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 18px;
            display: block;
            width: 100%;
        }

        footer {
            background-color: #007acc; 
            color: #fff;
            text-align: center;
            padding: 10px 0;
            margin-top: auto;
        }
    </style>
</head>
<body>
    <header>
        <h1><img src="img/vit-logo.png" alt="VIT Logo" class="header-logo"> Vellore Institute Of Technology</h1>
    </header>
    <div class="container">
        <div class="input-container">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($_SESSION['firstName'] . ' ' . $_SESSION['lastName']); ?>" readonly>
        </div>
        <div class="input-container">
            <label for="date">Date</label>
            <input type="text" id="date" name="date" readonly>
        </div>
        <div class="input-container">
            <label for="time">Time</label>
            <input type="text" id="time" name="time" readonly>
        </div>
        <div class="input-container">
            <label for="slotname">Slot Name</label>
            <select id="slotname" name="slotname">
                <?php foreach ($slots as $slot): ?>
                    <option value="<?php echo htmlspecialchars($slot); ?>"><?php echo htmlspecialchars($slot); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="input-container">
            <label for="email">Email</label>
            <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" readonly>
        </div>
        <button id="verifyButton">Verify Device and Location</button>
    </div>

    <script>
        window.onload = function () {
            var currentDate = new Date();
            var dateField = document.getElementById("date");
            var timeField = document.getElementById("time");

            var formattedDate = currentDate.toISOString().split('T')[0];
            dateField.value = formattedDate;

            var hours = String(currentDate.getHours()).padStart(2, '0');
            var minutes = String(currentDate.getMinutes()).padStart(2, '0');
            var formattedTime = hours + ':' + minutes;
            timeField.value = formattedTime;
        };

        function getMacAddress() {
            return fetch('http://localhost:8001/get_mac_address')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => data.mac_address || 'No MAC address found')
                .catch(error => {
                    console.error('Error:', error);
                    return 'Error fetching MAC address';
                });
        }

        document.getElementById('verifyButton').addEventListener('click', async function() {
            const macAddress = await getMacAddress();

            // Get geolocation
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;

                    // Send data to the server
                    fetch('verify_mac.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            macAddress: macAddress,
                            latitude: latitude,
                            longitude: longitude
                        })
                    })
                    .then(response => response.text())
                    .then(data => {
                        alert(data);
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                }, function(error) {
                    console.error('Error getting location:', error);
                    alert('Error getting location. Please enable location services.');
                });
            } else {
                alert('Geolocation is not supported by this browser.');
            }
        });
    </script>

    <footer>
        <p>&copy; 2023 Software Development Cell, VIT, Chennai-600 127. All rights reserved.</p>
    </footer>
</body>
</html>