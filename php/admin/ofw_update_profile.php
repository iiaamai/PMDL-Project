<?php
// php/admin/ofw_update_profile.php

// Manual database connection
$host = 'localhost';
$dbname = 'pmdlwebsite'; // REPLACE WITH YOUR ACTUAL DB NAME
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Connection failed: ' . $e->getMessage()]);
    exit;
}

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $ofw_id = $_POST['ofw_id'] ?? '';
        $worker_type = $_POST['worker_type'] ?? '';
        $status = $_POST['status'] ?? '';
        
        if (empty($ofw_id)) {
            echo json_encode(['error' => 'No OFW ID provided']);
            exit;
        }
        
        // Find the correct table name
        $tableName = 'ofw_records'; // Change this to your actual table name
        
        // Update only the allowed fields
        $sql = "UPDATE $tableName SET 
                worker_type = ?,
                Status = ?  
                WHERE Ofw_ID = ?";
        
        $stmt = $pdo->prepare($sql);
        
        $success = $stmt->execute([
            $worker_type,
            $status,
            $ofw_id
        ]);
        
        if ($success) {
            echo json_encode(['success' => true, 'message' => 'Profile updated successfully']);
        } else {
            echo json_encode(['error' => 'Failed to update record']);
        }
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    }
}
?>