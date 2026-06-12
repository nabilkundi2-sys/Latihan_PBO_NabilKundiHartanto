<?php
declare(strict_types=1);

/**
 * ============================================================
 * File Koneksi: koneksi.php
 * ============================================================
 *
 * Deskripsi:
 *   - Menghubungkan project PHP ke database MySQL Laragon
 *   - Sesuaikan nama database, username, dan password
 *
 * @package ShowroomInventory
 */

// =======================
// KONFIGURASI DATABASE
// =======================
$host     = 'localhost';   // Host MySQL
$username = 'root';        // User default Laragon
$password = '';            // Password default Laragon kosong
$database = 'db_latihan_pbo_fabianadilarevianza'; // Nama database yang dibuat di Laragon

// =======================
// MEMBUAT KONEKSI
// =======================
$koneksi = new mysqli($host, $username, $password, $database);

// =======================
// CEK KONEKSI
// =======================
if ($koneksi->connect_error) {
    die("Koneksi ke database gagal: " . $koneksi->connect_error);
}

// =======================
// SET CHARACTER SET
// =======================
$koneksi->set_charset("utf8mb4");

// =======================
// OPTIONAL: Fungsi bantu query
// =======================
/**
 * Jalankan query dan kembalikan hasil sebagai array associative
 *
 * @param string $sql
 * @return array
 */
function query_assoc(string $sql): array {
    global $koneksi;
    $result = $koneksi->query($sql);
    $data = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    return $data;
}