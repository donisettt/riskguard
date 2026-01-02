<div class="container-fluid px-4 pt-4">

    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-9">

            <div class="card shadow-sm border-0" style="border-radius: 14px;">
                <div class="card-header py-3 text-white"
                    style="background: linear-gradient(135deg, #009d63 0%, #00b377 100%);">
                    <h6 class="mb-0 fw-semibold">
                        <i class="fas fa-plus-circle me-2"></i> Tambah Materi Edukasi
                    </h6>
                </div>

                <div class="card-body p-4">
                    <form action="/sigma/index.php?url=education/store" method="POST" enctype="multipart/form-data">

                        <!-- Judul -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold small">
                                Judul Artikel
                            </label>
                            <input type="text"
                                name="title"
                                class="form-control"
                                placeholder="Masukkan judul artikel..."
                                required>
                        </div>

                        <!-- Banner -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold small">
                                Banner Gambar
                            </label>
                            <input type="file"
                                name="banner"
                                class="form-control"
                                accept="image/jpeg,image/png,image/jpg"
                                required>
                            <small class="text-muted">
                                Format JPG / PNG, max 2MB
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
                                placeholder="Tulis konten artikel di sini..."
                                required></textarea>
                        </div>

                        <!-- Action -->
                        <div class="d-flex justify-content-end gap-2">
                            <a href="/sigma/index.php?url=education" class="btn btn-light px-4">
                                Batal
                            </a>
                            <button type="submit" class="btn btn-success px-4">
                                <i class="fas fa-save me-1"></i> Simpan
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>

</div>