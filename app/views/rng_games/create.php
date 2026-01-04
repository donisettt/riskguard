<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold text-primary"><i class="fas fa-plus-circle"></i> Tambah Game RNG Baru</h2>
                    <p class="text-muted">Tambahkan game judi online viral untuk edukasi</p>
                </div>
                <a href="/sigma/rng-games" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>

            <!-- Alert -->
            <?php if (isset($_SESSION['message'])): ?>
                <div class="alert alert-<?= $_SESSION['message_type'] ?> alert-dismissible fade show">
                    <?= $_SESSION['message'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php unset($_SESSION['message'], $_SESSION['message_type']); ?>
            <?php endif; ?>

            <!-- Form Card -->
            <div class="card shadow-lg border-0">
                <div class="card-body p-4">
                    <form method="POST" action="/sigma/rng-games/create">

                        <!-- Nama Game -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Game <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" required
                                placeholder="Contoh: Slot Olympus, Higgs Domino, Crazy Time">
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Deskripsi Singkat <span class="text-danger">*</span></label>
                            <textarea name="description" class="form-control" rows="3" required
                                placeholder="Jelaskan game ini dan bahayanya bagi mental"></textarea>
                        </div>

                        <!-- Tipe Game -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tipe Game <span class="text-danger">*</span></label>
                            <select name="game_type" class="form-select" required>
                                <option value="">-- Pilih Tipe --</option>
                                <option value="Slot">Slot Machine</option>
                                <option value="Dice">Dice / Dadu</option>
                                <option value="Card">Card / Kartu</option>
                                <option value="Roulette">Roulette</option>
                                <option value="Crash">Crash Game</option>
                                <option value="Wheel">Wheel Spin</option>
                                <option value="Other">Lainnya</option>
                            </select>
                        </div>

                        <!-- Simbol -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Simbol / Emoji <span class="text-danger">*</span></label>
                            <input type="text" name="symbols" class="form-control" required
                                placeholder="Contoh: 🍒,🍋,🔔,💎,7️⃣ (pisahkan dengan koma)">
                            <small class="text-muted">Gunakan emoji atau karakter untuk visualisasi game</small>
                        </div>

                        <!-- RTP -->
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">RTP (%) <span class="text-danger">*</span></label>
                                <input type="number" name="rtp" class="form-control" required
                                    min="1" max="99" step="0.1" placeholder="85">
                                <small class="text-muted">Return to Player</small>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">Biaya Taruhan <span class="text-danger">*</span></label>
                                <input type="number" name="bet_cost" class="form-control" required
                                    min="1000" step="1000" placeholder="10000">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">Max Payout <span class="text-danger">*</span></label>
                                <input type="number" name="max_payout" class="form-control" required
                                    min="10000" step="10000" placeholder="500000">
                            </div>
                        </div>

                        <!-- Status Aktif -->
                        <div class="mb-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_active" id="is_active" checked>
                                <label class="form-check-label fw-bold" for="is_active">
                                    Aktifkan game ini
                                </label>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary flex-fill">
                                <i class="fas fa-save"></i> Simpan Game
                            </button>
                            <a href="/sigma/rng-games" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Batal
                            </a>
                        </div>

                    </form>
                </div>
            </div>

            <!-- Info Box -->
            <div class="alert alert-info mt-4">
                <h6 class="fw-bold"><i class="fas fa-lightbulb"></i> Tips:</h6>
                <ul class="mb-0 small">
                    <li>Pilih game judi online yang viral dan populer di Indonesia</li>
                    <li>RTP realistis untuk game slot biasanya 85-96%</li>
                    <li>Deskripsi harus mengedukasi bahaya mental dari game tersebut</li>
                    <li>Simbol bisa menggunakan emoji atau karakter unik</li>
                </ul>
            </div>
        </div>
    </div>
</div>