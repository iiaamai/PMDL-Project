<?php
// php/admin/joborder_get_details.php
header('Content-Type: application/json');

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = "localhost";
$user = "root";
$pass = "";
$db = "pmdlwebsite";

$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

if (!isset($_GET['job_id'])) {
    die(json_encode(["error" => "Job ID is required"]));
}

$job_id = $conn->real_escape_string($_GET['job_id']);

// Fetch ALL job details for the modal
$sql = "SELECT 
    JobOrder_id, 
    position_title, 
    employer_company, 
    country, 
    no_vacancies, 
    status, 
    application_deadline,
    salary,
    job_description,
    contact_person,
    contact_email,
    contact_phone
FROM job_order 
WHERE JobOrder_id = '$job_id'";

$result = $conn->query($sql);

if ($result === FALSE) {
    die(json_encode(["error" => "Query failed: " . $conn->error]));
}

if ($result->num_rows > 0) {
    $job = $result->fetch_assoc();
    echo json_encode($job);
} else {
    echo json_encode(["error" => "Job not found"]);
}

$conn->close();
?>