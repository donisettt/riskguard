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
<link rel="stylesheet" href="/sigma/public/css/play.css">

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

<!-- Include SweetAlert2 for better alerts -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">