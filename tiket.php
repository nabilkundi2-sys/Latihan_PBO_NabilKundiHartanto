<?php
declare(strict_types=1);

/**
 * ============================================================
 * Abstract Class: Tiket
 * ============================================================
 *
 * Deskripsi:
 *   - Properti terenkapsulasi, dipetakan dari kolom database tabel_tiket.
 *   - Mendeklarasikan metode abstrak untuk perhitungan harga dan info fasilitas.
 *
 * @package ShowroomInventory
 */
abstract class Tiket {

    // ========================================================
    // PROPERTI TERENKAPSULASI
    // ========================================================

    /** @var int ID tiket, dipetakan dari kolom id_tiket */
    protected int $id_tiket;

    /** @var string Nama film, dipetakan dari kolom nama_film */
    protected string $nama_film;

    /** @var string Jadwal tayang, dipetakan dari kolom jadwal_tayang */
    protected string $jadwal_tayang;

    /** @var int Jumlah kursi, dipetakan dari kolom jumlah_kursi */
    protected int $jumlah_kursi;

    /** @var float Harga dasar tiket, dipetakan dari kolom harga_dasar_tiket */
    protected float $hargaDasarTiket;

    // ========================================================
    // KONSTRUKTOR: Inisialisasi properti dari database
    // ========================================================

    /**
     * Constructor - Memetakan nilai dari database
     *
     * @param int    $id_tiket
     * @param string $nama_film
     * @param string $jadwal_tayang
     * @param int    $jumlah_kursi
     * @param float  $hargaDasarTiket
     */
    public function __construct(
        int $id_tiket,
        string $nama_film,
        string $jadwal_tayang,
        int $jumlah_kursi,
        float $hargaDasarTiket
    ) {
        $this->id_tiket       = $id_tiket;
        $this->nama_film      = $nama_film;
        $this->jadwal_tayang  = $jadwal_tayang;
        $this->jumlah_kursi   = $jumlah_kursi;
        $this->hargaDasarTiket = $hargaDasarTiket;
    }

    // ========================================================
    // METODE ABSTRAK
    // ========================================================

    /**
     * Hitung total harga tiket, harus diimplementasikan di subclass
     *
     * @return float
     */
    abstract public function hitungTotalHarga(): float;

    /**
     * Tampilkan informasi fasilitas tambahan tiket, harus diimplementasikan di subclass
     *
     * @return string
     */
    abstract public function tampilkanInfoFasilitas(): string;
}