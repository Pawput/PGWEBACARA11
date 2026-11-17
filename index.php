<?php

require_once __DIR__ . "/config/koneksi.php";

// ==========================================
// INISIALISASI DATA
// ==========================================

$totalPenduduk = 0;
$totalKecamatan = 0;
$totalData = 0;

if ($conn !== null) {

    try {

        // Menghitung jumlah data penduduk
        $result = $conn->query(
            "SELECT COUNT(*) AS total FROM penduduk"
        );

        if ($result) {
            $totalPenduduk = (int) $result->fetch_assoc()["total"];
        }

        // Menghitung jumlah kecamatan
        $result = $conn->query(
            "SELECT COUNT(DISTINCT kecamatan) AS total FROM penduduk"
        );

        if ($result) {
            $totalKecamatan = (int) $result->fetch_assoc()["total"];
        }

        // Menghitung jumlah seluruh record
        $totalData = $totalPenduduk;

    } catch (Exception $e) {

        // Tabel belum tersedia atau query gagal
        $totalPenduduk = 0;
        $totalKecamatan = 0;
        $totalData = 0;

    } catch (Error $e) {

        $totalPenduduk = 0;
        $totalKecamatan = 0;
        $totalData = 0;
    }
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>WebGIS PGWEB Acara 11</title>

    <!-- Leaflet CSS -->
    <link
        rel="stylesheet"
        href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    >

    <!-- Custom CSS -->
    <link
        rel="stylesheet"
        href="assets/style.css"
    >

</head>

<body>

    <!-- ==================================
         NAVBAR
    =================================== -->

    <nav class="navbar">

        <h2>WebGIS | PGWEB</h2>

        <span>
            Universitas Gadjah Mada
        </span>

    </nav>


    <!-- ==================================
         MAIN CONTENT
    =================================== -->

    <main class="container">

        <section class="header">

            <h1>
                Sistem Informasi Geografis
            </h1>

            <p>
                Visualisasi data spasial menggunakan
                GeoServer, MySQL, dan LeafletJS.
            </p>

        </section>


        <!-- ==================================
             DATABASE STATUS
        =================================== -->

        <?php if ($conn !== null): ?>

            <div class="database-status success">

                <strong>Database terhubung.</strong>

                MySQL berhasil terkoneksi melalui Laragon.

            </div>

        <?php else: ?>

            <div class="database-status error">

                <strong>Database belum terhubung.</strong>

                Periksa konfigurasi pada config/koneksi.php
                dan pastikan MySQL Laragon aktif.

            </div>

        <?php endif; ?>


        <!-- ==================================
             STATISTICS
        =================================== -->

        <section class="statistics">

            <div class="stat-card">

                <h3>Total Data Penduduk</h3>

                <div class="number">
                    <?= number_format($totalPenduduk, 0, ',', '.') ?>
                </div>

            </div>


            <div class="stat-card">

                <h3>Jumlah Kecamatan</h3>

                <div class="number">
                    <?= number_format($totalKecamatan, 0, ',', '.') ?>
                </div>

            </div>


            <div class="stat-card">

                <h3>Total Record Database</h3>

                <div class="number">
                    <?= number_format($totalData, 0, ',', '.') ?>
                </div>

            </div>

        </section>


        <!-- ==================================
             WEBGIS MAP
        =================================== -->

        <section class="map-container">

            <div class="map-header">

                <h2>
                    Peta Administrasi Kecamatan Bantul
                </h2>

                <span>
                    ● GeoServer WMS
                </span>

            </div>

            <div id="map"></div>

        </section>

    </main>


    <!-- ==================================
         FOOTER
    =================================== -->

    <footer class="footer">

        <p>
            WebGIS PGWEB Acara 11 |
            GeoServer + MySQL + LeafletJS
        </p>

        <p>
            Universitas Gadjah Mada
        </p>

    </footer>


    <!-- ==================================
         JAVASCRIPT
    =================================== -->

    <script
        src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js">
    </script>

    <script src="assets/map.js"></script>

</body>

</html>
