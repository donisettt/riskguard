<div class="container-fluid px-4 py-4">

    <!-- Alert Container -->
    <div id="alert-container"></div>

    <!-- HEADER -->
    <div class="d-flex align-items-center gap-3 mb-4">
        <div class="d-flex align-items-center gap-3">
            <div class="icon-shape bg-success text-white">
                <i class="fas fa-plus-circle"></i>
            </div>
            <h4 class="mb-0 fw-semibold">Tambah Pertanyaan Baru</h4>
        </div>
    </div>

    <!-- FORM CARD -->
    <div class="row">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">

                    <form data-question-form="create">

                        <div class="mb-4">
                            <label for="group_id" class="form-label fw-semibold">
                                Grup Assessment
                            </label>
                            <select name="group_id" id="group_id" class="form-select">
                                <option value="">-- Pilih Grup (Opsional) --</option>
                            </select>
                            <small class="text-muted">Pilih grup untuk mengelompokkan soal berdasarkan kategori</small>
                        </div>

                        <div class="mb-4">
                            <label for="question" class="form-label fw-semibold">
                                Teks Pertanyaan <span class="text-danger">*</span>
                            </label>
                            <textarea name="question"
                                id="question"
                                class="form-control"
                                rows="3"
                                placeholder="Contoh: Seberapa sering anda meminjam uang untuk berjudi?"
                                required></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="weight" class="form-label fw-semibold">
                                Bobot Risiko (Weight) <span class="text-danger">*</span>
                            </label>
                            <input type="number"
                                step="0.1"
                                name="weight"
                                id="weight"
                                class="form-control"
                                placeholder="1.0"
                                required>
                            <small class="text-muted">Semakin besar angka, semakin tinggi pengaruhnya terhadap hasil risiko.</small>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success px-4">
                                <i class="fas fa-save me-2"></i> Simpan
                            </button>
                            <a href="index.php?url=questions" class="btn btn-light px-4">
                                Batal
                            </a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

</div>

<script src="/sigma/public/js/questions.js"></script>