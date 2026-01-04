<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1 text-dark">Tambah Game Baru</h4>
            <p class="text-muted mb-0 small">Konfigurasi parameter simulasi.</p>
        </div>
        <a href="/sigma/rng-games" class="btn btn-outline-secondary btn-sm">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <form method="POST" action="/sigma/rng-games/create">
        <div class="row g-4">

            <div class="col-lg-6">
                <div class="card shadow-sm border-0 card-sigma-top h-100">
                    <div class="card-header bg-white border-0 pt-4 pb-0">
                        <h6 class="fw-bold text-sigma"><i class="fas fa-info-circle me-2"></i>Informasi Umum</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-secondary">Nama Game <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" required placeholder="Cth: Gates of Olympus">
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-secondary">Tipe Game <span class="text-danger">*</span></label>
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

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-secondary">Deskripsi Edukasi <span class="text-danger">*</span></label>
                            <textarea name="description" class="form-control" rows="4" required placeholder="Jelaskan mekanisme psikologis game ini..."></textarea>
                        </div>

                        <div class="p-3 bg-light rounded border border-light">
                            <div class="form-check form-switch mb-0">
                                <input class="form-check-input" type="checkbox" name="is_active" id="is_active" checked>
                                <label class="form-check-label fw-bold small text-dark" for="is_active">Status: Aktif</label>
                            </div>
                            <div class="text-muted small mt-1" style="font-size: 0.75rem;">
                                Game akan langsung tampil di halaman depan jika diaktifkan.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card shadow-sm border-0 card-sigma-top h-100">
                    <div class="card-header bg-white border-0 pt-4 pb-0">
                        <h6 class="fw-bold text-sigma"><i class="fas fa-cogs me-2"></i>Konfigurasi Algoritma</h6>
                    </div>
                    <div class="card-body">

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-secondary">Simbol / Aset <span class="text-danger">*</span></label>
                            <input type="text" name="symbols" class="form-control font-monospace" required placeholder="🍒,🍋,🔔,💎,7️⃣">
                            <div class="form-text small">Pisahkan dengan koma (tanpa spasi).</div>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary">RTP (%) <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="number" name="rtp" class="form-control" required min="1" max="99" step="0.1" placeholder="96.5">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary">Biaya Bet <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="bet_cost" class="form-control" required min="1000" step="500" placeholder="200">
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold text-secondary">Max Win (Payout) <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="max_payout" class="form-control" required min="10000" step="10000" placeholder="5000000">
                                </div>
                                <div class="form-text small mt-1 text-muted">
                                    <i class="fas fa-info-circle"></i> Batas kemenangan maksimal yang bisa didapat user.
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 pt-3 border-top d-flex justify-content-end gap-2">
                            <a href="/sigma/rng-games" class="btn btn-light border">Batal</a>
                            <button type="submit" class="btn btn-sigma px-4">
                                <i class="fas fa-save me-1"></i> Simpan
                            </button>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </form>

    <div class="mt-3 text-muted small">
        <i class="fas fa-lightbulb text-warning me-1"></i>
        <strong>Tips:</strong> Gunakan RTP rendah (dibawah 90%) untuk simulasi kerugian.
    </div>
</div>

<link rel="stylesheet" href="/sigma/public/css/games.css">