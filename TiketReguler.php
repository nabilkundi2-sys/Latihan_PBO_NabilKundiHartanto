<?php
declare(strict_types=1);

require_once 'tiket.php';

/**
 * ============================================================
 * Class: TiketRegular
 * ============================================================
 *
 * Deskripsi:
 *   - Subclass konkrit dari Tiket untuk studio Regular.
 *   - Properti tambahan: tipeAudio dan lokasiBaris.
 *
 * @package ShowroomInventory
 */
class TiketRegular extends Tiket {

    // ========================================================
    // PROPERTI TAMBAHAN
    // ========================================================

    /** @var string Tipe audio (misalnya: Stereo, Dolby) */
    private string $tipeAudio;

    /** @var string Lokasi baris kursi (misalnya: A, B, C) */
    private string $lokasiBaris;

    // ========================================================
    // KONSTRUKTOR
    // ========================================================

    public function __construct(
        int $id_tiket,
        string $nama_film,
        string $jadwal_tayang,
        int $jumlah_kursi,
        float $hargaDasarTiket,
        string $tipeAudio,
        string $lokasiBaris
    ) {
        parent::__construct($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $hargaDasarTiket);
        $this->tipeAudio   = $tipeAudio;
        $this->lokasiBaris = $lokasiBaris;
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

    public function getTipeAudio(): string {
        return $this->tipeAudio;
    }

    public function setTipeAudio(string $tipeAudio): void {
        $this->tipeAudio = $tipeAudio;
    }

    public function getLokasiBaris(): string {
        return $this->lokasiBaris;
    }

    public function setLokasiBaris(string $lokasiBaris): void {
        $this->lokasiBaris = $lokasiBaris;
    }

    // ========================================================
    // IMPLEMENTASI METODE ABSTRAK
    // ========================================================

    /**
     * Hitung total harga tiket Regular
     * Total Harga = jumlah_kursi * hargaDasarTiket
     *
     * @return float
     */
    public function hitungTotalHarga(): float {
        return $this->hargaDasarTiket * $this->jumlah_kursi;
    }

    /**
     * Tampilkan informasi fasilitas TiketRegular
     *
     * @return string
     */
    public function tampilkanInfoFasilitas(): string {
        return "Studio Regular | Tipe Audio: {$this->tipeAudio} | Lokasi Baris: {$this->lokasiBaris}";
    }
}