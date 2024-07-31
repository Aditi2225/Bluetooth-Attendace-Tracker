<?php
session_start();

if (isset($_POST['signUp'])) {
    include 'connect.php';
    
    $firstName = $_POST['fName'];
    $lastName = $_POST['lName'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $macAddress = $_POST['macAddress']; 

    $checkEmail = "SELECT * FROM student WHERE email='$email'";
    $result = $conn->query($checkEmail);
    if ($result->num_rows > 0) {
        echo "Email Address Already Exists!";
    } else {
        $insertQuery = "INSERT INTO student (firstName, lastName, email, password, mac) VALUES ('$firstName', '$lastName', '$email', '$password', '$macAddress')";
        if ($conn->query($insertQuery) === TRUE) {
            header("Location: index1.php");
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

if (isset($_POST['signIn'])) {
    include 'connect.php';
    
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM student WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['email'] = $row['email'];
        $_SESSION['firstName'] = $row['firstName'];
        $_SESSION['lastName'] = $row['lastName'];
        header("Location: studentoption.php");
        exit();
    } else {
        echo "Not Found, Incorrect Email or Password";
    }
}
?>