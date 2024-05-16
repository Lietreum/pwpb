<?php
include 'lib/library.php';

$nis = $_GET['nis'];

if (empty($nis)) {
    header('location: index.php');
    exit; // Terminate script execution after redirection
}

$sql = "SELECT * FROM siswa WHERE nis = '$nis'";
$query = $mysqli->query($sql);
$siswa = $query->fetch_array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql_delete = "DELETE FROM siswa WHERE nis = '$nis'";
    
    if ($mysqli->query($sql_delete)) {
        echo 1;
        exit; // Terminate script execution after successful deletion
    } else {
        echo "Error: " . $mysqli->error; // Display error message
        exit; // Terminate script execution after unsuccessful deletion
    }
}

header('location: index.php');
exit; // Terminate script execution after redirection



