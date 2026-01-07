<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sigma</title>
    <link rel="stylesheet" href="/sigma/public/css/login.css">
    <style>
        .alert {
            padding: 12px 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            font-size: 14px;
            display: none;
        }

        .alert-danger {
            background-color: #fee;
            color: #c33;
            border: 1px solid #fcc;
        }

        .alert-success {
            background-color: #efe;
            color: #3c3;
            border: 1px solid #cfc;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <!-- Left Side - Form -->
        <div class="login-form-section">
            <div class="login-form-wrapper">
                <div class="login-logo">
                    <h1>SIGMA</h1>
                    <p>Sistem Manajemen Assessment</p>
                </div>

                <div class="login-form">
                    <h3>Selamat Datang</h3>
                    <p class="subtitle">Silakan masuk ke akun Anda untuk melanjutkan</p>

                    <!-- Alert container - akan diisi via JavaScript atau PHP -->
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger" style="display: block;"><?= htmlspecialchars($error) ?></div>
                    <?php else: ?>
                        <div class="alert" style="display: none;"></div>
                    <?php endif; ?>

                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" name="email" id="email" class="form-control-custom" placeholder="Masukkan email Anda" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control-custom" placeholder="Masukkan password Anda" required>
                        </div>
                        <button type="submit" class="btn-login">Masuk Sekarang</button>
                    </form>

                    <div class="register-link">
                        <p>Belum punya akun? <a href="/sigma/register">Daftar disini</a></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Image/Illustration -->
        <div class="login-image-section">
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

                    <!-- Tablet -->
                    <rect x="200" y="280" width="100" height="140" rx="8" fill="#d1fae5" stroke="#009d63" stroke-width="3" />
                    <rect x="210" y="290" width="80" height="100" rx="4" fill="#ffffff" />
                    <line x1="220" y1="300" x2="270" y2="300" stroke="#047857" stroke-width="2" />
                    <line x1="220" y1="315" x2="280" y2="315" stroke="#047857" stroke-width="2" />
                    <line x1="220" y1="330" x2="260" y2="330" stroke="#047857" stroke-width="2" />
                    <circle cx="250" cy="410" r="5" fill="#009d63" />

                    <!-- Arms -->
                    <ellipse cx="170" cy="300" rx="25" ry="70" fill="#ffffff" transform="rotate(-20 170 300)" />
                    <ellipse cx="330" cy="300" rx="25" ry="70" fill="#ffffff" transform="rotate(20 330 300)" />

                    <!-- Decorative Elements -->
                    <circle cx="100" cy="150" r="15" fill="rgba(255,255,255,0.3)" />
                    <circle cx="380" cy="200" r="20" fill="rgba(255,255,255,0.3)" />
                    <circle cx="400" cy="350" r="12" fill="rgba(255,255,255,0.3)" />
                    <circle cx="120" cy="380" r="18" fill="rgba(255,255,255,0.3)" />

                    <!-- Graph Icon -->
                    <g transform="translate(80, 80)">
                        <rect width="60" height="60" rx="8" fill="rgba(255,255,255,0.2)" />
                        <path d="M 15 45 L 25 35 L 35 40 L 45 25" stroke="#ffffff" stroke-width="2.5" fill="none" stroke-linecap="round" />
                        <circle cx="15" cy="45" r="3" fill="#ffffff" />
                        <circle cx="25" cy="35" r="3" fill="#ffffff" />
                        <circle cx="35" cy="40" r="3" fill="#ffffff" />
                        <circle cx="45" cy="25" r="3" fill="#ffffff" />
                    </g>

                    <!-- Book Icon -->
                    <g transform="translate(360, 80)">
                        <rect width="60" height="60" rx="8" fill="rgba(255,255,255,0.2)" />
                        <rect x="18" y="20" width="24" height="30" rx="2" fill="#ffffff" />
                        <line x1="30" y1="20" x2="30" y2="50" stroke="#2a5298" stroke-width="1.5" />
                        <line x1="22" y1="28" x2="27" y2="28" stroke="#2a5298" stroke-width="1" />
                        <line x1="22" y1="33" x2="27" y2="33" stroke="#2a5298" stroke-width="1" />
                        <line x1="33" y1="28" x2="38" y2="28" stroke="#2a5298" stroke-width="1" />
                        <line x1="33" y1="33" x2="38" y2="33" stroke="#2a5298" stroke-width="1" />
                    </g>
                </svg>
            </div>
        </div>
    </div>

    <!-- Include Auth JavaScript -->
    <script src="/sigma/public/js/auth.js"></script>
</body>

</html>