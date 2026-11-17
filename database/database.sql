-- ==========================================
-- DATABASE PGWEB ACARA 11
-- ==========================================

CREATE DATABASE IF NOT EXISTS latihan
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE latihan;

-- Tabel data penduduk
CREATE TABLE IF NOT EXISTS penduduk (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kecamatan VARCHAR(100) NOT NULL,
    luas DECIMAL(12,4),
    jumlah_penduduk BIGINT,
    longitude DECIMAL(12,8),
    latitude DECIMAL(12,8)
) ENGINE=InnoDB;

-- View untuk membentuk geometri titik
-- berdasarkan longitude dan latitude.

CREATE OR REPLACE VIEW vw_penduduk_spasial AS
SELECT
    id,
    kecamatan,
    luas,
    jumlah_penduduk,
    longitude,
    latitude,
    ST_GeomFromText(
        CONCAT(
            'POINT(',
            CAST(longitude AS CHAR),
            ' ',
            CAST(latitude AS CHAR),
            ')'
        ),
        4326
    ) AS geom
FROM penduduk
WHERE longitude IS NOT NULL
AND latitude IS NOT NULL;

-- Pemeriksaan database
SHOW TABLES;

-- Pemeriksaan struktur tabel
DESCRIBE penduduk;

-- Pemeriksaan data
SELECT * FROM penduduk;
