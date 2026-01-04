<div class="container-fluid px-4 py-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center gap-3">
            <div class="icon-shape bg-success text-white">
                <i class="fas fa-users"></i>
            </div>
            <div>
                <h4 class="mb-0 fw-semibold">Data Responden</h4>
                <small class="text-muted">Daftar pengguna yang terdaftar di sistem.</small>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light border-bottom">
                        <tr class="text-uppercase small text-muted">
                            <th class="ps-4">No</th>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>Status Risiko (Terakhir)</th>
                            <th class="pe-4">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($data['respondents'] as $row):
                        ?>
                            <tr>
                                <td class="ps-4 fw-semibold"><?= $no++ ?></td>

                                <td>
                                    <div class="fw-semibold"><?= $row['name'] ?></div>
                                    <small class="text-muted">User ID: <?= $row['id'] ?></small>
                                </td>

                                <td><?= $row['email'] ?></td>

                                <td>
                                    <?php if ($row['last_risk']): ?>
                                        <?php
                                        $bg = 'secondary';

                                        if ($row['last_risk'] === 'Rendah')  $bg = 'success';
                                        if ($row['last_risk'] === 'Sedang')  $bg = 'warning';
                                        if ($row['last_risk'] === 'Tinggi')  $bg = 'danger';
                                        if ($row['last_risk'] === 'Bahaya')  $bg = 'danger';
                                        ?>
                                        <span class="badge rounded-pill bg-<?= $bg ?> px-3 py-2">
                                            <?= $row['last_risk'] ?>
                                        </span>

                                    <?php else: ?>
                                        <span class="badge bg-light text-dark border px-3 py-2">
                                            Belum Mengerjakan
                                        </span>
                                    <?php endif; ?>
                                </td>

                                <td class="pe-4">
                                    <?php if ($row['last_risk']): ?>
                                        <a href="index.php?url=respondent/detail/<?= $row['id'] ?>"
                                            class="btn btn-sm btn-info text-white">
                                            <i class="fas fa-eye me-1"></i> Lihat Jawaban
                                        </a>
                                    <?php else: ?>
                                        <button class="btn btn-sm btn-secondary" disabled>No Data</button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                        <?php if (empty($data['respondents'])): ?>
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="fas fa-users-slash fa-2x mb-2"></i>
                                    <div>Belum ada responden</div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>