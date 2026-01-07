<div class="container-fluid">

    <!-- Alert Container -->
    <div id="alert-container"></div>

    <div class="mb-4">
        <h4 class="fw-bold" style="color: #1e293b;">Pengaturan Akun</h4>
        <p class="text-muted m-0" style="font-size: 0.9rem;">Kelola informasi profil dan keamanan akun Anda</p>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="profile-card">
                <div class="profile-card-body text-center">
                    <div class="profile-avatar">
                        <?= strtoupper(substr($data['user_data']['name'], 0, 1)) ?>
                    </div>
                    <h5 class="fw-bold mb-1" style="color: #1e293b;"><?= $data['user_data']['name'] ?></h5>
                    <p class="text-muted mb-3" style="font-size: 0.9rem;"><?= $data['user_data']['email'] ?></p>

                    <div class="role-badge">
                        <?= ucfirst($data['user_data']['role']) ?>
                    </div>

                    <div class="profile-stats mt-4">
                        <div class="stat-item">
                            <span>Bergabung Sejak</span>
                            <span
                                class="stat-value"><?= date('M Y', strtotime($data['user_data']['created_at'])) ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="profile-card">
                <div class="profile-card-header">
                    <ul class="nav profile-tabs" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-profile-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-profile" type="button" role="tab">
                                <i class="fas fa-user-edit me-2"></i>Edit Profil
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-security-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-security" type="button" role="tab">
                                <i class="fas fa-lock me-2"></i>Keamanan
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="profile-card-body">
                    <div class="tab-content" id="pills-tabContent">

                        <div class="tab-pane fade show active" id="pills-profile" role="tabpanel">
                            <form id="form-profile">
                                <div class="mb-3">
                                    <label class="profile-label">Nama Lengkap</label>
                                    <input type="text" name="name" class="profile-input"
                                        value="<?= htmlspecialchars($data['user_data']['name']) ?>" required>
                                </div>
                                <div class="mb-4">
                                    <label class="profile-label">Alamat Email</label>
                                    <input type="email" name="email" class="profile-input"
                                        value="<?= htmlspecialchars($data['user_data']['email']) ?>" required>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn-primary-custom">
                                        <i class="fas fa-save me-2"></i>Simpan Perubahan
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade" id="pills-security" role="tabpanel">
                            <form id="form-password">
                                <div class="mb-4">
                                    <label class="profile-label">Password Saat Ini</label>
                                    <input type="password" name="old_password" class="profile-input" required>
                                </div>
                                <div class="mb-3">
                                    <label class="profile-label">Password Baru</label>
                                    <input type="password" name="new_password" class="profile-input" minlength="6"
                                        required>
                                    <small class="text-muted" style="font-size: 0.8rem;">Minimal 6 karakter</small>
                                </div>
                                <div class="mb-4">
                                    <label class="profile-label">Konfirmasi Password Baru</label>
                                    <input type="password" name="confirm_password" class="profile-input" minlength="6"
                                        required>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn-secondary-custom">
                                        <i class="fas fa-key me-2"></i>Update Password
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="/sigma/public/css/profile.css">
<script src="/sigma/public/js/profile.js"></script>