@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/events.css') }}">
@endsection

@section('content')
<section class="section">
    <div class="section-container">

        <h2>Event yang Akan Diikuti</h2>

        @forelse($upcomingEvents as $event)
            <div class="event-item">
                <h3>{{ $event->judul }}</h3>
                <p>{{ $event->start_date->format('d M Y') }}</p>
                <span class="badge upcoming">Akan Datang</span>
            </div>
        @empty
            <p>Tidak ada event yang akan diikuti.</p>
        @endforelse

        <hr style="margin:40px 0">

        <h2>Event yang Sudah Diikuti</h2>

        @forelse($pastEvents as $event)
            <div class="event-item">
                <h3>{{ $event->judul }}</h3>
                <p>{{ $event->start_date->format('d M Y') }}</p>
                <span class="badge finished">Selesai</span>
            </div>
        @empty
            <p>Belum ada event yang selesai.</p>
        @endforelse

    </div>
</section>
@endsection
