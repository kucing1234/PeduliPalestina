<?php
/* =========================================================
   Lembaga.php - class Lembaga (Week 6: setara class President)
   Data: nama, periode, programs. Behavior: getProfile(), getPrograms()
   ========================================================= */
require_once __DIR__ . '/Program.php';

class Lembaga
{
    // Property (data) - private = encapsulation
    private string $nama;
    private string $periode;
    private int $jumlahDonatur;
    private int $penerimaManfaat;
    private array $programs = [];   // berisi object Program

    // Constructor
    public function __construct(
        string $nama,
        string $periode,
        int $jumlahDonatur,
        int $penerimaManfaat,
        array $programs = []
    ) {
        $this->nama            = $nama;
        $this->periode         = $periode;
        $this->jumlahDonatur   = $jumlahDonatur;
        $this->penerimaManfaat = $penerimaManfaat;
        foreach ($programs as $program) {
            $this->tambahProgram($program);
        }
    }

    // Getter
    public function getNama(): string         { return $this->nama; }
    public function getPeriode(): string      { return $this->periode; }
    public function getJumlahDonatur(): int   { return $this->jumlahDonatur; }
    public function getPenerimaManfaat(): int { return $this->penerimaManfaat; }

    // Behavior: tambah program (hanya menerima object Program)
    public function tambahProgram(Program $program): void
    {
        $this->programs[] = $program;
    }

    // Behavior: getPrograms() -> array object Program
    public function getPrograms(): array
    {
        return $this->programs;
    }

    public function totalTerkumpul(): int
    {
        return array_sum(array_map(fn($p) => $p->getTerkumpul(), $this->programs));
    }

    public function totalTarget(): int
    {
        return array_sum(array_map(fn($p) => $p->getTarget(), $this->programs));
    }

    public function persenTotal(): int
    {
        $target = $this->totalTarget();
        if ($target <= 0) {
            return 0;
        }
        return min(100, (int) round($this->totalTerkumpul() / $target * 100));
    }

    // Conditional: [label, kelas CSS] untuk keseluruhan kampanye
    public function status(): array
    {
        $persen = $this->persenTotal();
        if ($persen >= 100) {
            return ['Tercapai', 'tercapai'];
        } elseif ($persen >= 80) {
            return ['Hampir Tercapai', 'hampir'];
        } elseif ($persen >= 60) {
            return ['Berjalan', 'berjalan'];
        }
        return ['Butuh Dukungan', 'mendesak'];
    }

    // Behavior: getProfile() -> data profil siap ditampilkan halaman
    public function getProfile(): array
    {
        list($label, $kelas) = $this->status();
        return [
            'nama'           => $this->nama,
            'periode'        => $this->periode,
            'jumlah_program' => count($this->programs),
            'persen'         => $this->persenTotal(),
            'status_label'   => $label,
            'status_kelas'   => $kelas,
        ];
    }

    // Data per-id untuk panel detail di JavaScript
    public function getProgramsById(): array
    {
        $hasil = [];
        foreach ($this->programs as $p) {
            $hasil[$p->getId()] = $p->toArray();
        }
        return $hasil;
    }
}