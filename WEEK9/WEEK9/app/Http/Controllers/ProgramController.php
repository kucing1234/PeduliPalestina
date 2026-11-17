<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProgramController extends Controller
{
    // READ: tampilkan semua program dari database
    public function index(): View
    {
        $programs = Program::all();

        return view('programs.index', compact('programs'));
    }

    // CREATE: tampilkan form tambah
    public function create(): View
    {
        return view('programs.create');
    }

    // CREATE: simpan ke database
    public function store(Request $request): RedirectResponse
    {
        Program::create($this->dataTervalidasi($request));

        return redirect()->route('programs.index')
            ->with('sukses', 'Program berhasil ditambahkan.');
    }

    // UPDATE: tampilkan form edit
    public function edit(Program $program): View
    {
        return view('programs.edit', compact('program'));
    }

    // UPDATE: simpan perubahan
    public function update(Request $request, Program $program): RedirectResponse
    {
        $program->update($this->dataTervalidasi($request));

        return redirect()->route('programs.index')
            ->with('sukses', 'Program berhasil diperbarui.');
    }

    // DELETE: hapus dari database
    public function destroy(Program $program): RedirectResponse
    {
        $program->delete();

        return redirect()->route('programs.index')
            ->with('sukses', 'Program berhasil dihapus.');
    }

    // Validasi sederhana (pendalaman validation ada di Pertemuan 10)
    private function dataTervalidasi(Request $request): array
    {
        return $request->validate([
            'nama'      => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kategori'  => 'required|string|max:100',
            'target'    => 'required|integer|min:0',
            'terkumpul' => 'required|integer|min:0|lte:target',
        ], [
            'required' => ':attribute wajib diisi.',
            'integer'  => ':attribute harus berupa angka bulat.',
            'min'      => ':attribute tidak boleh negatif.',
            'max'      => ':attribute terlalu panjang.',
            'lte'      => 'Dana terkumpul tidak boleh melebihi target.',
        ]);
    }
}
