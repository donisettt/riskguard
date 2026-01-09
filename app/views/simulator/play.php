<div class="container-fluid p-0" style="height: 100vh; overflow: hidden;">
    <!-- Top Bar -->
    <div class="top-bar bg-white border-bottom shadow-sm py-2 px-3">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-3">
                <a href="/sigma/simulator" class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <div class="d-flex align-items-center gap-2">
                    <span style="font-size: 1.8rem;"><?php
                                                        $symbols = json_decode($data['game']['symbols'], true);
                                                        echo $symbols[0] ?? '🎮';
                                                        ?></span>
                    <div>
                        <h5 class="mb-0 fw-bold" style="color: #009d63;"><?= htmlspecialchars($data['game']['name']) ?></h5>
                        <small class="text-muted">RTP: <?= $data['game']['rtp'] ?>% | Min: Rp <?= number_format($data['game']['bet_cost'], 0, ',', '.') ?></small>
                    </div>
                </div>
            </div>
            <div class="d-flex align-items-center gap-3">
                <div class="text-end">
                    <small class="text-muted d-block">Saldo Virtual</small>
                    <h4 class="mb-0 fw-bold" style="color: #009d63;">Rp <span id="balance"><?= number_format($data['user_balance'], 0, ',', '.') ?></span></h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="row g-0" style="height: calc(100vh - 70px);">
        <!-- Game Area - 60% -->
        <div class="col-lg-7 p-3" style="height: 100%; overflow-y: auto;">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-3">
                    <!-- Game Container -->
                    <div id="game-container" class="mb-2"></div>

                    <!-- Control Buttons -->
                    <div class="d-grid gap-2" id="control-buttons"></div>

                    <!-- Status Message -->
                    <div id="status-msg" class="mt-2 text-center fw-bold" style="min-height: 25px;"></div>
                </div>
            </div>
        </div>

        <!-- Statistics Sidebar - 40% -->
        <div class="col-lg-5 bg-light border-start" style="height: 100%; overflow-y: auto;">
            <div class="p-3">
                <!-- Stats Cards -->
                <div class="row g-2 mb-3">
                    <div class="col-6">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body p-2 text-center">
                                <small class="text-muted d-block">Putaran</small>
                                <h4 class="mb-0 fw-bold" style="color: #009d63;" id="total-rounds">0</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body p-2 text-center">
                                <small class="text-muted d-block">Taruhan</small>
                                <h6 class="mb-0 fw-bold text-warning" id="total-bet-amount">Rp 0</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body p-2 text-center">
                                <small class="text-muted d-block">Modal</small>
                                <h6 class="mb-0 fw-bold" style="color: #3b82f6;">Rp <?= number_format($data['user_balance'], 0, ',', '.') ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body p-2 text-center">
                                <small class="text-muted d-block">Sisa</small>
                                <h6 class="mb-0 fw-bold" style="color: #06b6d4;" id="current-balance">Rp <?= number_format($data['user_balance'], 0, ',', '.') ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body p-2 text-center">
                                <small class="text-muted d-block">Rugi</small>
                                <h6 class="mb-0 fw-bold text-danger" id="total-loss">Rp 0</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body p-2 text-center">
                                <small class="text-muted d-block">Max Win</small>
                                <h6 class="mb-0 fw-bold text-success" id="max-win">Rp 0</h6>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Progress Bar -->
                <div class="card border-0 shadow-sm mb-3">
                    <div class="card-body p-2">
                        <small class="text-muted d-block mb-1">Saldo Tersisa</small>
                        <div class="progress" style="height: 20px;">
                            <div id="balance-progress" class="progress-bar" style="width: 100%; background-color: #009d63;" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                <small class="fw-bold">100%</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Educational Alerts -->
                <div class="alert alert-warning border-0 shadow-sm mb-2 py-2 px-3">
                    <small>
                        <i class="fas fa-lightbulb"></i>
                        <strong>Perhatikan:</strong> Meskipun kadang menang, saldo akan terus turun dalam jangka panjang. Inilah bukti <strong>House Edge</strong> bekerja!
                    </small>
                </div>

                <div class="alert alert-danger border-0 shadow-sm mb-0 py-2 px-3">
                    <small>
                        <i class="fas fa-exclamation-triangle"></i>
                        <strong>Fakta RTP:</strong> RTP <?= $data['game']['rtp'] ?>% artinya dari setiap Rp 100.000 yang Anda taruhkan, rata-rata hanya Rp <?= number_format($data['game']['rtp'] * 1000, 0, ',', '.') ?> yang kembali. <strong>House edge <?= 100 - $data['game']['rtp'] ?>%</strong> adalah keuntungan bandar yang pasti!
                    </small>
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