<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white py-3">
                <h4 class="m-0"><i class="fas fa-clipboard-check me-2"></i>Kuesioner Analisis Risiko</h4>
                <small>Jawablah dengan jujur sesuai kondisi Anda dalam 12 bulan terakhir.</small>
            </div>
            <div class="card-body p-4">
                <form action="index.php?url=assessment/submit" method="POST">

                    <?php foreach ($data['questions'] as $index => $row): ?>
                        <div class="mb-5 border-bottom pb-3">
                            <h5 class="fw-bold text-dark mb-3">
                                <?= ($index + 1) . ". " . $row['question'] ?>
                            </h5>

                            <div class="d-flex justify-content-between px-3">
                                <div class="form-check text-center">
                                    <input class="form-check-input float-none" type="radio" name="answers[<?= $row['id'] ?>]" value="0" required style="width: 20px; height: 20px;">
                                    <label class="d-block mt-2 small text-muted">Tidak Pernah<br>(0)</label>
                                </div>
                                <div class="form-check text-center">
                                    <input class="form-check-input float-none" type="radio" name="answers[<?= $row['id'] ?>]" value="1" style="width: 20px; height: 20px;">
                                    <label class="d-block mt-2 small text-muted">Kadang-kadang<br>(1)</label>
                                </div>
                                <div class="form-check text-center">
                                    <input class="form-check-input float-none" type="radio" name="answers[<?= $row['id'] ?>]" value="2" style="width: 20px; height: 20px;">
                                    <label class="d-block mt-2 small text-muted">Sering<br>(2)</label>
                                </div>
                                <div class="form-check text-center">
                                    <input class="form-check-input float-none" type="radio" name="answers[<?= $row['id'] ?>]" value="3" style="width: 20px; height: 20px;">
                                    <label class="d-block mt-2 small text-muted">Hampir Selalu<br>(3)</label>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-success btn-lg py-3 fw-bold">
                            LIHAT HASIL ANALISIS SAYA <i class="fas fa-arrow-right ms-2"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>