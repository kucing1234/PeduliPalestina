@extends('layouts.app')

@section('judul', 'Tambah Program')

@section('konten')
<section id="form-program">
  <h2>Tambah Program</h2>
  <form class="form-program" method="POST" action="{{ route('programs.store') }}">
    @csrf
    @include('programs._form')
    <button type="submit">Simpan</button>
    <a class="btn btn-batal" href="{{ route('programs.index') }}">Batal</a>
  </form>
</section>
@endsection
