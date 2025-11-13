<?php
// php/admin/joborder_fetch.php
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

// Fetch only the necessary data for table display
$sql = "SELECT 
    JobOrder_id, 
    position_title, 
    employer_company, 
    country, 
    no_vacancies, 
    status, 
    application_deadline
FROM job_order 
WHERE status = 'active' 
ORDER BY JobOrder_id DESC";

$result = $conn->query($sql);

// Check if query was successful
if ($result === FALSE) {
    die(json_encode(["error" => "Query failed: " . $conn->error]));
}

$jobs = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $jobs[] = $row;
    }
    echo json_encode($jobs);
} else {
    echo json_encode(["message" => "No active job orders found", "count" => 0]);
}

$conn->close();
?>