<?php
declare(strict_types=1);

require_once 'tiket.php';

/**
 * ============================================================
 * Class: TiketVelvet
 * ============================================================
 *
 * Deskripsi:
 *   - Subclass konkrit dari Tiket untuk studio Velvet (Premium).
 *   - Properti tambahan: bantalSelimutPack dan layananButler.
 *
 * @package ShowroomInventory
 */
class TiketVelvet extends Tiket {

    // ========================================================
    // PROPERTI TAMBAHAN
    // ========================================================

    /** @var bool Apakah termasuk paket bantal & selimut */
    private bool $bantalSelimutPack;

    /** @var string Nama/deskripsi layanan butler */
    private string $layananButler;

    // ========================================================
    // KONSTRUKTOR
    // ========================================================

    public function __construct(
        int $id_tiket,
        string $nama_film,
        string $jadwal_tayang,
        int $jumlah_kursi,
        float $hargaDasarTiket,
        bool $bantalSelimutPack,
        string $layananButler
    ) {
        parent::__construct($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $hargaDasarTiket);
        $this->bantalSelimutPack = $bantalSelimutPack;
        $this->layananButler     = $layananButler;
    }

    // ========================================================
    // GETTER PROPERTI INDUK
    // ========================================================

    public function getNamaFilm(): string     { return $this->nama_film; }
    public function getJadwalTayang(): string { return $this->jadwal_tayang; }
    public function getJumlahKursi(): int     { return $this->jumlah_kursi; }

    // ========================================================
    // GETTER & SETTER PROPERTI TAMBAHAN
    // ========================================================

    public function getBantalSelimutPack(): bool {
        return $this->bantalSelimutPack;
    }

    public function setBantalSelimutPack(bool $bantalSelimutPack): void {
        $this->bantalSelimutPack = $bantalSelimutPack;
    }

    public function getLayananButler(): string {
        return $this->layananButler;
    }

    public function setLayananButler(string $layananButler): void {
        $this->layananButler = $layananButler;
    }

    // ========================================================
    // IMPLEMENTASI METODE ABSTRAK
    // ========================================================

    /**
     * Hitung total harga tiket Velvet
     * Total Harga = (jumlah_kursi * hargaDasarTiket) * 1.50
     *
     * @return float
     */
    public function hitungTotalHarga(): float {
        return ($this->jumlah_kursi * $this->hargaDasarTiket) * 1.50;
    }

    /**
     * Tampilkan informasi fasilitas TiketVelvet
     *
     * @return string
     */
    public function tampilkanInfoFasilitas(): string {
        $pack = $this->bantalSelimutPack ? 'Tersedia' : 'Tidak Tersedia';
        return "Studio Velvet | Bantal & Selimut Pack: {$pack} | Layanan Butler: {$this->layananButler}";
    }
}