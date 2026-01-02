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
                <table class="table table-hover align-middle mb-0">
                    <thead style="background: linear-gradient(135deg, #c1efde 0%, #a8e6cf 100%);">
                        <tr>
                            <th style="width: 5%" class="ps-3 text-muted">No</th>
                            <th style="width: 15%" class="text-muted">Banner</th>
                            <th style="width: 40%" class="text-muted">Judul</th>
                            <th style="width: 18%" class="text-muted">Tanggal</th>
                            <th style="width: 15%" class="text-center text-muted">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (empty($data['articles'])): ?>
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                    <p class="text-muted mb-0">Belum ada artikel edukasi</p>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php $no = 1;
                            foreach ($data['articles'] as $row): ?>
                                <tr>
                                    <td class="ps-3 fw-semibold text-secondary">
                                        <?= $no++ ?>
                                    </td>

                                    <td>
                                        <img src="/sigma/public/uploads/<?= $row['banner'] ?>"
                                            width="80"
                                            height="55"
                                            class="rounded shadow-sm border"
                                            style="object-fit: cover;">
                                    </td>

                                    <td>
                                        <div class="fw-medium text-dark" style="font-size: 0.9rem;">
                                            <?= htmlspecialchars($row['title']) ?>
                                        </div>
                                    </td>

                                    <td>
                                        <span class="badge bg-light text-dark border px-3 py-2">
                                            <i class="far fa-calendar-alt text-success me-1"></i>
                                            <?= date('d M Y', strtotime($row['created_at'])) ?>
                                        </span>
                                    </td>

                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="/sigma/index.php?url=education/edit/<?= $row['id'] ?>"
                                                class="btn btn-sm btn-warning text-white px-3">
                                                <i class="fas fa-edit me-1"></i> Edit
                                            </a>

                                            <a href="/sigma/index.php?url=education/delete/<?= $row['id'] ?>"
                                                class="btn btn-sm btn-danger px-3"
                                                onclick="return confirm('Yakin ingin menghapus artikel ini?')">
                                                <i class="fas fa-trash me-1"></i> Hapus
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>