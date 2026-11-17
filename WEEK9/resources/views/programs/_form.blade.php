{{-- Form dipakai bersama oleh create dan edit. Variabel $program hanya ada saat edit. --}}
<div>
  <label for="nama">Nama Program</label>
  <input type="text" id="nama" name="nama" value="{{ old('nama', $program->nama ?? '') }}" @class(['invalid' => $errors->has('nama')]) required>
  @error('nama') <p class="error-teks">{{ $message }}</p> @enderror
</div>

<div>
  <label for="kategori">Kategori</label>
  <input type="text" id="kategori" name="kategori" value="{{ old('kategori', $program->kategori ?? '') }}" @class(['invalid' => $errors->has('kategori')]) required>
  @error('kategori') <p class="error-teks">{{ $message }}</p> @enderror
</div>

<div>
  <label for="deskripsi">Deskripsi</label>
  <textarea id="deskripsi" name="deskripsi" rows="4" @class(['invalid' => $errors->has('deskripsi')]) required>{{ old('deskripsi', $program->deskripsi ?? '') }}</textarea>
  @error('deskripsi') <p class="error-teks">{{ $message }}</p> @enderror
</div>

<div>
  <label for="target">Target Dana (Rp)</label>
  <input type="number" id="target" name="target" min="0" value="{{ old('target', $program->target ?? 0) }}" @class(['invalid' => $errors->has('target')]) required>
  @error('target') <p class="error-teks">{{ $message }}</p> @enderror
</div>

<div>
  <label for="terkumpul">Dana Terkumpul (Rp)</label>
  <input type="number" id="terkumpul" name="terkumpul" min="0" value="{{ old('terkumpul', $program->terkumpul ?? 0) }}" @class(['invalid' => $errors->has('terkumpul')]) required>
  @error('terkumpul') <p class="error-teks">{{ $message }}</p> @enderror
</div>
