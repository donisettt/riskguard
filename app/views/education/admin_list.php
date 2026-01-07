<div class="container-fluid px-4 pt-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0 d-flex align-items-center">
            <i class="fas fa-book-open text-success me-3 fs-4"></i>
            <span class="text-dark fw-semibold">Manajemen Edukasi</span>
        </h3>

        <a href="/sigma/index.php?url=education/create"
            class="btn btn-success px-4 py-2 shadow-sm">
            <i class="fas fa-plus me-2"></i> Tambah Artikel
        </a>
    </div>

    <!-- CARD TABLE -->
    <div class="card shadow-sm border-0" style="border-radius: 14px;">
        <div class="card-body p-3">

            <div class="table-responsive">
                <table id="articles-table" class="table table-hover align-middle mb-0">
                    <thead style="background: linear-gradient(135deg, #c1efde 0%, #a8e6cf 100%);">
                        <tr>
                            <th style="width: 5%" class="ps-3 text-muted">No</th>
                            <th style="width: 40%" class="text-muted">Judul</th>
                            <th style="width: 15%" class="text-muted">Banner</th>
                            <th style="width: 18%" class="text-muted">Tanggal Upload</th>
                            <th style="width: 22%" class="text-center text-muted">Aksi</th>
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

<!-- Include Education JavaScript -->
<script src="/sigma/public/js/education.js"></script>