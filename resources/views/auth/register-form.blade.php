<div class="auth-modal" id="registerModal">
    <button class="close-btn" onclick="closeAuth()">×</button>
    <h2>Buat Akun</h2>

    @if(session('status'))
    <div class="success-message" style="color:#00695c;margin-bottom:8px;">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <label>Username</label>
        <input type="text" name="username" id="username" placeholder="Username" required value="{{ old('username') }}">

        <label>Email</label>
        <input type="email" name="email"  id="email" placeholde required value="{{ old('email') }}">

        <label>Password</label>
        <input type="password" name="password" id="password" placeholder="Password" required>

        <label>Konfirmasi Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Ulangi Password" required>

        <div class="register-agree">
            <input type="checkbox" name="terms" {{ old('terms') ? 'checked' : '' }}>
            <span class="switch-text">Saya setuju dengan <a href="/tentang_kami" target="_blank">Syarat dan Ketentuan</a></span>
        </div>

        <button type="submit" class="primary-btn">Buat Akun</button>
    </form>

    <p class="switch-text">
        Sudah Punya Akun?
        <a href="#" onclick="switchToLogin()">Masuk</a>
    </p>
</div>