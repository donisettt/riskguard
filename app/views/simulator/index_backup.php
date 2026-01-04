<div class="row mb-4">
    <div class="col-md-12 text-center">
        <h2 class="fw-bold text-primary">Simulator RNG (Random Number Generator)</h2>
        <p class="text-muted">
            Ini adalah simulasi untuk membuktikan bahwa dalam jangka panjang,
            <strong>Bandar Selalu Menang</strong>.
        </p>
    </div>
</div>

<!-- Game Selection -->
<?php if (!empty($data['games'])): ?>
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <label class="form-label fw-bold mb-3">
                        <i class="fas fa-gamepad"></i> Pilih Game Judi Online:
                    </label>
                    <div class="row g-3">
                        <?php foreach ($data['games'] as $game): ?>
                            <div class="col-md-3">
                                <a href="?url=simulator&game_id=<?= $game['id'] ?>"
                                    class="text-decoration-none">
                                    <div class="card game-card h-100 <?= ($data['selectedGame'] && $data['selectedGame']['id'] == $game['id']) ? 'border-primary shadow' : 'border-light' ?>">
                                        <div class="card-body text-center p-3">
                                            <div class="fs-2 mb-2"><?= explode(',', $game['symbols'])[0] ?></div>
                                            <h6 class="fw-bold mb-1"><?= htmlspecialchars($game['name']) ?></h6>
                                            <small class="text-muted"><?= $game['game_type'] ?></small>
                                            <div class="mt-2">
                                                <span class="badge bg-warning text-dark">RTP <?= $game['rtp'] ?>%</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<!-- Game Info -->
<?php if ($data['selectedGame']): ?>
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="alert alert-info">
                <h5 class="fw-bold mb-2">
                    <i class="fas fa-info-circle"></i> <?= htmlspecialchars($data['selectedGame']['name']) ?>
                </h5>
                <p class="mb-0"><?= htmlspecialchars($data['selectedGame']['description']) ?></p>
                <small class="text-muted">
                    RTP: <?= $data['selectedGame']['rtp'] ?>% |
                    Taruhan: Rp <?= number_format($data['selectedGame']['bet_cost'], 0, ',', '.') ?> |
                    Max Win: Rp <?= number_format($data['selectedGame']['max_payout'], 0, ',', '.') ?>
                </small>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if ($data['selectedGame']): ?>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-lg" style="background: #2c3e50; color: white;">
                <div class="card-body text-center p-5">

                    <div class="mb-4">
                        <h5 class="text-white-50">Saldo Virtual Anda</h5>
                        <h1 class="fw-bold text-warning">Rp <span id="balance">1000000</span></h1>
                    </div>

                    <div class="d-flex justify-content-center gap-3 mb-5 p-3 rounded bg-dark border border-secondary">
                        <div id="slot1" class="bg-white text-dark display-3 fw-bold rounded p-3" style="width: 80px;">?</div>
                        <div id="slot2" class="bg-white text-dark display-3 fw-bold rounded p-3" style="width: 80px;">?</div>
                        <div id="slot3" class="bg-white text-dark display-3 fw-bold rounded p-3" style="width: 80px;">?</div>
                    </div>

                    <div class="d-grid gap-2">
                        <button id="btn-spin" class="btn btn-danger btn-lg py-3 fw-bold" onclick="spin()">
                            PUTAR (Biaya: Rp <span id="bet-cost"><?= number_format($data['selectedGame']['bet_cost'], 0, ',', '.') ?></span>)
                        </button>
                        <button id="btn-stop" class="btn btn-secondary mt-2" onclick="finishSimulation()" disabled>
                            Stop & Lihat Analisis
                        </button>
                    </div>

                    <div id="status-msg" class="mt-3 fw-bold" style="height: 25px;"></div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white fw-bold">Statistik Sesi Ini</div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total Putaran:</span>
                            <strong id="total-rounds">0</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Modal Awal:</span>
                            <strong>Rp 1.000.000</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Kemenangan Terbesar:</span>
                            <strong class="text-success" id="max-win">0</strong>
                        </li>
                    </ul>
                    <div class="alert alert-info mt-3 small">
                        <i class="fas fa-info-circle"></i> Perhatikan saldo Anda. Meskipun Anda sesekali menang (diberi "hadiah" kecil), grafik saldo Anda perlahan akan turun menuju nol.
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-warning text-center">
                <i class="fas fa-exclamation-triangle"></i>
                <strong>Tidak ada game RNG yang tersedia saat ini.</strong>
                <br>Silakan hubungi admin untuk menambahkan game.
            </div>
        </div>
    </div>
<?php endif; ?>

