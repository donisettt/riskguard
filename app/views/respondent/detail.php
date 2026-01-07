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

                <div id="summary-card" class="card-body text-center py-4">
                    <div class="text-center py-5">
                        <i class="fas fa-spinner fa-spin fa-2x text-muted mb-3"></i>
                        <p class="text-muted mb-0">Loading...</p>
                    </div>
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
                    <div class="table-responsive">
                        <table id="answers-table" class="table table-hover align-middle mb-0">
                            <thead class="table-light border-bottom">
                                <tr class="text-uppercase small text-muted">
                                    <th>Pertanyaan</th>
                                    <th class="text-center" width="15%">Jawaban</th>
                                    <th class="text-center" width="15%">Bobot</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="3" class="text-center py-5">
                                        <i class="fas fa-spinner fa-spin fa-2x text-muted mb-3"></i>
                                        <p class="text-muted mb-0">Loading...</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Include Respondent JavaScript -->
<script src="/sigma/public/js/respondent.js"></script>