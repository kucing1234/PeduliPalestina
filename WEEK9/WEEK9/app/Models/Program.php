<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    // Kolom yang boleh diisi lewat Program::create([...]) dan $program->update([...])
    protected $fillable = [
        'nama',
        'deskripsi',
        'kategori',
        'target',
        'terkumpul',
    ];

    // Persentase dana terkumpul (0-100), dipakai progress bar. Dipanggil sebagai $program->persen
    public function getPersenAttribute(): int
    {
        if ($this->target <= 0) {
            return 0;
        }
        return min(100, (int) round($this->terkumpul / $this->target * 100));
    }
}
