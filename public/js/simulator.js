/*
 * SIMULATOR RNG GAME - UNTUK EDUKASI BAHAYA JUDI ONLINE
 * 
 * KONSEP PENTING:
 * 
 * 1. RTP (Return to Player): Persentase dari total taruhan yang dikembalikan ke pemain
 *    Contoh: RTP 85% = dari 100 juta rupiah taruhan, rata-rata 85 juta kembali ke pemain
 * 
 * 2. House Edge: Keuntungan matematika bandar = (100 - RTP)%
 *    Contoh: RTP 85% = House Edge 15% = bandar PASTI untung 15% dari semua taruhan
 * 
 * 3. Mengapa Tetap Kalah Meskipun Kadang Menang?
 *    - Win kecil memang sering terjadi (memberi false hope)
 *    - Tapi nilai win rata-rata < nilai taruhan
 *    - Dalam jangka panjang, house edge memastikan pemain rugi
 * 
 * 4. "The House Always Wins" - Bukan Karena Curang:
 *    - Ini murni matematika probabilitas
 *    - RTP sudah diperhitungkan agar bandar pasti untung
 *    - Semakin lama main, semakin mendekati expected loss
 * 
 * 5. Tidak Ada "Strategi" atau "Pola":
 *    - Setiap spin independen (tidak dipengaruhi hasil sebelumnya)
 *    - Tidak ada cara mengalahkan house edge
 *    - "Hot/Cold streak" adalah ilusi (gambler's fallacy)
 * 
 * TUJUAN SIMULATOR INI:
 * Menunjukkan secara real bahwa meskipun kadang menang, dalam jangka panjang
 * house edge matematis akan membuat pemain kalah. Ini untuk mencegah kecanduan!
 */

// Global variables - will be initialized from PHP
let gameData, userStartBalance, balance, initialBalance;
let minBetPerGame, currentBetAmount, maxBet, rtp, maxPayout;
let rounds = 0;
let maxWin = 0;
let isPlaying = false;
let totalBetAmount = 0;
let symbols, gameType;

// Crash game variables
let crashMultiplier = 1.00;
let crashInterval = null;
let crashPoint = 1.00;
let hasCashedOut = false;

// Initialize game data from window object (set by PHP)
function initGameData(data) {
    gameData = data.game;
    userStartBalance = data.userBalance || 1000000;
    balance = userStartBalance;
    initialBalance = userStartBalance;
    minBetPerGame = parseInt(gameData.bet_cost);
    currentBetAmount = minBetPerGame;
    maxBet = 100000;
    rtp = parseFloat(gameData.rtp);
    maxPayout = parseInt(gameData.max_payout);
    symbols = gameData.symbols.split(',').map(s => s.trim());
    gameType = gameData.game_type;

    console.log('Game initialized:', {
        gameData,
        userStartBalance,
        balance,
        minBetPerGame,
        currentBetAmount
    });
}

// Realistic RNG Logic - House Edge Konsisten
function getAdjustedRTP() {
    return rtp;
}

// Initialize game berdasarkan tipe
document.addEventListener('DOMContentLoaded', function() {
    initializeGame();
});

function initializeGame() {
    switch (gameType) {
        case 'Slot':
            initSlotGame();
            break;
        case 'Crash':
            initCrashGame();
            break;
        case 'Wheel':
            initWheelGame();
            break;
        case 'Card':
        case 'Dice':
            initCardGame();
            break;
        default:
            initSlotGame();
    }
}

