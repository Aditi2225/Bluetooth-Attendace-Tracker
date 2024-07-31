<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: index1.php");
    exit();
}

$email = $_SESSION['email'];

$data = json_decode(file_get_contents('php://input'), true);
$macAddress = $data['macAddress'];
$latitude = $data['latitude'];
$longitude = $data['longitude'];

include("connect.php");

$sql = "SELECT mac FROM student WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    if ($row['mac'] === $macAddress) {
        $updateSql = "UPDATE student SET latitude = ?, longitude = ? WHERE email = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("dds", $latitude, $longitude, $email);
        if ($updateStmt->execute()) {
            echo "MAC address verified and location updated successfully.";
        } else {
            echo "Error updating location: " . $conn->error;
        }
    } else {
        echo "MAC address does not match.";
    }
} else {
    echo "User not found.";
}

$stmt->close();
$conn->close();
?>
