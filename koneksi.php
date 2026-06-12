<?php
declare(strict_types=1);

/**
 * ============================================================
 * File Koneksi: koneksi.php
 * ============================================================
 *
 * Deskripsi:
 *   - Menghubungkan project PHP ke database MySQL Laragon
 *
 * @package ShowroomInventory
 */

// =======================
// KONFIGURASI DATABASE
// =======================
$host     = 'localhost';
$username = 'root';
$password = '';
$database = 'db_latihan_pbo_trpl1a_nabil_kundi_hartanto';

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
function query_assoc(string $sql): array
{
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