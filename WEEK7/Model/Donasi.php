<?php
/* =========================================================
   Model/Donasi.php - data dan aturan (business data) untuk donasi
   Dipakai oleh LembagaController::process()
   ========================================================= */
require_once __DIR__ . '/Lembaga.php';

class Donasi
{
    public const NOMINAL_MINIMAL = 1000;
    public const UKURAN_BUKTI_MAKS = 2 * 1024 * 1024; // 2 MB

    private string $nama;
    private string $programId;
    private int $nominal;
    private string $doa;

    public function __construct(array $input)
    {
        $nama = trim((string) ($input['nama'] ?? ''));
        $this->nama      = $nama === '' ? 'Hamba Allah' : self::potong($nama, 80);
        $this->programId = trim((string) ($input['program'] ?? ''));
        $nominal         = filter_var($input['nominal'] ?? '', FILTER_VALIDATE_INT);
        $this->nominal   = $nominal === false ? 0 : $nominal;
        $this->doa       = self::potong(trim((string) ($input['doa'] ?? '')), 300);
    }

    // Potong teks maksimal $maks karakter (aman untuk UTF-8, tanpa ekstensi mbstring)
    private static function potong(string $teks, int $maks): string
    {
        return preg_match('/^.{0,' . $maks . '}/us', $teks, $m) ? $m[0] : '';
    }

    public function getNama(): string      { return $this->nama; }
    public function getProgramId(): string { return $this->programId; }
    public function getNominal(): int      { return $this->nominal; }
    public function getDoa(): string       { return $this->doa; }

    // Mengembalikan daftar pesan error (array kosong = valid)
    public function validasi(Lembaga $lembaga, ?array $bukti = null): array
    {
        $errors = [];

        if ($lembaga->cariProgram($this->programId) === null) {
            $errors[] = 'Program bantuan yang dipilih tidak ditemukan.';
        }
        if ($this->nominal < self::NOMINAL_MINIMAL) {
            $errors[] = 'Nominal donasi minimal Rp ' . number_format(self::NOMINAL_MINIMAL, 0, ',', '.') . '.';
        }
        if ($bukti !== null && ($bukti['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_NO_FILE) {
            if ($bukti['error'] !== UPLOAD_ERR_OK) {
                $errors[] = 'Bukti transfer gagal diunggah. Silakan coba lagi.';
            } elseif ($bukti['size'] > self::UKURAN_BUKTI_MAKS) {
                $errors[] = 'Ukuran bukti transfer maksimal 2 MB.';
            } elseif (@getimagesize($bukti['tmp_name']) === false) {
                $errors[] = 'Bukti transfer harus berupa gambar.';
            }
        }

        return $errors;
    }
}
