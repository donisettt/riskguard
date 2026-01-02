<div class="row justify-content-center mt-5">
    <div class="col-md-6">
        <div class="card shadow border-0">
            <div class="card-header bg-white">
                <h5 class="m-0 fw-bold text-warning">Edit Pertanyaan</h5>
            </div>
            <div class="card-body">
                <form action="index.php?url=questions/update/<?= $data['q']['id'] ?>" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Teks Pertanyaan</label>
                        <textarea name="question" class="form-control" rows="3" required><?= htmlspecialchars($data['q']['question']) ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Bobot Risiko (Weight)</label>
                        <input type="number" step="0.1" name="weight" class="form-control" value="<?= $data['q']['weight'] ?>" required>
                    </div>

                    <button type="submit" class="btn btn-warning w-100 text-white">Update Pertanyaan</button>
                    <a href="index.php?url=questions" class="btn btn-light w-100 mt-2">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>