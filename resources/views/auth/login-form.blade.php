<div id="loginModal" class="auth-modal hidden">
    <div class="auth-modal-content">

        <button class="auth-close" onclick="closeLogin()">×</button>

        <h2>Masuk ke ZHIB</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="login">Username atau Email</label>
                <input
                    type="text"
                    name="login"
                    id="login"
                    placeholder="Masukkan username atau email"
                    required
                >
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    placeholder="Masukkan password"
                    required
                >
            </div>

            <button type="submit" class="btn-primary">
                Login
            </button>
        </form>

        <p class="auth-switch">
            Belum punya akun?
            <a href="#" onclick="switchToRegister()">Daftar di sini</a>
        </p>
    </div>
</div>
