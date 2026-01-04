<div class="container-fluid px-4 py-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center gap-3">
            <div class="icon-shape bg-primary text-white">
                <i class="fas fa-layer-group"></i>
            </div>
            <h4 class="mb-0 fw-semibold">Manajemen Grup Assessment</h4>
        </div>

        <a href="index.php?url=assessment-groups/create" class="btn btn-primary px-4">
            <i class="fas fa-plus me-2"></i> Tambah Grup
        </a>
    </div>

    <!-- CARD -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light border-bottom">
                        <tr class="text-uppercase small text-muted">
                            <th class="ps-4" width="5%">No</th>
                            <th>Judul Grup</th>
                            <th>Deskripsi</th>
                            <th class="text-center" width="12%">Jumlah Soal</th>
                            <th class="text-center pe-4" width="15%">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $no = ($data['currentPage'] - 1) * $data['limit'] + 1;
                        foreach ($data['groups'] as $row): ?>
                            <tr>
                                <td class="ps-4 fw-semibold"><?= $no++ ?></td>
                                <td>
                                    <div class="fw-semibold text-primary"><?= htmlspecialchars($row['title']) ?></div>
                                </td>
                                <td><?= htmlspecialchars($row['description'] ?? '-') ?></td>
                                <td class="text-center">
                                    <span class="badge rounded-pill bg-info text-dark px-3 py-2">
                                        <?= $row['total_questions'] ?? 0 ?> Soal
                                    </span>
                                </td>
                                <td class="text-center pe-4">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="index.php?url=assessment-groups/edit/<?= $row['id'] ?>"
                                            class="btn btn-sm btn-warning text-white">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="index.php?url=assessment-groups/delete/<?= $row['id'] ?>"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Hapus grup ini? Soal yang terhubung tidak akan dihapus.')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                        <?php if (empty($data['groups'])): ?>
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="fas fa-folder-open fa-2x mb-2"></i>
                                    <div>Belum ada grup assessment</div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <?php if ($data['totalPages'] > 1): ?>
                <div class="d-flex justify-content-between align-items-center px-4 py-3 border-top">
                    <small class="text-muted">
                        Halaman <?= $data['currentPage'] ?> dari <?= $data['totalPages'] ?>
                    </small>

                    <nav>
                        <ul class="pagination mb-0">

                            <li class="page-item <?= $data['currentPage'] <= 1 ? 'disabled' : '' ?>">
                                <a class="page-link"
                                    href="index.php?url=assessment-groups&page=<?= $data['currentPage'] - 1 ?>">
                                    &laquo;
                                </a>
                            </li>

                            <?php for ($i = 1; $i <= $data['totalPages']; $i++): ?>
                                <li class="page-item <?= $i == $data['currentPage'] ? 'active' : '' ?>">
                                    <a class="page-link"
                                        href="index.php?url=assessment-groups&page=<?= $i ?>">
                                        <?= $i ?>
                                    </a>
                                </li>
                            <?php endfor; ?>

                            <li class="page-item <?= $data['currentPage'] >= $data['totalPages'] ? 'disabled' : '' ?>">
                                <a class="page-link"
                                    href="index.php?url=assessment-groups&page=<?= $data['currentPage'] + 1 ?>">
                                    &raquo;
                                </a>
                            </li>

                        </ul>
                    </nav>
                </div>
            <?php endif; ?>

        </div>
    </div>

</div>