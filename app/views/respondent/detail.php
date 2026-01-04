<div class="container-fluid px-4 py-4">

    <!-- BACK BUTTON -->
    <div class="mb-4">
        <a href="index.php?url=respondent" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
            <i class="fas fa-arrow-left me-1"></i> Kembali ke Data Responden
        </a>
    </div>

    <div class="row g-4">

        <!-- RINGKASAN -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white border-0 fw-semibold">
                    Ringkasan Hasil
                </div>

                <div class="card-body text-center py-4">
                    <?php if ($data['result_header']): ?>

                        <h1 class="fw-bold display-5 mb-0">
                            <?= number_format($data['result_header']['total_score'], 2) ?>
                        </h1>
                        <small class="text-muted">Total Skor</small>

                        <hr class="my-4">

                        <?php
                        $risk = $data['result_header']['risk_level'];
                        $badge = 'secondary';
                        if ($risk === 'Rendah') $badge = 'success';
                        if ($risk === 'Sedang') $badge = 'warning';
                        if ($risk === 'Tinggi') $badge = 'danger';
                        if ($risk === 'Bahaya') $badge = 'danger';
                        ?>

                        <div class="mb-3">
                            <span class="fw-semibold me-2">Status:</span>
                            <span class="badge rounded-pill bg-<?= $badge ?> px-3 py-2">
                                <?= $risk ?>
                            </span>
                        </div>

                        <small class="text-muted d-block">
                            Tanggal Tes<br>
                            <?= date('d M Y, H:i', strtotime($data['result_header']['created_at'])) ?>
                        </small>

                    <?php else: ?>
                        <div class="text-muted">Data tidak ditemukan.</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- RINCIAN JAWABAN -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-white border-0 fw-semibold">
                    Rincian Jawaban Per Soal
                </div>

                <div class="card-body">

                    <?php if (!empty($data['answers'])): ?>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light border-bottom">
                                    <tr class="text-uppercase small text-muted">
                                        <th>Pertanyaan</th>
                                        <th class="text-center" width="15%">Jawaban</th>
                                        <th class="text-center" width="15%">Bobot</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data['answers'] as $ans): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($ans['question']) ?></td>

                                            <td class="text-center">
                                                <span class="badge bg-light text-dark border px-3 py-2">
                                                    <?= $ans['answer_value'] ?>
                                                </span>
                                            </td>

                                            <td class="text-center fw-semibold">
                                                <?= number_format($ans['weight'], 2) ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-warning mb-0">
                            User ini belum mengisi kuesioner.
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>

    </div>
</div>