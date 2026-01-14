<div id="registerModal" class="auth-modal hidden">
    <div class="auth-modal-content">

        <button class="auth-close" onclick="closeRegister()">×</button>

        <h2>Daftar Akun ZHIB</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label for="username">Username</label>
                <input
                    type="text"
                    name="username"
                    id="username"
                    placeholder="Username"
                    required
                >
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    placeholder="Email aktif"
                    required
                >
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    placeholder="Password"
                    required
                >
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input
                    type="password"
                    name="password_confirmation"
                    id="password_confirmation"
                    placeholder="Ulangi password"
                    required
                >
            </div>

            <div class="form-group checkbox">
                <label>
                    <input type="checkbox" name="terms" required>
                    Saya setuju dengan <a href="/tentang_kami" target="_blank">syarat dan ketentuan</a>
                </label>
            </div>

            <button type="submit" class="btn-primary">
                Daftar
            </button>
        </form>

        <p class="auth-switch">
            Sudah punya akun?
            <a href="#" onclick="switchToLogin()">Login di sini</a>
        </p>
    </div>
</div>
