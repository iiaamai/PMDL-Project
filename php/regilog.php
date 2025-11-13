<?php
include 'connect.php';
session_start();
 

// --------------- REGISTER SECTION ---------------
if (isset($_POST['register'])) {
    $lastName = $_POST['lname'];
    $firstName = $_POST['fname'];
    $midName = $_POST['mname'];
    $birthday = $_POST['bday'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // ✅ Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // ✅ Check if email is used by admin
    $checkAdmin = "SELECT * FROM admin WHERE email = ?";
    $stmt = $conn->prepare($checkAdmin);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $adminResult = $stmt->get_result();

    if ($adminResult->num_rows > 0) {
        header("Location: ../registerlog.php?error=adminexists");
        exit();
    }

    // ✅ Check if user email already exists
    $checkUser = "SELECT * FROM register WHERE Email = ?";
    $stmt = $conn->prepare($checkUser);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $userResult = $stmt->get_result();

    if ($userResult->num_rows > 0) {
        header("Location: ../registerlog.php?error=emailexists");
        exit();
    }

    // ✅ Insert new user
    $insert = "INSERT INTO register (Last_Name, First_Name, Middle_Name, Birthday, Email, Password)
               VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insert);
    $stmt->bind_param("ssssss", $lastName, $firstName, $midName, $birthday, $email, $hashedPassword);

    if ($stmt->execute()) {
        header("Location: ../registerlog.php?success=1");
        exit();
    } else {
        header("Location: ../registerlog.php?error=dberror");
        exit();
    }
}



// --------------- LOGIN SECTION ---------------
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // ✅ Step 1: Check if it's an admin
    $adminSql = "SELECT * FROM admin WHERE email = ?";
    $stmt = $conn->prepare($adminSql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $adminResult = $stmt->get_result();

    if ($adminResult->num_rows > 0) {
        $adminRow = $adminResult->fetch_assoc();

        // ✅ Compare hashed password for admin
        if (password_verify($password, $adminRow['Password'])) {
            $_SESSION['admin_email'] = $adminRow['email'];
            header("Location: ../admin.php");
            exit();
        } else {
            header("Location: ../registerlog.php?error=wrongpass");
            exit();
        }
    }

    // ✅ Step 2: Check if it's a user
    $userSql = "SELECT * FROM register WHERE Email = ?";
    $stmt = $conn->prepare($userSql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $userResult = $stmt->get_result();

    if ($userResult->num_rows > 0) {
        $userRow = $userResult->fetch_assoc();

        // ✅ Compare hashed password for user
        if (password_verify($password, $userRow['Password'])) {
            $_SESSION['email'] = $userRow['Email'];
            header("Location: ../userdash.php");
            exit();
        } else {
            header("Location: ../registerlog.php?error=wrongpass");
            exit();
        }
    } else {
        header("Location: ../registerlog.php?error=noemail");
        exit();
    }
}
?>
