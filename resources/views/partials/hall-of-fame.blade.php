<div class="hof-grid">
    @forelse($users as $user)
    <a href="{{ url('/profile') }}?user={{ \Illuminate\Support\Str::slug($user->nama) }}" class="hof-card">
        <img class="avatar" src="{{ asset($user->foto_profil_url ?? 'image/download (13).jpg') }}">
        <h4>{{ $user->nama }}</h4>
        <h6>Level {{ $user->level_terkini }}</h6>
        <div class="badges">
            @foreach($user->badges as $badge)
            <img src="{{ asset($badge->image_url ?? 'image/badges/badge (1).png') }}" alt="badge">
            @endforeach
        </div>
    </a>
    @empty
    <p>Tidak ada data Hall of Fame.</p>
    @endforelse
</div>