// ==================== BET AMOUNT CONTROLS ====================
function getBetControlPanelHTML() {
    return `
        <div class="bet-control-panel mb-3">
            <div class="d-flex justify-content-center align-items-center gap-2 mb-2">
                <span class="text-white fw-bold">Taruhan:</span>
                <span class="badge bg-success fs-5 px-3 py-2">Rp <span id="current-bet-display">${currentBetAmount.toLocaleString('id-ID')}</span></span>
            </div>
            <div class="text-center mb-2">
                <small class="text-white-50"><i class="fas fa-info-circle"></i> Min: Rp ${minBetPerGame.toLocaleString('id-ID')} | Max: Rp ${maxBet.toLocaleString('id-ID')}</small>
            </div>
            <div class="d-flex justify-content-center gap-2 flex-wrap mb-2">
                <button class="btn btn-sm btn-outline-light quick-bet-btn ${1000 < minBetPerGame ? 'disabled' : ''}${1000 === currentBetAmount ? ' active' : ''}" 
                        data-amount="1000" onclick="setBetAmount(1000)" ${1000 < minBetPerGame ? 'disabled' : ''}>1K</button>
                <button class="btn btn-sm btn-outline-light quick-bet-btn ${5000 < minBetPerGame ? 'disabled' : ''}${5000 === currentBetAmount ? ' active' : ''}" 
                        data-amount="5000" onclick="setBetAmount(5000)" ${5000 < minBetPerGame ? 'disabled' : ''}>5K</button>
                <button class="btn btn-sm btn-outline-light quick-bet-btn ${10000 < minBetPerGame ? 'disabled' : ''}${10000 === currentBetAmount ? ' active' : ''}" 
                        data-amount="10000" onclick="setBetAmount(10000)" ${10000 < minBetPerGame ? 'disabled' : ''}>10K</button>
                <button class="btn btn-sm btn-outline-light quick-bet-btn ${15000 < minBetPerGame ? 'disabled' : ''}${15000 === currentBetAmount ? ' active' : ''}" 
                        data-amount="15000" onclick="setBetAmount(15000)" ${15000 < minBetPerGame ? 'disabled' : ''}>15K</button>
                <button class="btn btn-sm btn-outline-light quick-bet-btn ${25000 < minBetPerGame ? 'disabled' : ''}${25000 === currentBetAmount ? ' active' : ''}" 
                        data-amount="25000" onclick="setBetAmount(25000)" ${25000 < minBetPerGame ? 'disabled' : ''}>25K</button>
                <button class="btn btn-sm btn-outline-light quick-bet-btn ${50000 < minBetPerGame ? 'disabled' : ''}${50000 === currentBetAmount ? ' active' : ''}" 
                        data-amount="50000" onclick="setBetAmount(50000)" ${50000 < minBetPerGame ? 'disabled' : ''}>50K</button>
                <button class="btn btn-sm btn-outline-light quick-bet-btn ${100000 < minBetPerGame ? 'disabled' : ''}${100000 === currentBetAmount ? ' active' : ''}" 
                        data-amount="100000" onclick="setBetAmount(100000)" ${100000 < minBetPerGame ? 'disabled' : ''}>100K</button>
            </div>
            <div class="input-group input-group-sm" style="max-width: 300px; margin: 0 auto;">
                <span class="input-group-text">Rp</span>
                <input type="number" class="form-control" id="custom-bet-input" 
                       value="${currentBetAmount}" min="${minBetPerGame}" max="${maxBet}" step="1000"
                       onchange="setCustomBet()" placeholder="Min ${minBetPerGame.toLocaleString('id-ID')}">
            </div>
        </div>
    `;
}

function updateBetDisplay() {
    document.getElementById('current-bet-display').textContent = currentBetAmount.toLocaleString('id-ID');
    const allBtns = document.querySelectorAll('.btn-spin, .btn-bet, .btn-play');
    allBtns.forEach(btn => {
        const match = btn.innerHTML.match(/(SPIN|TERBANG|PUTAR RODA|MAIN)/);
        if (match) {
            btn.innerHTML = btn.innerHTML.replace(/Rp [\d.,]+/, `Rp ${currentBetAmount.toLocaleString('id-ID')}`);
        }
    });
}

function setBetAmount(amount) {
    if (isPlaying) return;

    if (amount < minBetPerGame) {
        Swal.fire({
            icon: 'warning',
            title: 'Taruhan Terlalu Kecil!',
            html: `Game ini memiliki <strong>minimal taruhan Rp ${minBetPerGame.toLocaleString('id-ID')}</strong>.<br><br>Silakan pilih nominal yang lebih besar.`,
            confirmButtonText: 'OK'
        });
        return;
    }

    currentBetAmount = Math.max(minBetPerGame, Math.min(maxBet, amount));
    updateBetDisplay();

    document.querySelectorAll('.quick-bet-btn').forEach(btn => {
        btn.classList.remove('active');
        const btnAmount = parseInt(btn.getAttribute('data-amount'));
        if (btnAmount === amount) {
            btn.classList.add('active');
        }
    });
}

