<?php
include 'lib/library.php';

checkLogin();

// join
$sql = 'SELECT siswa.*, kelas.nama_kelas FROM siswa INNER JOIN kelas ON (siswa.id_kelas = kelas.id_kelas)';
$search = isset($_GET['search']) ? $_GET['search'] : '';

if (!empty($search)) {
    $search = $mysqli->real_escape_string($search);
    $sql .= " WHERE siswa.nis LIKE '%$search%' OR siswa.nama_lengkap LIKE '%$search%'";
}

$order_field = isset($_GET['sort']) ? $_GET['sort'] : '';
$order_mode = isset($_GET['order']) ? $_GET['order'] : '';

if (!empty($order_field) && !empty($order_mode)) {
    $sql .= " ORDER BY $order_field $order_mode";
}

$listSiswa = $mysqli->query($sql);

// Check for query errors
if (!$listSiswa) {
    echo "Error: " . $mysqli->error;
    exit();
}

include 'views/v_index.php';
