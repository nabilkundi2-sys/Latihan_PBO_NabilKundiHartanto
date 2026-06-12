<?php
declare(strict_types=1);

require_once 'tiket.php';

/**
 * ============================================================
 * Class: TiketIMAX
 * ============================================================
 *
 * Deskripsi:
 *   - Subclass konkrit dari Tiket untuk studio IMAX.
 *   - Properti tambahan: kacamata3dId dan efekGerakFitur.
 *
 * @package ShowroomInventory
 */
class TiketIMAX extends Tiket {

    // ========================================================
    // PROPERTI TAMBAHAN
    // ========================================================

    /** @var string ID kacamata 3D yang dipinjamkan */
    private string $kacamata3dId;

    /** @var string Fitur efek gerak (misalnya: IMAX with Laser, 4DX) */
    private string $efekGerakFitur;

    // ========================================================
    // KONSTRUKTOR
    // ========================================================

    public function __construct(
        int $id_tiket,
        string $nama_film,
        string $jadwal_tayang,
        int $jumlah_kursi,
        float $hargaDasarTiket,
        string $kacamata3dId,
        string $efekGerakFitur
    ) {
        parent::__construct($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $hargaDasarTiket);
        $this->kacamata3dId   = $kacamata3dId;
        $this->efekGerakFitur = $efekGerakFitur;
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

    public function getKacamata3dId(): string {
        return $this->kacamata3dId;
    }

    public function setKacamata3dId(string $kacamata3dId): void {
        $this->kacamata3dId = $kacamata3dId;
    }

    public function getEfekGerakFitur(): string {
        return $this->efekGerakFitur;
    }

    public function setEfekGerakFitur(string $efekGerakFitur): void {
        $this->efekGerakFitur = $efekGerakFitur;
    }

    // ========================================================
    // IMPLEMENTASI METODE ABSTRAK
    // ========================================================

    /**
     * Hitung total harga tiket IMAX
     * Total Harga = (jumlah_kursi * hargaDasarTiket) + 35000
     *
     * @return float
     */
    public function hitungTotalHarga(): float {
        return ($this->jumlah_kursi * $this->hargaDasarTiket) + 35000;
    }

    /**
     * Tampilkan informasi fasilitas TiketIMAX
     *
     * @return string
     */
    public function tampilkanInfoFasilitas(): string {
        return "Studio IMAX | Kacamata 3D ID: {$this->kacamata3dId} | Efek Gerak: {$this->efekGerakFitur}";
    }
}