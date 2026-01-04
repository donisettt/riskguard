<div class="row justify-content-center mt-5">
    <div class="col-md-6">
        <div class="card shadow border-0">
            <div class="card-header bg-white">
                <h5 class="m-0 fw-bold text-success">Tambah Pertanyaan Baru</h5>
            </div>
            <div class="card-body">
                <form action="index.php?url=questions/store" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Grup Assessment</label>
                        <select name="group_id" class="form-select">
                            <option value="">-- Pilih Grup (Opsional) --</option>
                            <?php foreach ($data['groups'] as $group): ?>
                                <option value="<?= $group['id'] ?>"><?= htmlspecialchars($group['title']) ?></option>
                            <?php endforeach; ?>
                        </select>
                        <small class="text-muted">Pilih grup untuk mengelompokkan soal berdasarkan kategori</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Teks Pertanyaan</label>
                        <textarea name="question" class="form-control" rows="3" placeholder="Contoh: Seberapa sering anda meminjam uang untuk berjudi?" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Bobot Risiko (Weight)</label>
                        <input type="number" step="0.1" name="weight" class="form-control" placeholder="1.0" required>
                        <small class="text-muted">Semakin besar angka, semakin tinggi pengaruhnya terhadap hasil risiko.</small>
                    </div>

                    <button type="submit" class="btn btn-success w-100">Simpan Pertanyaan</button>
                    <a href="index.php?url=questions" class="btn btn-light w-100 mt-2">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>