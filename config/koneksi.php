<?php

// ==========================================
// KONFIGURASI KONEKSI DATABASE
// ==========================================

$host = "localhost";
$username = "root";
$password = "";
$database = "latihan";
$port = 3306;

$conn = null;
$dbError = null;

// ==========================================
// MEMBUAT KONEKSI
// ==========================================

mysqli_report(MYSQLI_REPORT_OFF);

try {

    $conn = new mysqli(
        $host,
        $username,
        $password,
        $database,
        $port
    );

    if ($conn->connect_error) {
        throw new Exception($conn->connect_error);
    }

    $conn->set_charset("utf8mb4");

} catch (Exception $e) {

    $dbError = $e->getMessage();
}

?>
