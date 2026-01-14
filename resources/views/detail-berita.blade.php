@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-container">

        <h1>{{ $berita->judul }}</h1>

        @if($berita->gambar_url)
        <img src="{{ asset($berita->gambar_url) }}" style="max-width:100%;margin:20px 0;">
        @endif

        <div class="berita-konten">
            {!! nl2br(e($berita->konten)) !!}
        </div>

    </div>
</section>
@endsection