<script>
    // Data dari PHP
    const gameData = <?= $data['selectedGame'] ? json_encode($data['selectedGame']) : 'null' ?>;

    if (gameData) {
        let balance = 1000000;
        const initialBalance = 1000000;
        const betCost = parseInt(gameData.bet_cost);
        const rtp = parseFloat(gameData.rtp);
        const maxPayout = parseInt(gameData.max_payout);
        let rounds = 0;
        let maxWin = 0;

        // Parse symbols dari database
        const symbols = gameData.symbols.split(',').map(s => s.trim());

        function spin() {
            // Cek saldo
            if (balance < betCost) {
                alert("Saldo Anda habis! Inilah risiko nyata perjudian.");
                finishSimulation();
                return;
            }

            // Kurangi saldo & update UI
            balance -= betCost;
            rounds++;
            updateUI();

            // Efek putar (Animasi sederhana)
            document.getElementById('btn-spin').disabled = true;
            document.getElementById('status-msg').innerHTML = "Memutar...";

            let spinDuration = 0;
            let interval = setInterval(() => {
                document.getElementById('slot1').innerHTML = symbols[Math.floor(Math.random() * symbols.length)];
                document.getElementById('slot2').innerHTML = symbols[Math.floor(Math.random() * symbols.length)];
                document.getElementById('slot3').innerHTML = symbols[Math.floor(Math.random() * symbols.length)];

                spinDuration += 100;
                if (spinDuration > 1000) { // Berhenti setelah 1 detik
                    clearInterval(interval);
                    finalizeSpin();
                }
            }, 100);
        }

        function finalizeSpin() {
            // LOGIKA RNG BERDASARKAN RTP DARI DATABASE
            let rand = Math.random() * 100;
            let winAmount = 0;
            let s1, s2, s3;

            // Kalkulasi peluang berdasarkan RTP
            const loseChance = 100 - rtp; // Contoh: jika RTP 85%, lose = 15%
            const smallWinChance = rtp * 0.7; // 70% dari RTP untuk menang kecil
            const bigWinChance = rtp * 0.3; // 30% dari RTP untuk jackpot

            if (rand < loseChance) {
                // KALAH (Zonk)
                s1 = symbols[0];
                s2 = symbols[1];
                s3 = symbols[2];
            } else if (rand < (loseChance + smallWinChance)) {
                // MENANG KECIL (2 Simbol sama)
                let sym = symbols[Math.floor(Math.random() * symbols.length)];
                s1 = sym;
                s2 = sym;
                s3 = symbols[(symbols.indexOf(sym) + 1) % symbols.length];
                winAmount = Math.floor(betCost * 0.5); // Balik modal 50%
            } else {
                // JACKPOT (3 Simbol sama)
                let sym = symbols[Math.floor(Math.random() * symbols.length)];
                s1 = sym;
                s2 = sym;
                s3 = sym;
                winAmount = Math.min(betCost * 5, maxPayout); // 5x atau max payout
            }

            // Tampilkan Simbol Final
            document.getElementById('slot1').innerHTML = s1;
            document.getElementById('slot2').innerHTML = s2;
            document.getElementById('slot3').innerHTML = s3;

            // Update Saldo
            balance += winAmount;
            if (winAmount > maxWin) maxWin = winAmount;

            // Pesan
            if (winAmount > 0) {
                document.getElementById('status-msg').innerHTML = `<span class="text-success">MENANG! +Rp ${winAmount.toLocaleString('id-ID')}</span>`;
            } else {
                document.getElementById('status-msg').innerHTML = `<span class="text-danger">ANDA KALAH!</span>`;
            }

            updateUI();
            document.getElementById('btn-spin').disabled = false;
            document.getElementById('btn-stop').disabled = false;
        }

        function updateUI() {
            document.getElementById('balance').innerText = balance.toLocaleString('id-ID');
            document.getElementById('total-rounds').innerText = rounds;
            document.getElementById('max-win').innerText = "Rp " + maxWin.toLocaleString('id-ID');
        }

        function finishSimulation() {
            if (confirm("Akhiri simulasi dan simpan hasilnya?")) {
                // Kirim data ke server via Fetch API
                fetch('index.php?url=simulator/save', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            game_id: gameData.id,
                            rounds: rounds,
                            initial: initialBalance,
                            final: balance
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status == 'success') {
                            alert("Simulasi Selesai. Data tersimpan.");
                            // Reset Game
                            window.location.reload();
                        } else {
                            alert("Gagal menyimpan data.");
                        }
                    });
            }
        }
    }
</script>

<style>
    .game-card {
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .game-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2) !important;
    }
</style>