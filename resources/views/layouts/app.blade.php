<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'ZHIB')</title>

    {{-- Global Styles --}}
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    @stack('styles')

    {{-- 🔥 CSS MODAL (LANGSUNG DISINI AGAR PASTI JALAN) 🔥 --}}
    <style>
        /* Overlay Gelap */
        #authOverlay {
            display: none; /* Sembunyi default */
            position: fixed;
            top: 0; 
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: 9998; /* Sangat tinggi */
            backdrop-filter: blur(2px);
        }
        #authOverlay.active {
            display: block !important;
        }

        /* Modal Box */
        .auth-modal {
            display: none; /* Sembunyi default */
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            z-index: 9999; /* Di atas overlay */
            width: 90%;
            max-width: 400px;
        }
        
        /* Class helper untuk menampilkan */
        .auth-modal.active {
            display: block !important; /* Paksa Tampil */
            animation: fadeIn 0.3s ease;
        }

        /* Hilangkan class hidden bawaan jika ada bentrok */
        .auth-modal.hidden {
            display: none !important;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translate(-50%, -60%); }
            to { opacity: 1; transform: translate(-50%, -50%); }
        }
    </style>
</head>

<body>

    @include('partials.header')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    {{-- 🔥 STRUKTUR POPUP (WAJIB ADA DISINI) 🔥 --}}
    @guest
        <div id="authOverlay" onclick="closeAuth()"></div>
        
        @include('auth.login-form')
        @include('auth.register-form')
        @include('auth.forgot-form')
    @endguest

    {{-- 🔥 JAVASCRIPT LOGIC 🔥 --}}
    <script>
        // Fungsi Debugging
        function openLogin() {
            console.log('Tombol Masuk Diklik!'); 
            
            const modal = document.getElementById('loginModal');
            const overlay = document.getElementById('authOverlay');
            
            // Tutup Register jika terbuka
            document.getElementById('registerModal')?.classList.remove('active');
            document.getElementById('registerModal')?.classList.add('hidden');

            if (modal && overlay) {
                modal.classList.remove('hidden'); 
                modal.classList.add('active');    
                overlay.classList.add('active');
            } else {
                // SAYA HAPUS TANDA @ DI SINI AGAR TIDAK ERROR
                console.error('Elemen Modal tidak ditemukan! Pastikan file auth sudah di-include.');
            }
        }

        function openRegister() {
            console.log('Tombol Daftar Diklik!');

            const modal = document.getElementById('registerModal');
            const overlay = document.getElementById('authOverlay');
            const forgotModal = document.getElementById('forgotModal');

            // Tutup Login jika terbuka
            document.getElementById('loginModal')?.classList.remove('active');
            document.getElementById('loginModal')?.classList.add('hidden');

            if (modal && overlay) {
                modal.classList.remove('hidden');
                modal.classList.add('active');
                overlay.classList.add('active');
            }
        }

        function closeAuth() {
            console.log('Menutup Modal...');
            const overlay = document.getElementById('authOverlay');
            const modals = document.querySelectorAll('.auth-modal');

            if (overlay) overlay.classList.remove('active');
            modals.forEach(m => {
                m.classList.remove('active');
                m.classList.add('hidden');
            });
        }
        
        // Fungsi Switch (Ganti antar modal)
        function switchToRegister() {
            closeAuth();
            setTimeout(openRegister, 100);
        }
        function switchToLogin() {
            closeAuth();
            setTimeout(openLogin, 100);
        }

        function openForgot() {
            // Jangan clear server-rendered messages saat membuka forgot
            loginModal.style.display = 'none';
            registerModal.style.display = 'none';
            overlay.style.display = 'block';
            forgotModal.style.display = 'block';
        }

        // 8. Fungsi Reset Password Action
        function goToResetPage() {
            // Redirect ke Route Laravel 'reset-password'
            window.location.href = "{{ url('/reset-password') }}";
        }
    </script>

    @stack('scripts')

</body>
</html>