@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
<link rel="stylesheet" href="{{ asset('css/detail_berita.css') }}">
@endsection

@section('content')
<main class="news-page">
  <div class="article-container">

    <div class="nav-left">
      <a href="{{ url('/home') }}" class="nav-item">Home</a>

      <div class="nav-dropdown">
        <button class="nav-link" type="button">
          Komunitas <span class="arrow">▾</span>
        </button>
        <div class="nav-dropdown-menu">
          <a href="{{ url('/komunitas-saya') }}">Komunitas Saya</a>
          <a href="{{ url('/cari-komunitas') }}">Cari Komunitas</a>
        </div>
      </div>

      <div class="nav-dropdown">
        <button class="nav-link" type="button">
          Event <span class="arrow">▾</span>
        </button>
        <div class="nav-dropdown-menu">
          <a href="{{ url('/event') }}">Cari Event</a>
          <a href="{{ url('/riwayat-event') }}">Riwayat Event</a>
        </div>
      </div>
    </div>

    <div class="logo">ZHIB</div>

    <div class="nav-right">
      <div class="profile-dropdown" id="profileDropdown">
        <button class="profile-navbar" id="profileToggle">
          <div class="profile-text">
            <div class="profile-name">Windah Batubara</div>
            <div class="profile-level">LVL. 999</div>
          </div>
          <img src="{{ asset('image/download (13).jpg') }}" class="nav-avatar" alt="Profile">
        </button>

        <div class="profile-menu">
          <a href="{{ url('/profile') }}">Profil</a>
          <a href="{{ url('/profile') }}?edit=true">Edit Profil</a>
          <hr>
          <a href="{{ url('/') }}" class="logout">Logout</a>
        </div>
      </div>
    </div>

  </div>
  </header>

  <main class="news-page">
    <div class="article-container">

      <div class="article-image-wrapper">
        <img src="{{ asset('image/img (2).jpg') }}" alt="Event Olahraga" class="article-img">
      </div>

      <h1 class="article-title">Komunitas Olahraga Lokal Gelar Event Kebersamaan</h1>

      <div class="article-content">
        <p>
          Sebuah komunitas olahraga lokal menggelar event bersama yang diikuti oleh puluhan peserta dari berbagai latar belakang. Acara ini berlangsung dengan antusias dan menjadi ajang berkumpulnya para pecinta olahraga yang memiliki minat serupa.
        </p>
        <p>
          Event ini tidak hanya berfokus pada kompetisi, tetapi juga pada kebersamaan dan interaksi antaranggota komunitas. Para peserta terlihat aktif mengikuti rangkaian acara, mulai dari sesi permainan hingga diskusi santai setelah event berlangsung.
        </p>
        <p>
          Menurut panitia, acara ini diselenggarakan sebagai wadah untuk mempererat hubungan antaranggota serta membuka kesempatan bagi masyarakat yang ingin bergabung dalam komunitas olahraga. Konsep event dibuat terbuka agar peserta baru dapat beradaptasi dengan nyaman.
        </p>
        <p>
          Melalui event ini, komunitas berharap dapat membangun lingkungan yang positif, aktif, dan berkelanjutan, sekaligus mendorong lahirnya event serupa di masa mendatang.
        </p>
      </div>

    </div>
  </main>

  @endsection

  @section('scripts')
  <script>
    // Profile dropdown handled by header partial
  </script>
  @endsection