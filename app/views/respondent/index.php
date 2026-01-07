<div class="container-fluid px-4 py-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center gap-3">
            <div class="icon-shape bg-success text-white">
                <i class="fas fa-users"></i>
            </div>
            <div>
                <h4 class="mb-0 fw-semibold">Data Responden</h4>
                <small class="text-muted">Daftar pengguna yang terdaftar di sistem.</small>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">

            <div class="table-responsive">
                <table id="respondents-table" class="table table-hover align-middle mb-0">
                    <thead class="table-light border-bottom">
                        <tr class="text-uppercase small text-muted">
                            <th class="ps-4">No</th>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>Status Risiko (Terakhir)</th>
                            <th class="pe-4">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td colspan="5" class="text-center py-5">
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

<!-- Include Respondent JavaScript -->
<script src="/sigma/public/js/respondent.js"></script>