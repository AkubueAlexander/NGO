<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the submitted date (e.g., "2025-08-22")
    $date = $_POST['event_date'];

    // Convert to timestamp
    $timestamp = strtotime($date);

    echo "Selected Date: " . $date . "<br>";
    echo "Timestamp: " . $timestamp;
}
?>
