<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1 text-dark">Edit Game RNG</h4>
            <p class="text-muted mb-0 small">Perbarui data: <?= htmlspecialchars($data['game']['name']) ?></p>
        </div>
        <a href="/sigma/rng-games" class="btn btn-outline-secondary btn-sm">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <form method="POST" action="/sigma/rng-games/edit/<?= $data['game']['id'] ?>">
        <div class="row g-4">

            <div class="col-lg-6">
                <div class="card shadow-sm border-0 card-sigma-top h-100">
                    <div class="card-header bg-white border-0 pt-4 pb-0">
                        <h6 class="fw-bold text-sigma"><i class="fas fa-edit me-2"></i>Informasi Umum</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-secondary">Nama Game</label>
                            <input type="text" name="name" class="form-control" required
                                value="<?= htmlspecialchars($data['game']['name']) ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-secondary">Tipe Game</label>
                            <select name="game_type" class="form-select" required>
                                <option value="">-- Pilih Tipe --</option>
                                <option value="Slot" <?= $data['game']['game_type'] == 'Slot' ? 'selected' : '' ?>>Slot Machine</option>
                                <option value="Dice" <?= $data['game']['game_type'] == 'Dice' ? 'selected' : '' ?>>Dice / Dadu</option>
                                <option value="Card" <?= $data['game']['game_type'] == 'Card' ? 'selected' : '' ?>>Card / Kartu</option>
                                <option value="Roulette" <?= $data['game']['game_type'] == 'Roulette' ? 'selected' : '' ?>>Roulette</option>
                                <option value="Crash" <?= $data['game']['game_type'] == 'Crash' ? 'selected' : '' ?>>Crash Game</option>
                                <option value="Wheel" <?= $data['game']['game_type'] == 'Wheel' ? 'selected' : '' ?>>Wheel Spin</option>
                                <option value="Other" <?= $data['game']['game_type'] == 'Other' ? 'selected' : '' ?>>Lainnya</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-secondary">Deskripsi Edukasi</label>
                            <textarea name="description" class="form-control" rows="4" required><?= htmlspecialchars($data['game']['description']) ?></textarea>
                        </div>

                        <div class="p-3 bg-light rounded border border-light">
                            <div class="form-check form-switch mb-0">
                                <input class="form-check-input" type="checkbox" name="is_active" id="is_active"
                                    <?= $data['game']['is_active'] ? 'checked' : '' ?>>
                                <label class="form-check-label fw-bold small text-dark" for="is_active">Status: Aktif</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card shadow-sm border-0 card-sigma-top h-100">
                    <div class="card-header bg-white border-0 pt-4 pb-0">
                        <h6 class="fw-bold text-sigma"><i class="fas fa-sliders-h me-2"></i>Parameter Teknis</h6>
                    </div>
                    <div class="card-body">

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-secondary">Simbol / Aset</label>
                            <input type="text" name="symbols" class="form-control font-monospace" required
                                value="<?= htmlspecialchars($data['game']['symbols']) ?>">
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary">RTP (%)</label>
                                <div class="input-group">
                                    <input type="number" name="rtp" class="form-control" required min="1" max="99" step="0.1"
                                        value="<?= $data['game']['rtp'] ?>">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-secondary">Biaya Bet</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="bet_cost" class="form-control" required min="1000" step="500"
                                        value="<?= $data['game']['bet_cost'] ?>">
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold text-secondary">Max Win (Payout)</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="max_payout" class="form-control" required min="10000" step="10000"
                                        value="<?= $data['game']['max_payout'] ?>">
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-warning border-0 bg-warning-subtle small mt-3 mb-0 p-2 d-flex align-items-center">
                            <i class="fas fa-exclamation-triangle me-2 text-warning"></i>
                            <div class="text-dark opacity-75" style="font-size: 0.75rem; line-height: 1.2;">
                                Perubahan data sensitif saat simulasi berjalan dapat mempengaruhi hasil real-time.
                            </div>
                        </div>

                        <div class="mt-4 pt-3 border-top d-flex justify-content-end gap-2">
                            <a href="/sigma/rng-games" class="btn btn-light border">Batal</a>
                            <button type="submit" class="btn btn-sigma px-4">
                                <i class="fas fa-save me-1"></i> Simpan Perubahan
                            </button>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </form>
</div>

<link rel="stylesheet" href="/sigma/public/css/games.css">