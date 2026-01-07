<div class="container-fluid px-4 py-4">

    <!-- Alert Container -->
    <div id="alert-container"></div>

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center gap-3">
            <div class="icon-shape bg-success text-white">
                <i class="fas fa-clipboard-list"></i>
            </div>
            <h4 class="mb-0 fw-semibold">Bank Soal Assessment</h4>
        </div>

        <a href="index.php?url=questions/create" class="btn btn-success px-4">
            <i class="fas fa-plus me-2"></i> Tambah Soal
        </a>
    </div>

    <!-- CARD -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">

            <div class="table-responsive">
                <table id="questions-table" class="table table-hover align-middle mb-0">
                    <thead class="table-light border-bottom">
                        <tr class="text-uppercase small text-muted">
                            <th class="ps-4" width="5%">No</th>
                            <th>Pertanyaan</th>
                            <th width="18%">Grup Assessment</th>
                            <th class="text-center" width="12%">Bobot Risiko</th>
                            <th class="text-center pe-4" width="15%">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <i class="fas fa-spinner fa-spin fa-2x mb-2"></i>
                                <div>Memuat data...</div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div id="pagination-container" class="px-4 py-3 border-top"></div>

        </div>
    </div>

</div>

<script src="/sigma/public/js/questions.js"></script>