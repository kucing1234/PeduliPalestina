@extends('layouts.app')

@section('judul', 'Edit Program')

@section('konten')
<section id="form-program">
  <h2>Edit Program</h2>
  <form class="form-program" method="POST" action="{{ route('programs.update', $program) }}">
    @csrf
    @method('PUT')
    @include('programs._form')
    <button type="submit">Update</button>
    <a class="btn btn-batal" href="{{ route('programs.index') }}">Batal</a>
  </form>
</section>
@endsection
