<div class="container-fluid py-4">
    <!-- Header with Back Button -->
    <div class="row mb-4">
        <div class="col-md-12">
            <a href="/sigma/simulator" class="btn btn-outline-secondary mb-3">
                <i class="fas fa-arrow-left"></i> Kembali ke Pilihan Game
            </a>
            <div class="text-center">
                <h2 class="fw-bold text-primary mb-2">
                    <span style="font-size: 2.5rem;"><?= explode(',', $data['game']['symbols'])[0] ?></span>
                    <?= htmlspecialchars($data['game']['name']) ?>
                </h2>
                <span class="badge bg-info text-dark fs-6 mb-3"><?= htmlspecialchars($data['game']['game_type']) ?></span>
            </div>
        </div>
    </div>

    <!-- Game Info Alert -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="alert alert-info border-0 shadow-sm">
                <h5 class="fw-bold mb-2">
                    <i class="fas fa-info-circle"></i> Tentang Game Ini
                </h5>
                <p class="mb-2"><?= htmlspecialchars($data['game']['description']) ?></p>
                <div class="d-flex gap-4 mt-3 flex-wrap">
                    <small><strong>RTP:</strong> <?= $data['game']['rtp'] ?>%</small>
                    <small><strong>Min Taruhan:</strong> <span class="badge bg-warning text-dark">Rp <?= number_format($data['game']['bet_cost'], 0, ',', '.') ?></span></small>
                    <small><strong>Max Win:</strong> Rp <?= number_format($data['game']['max_payout'], 0, ',', '.') ?></small>
                </div>
            </div>
        </div>
    </div>

    <!-- Game Area -->
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card border-0 shadow-lg game-machine">
                <div class="card-body text-center p-4">

                    <!-- Balance Display -->
                    <div class="mb-3 balance-display">
                        <h5 class="text-muted mb-2">Saldo Virtual Anda</h5>
                        <h1 class="fw-bold text-warning balance-amount">Rp <span id="balance"><?= number_format($data['user_balance'], 0, ',', '.') ?></span></h1>
                    </div>

                    <!-- Game Container - Will be dynamically rendered based on game type -->
                    <div id="game-container" class="mb-4">
                        <!-- Dynamically loaded by JavaScript -->
                    </div>

                    <!-- Control Buttons -->
                    <div class="d-grid gap-2" id="control-buttons">
                        <!-- Dynamically loaded by JavaScript -->
                    </div>

                    <!-- Status Message -->
                    <div id="status-msg" class="mt-3 fw-bold fs-5" style="min-height: 40px;"></div>
                </div>
            </div>
        </div>

        <!-- Statistics Sidebar -->
        <div class="col-md-4">
            <div class="card shadow-sm h-100 border-0">
                <div class="card-header bg-primary text-white fw-bold">
                    <i class="fas fa-chart-bar"></i> Statistik Sesi Ini
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush mb-3">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Total Putaran:</span>
                            <span class="badge bg-primary rounded-pill fs-6" id="total-rounds">0</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Total Taruhan:</span>
                            <strong class="text-warning" id="total-bet-amount">Rp 0</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Modal Awal:</span>
                            <strong class="text-primary">Rp <?= number_format($data['user_balance'], 0, ',', '.') ?></strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Sisa Saldo:</span>
                            <strong class="text-info" id="current-balance">Rp <?= number_format($data['user_balance'], 0, ',', '.') ?></strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Total Kerugian:</span>
                            <strong class="text-danger" id="total-loss">Rp 0</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Kemenangan Terbesar:</span>
                            <strong class="text-success" id="max-win">Rp 0</strong>
                        </li>
                    </ul>

                    <!-- Progress Bar -->
                    <div class="mb-3">
                        <small class="text-muted">Saldo Tersisa:</small>
                        <div class="progress" style="height: 25px;">
                            <div id="balance-progress" class="progress-bar bg-success" role="progressbar"
                                style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                100%
                            </div>
                        </div>
                    </div>

                    <!-- Educational Alert -->
                    <div class="alert alert-warning border-0 small mb-3">
                        <i class="fas fa-lightbulb"></i>
                        <strong>Perhatikan:</strong> Meskipun kadang menang, saldo akan terus turun dalam jangka panjang.
                        Inilah bukti <strong>House Edge</strong> bekerja!
                    </div>

                    <div class="alert alert-danger border-0 small mb-0">
                        <i class="fas fa-exclamation-triangle"></i>
                        <strong>Fakta RTP:</strong> RTP <?= $data['game']['rtp'] ?>% artinya dari setiap Rp 100.000 yang Anda taruhkan,
                        rata-rata hanya Rp <?= number_format($data['game']['rtp'] * 1000, 0, ',', '.') ?> yang kembali.
                        <strong>House edge <?= 100 - $data['game']['rtp'] ?>%</strong> adalah keuntungan bandar yang pasti!
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include CSS -->
<link rel="stylesheet" href="/sigma/public/css/simulator-game.css">

