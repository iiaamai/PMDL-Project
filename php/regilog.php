<?php
include 'connect.php';
session_start();

if (isset($_POST['register'])) {
    $lastName = $_POST['lname'];
    $firstName = $_POST['fname'];
    $midName = $_POST['mname'];
    $birthday = $_POST['bday'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $checkEmail = "SELECT * FROM register WHERE Email='$email'";
    $result = $conn->query($checkEmail);

    if ($result->num_rows > 0) {
        echo "Email Address Already Exists";
    } else {
        $insertQuery = "INSERT INTO register (Last_Name, First_Name, Middle_Name, Birthday, Email, Password)
                        VALUES ('$lastName', '$firstName', '$midName', '$birthday', '$email', '$password')";
        if ($conn->query($insertQuery) === TRUE) {
            header("Location: ../registerlog.php");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

  // Check if admin  
    $adminSql = "SELECT * FROM admin WHERE email='$email' AND Password='$password'";
    $adminResult = $conn->query($adminSql);

    if ($adminResult->num_rows > 0) {
        $row = $adminResult->fetch_assoc();
        $_SESSION['admin_email'] = $row['email'];
        echo 'ALksbdafgh';
        header("Location: /PMDL-PROJECT/admin.php");
        exit();
    }

    // If not admin, check users
    $userSql = "SELECT * FROM register WHERE Email='$email' AND Password='$password'";
    $userResult = $conn->query($userSql);

    if ($userResult->num_rows > 0) {
        $row = $userResult->fetch_assoc();
        $_SESSION['email'] = $row['Email'];
        header("Location: /PMDL-PROJECT/userdash.php"); 
        exit();
    } else {
        header("Location: /PMDL-PROJECT/registerlog.php");
    }
}
