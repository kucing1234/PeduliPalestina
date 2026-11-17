<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('judul', 'PeduliPalestina') - PeduliPalestina</title>
  <link rel="icon" href="{{ asset('images/favicon.svg') }}" type="image/svg+xml">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <script src="{{ asset('js/menu.js') }}" defer></script>
</head>
<body>
  <a class="skip-link" href="#main">Lewati ke konten utama</a>

  <header>
    <div class="logo">
      <a href="{{ route('programs.index') }}"><img src="{{ asset('images/favicon.svg') }}" alt="" width="32" height="32">Peduli<span>Palestina</span></a>
    </div>
    <button class="menu-toggle" type="button" aria-expanded="false" aria-controls="menu" aria-label="Buka menu">
      <span></span><span></span><span></span>
    </button>
    <nav id="menu" aria-label="Navigasi utama">
      <ul>
        <li><a href="{{ route('programs.index') }}">Kelola Program</a></li>
        <li><a href="{{ route('programs.create') }}" class="nav-cta">Tambah Program</a></li>
      </ul>
    </nav>
  </header>

  <main id="main">
    @yield('konten')
  </main>

  <footer>
    <p>&copy; {{ date('Y') }} PeduliPalestina - Lembaga Penggalangan Dana Kemanusiaan Terpercaya</p>
  </footer>
</body>
</html>
