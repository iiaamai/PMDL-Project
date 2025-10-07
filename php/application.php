<?php 
include 'connect.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $LastName    = $_POST['Lname'] ?? '';
    $FirstName   = $_POST['Fname'] ?? '';
    $MidName     = $_POST['Mname'] ?? '';
    $ExtraName   = $_POST['Ename'] ?? '';
    $Sex         = $_POST['sex'] ?? '';
    $civilstatus = $_POST['cvstatus'] ?? '';
    $DateBirth   = $_POST['Dateb'] ?? '';
    $Height      = $_POST['height'] ?? '';
    $Weight      = $_POST['weight'] ?? '';
    $Nationality = $_POST['nationality'] ?? '';
    $BirthPlace  = $_POST['bPlace'] ?? '';
    $religion    = $_POST['Religion'] ?? '';
    $PAddress    = $_POST['pAdress'] ?? '';
    $City        = $_POST['city'] ?? '';
    $Zip         = $_POST['zip'] ?? '';
    $ActNum      = $_POST['activeNum'] ?? '';
    $AEmail      = $_POST['Aemail'] ?? '';
    $CountyDeply = $_POST['CountryDeploy'] ?? '';
    $jobType     = $_POST['Jobtype'] ?? '';

    $stmt = $conn->prepare("
        INSERT INTO application 
        (Last_Name, First_Name, Middle_Name, Extension_Name, Sex, Civil_Status, Date_of_Birth, Height, Weight, 
        Nationality, Birth_Place, Religion, Barangay, City, Zip_Code, Contact_Num, Email_Address, Country, Job)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    $stmt->bind_param(
        "sssssssssssssssssss",
        $LastName, $FirstName, $MidName, $ExtraName, $Sex, $civilstatus, $DateBirth, $Height, $Weight, 
        $Nationality, $BirthPlace, $religion, $PAddress, $City, $Zip, $ActNum, $AEmail, $CountyDeply, $jobType
    );

    if ($stmt->execute()) {
        header("Location: ../submission.html");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
