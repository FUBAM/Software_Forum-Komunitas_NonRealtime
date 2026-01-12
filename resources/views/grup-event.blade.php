@extends('layouts.app')

@section('title', 'Events - KOMUNITAS DESAIN INDONESIA')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/grup-event.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
@endsection

@section('content')
<header class="event-header">
  <div class="header-left">
    <a href="{{ url('/chat') }}" class="header-link">Chat</a>
    <a href="{{ url('/grup-event') }}" class="header-link active">Events</a>
  </div>

  <div class="header-center">
    <h1>KOMUNITAS DESAIN INDONESIA</h1>
  </div>

  <div class="header-right">
    <div class="search-pill">
      <i class="fa-solid fa-magnifying-glass"></i>
      <input type="text" placeholder="Search">
    </div>
  </div>
</header>

<main class="event-container">

  <section class="section-group">
    <h2 class="section-title">KEGIATAN MENDATANG</h2>

    <div class="activity-grid">
      <div class="activity-card">
        <h3>Kelas Dasar UI/UX Design dengan Figma</h3>
        <div class="meta-info">
          <div class="meta-item">
            <i class="fa-regular fa-calendar"></i> 15 Desember 2025
          </div>
          <div class="meta-item">
            <i class="fa-solid fa-location-dot"></i> Bento Kopi JCM, Yogyakarta
          </div>
          <div class="meta-item status-registered">
            <i class="fa-solid fa-clipboard-check"></i> Terdaftar
          </div>
        </div>
      </div>

      <div class="activity-card">
        <h3>Workshop Design System untuk Pemula</h3>
        <div class="meta-info">
          <div class="meta-item">
            <i class="fa-regular fa-calendar"></i> 20 Desember 2025
          </div>
          <div class="meta-item">
            <i class="fa-solid fa-location-dot"></i> Co-Working Space, Sleman
          </div>
          <div class="meta-item status-registered">
            <i class="fa-solid fa-clipboard-check"></i> Terdaftar
          </div>
        </div>
      </div>

      <div class="activity-card">
        <h3>Sharing Session: Freelance Designer</h3>
        <div class="meta-info">
          <div class="meta-item">
            <i class="fa-regular fa-calendar"></i> 15 Januari 2026
          </div>
          <div class="meta-item">
            <i class="fa-solid fa-location-dot"></i> Online (Zoom)
          </div>
          <div class="meta-item status-registered">
            <i class="fa-solid fa-clipboard-check"></i> Terdaftar
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section-group">
    <h2 class="section-title">LOMBA MENDATANG</h2>

    <div class="competition-grid">
      <div class="comp-card">
        <div class="comp-img">
          <img src="{{ asset('image/img (9).jpg') }}" alt="Poster Lomba">
        </div>
        <div class="comp-content">
          <h4>Kompetisi Offline Mobile Legend</h4>
          <div class="meta-info">
            <div class="meta-item">
              <i class="fa-regular fa-calendar"></i> 7 Januari 2026
            </div>
            <div class="meta-item">
              <i class="fa-solid fa-location-dot"></i> Yogyakarta
            </div>
          </div>
        </div>
      </div>

      <div class="comp-card">
        <div class="comp-img">
          <img src="{{ asset('image/img (9).jpg') }}" alt="Poster Lomba">
        </div>
        <div class="comp-content">
          <h4>Hackathon UI/UX Nasional</h4>
          <div class="meta-info">
            <div class="meta-item">
              <i class="fa-regular fa-calendar"></i> 10 Februari 2026
            </div>
            <div class="meta-item">
              <i class="fa-solid fa-location-dot"></i> Jakarta
            </div>
          </div>
        </div>
      </div>

      <div class="comp-card">
        <div class="comp-img">
          <img src="{{ asset('image/img (9).jpg') }}" alt="Poster Lomba">
        </div>
        <div class="comp-content">
          <h4>Lomba Ilustrasi Karakter 2026</h4>
          <div class="meta-info">
            <div class="meta-item">
              <i class="fa-regular fa-calendar"></i> 1 Maret 2026
            </div>
            <div class="meta-item">
              <i class="fa-solid fa-location-dot"></i> Bandung
            </div>
          </div>
        </div>
      </div>

      <div class="comp-card">
        <div class="comp-img">
          <img src="{{ asset('image/img (9).jpg') }}" alt="Poster Lomba">
        </div>
        <div class="comp-content">
          <h4>Design Sprint Challenge</h4>
          <div class="meta-info">
            <div class="meta-item">
              <i class="fa-regular fa-calendar"></i> 5 April 2026
            </div>
            <div class="meta-item">
              <i class="fa-solid fa-location-dot"></i> Surabaya
            </div>
          </div>
        </div>
      </div>

    </div>

    <div class="slider-nav">
      <button class="nav-btn"><i class="fa-solid fa-chevron-left"></i></button>
      <button class="nav-btn"><i class="fa-solid fa-chevron-right"></i></button>
    </div>
  </section>

</main>
@endsection