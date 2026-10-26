<?php
/* =========================================================
   Program.php - class Program (Week 6: OOP)
   ========================================================= */
class Program
{
    // Encapsulation: property private, hanya bisa diakses lewat method
    private string $id;
    private string $title;
    private string $description;
    private int $target;
    private int $terkumpul;
    private string $category;

    // Constructor: dipanggil saat object dibuat dengan `new Program(...)`
    public function __construct(
        string $id,
        string $title,
        string $description,
        int $target,
        int $terkumpul,
        string $category
    ) {
        $this->id          = $id;
        $this->title       = $title;
        $this->description = $description;
        $this->target      = $target;
        $this->terkumpul   = max(0, $terkumpul);
        $this->category    = $category;
    }

    // Getter (akses baca ke property private)
    public function getId(): string          { return $this->id; }
    public function getTitle(): string       { return $this->title; }
    public function getDescription(): string { return $this->description; }
    public function getTarget(): int         { return $this->target; }
    public function getTerkumpul(): int      { return $this->terkumpul; }
    public function getCategory(): string    { return $this->category; }

    // Method: perilaku object
    public function persen(): int
    {
        if ($this->target <= 0) {
            return 0;
        }
        return min(100, (int) round($this->terkumpul / $this->target * 100));
    }

    // Conditional: kembalikan [label, kelas CSS]
    public function status(): array
    {
        $persen = $this->persen();
        if ($persen >= 100) {
            return ['Tercapai', 'tercapai'];
        } elseif ($persen >= 80) {
            return ['Hampir Tercapai', 'hampir'];
        } elseif ($persen >= 60) {
            return ['Berjalan', 'berjalan'];
        }
        return ['Butuh Dukungan', 'mendesak'];
    }

    // Untuk JSON (API dan JavaScript)
    public function toArray(): array
    {
        return [
            'id'          => $this->id,
            'title'       => $this->title,
            'description' => $this->description,
            'target'      => $this->target,
            'terkumpul'   => $this->terkumpul,
            'category'    => $this->category,
            'persen'      => $this->persen(),
        ];
    }
}