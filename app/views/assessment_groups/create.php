<div class="container-fluid px-4 py-4">

    <!-- Alert Container -->
    <div id="alert-container"></div>

    <!-- HEADER -->
    <div class="d-flex align-items-center gap-3 mb-4">
        <div class="d-flex align-items-center gap-3">
            <div class="icon-shape bg-success text-white">
                <i class="fas fa-plus-circle"></i>
            </div>
            <h4 class="mb-0 fw-semibold">Tambah Grup Assessment</h4>
        </div>
    </div>

    <!-- FORM CARD -->
    <div class="row">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">

                    <form data-group-form="create">

                        <div class="mb-4">
                            <label for="title" class="form-label fw-semibold">
                                Judul Grup <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                class="form-control form-control-lg"
                                id="title"
                                name="title"
                                placeholder="Contoh: Pengembangan Diri, Kesehatan Mental"
                                required>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label fw-semibold">
                                Deskripsi
                            </label>
                            <textarea class="form-control"
                                id="description"
                                name="description"
                                rows="4"
                                placeholder="Jelaskan tujuan dari grup assessment ini..."></textarea>
                            <small class="text-muted">
                                Deskripsi akan membantu user memahami tujuan dari assessment ini
                            </small>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success px-4">
                                <i class="fas fa-save me-2"></i> Simpan
                            </button>
                            <a href="index.php?url=assessment-groups" class="btn btn-light px-4">
                                Batal
                            </a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

</div>

<script src="/sigma/public/js/assessment-groups.js"></script>