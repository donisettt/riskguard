<div class="container-fluid px-4 pt-4">

    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-9">

            <div class="card shadow-sm border-0" style="border-radius: 14px;">
                <div class="card-header py-3 text-white"
                    style="background: linear-gradient(135deg, #ffc107 0%, #ffb300 100%);">
                    <h6 class="mb-0 fw-semibold">
                        <i class="fas fa-edit me-2"></i> Edit Materi Edukasi
                    </h6>
                </div>

                <div class="card-body p-4">
                    <form action="/sigma/index.php?url=education/update_data/<?= $data['article']['id'] ?>"
                        method="POST"
                        enctype="multipart/form-data">

                        <input type="hidden" name="old_banner" value="<?= $data['article']['banner'] ?>">

                        <!-- Judul -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold small">
                                Judul Artikel
                            </label>
                            <input type="text"
                                name="title"
                                class="form-control"
                                value="<?= htmlspecialchars($data['article']['title']) ?>"
                                required>
                        </div>

                        <!-- Banner -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold small">
                                Banner Gambar
                            </label>

                            <div class="mb-2 p-2 bg-light rounded border">
                                <img src="/sigma/public/uploads/<?= $data['article']['banner'] ?>"
                                    class="rounded"
                                    style="max-width: 80px;">
                            </div>

                            <input type="file"
                                name="banner"
                                class="form-control"
                                accept="image/jpeg,image/png,image/jpg">
                            <small class="text-muted">
                                Kosongkan jika tidak ingin mengganti banner
                            </small>
                        </div>

                        <!-- Konten -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold small">
                                Isi Konten
                            </label>
                            <textarea name="content"
                                class="form-control"
                                rows="6"
                                required><?= $data['article']['content'] ?></textarea>
                        </div>

                        <!-- Action -->
                        <div class="d-flex justify-content-end gap-2">
                            <a href="/sigma/index.php?url=education" class="btn btn-light px-4">
                                Batal
                            </a>
                            <button type="submit" class="btn btn-warning text-white px-4">
                                <i class="fas fa-sync-alt me-1"></i> Update
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>

</div>