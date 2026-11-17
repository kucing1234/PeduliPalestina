@extends('layouts.app')

@section('judul', 'Kelola Program')

@section('konten')
<section id="kelola-program">
  <div class="crud-bar">
    <h2>Program PeduliPalestina</h2>
    <a class="btn btn-edit" href="{{ route('programs.create') }}">+ Tambah Program</a>
  </div>

  @if (session('sukses'))
    <p class="alert alert-sukses" role="status">{{ session('sukses') }}</p>
  @endif

  <div class="tabel-wrap">
    <table class="tabel">
      <caption class="sr-only">Daftar program bantuan dari database</caption>
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Nama Program</th>
          <th scope="col">Deskripsi</th>
          <th scope="col">Dana Terkumpul</th>
          <th scope="col">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($programs as $program)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>
              <strong>{{ $program->nama }}</strong><br>
              <span class="badge badge-berjalan">{{ $program->kategori }}</span>
            </td>
            <td>{{ \Illuminate\Support\Str::limit($program->deskripsi, 80) }}</td>
            <td>
              <div class="bar" aria-hidden="true"><span style="width: {{ $program->persen }}%"></span></div>
              <small>Rp {{ number_format($program->terkumpul, 0, ',', '.') }} dari Rp {{ number_format($program->target, 0, ',', '.') }} ({{ $program->persen }}%)</small>
            </td>
            <td>
              <div class="aksi">
                <a class="btn btn-edit" href="{{ route('programs.edit', $program) }}">Edit</a>
                <form method="POST" action="{{ route('programs.destroy', $program) }}"
                      data-nama="{{ $program->nama }}"
                      onsubmit="return confirm('Yakin ingin menghapus program ini?\n' + this.dataset.nama)">
                  @csrf
                  @method('DELETE')
                  <button type="submit">Hapus</button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr><td colspan="5" class="kosong">Belum ada program. Klik "+ Tambah Program" untuk menambah.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</section>
@endsection
