<?php
// Logic warna berdasarkan hasil
$level = $data['result']['risk_level'];
$color = 'success';
$icon = 'fa-check-circle';
$msg = 'Anda memiliki kendali yang baik.';

if ($level == 'Sedang') {
    $color = 'warning';
    $icon = 'fa-exclamation-circle';
    $msg = 'Waspada! Anda mulai menunjukkan tanda risiko.';
}
if ($level == 'Tinggi') {
    $color = 'orange';
    $icon = 'fa-exclamation-triangle';
    $msg = 'Bahaya! Segera cari bantuan atau berhenti.';
}
if ($level == 'Bahaya') {
    $color = 'danger';
    $icon = 'fa-skull-crossbones';
    $msg = 'KRITIS! Anda memerlukan intervensi profesional.';
}
?>

<div class="row justify-content-center mt-4">
    <div class="col-md-8 text-center">

        <div class="card shadow-lg border-0 mb-4">
            <div class="card-body p-5">
                <h2 class="text-muted mb-4">Hasil Analisis Risiko Anda</h2>

                <div class="display-1 text-<?= $color ?> mb-3">
                    <i class="fas <?= $icon ?>"></i>
                </div>

                <h1 class="fw-bold text-<?= $color ?> display-4 text-uppercase"><?= $level ?></h1>
                <p class="lead mt-3"><?= $msg ?></p>

                <hr class="my-4">

                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="bg-light p-3 rounded">
                            <h5 class="m-0 text-muted">Total Skor Risiko</h5>
                            <h2 class="fw-bold m-0"><?= number_format($data['result']['total_score'], 1) ?></h2>
                        </div>
                    </div>
                </div>

                <div class="mt-5 d-flex justify-content-center gap-3">
                    <a href="index.php?url=assessment" class="btn btn-outline-secondary">
                        <i class="fas fa-redo"></i> Coba Lagi
                    </a>
                    <a href="index.php?url=simulator" class="btn btn-primary">
                        <i class="fas fa-gamepad"></i> Lanjut ke Simulator RNG
                    </a>
                    <a href="index.php?url=education" class="btn btn-info text-white">
                        <i class="fas fa-book-open"></i> Baca Edukasi
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>