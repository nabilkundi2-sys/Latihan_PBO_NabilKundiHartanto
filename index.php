<?php
declare(strict_types=1);

// Memanggil koneksi dan semua class OOP
require_once 'koneksi.php';
require_once 'TiketReguler.php'; 
require_once 'TiketImax.php';
require_once 'TiketVelvet.php';

// Mengambil data dari database
$sql = "SELECT * FROM tabel_tiket ORDER BY jenis_studio, id_tiket ASC";
$data_tiket_db = query_assoc($sql);

// Membuat 3 kantong/array terpisah untuk masing-masing jenis studio
$daftar_reguler = [];
$daftar_imax    = [];
$daftar_velvet  = [];

// Looping data dari database dan memisahkan kelompok objek sejak awal
foreach ($data_tiket_db as $row) {
    $id_tiket      = (int)$row['id_tiket'];
    $nama_film     = $row['nama_film'];
    $jadwal_tayang = $row['jadwal_tayang'];
    $jumlah_kursi  = (int)$row['jumlah_kursi'];
    $harga_dasar   = (float)$row['harga_dasar_tiket'];
    $jenis_studio  = $row['jenis_studio'];

    if ($jenis_studio === 'regular') {
        $tipe_audio   = $row['tipe_audio'] ?? 'Stereo Standar';
        $lokasi_baris = $row['lokasi_baris'] ?? 'Bebas';
        
        $daftar_reguler[] = new TiketRegular($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $harga_dasar, $tipe_audio, $lokasi_baris);
    
    } elseif ($jenis_studio === 'imax') {
        $kacamata = $row['kacamata_3d_id'] ?? '-';
        $efek     = $row['efek_gerak_fitur'] ?? '-';
        
        $daftar_imax[] = new TiketIMAX($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $harga_dasar, $kacamata, $efek);
    
    } elseif ($jenis_studio === 'velvet') {
        $is_bantal_pack = (!empty($row['bantal_selimut_pack']));
        $butler         = $row['layanan_butler'] ?? 'Tidak Ada';
        
        $daftar_velvet[] = new TiketVelvet($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $harga_dasar, $is_bantal_pack, $butler);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineManage — Luxury Cinematic Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-deep: #090d16;
            --bg-surface: rgba(20, 28, 47, 0.6);
            --border-glass: rgba(255, 255, 255, 0.07);
            
            --glow-regular: #3b82f6;
            --glow-imax: #06b6d4;
            --glow-velvet: #f59e0b;
            
            --text-main: #f8fafc;
            --text-secondary: #94a3b8;
        }

        body { 
            background-color: var(--bg-deep); 
            color: var(--text-main);
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(59, 130, 246, 0.05) 0%, transparent 40%),
                radial-gradient(circle at 90% 80%, rgba(245, 158, 11, 0.04) 0%, transparent 40%);
            background-attachment: fixed;
            -webkit-font-smoothing: antialiased;
        }

        /* Glassmorphic Navbar-style Header */
        .premium-header {
            background: rgba(9, 13, 22, 0.7);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--border-glass);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .brand-logo {
            font-size: 1.5rem;
            font-weight: 800;
            background: linear-gradient(45deg, #fff 30%, #94a3b8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: -0.03em;
        }

        /* Aesthetic Category Title */
        .category-heading {
            font-size: 1.5rem;
            font-weight: 700;
            letter-spacing: -0.02em;
            position: relative;
            padding-left: 16px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .category-heading::before {
            content: '';
            position: absolute;
            left: 0;
            width: 5px;
            height: 24px;
            border-radius: 4px;
        }

        .head-regular::before { background: var(--glow-regular); box-shadow: 0 0 12px var(--glow-regular); }
        .head-imax::before { background: var(--glow-imax); box-shadow: 0 0 12px var(--glow-imax); }
        .head-velvet::before { background: var(--glow-velvet); box-shadow: 0 0 12px var(--glow-velvet); }

        /* Elegant Luxury Ticket Card Layout */
        .aesthetic-ticket {
            background: var(--bg-surface);
            backdrop-filter: blur(12px);
            border: 1px solid var(--border-glass);
            border-radius: 24px;
            position: relative;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .aesthetic-ticket:hover {
            transform: translateY(-6px) scale(1.01);
            border-color: rgba(255, 255, 255, 0.15);
        }

        /* Efek Glow Tipis Saat Hover Berdasarkan Kategori */
        .card-regular:hover { box-shadow: 0 20px 40px -15px rgba(59, 130, 246, 0.15); }
        .card-imax:hover { box-shadow: 0 20px 40px -15px rgba(6, 182, 212, 0.15); }
        .card-velvet:hover { box-shadow: 0 20px 40px -15px rgba(245, 158, 11, 0.15); }

        .ticket-body {
            padding: 28px 28px 20px 28px;
        }

        .ticket-id {
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--text-secondary);
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }

        .film-title-luxury {
            font-size: 1.35rem;
            font-weight: 700;
            line-height: 1.3;
            margin-top: 6px;
            color: #ffffff;
            letter-spacing: -0.01em;
        }

        .meta-pill-container {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin: 16px 0;
        }

        .meta-pill {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.05);
            padding: 6px 12px;
            border-radius: 100px;
            font-size: 0.78rem;
            color: #cbd5e1;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        /* Aesthetic Perforation Line (Potongan Tiket Bioskop) */
        .ticket-perforation {
            height: 2px;
            border-top: 2px dashed rgba(255, 255, 255, 0.12);
            position: relative;
            margin: 0 4px;
        }

        /* Bulatan Potongan Kiri & Kanan Tiket */
        .ticket-perforation::before, .ticket-perforation::after {
            content: '';
            position: absolute;
            top: -9px;
            width: 18px;
            height: 18px;
            background-color: var(--bg-deep);
            border-radius: 50%;
            z-index: 5;
        }
        .ticket-perforation::before { left: -10px; border-right: 1px solid var(--border-glass); }
        .ticket-perforation::after { right: -10px; border-left: 1px solid var(--border-glass); }

        .ticket-footer {
            padding: 20px 28px 28px 28px;
            background: rgba(255, 255, 255, 0.01);
            border-radius: 0 0 24px 24px;
        }

        /* Neon Text Badges */
        .badge-premium {
            font-size: 0.7rem;
            font-weight: 700;
            padding: 5px 10px;
            border-radius: 6px;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }
        .badge-premium-regular { background: rgba(59, 130, 246, 0.1); color: #60a5fa; border: 1px solid rgba(59, 130, 246, 0.2); }
        .badge-premium-imax { background: rgba(6, 182, 212, 0.1); color: #22d3ee; border: 1px solid rgba(6, 182, 212, 0.2); }
        .badge-premium-velvet { background: rgba(245, 158, 11, 0.1); color: #fbbf24; border: 1px solid rgba(245, 158, 11, 0.2); }

        /* Typography Price */
        .price-title {
            font-size: 0.75rem;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            display: block;
        }

        .price-value {
            font-size: 1.45rem;
            font-weight: 800;
            letter-spacing: -0.02em;
        }
        .text-glow-regular { color: #60a5fa; text-shadow: 0 0 15px rgba(59, 130, 246, 0.3); }
        .text-glow-imax { color: #22d3ee; text-shadow: 0 0 15px rgba(6, 182, 212, 0.3); }
        .text-glow-velvet { color: #fbbf24; text-shadow: 0 0 15px rgba(245, 158, 11, 0.3); }
    </style>
</head>
<body>

<header class="premium-header py-3 mb-5">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="brand-logo d-flex align-items-center gap-2">
            <i class="bi bi-alexa text-info fs-4"></i> CineManage
        </div>
        <div>
            <span class="badge bg-dark border border-secondary px-3 py-2 rounded-pill fw-medium text-white-50">
                <i class="bi bi-database-fill text-success me-1"></i> <?= count($data_tiket_db); ?> Terinventaris
            </span>
        </div>
    </div>
</header>

<main class="container pb-5">

    <div class="d-flex justify-content-between align-items-center mb-4 mt-2">
        <h3 class="category-heading head-regular">Studio Regular</h3>
        <span class="text-muted small fw-medium"><?= count($daftar_reguler); ?> Data Tersedia</span>
    </div>
    
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4 mb-5">
        <?php foreach ($daftar_reguler as $index => $tiket): ?>
        <div class="col">
            <div class="aesthetic-ticket card-regular h-100 d-flex flex-column justify-content-between">
                <div class="ticket-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="ticket-id">PASS #REG-<?= str_pad((string)($index+1), 2, '0', STR_PAD_LEFT); ?></span>
                        <span class="badge-premium badge-premium-regular">Standard</span>
                    </div>
                    
                    <h4 class="film-title-luxury text-truncate" title="<?= htmlspecialchars($tiket->getNamaFilm()); ?>">
                        <?= htmlspecialchars($tiket->getNamaFilm()); ?>
                    </h4>
                    
                    <div class="meta-pill-container">
                        <div class="meta-pill">
                            <i class="bi bi-clock-history"></i>
                            <span><?= date('d M, H:i', strtotime($tiket->getJadwalTayang())); ?> WIB</span>
                        </div>
                        <div class="meta-pill">
                            <i class="bi bi-disc"></i>
                            <span><?= $tiket->getJumlahKursi(); ?> Kursi</span>
                        </div>
                    </div>

                    <div class="mt-3 pt-2" style="border-top: 1px solid rgba(255,255,255,0.03);">
                        <span class="text-white-50 small d-block mb-1"><i class="bi bi-cpu me-1"></i> Fasilitas Studio:</span>
                        <p class="m-0 text-secondary small italic font-monospace"><?= $tiket->tampilkanInfoFasilitas(); ?></p>
                    </div>
                </div>

                <div>
                    <div class="ticket-perforation"></div>
                    <div class="ticket-footer d-flex justify-content-between align-items-center">
                        <div>
                            <span class="price-title">Total Pembayaran</span>
                        </div>
                        <div>
                            <span class="price-value text-glow-regular">Rp <?= number_format($tiket->hitungTotalHarga(), 0, ',', '.'); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>


    <div class="d-flex justify-content-between align-items-center mb-4 mt-5">
        <h3 class="category-heading head-imax">Studio IMAX 3D</h3>
        <span class="text-muted small fw-medium"><?= count($daftar_imax); ?> Data Tersedia</span>
    </div>
    
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4 mb-5">
        <?php foreach ($daftar_imax as $index => $tiket): ?>
        <div class="col">
            <div class="aesthetic-ticket card-imax h-100 d-flex flex-column justify-content-between">
                <div class="ticket-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="ticket-id">PASS #IMX-<?= str_pad((string)($index+1), 2, '0', STR_PAD_LEFT); ?></span>
                        <span class="badge-premium badge-premium-imax">IMAX Digital</span>
                    </div>
                    
                    <h4 class="film-title-luxury text-truncate" title="<?= htmlspecialchars($tiket->getNamaFilm()); ?>">
                        <?= htmlspecialchars($tiket->getNamaFilm()); ?>
                    </h4>
                    
                    <div class="meta-pill-container">
                        <div class="meta-pill">
                            <i class="bi bi-clock-history text-info"></i>
                            <span><?= date('d M, H:i', strtotime($tiket->getJadwalTayang())); ?> WIB</span>
                        </div>
                        <div class="meta-pill">
                            <i class="bi bi-disc text-info"></i>
                            <span><?= $tiket->getJumlahKursi(); ?> Kursi</span>
                        </div>
                    </div>

                    <div class="mt-3 pt-2" style="border-top: 1px solid rgba(255,255,255,0.03);">
                        <span class="text-info small d-block mb-1"><i class="bi bi-projector-fill me-1"></i> Fitur Audio & Visual:</span>
                        <p class="m-0 text-secondary small font-monospace"><?= $tiket->tampilkanInfoFasilitas(); ?></p>
                    </div>
                </div>

                <div>
                    <div class="ticket-perforation"></div>
                    <div class="ticket-footer d-flex justify-content-between align-items-center">
                        <div>
                            <span class="price-title">Total Pembayaran</span>
                        </div>
                        <div>
                            <span class="price-value text-glow-imax">Rp <?= number_format($tiket->hitungTotalHarga(), 0, ',', '.'); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>


    <div class="d-flex justify-content-between align-items-center mb-4 mt-5">
        <h3 class="category-heading head-velvet">Studio Velvet (VIP Suite)</h3>
        <span class="text-muted small fw-medium"><?= count($daftar_velvet); ?> Data Tersedia</span>
    </div>
    
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4 mb-5">
        <?php foreach ($daftar_velvet as $index => $tiket): ?>
        <div class="col">
            <div class="aesthetic-ticket card-velvet h-100 d-flex flex-column justify-content-between">
                <div class="ticket-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="ticket-id">PASS #VVT-<?= str_pad((string)($index+1), 2, '0', STR_PAD_LEFT); ?></span>
                        <span class="badge-premium badge-premium-velvet">Velvet Luxury</span>
                    </div>
                    
                    <h4 class="film-title-luxury text-truncate" title="<?= htmlspecialchars($tiket->getNamaFilm()); ?>">
                        <?= htmlspecialchars($tiket->getNamaFilm()); ?>
                    </h4>
                    
                    <div class="meta-pill-container">
                        <div class="meta-pill">
                            <i class="bi bi-clock-history text-warning"></i>
                            <span><?= date('d M, H:i', strtotime($tiket->getJadwalTayang())); ?> WIB</span>
                        </div>
                        <div class="meta-pill">
                            <i class="bi bi-disc text-warning"></i>
                            <span><?= $tiket->getJumlahKursi(); ?> Kursi</span>
                        </div>
                    </div>

                    <div class="mt-3 pt-2" style="border-top: 1px solid rgba(255,255,255,0.03);">
                        <span class="text-warning small d-block mb-1"><i class="bi bi-gem me-1"></i> Layanan Kelas Utama:</span>
                        <p class="m-0 text-secondary small font-monospace"><?= $tiket->tampilkanInfoFasilitas(); ?></p>
                    </div>
                </div>

                <div>
                    <div class="ticket-perforation"></div>
                    <div class="ticket-footer d-flex justify-content-between align-items-center">
                        <div>
                            <span class="price-title">Total Pembayaran</span>
                        </div>
                        <div>
                            <span class="price-value text-glow-velvet">Rp <?= number_format($tiket->hitungTotalHarga(), 0, ',', '.'); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>