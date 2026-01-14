<!-- <div class="hof-grid">
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
</div> -->

<section class="hall-of-fame">
    <div class="section-container">

        <div class="section-header">
            <h2 class="section-title">HALL OF FAME</h2>
            <p class="section-subtitle">
                Member dengan kontribusi dan prestasi tertinggi
            </p>
        </div>

        <div class="hof-carousel-wrapper">

            {{-- Button Left --}}
            <button class="carousel-btn left"
                    aria-label="Geser kiri"
                    onclick="scrollHofCarousel(-1)">
                ‹
            </button>

            {{-- Carousel --}}
            <div class="hof-carousel" id="hofCarousel">

                @forelse ($hallOfFame as $user)
                    <div class="hof-card">

                        @guest
                            <a href="#" onclick="openLogin(); return false;" class="hof-link">
                        @else
                            <a href="{{ route('profile.show', ['user' => \Illuminate\Support\Str::slug($user->nama)]) }}"
                               class="hof-link">
                        @endguest

                            <div class="hof-avatar">
                                <img
                                    src="{{ $user->foto_profil_url
                                            ? asset($user->foto_profil_url)
                                            : asset('image/default-avatar.jpg') }}"
                                    alt="{{ $user->nama }}"
                                >
                            </div>  

                            <div class="hof-info">
                                <div class="hof-name">
                                    {{ \Illuminate\Support\Str::limit($user->nama, 14) }}
                                </div>

                                <div class="hof-level">
                                    Level {{ $user->level_terkini ?? 1 }}
                                </div>

                                <div class="hof-xp">
                                    {{ number_format($user->xp_total ?? 0) }} XP
                                </div>
                            </div>

                        </a>
                    </div>
                @empty
                    {{-- Placeholder --}}
                    @for ($i = 0; $i < 8; $i++)
                        <div class="hof-card placeholder">
                            <div class="hof-avatar skeleton"></div>
                            <div class="hof-info">
                                <div class="skeleton name"></div>
                                <div class="skeleton text"></div>
                            </div>
                        </div>
                    @endfor
                @endforelse

            </div>

            {{-- Button Right --}}
            <button class="carousel-btn right"
                    aria-label="Geser kanan"
                    onclick="scrollHofCarousel(1)">
                ›
            </button>

        </div>

    </div>
</section>

@push('scripts')
<script>
function scrollHofCarousel(direction) {
    const carousel = document.getElementById('hofCarousel');
    if (!carousel) return;

    const cardWidth = carousel.querySelector('.hof-card')?.offsetWidth || 140;
    carousel.scrollBy({
        left: direction * cardWidth * 3,
        behavior: 'smooth'
    });
}
</script>
@endpush
