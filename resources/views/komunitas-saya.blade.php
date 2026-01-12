@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
<link rel="stylesheet" href="{{ asset('css/komunitas-saya.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
@endsection

@section('content')

<div class="my-comm-page">
    <div class="container">

        <div class="page-header">
            <h1 class="page-title">Grup Saya</h1>
            <div class="search-box">
                <i class="fa-solid fa-magnifying-glass search-icon"></i>
                <form method="GET" action="{{ route('komunitas.my') }}">
                    <input type="text" name="q" id="searchInput" placeholder="Search"
                        value="{{ isset($q) ? e($q) : request('q') }}" onkeyup="searchMyCommunity()">
                </form>
            </div>
        </div>

        <div class="community-list" id="communityList">
            @if(isset($komunitas) && $komunitas->count())
            @foreach($komunitas as $k)
            <div class="comm-card">
                <div class="comm-img">
                    <img src="{{ asset($k->icon_url ?? 'image/img (9).jpg') }}" alt="{{ $k->nama }}">
                </div>
                <div class="comm-content">
                    <h2 class="comm-title">{{ $k->nama }}</h2>
                    <p class="comm-desc">{{ \Illuminate\Support\Str::limit($k->deskripsi, 200) }}</p>
                </div>
                <div class="comm-action">
                    <a href="{{ url('/komunitas/'.$k->id) }}" class="btn-open-chat">Lihat Komunitas <i
                            class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>
            @endforeach
            @else
            <!-- If backend provided zero results we still render the list empty and show the no results message -->
            @endif

        </div>

        @php
        $isSearch = isset($q) && trim($q) !== '';
        $initialMessage = $isSearch ? 'Tidak ada komunitas yang cocok.' : 'Anda belum bergabung dengan komunitas
        apapun.';
        @endphp
        <p id="noResults" class="no-results {{ (isset($komunitas) && $komunitas->count() === 0) ? '' : 'hidden' }}"
            style="text-align:center; color:#666; margin-top:20px;"
            data-empty-text="Anda belum bergabung dengan komunitas apapun."
            data-search-text="Tidak ada komunitas yang cocok.">
            {{ $initialMessage }}
        </p>
    </div>
</div>
</div>

@section('scripts')
<script>
// Profile dropdown handled by header partial

// 2. SEARCH FUNCTION (Client Side Search) – improved
function searchMyCommunity() {
    const inputEl = document.getElementById('searchInput');
    const noEl = document.getElementById('noResults');
    const query = inputEl ? inputEl.value.trim().toLowerCase() : '';
    const tokens = query.split(/\s+/).filter(Boolean);
    const cards = Array.from(document.getElementsByClassName('comm-card'));
    let anyVisible = false;

    cards.forEach(card => {
        const titleEl = card.querySelector('.comm-title');
        const descEl = card.querySelector('.comm-desc');
        const text = ((titleEl ? titleEl.textContent : '') + ' ' + (descEl ? descEl.textContent : ''))
            .toLowerCase();

        // Match when all tokens are present (AND search) — fallback: match empty query
        const matched = tokens.length === 0 || tokens.every(t => text.includes(t));

        card.style.display = matched ? 'flex' : 'none';
        if (matched) anyVisible = true;
    });

    if (noEl) {
        // Update message depending on whether user typed a query (search) or not (no memberships)
        const queryValue = query.trim();
        if (!anyVisible) {
            const text = queryValue.length === 0 ? (noEl.dataset.emptyText ||
                'Anda belum bergabung dengan komunitas apapun.') : (noEl.dataset.searchText ||
                'Tidak ada komunitas yang cocok.');
            noEl.textContent = text;
            noEl.classList.remove('hidden');
        } else {
            noEl.classList.add('hidden');
        }
    }
}

// Attach input listener (works with onkeyup too) for better UX
document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('searchInput');
    if (input) input.addEventListener('input', searchMyCommunity);

    // Run initial filter so server-side results and no-results message are synchronized
    searchMyCommunity();
});
</script>
@endsection