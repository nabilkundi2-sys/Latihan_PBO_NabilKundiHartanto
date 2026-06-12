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

    /**
     * Constructor TiketIMAX
     *
     * @param int    $id_tiket
     * @param string $nama_film
     * @param string $jadwal_tayang
     * @param int    $jumlah_kursi
     * @param float  $hargaDasarTiket
     * @param string $kacamata3dId
     * @param string $efekGerakFitur
     */
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
    // GETTER & SETTER
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
     * (Tambahan biaya 50% dari harga dasar untuk layanan IMAX)
     *
     * @return float
     */
    public function hitungTotalHarga(): float {
        $biayaTambahan = $this->hargaDasarTiket * 0.50;
        return ($this->hargaDasarTiket + $biayaTambahan) * $this->jumlah_kursi;
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