function setCustomBet() {
    if (isPlaying) return;

    const input = document.getElementById('custom-bet-input');
    const amount = parseInt(input.value);

    if (isNaN(amount) || amount < minBetPerGame) {
        Swal.fire({
            icon: 'error',
            title: 'Taruhan Tidak Valid!',
            html: `Minimal bet untuk game ini adalah <strong>Rp ${minBetPerGame.toLocaleString('id-ID')}</strong>`,
            confirmButtonText: 'OK'
        });
        input.value = currentBetAmount;
        return;
    }

    if (amount > maxBet) {
        Swal.fire('Error', `Maksimal bet adalah Rp ${maxBet.toLocaleString('id-ID')}`, 'error');
        input.value = currentBetAmount;
        return;
    }

    if (amount > balance) {
        Swal.fire('Error', 'Saldo Anda tidak cukup!', 'error');
        input.value = currentBetAmount;
        return;
    }

    currentBetAmount = amount;
    updateBetDisplay();
}

// ==================== COMMON FUNCTIONS ====================
function updateUI() {
    document.getElementById('balance').innerText = balance.toLocaleString('id-ID');
    document.getElementById('total-rounds').innerText = rounds;
    document.getElementById('total-bet-amount').innerText = "Rp " + totalBetAmount.toLocaleString('id-ID');
    document.getElementById('max-win').innerText = "Rp " + maxWin.toLocaleString('id-ID');
    document.getElementById('current-balance').innerText = "Rp " + balance.toLocaleString('id-ID');

    const loss = initialBalance - balance;
    document.getElementById('total-loss').innerText = "Rp " + loss.toLocaleString('id-ID');

    const percentage = (balance / initialBalance) * 100;
    const progressBar = document.getElementById('balance-progress');
    progressBar.style.width = percentage + '%';
    progressBar.innerText = Math.round(percentage) + '%';

    if (percentage > 70) {
        progressBar.className = 'progress-bar bg-success';
    } else if (percentage > 30) {
        progressBar.className = 'progress-bar bg-warning';
    } else {
        progressBar.className = 'progress-bar bg-danger';
    }
}

function gameOver() {
    saveBalanceToDatabase();
    saveSimulationResults();

    Swal.fire({
        icon: 'error',
        title: 'Saldo Habis!',
        html: `<div class="text-start">
            <p>Saldo Anda telah habis setelah <strong>${rounds} putaran</strong>.</p>
            <hr>
            <p><strong>📊 Analisis Hasil:</strong></p>
            <ul>
                <li>Modal awal: <strong>Rp ${initialBalance.toLocaleString('id-ID')}</strong></li>
                <li>Total taruhan: <strong>Rp ${totalBetAmount.toLocaleString('id-ID')}</strong></li>
                <li>Saldo akhir: <strong>Rp 0</strong></li>
                <li>Total loss: <strong class="text-danger">Rp ${initialBalance.toLocaleString('id-ID')}</strong> (100%)</li>
                <li>Win terbesar: <strong>Rp ${maxWin.toLocaleString('id-ID')}</strong></li>
            </ul>
            <hr>
            <p class="text-danger"><strong>💡 Kesimpulan Edukatif:</strong></p>
            <p>Meskipun Anda sempat menang beberapa kali, <strong>house edge matematika</strong> 
            memastikan bandar selalu untung dalam jangka panjang.</p>
            <p class="small"><em>"The house always wins" - bukan karena curang, tapi karena matematika probabilitas.</em></p>
        </div>`,
        confirmButtonText: 'Kembali ke Menu',
        allowOutsideClick: false,
        width: '600px'
    }).then(() => {
        window.location.href = '/sigma/simulator';
    });
}

function saveBalanceToDatabase() {
    fetch('/sigma/index.php?url=simulator/updateBalance', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            balance: balance
        })
    }).catch(err => console.error('Error saving balance:', err));
}

function saveSimulationResults() {
    if (rounds === 0) return;

    fetch('/sigma/index.php?url=simulator/save', {
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
    }).catch(err => console.error('Error saving simulation:', err));
}

window.addEventListener('beforeunload', function(e) {
    if (rounds > 0) {
        saveBalanceToDatabase();
        saveSimulationResults();
    }
});