<!-- Include JavaScript -->
<script>
    // Pass PHP data to JavaScript
    window.gameInitData = {
        game: <?= json_encode($data['game']) ?>,
        userBalance: <?= isset($data['user_balance']) ? $data['user_balance'] : 1000000 ?>,
        gameRTP: <?= $data['game']['rtp'] ?>
    };
</script>
<script src="/sigma/public/js/simulator.js"></script>
<script src="/sigma/public/js/simulator-games.js"></script>
<script>
    // Initialize game with data from PHP
    initGameData(window.gameInitData);
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    /* Base Styles */
    .game-machine {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        min-height: 500px;
    }

    /* Bet Control Panel */
    .bet-control-panel {
        background: rgba(255, 255, 255, 0.1);
        padding: 15px;
        border-radius: 10px;
        backdrop-filter: blur(10px);
    }

    .quick-bet-btn {
        min-width: 50px;
        transition: all 0.3s;
    }

    .quick-bet-btn:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: translateY(-2px);
    }

    .quick-bet-btn.active {
        background: rgba(255, 255, 255, 0.3);
        border-color: #ffc107;
        box-shadow: 0 0 10px rgba(255, 193, 7, 0.5);
    }

    .quick-bet-btn.disabled,
    .quick-bet-btn:disabled {
        opacity: 0.3;
        cursor: not-allowed;
        background: rgba(255, 255, 255, 0.05);
    }

    .quick-bet-btn.disabled:hover,
    .quick-bet-btn:disabled:hover {
        transform: none;
        background: rgba(255, 255, 255, 0.05);
    }

    .balance-amount {
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        font-size: 2.5rem;
        animation: pulse 2s ease-in-out infinite;
    }

    @keyframes pulse {

        0%,
        100% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.05);
        }
    }

    /* SLOT GAME */
    .slot-game {
        position: relative;
    }

    .multiplier-display {
        text-align: center;
    }

    .slot-grid {
        background: rgba(0, 0, 0, 0.3);
        padding: 20px;
        border-radius: 15px;
        border: 3px solid rgba(255, 255, 255, 0.2);
    }

    .slot-row {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-bottom: 10px;
    }

    .slot-row:last-child {
        margin-bottom: 0;
    }

    .slot-cell {
        background: white;
        color: #333;
        font-size: 2.5rem;
        width: 70px;
        height: 70px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        transition: all 0.3s;
    }

    .slot-cell.spinning {
        animation: spin 0.1s linear infinite;
    }

    .slot-cell.winning-cell {
        background: gold;
        animation: flash 0.5s ease-in-out infinite;
        box-shadow: 0 0 20px gold;
    }

    @keyframes spin {
        0% {
            transform: rotateY(0deg);
        }

        100% {
            transform: rotateY(360deg);
        }
    }

    @keyframes flash {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0.7;
        }
    }

    .lightning-effect {
        display: none;
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle, rgba(255, 255, 0, 0.5) 0%, transparent 70%);
        animation: lightning 0.2s ease-in-out 5;
        pointer-events: none;
    }

    @keyframes lightning {

        0%,
        100% {
            opacity: 0;
        }

        50% {
            opacity: 1;
        }
    }

    /* CRASH GAME */
    .crash-game {
        background: linear-gradient(180deg, #001a33 0%, #003366 100%);
        padding: 30px;
        border-radius: 15px;
        position: relative;
        min-height: 400px;
        height: 400px;
        display: flex;
        flex-direction: column;
    }

    .crash-display {
        position: relative;
        flex: 1;
        min-height: 300px;
        max-height: 300px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .crash-animation-area {
        position: relative;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .rocket {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 3rem;
        z-index: 10;
        pointer-events: none;
    }

    .rocket.explode {
        animation: explode 0.5s ease-out;
    }

    @keyframes explode {
        0% {
            transform: translate(-50%, -50%) scale(1);
        }

        50% {
            transform: translate(-50%, -50%) scale(2);
            opacity: 1;
        }

        100% {
            transform: translate(-50%, -50%) scale(3);
            opacity: 0;
        }
    }

    .multiplier-big {
        position: absolute;
        top: 65%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 4rem;
        font-weight: bold;
        color: #ffd700;
        text-shadow: 0 0 20px rgba(255, 215, 0, 0.8);
        z-index: 5;
        pointer-events: none;
    }

    /* WHEEL GAME */
    .wheel-game {
        padding: 20px;
    }

    .wheel-container {
        position: relative;
        width: 300px;
        height: 300px;
        margin: 0 auto;
    }

    .wheel-pointer {
        position: absolute;
        top: -20px;
        left: 50%;
        transform: translateX(-50%);
        font-size: 2rem;
        color: red;
        z-index: 10;
    }

    .wheel {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        border: 5px solid gold;
        position: relative;
        background: conic-gradient(from 0deg,
                #ff6b6b 0deg 30deg,
                #4ecdc4 30deg 60deg,
                #ffe66d 60deg 90deg,
                #95e1d3 90deg 120deg,
                #ff6b6b 120deg 150deg,
                #4ecdc4 150deg 180deg,
                #ffe66d 180deg 210deg,
                #95e1d3 210deg 240deg,
                #ff6b6b 240deg 270deg,
                #4ecdc4 270deg 300deg,
                #ffe66d 300deg 330deg,
                #95e1d3 330deg 360deg);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }

    .wheel-segment {
        position: absolute;
        width: 50%;
        height: 50%;
        top: 50%;
        left: 50%;
        transform-origin: 0 0;
        display: flex;
        align-items: flex-start;
        justify-content: center;
        padding-top: 10px;
        font-weight: bold;
        color: white;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
    }

    /* CARD GAME */
    .card-game {
        padding: 30px;
    }

    .card-table {
        background: #0d6938;
        padding: 40px;
        border-radius: 20px;
        border: 5px solid #8b4513;
    }

    .card-hand {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin: 20px 0;
    }

    .vs-text {
        text-align: center;
        font-size: 2rem;
        font-weight: bold;
        color: white;
        margin: 20px 0;
    }

    .card-item {
        background: white;
        width: 80px;
        height: 120px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        transition: transform 0.3s;
    }

    .card-item.flipping {
        animation: flip 0.6s ease-in-out infinite;
    }

    @keyframes flip {

        0%,
        100% {
            transform: rotateY(0deg);
        }

        50% {
            transform: rotateY(180deg);
        }
    }

    /* Button Styles */
    .spin-button {
        box-shadow: 0 5px 15px rgba(220, 53, 69, 0.4);
        transition: all 0.3s;
    }

    .spin-button:hover:not(:disabled) {
        transform: scale(1.05);
        box-shadow: 0 8px 25px rgba(220, 53, 69, 0.6);
    }

    .spin-button:active {
        transform: scale(0.95);
    }
</style>

<!-- Include SweetAlert2 for better alerts -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">