<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Sigma</title>
    <link rel="stylesheet" href="/sigma/public/css/register.css">
</head>

<body>
    <div class="register-container">
        <!-- Left Side - Form -->
        <div class="register-form-section">
            <div class="register-form-wrapper">
                <div class="register-logo">
                    <h1>SIGMA</h1>
                    <p>Sistem Manajemen Assessment</p>
                </div>

                <div class="register-form">
                    <h3>Daftar Akun Baru</h3>
                    <p class="subtitle">Buat akun Anda untuk memulai perjalanan belajar</p>

                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>

                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" name="name" id="name" class="form-control-custom" placeholder="Masukkan nama lengkap Anda" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" name="email" id="email" class="form-control-custom" placeholder="Masukkan email Anda" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control-custom" placeholder="Buat password yang kuat" required>
                        </div>
                        <button type="submit" class="btn-register">Daftar Sekarang</button>
                    </form>

                    <div class="login-link">
                        <p>Sudah punya akun? <a href="/sigma/login">Login disini</a></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Image/Illustration -->
        <div class="register-image-section">
            <div class="illustration-wrapper">
                <svg class="illustration-image" viewBox="0 0 500 500" xmlns="http://www.w3.org/2000/svg">
                    <!-- Background Circle -->
                    <circle cx="250" cy="250" r="200" fill="rgba(255,255,255,0.1)" />

                    <!-- Person -->
                    <ellipse cx="250" cy="180" rx="60" ry="65" fill="#ffffff" />
                    <circle cx="235" cy="170" r="8" fill="#009d63" />
                    <circle cx="265" cy="170" r="8" fill="#009d63" />
                    <path d="M 230 190 Q 250 200 270 190" stroke="#009d63" stroke-width="3" fill="none" stroke-linecap="round" />

                    <!-- Body -->
                    <rect x="180" y="240" width="140" height="160" rx="20" fill="#ffffff" />

                    <!-- Laptop -->
                    <rect x="190" y="290" width="120" height="80" rx="5" fill="#009d63" />
                    <rect x="195" y="295" width="110" height="70" rx="3" fill="#d1fae5" />

                    <!-- Screen Content -->
                    <rect x="205" y="305" width="90" height="50" rx="2" fill="#ffffff" />
                    <circle cx="225" cy="330" r="12" fill="#047857" />
                    <path d="M 220 330 L 223 333 L 230 325" stroke="#ffffff" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" />
                    <line x1="245" y1="322" x2="280" y2="322" stroke="#047857" stroke-width="2" />
                    <line x1="245" y1="330" x2="275" y2="330" stroke="#047857" stroke-width="2" />
                    <line x1="245" y1="338" x2="270" y2="338" stroke="#047857" stroke-width="2" />

                    <!-- Keyboard -->
                    <rect x="185" y="370" width="130" height="8" rx="2" fill="#009d63" />

                    <!-- Arms -->
                    <ellipse cx="160" cy="320" rx="25" ry="60" fill="#ffffff" transform="rotate(-15 160 320)" />
                    <ellipse cx="340" cy="320" rx="25" ry="60" fill="#ffffff" transform="rotate(15 340 320)" />

                    <!-- Decorative Elements -->
                    <circle cx="100" cy="150" r="15" fill="rgba(255,255,255,0.3)" />
                    <circle cx="380" cy="180" r="20" fill="rgba(255,255,255,0.3)" />
                    <circle cx="400" cy="350" r="12" fill="rgba(255,255,255,0.3)" />
                    <circle cx="120" cy="380" r="18" fill="rgba(255,255,255,0.3)" />

                    <!-- User Add Icon -->
                    <g transform="translate(70, 70)">
                        <rect width="70" height="70" rx="10" fill="rgba(255,255,255,0.2)" />
                        <circle cx="30" cy="28" r="8" fill="#ffffff" />
                        <path d="M 18 42 Q 30 38 42 42 L 42 48 L 18 48 Z" fill="#ffffff" />
                        <line x1="50" y1="35" x2="50" y2="45" stroke="#ffffff" stroke-width="3" stroke-linecap="round" />
                        <line x1="45" y1="40" x2="55" y2="40" stroke="#ffffff" stroke-width="3" stroke-linecap="round" />
                    </g>

                    <!-- Target Icon -->
                    <g transform="translate(355, 70)">
                        <rect width="70" height="70" rx="10" fill="rgba(255,255,255,0.2)" />
                        <circle cx="35" cy="35" r="18" fill="none" stroke="#ffffff" stroke-width="2.5" />
                        <circle cx="35" cy="35" r="12" fill="none" stroke="#ffffff" stroke-width="2" />
                        <circle cx="35" cy="35" r="6" fill="none" stroke="#ffffff" stroke-width="2" />
                        <circle cx="35" cy="35" r="2" fill="#ffffff" />
                    </g>
                </svg>
            </div>
        </div>
    </div>
</body>

</html>