<div class="container-fluid px-4 py-4">

    <!-- Alert Container -->
    <div id="alert-container"></div>

    <!-- HEADER -->
    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="index.php?url=questions" class="btn btn-light">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div class="d-flex align-items-center gap-3">
            <div class="icon-shape bg-warning text-white">
                <i class="fas fa-edit"></i>
            </div>
            <h4 class="mb-0 fw-semibold">Edit Pertanyaan</h4>
        </div>
    </div>

    <!-- FORM CARD -->
    <div class="row">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">

                    <form data-question-form="edit" data-edit-id="<?= $data['q']['id'] ?>">

                        <div class="mb-4">
                            <label for="group_id" class="form-label fw-semibold">
                                Grup Assessment
                            </label>
                            <select name="group_id"
                                id="group_id"
                                class="form-select"
                                data-selected-group="<?= $data['q']['group_id'] ?? '' ?>">
                                <option value="">-- Pilih Grup (Opsional) --</option>
                                <?php foreach ($data['groups'] as $group): ?>
                                    <option value="<?= $group['id'] ?>" <?= ($data['q']['group_id'] == $group['id']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($group['title']) ?>
                                    </option>
                                <?php endforeach; ?>
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
                                required><?= htmlspecialchars($data['q']['question']) ?></textarea>
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
                                value="<?= $data['q']['weight'] ?>"
                                required>
                            <small class="text-muted">Semakin besar angka, semakin tinggi pengaruhnya terhadap hasil risiko.</small>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-warning text-white px-4">
                                <i class="fas fa-save me-2"></i> Update
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