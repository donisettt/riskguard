<div class="container-fluid px-4 pt-4">

    <!-- HEADER -->
    <div class="mb-4">
        <h3 class="fw-semibold d-flex align-items-center gap-2">
            <i class="fas fa-graduation-cap text-success"></i>
            Pusat Edukasi
        </h3>
        <p class="text-muted mb-0">
            Pelajari bahaya dan dampak psikologis dari perjudian online.
        </p>
    </div>

    <!-- GRID ARTIKEL -->
    <div class="row g-4">
        <?php foreach ($data['articles'] as $row): ?>
            <div class="col-xl-3 col-lg-4 col-md-6">

                <div class="card h-100 border-0 shadow-sm edu-card">

                    <!-- Banner -->
                    <img src="/sigma/public/uploads/<?= $row['banner'] ?>"
                        class="card-img-top"
                        alt="<?= htmlspecialchars($row['title']) ?>"
                        style="height: 180px; object-fit: cover;">

                    <!-- Body -->
                    <div class="card-body d-flex flex-column">
                        <h6 class="fw-semibold text-dark mb-2">
                            <?= htmlspecialchars($row['title']) ?>
                        </h6>

                        <p class="text-muted small flex-grow-1 mb-3">
                            <?= substr(strip_tags($row['content']), 0, 90) ?>...
                        </p>

                        <button class="btn btn-success btn-sm mt-auto"
                            data-bs-toggle="modal"
                            data-bs-target="#readModal<?= $row['id'] ?>">
                            <i class="fas fa-book-reader me-1"></i>
                            Baca Selengkapnya
                        </button>
                    </div>

                    <!-- Footer -->
                    <div class="card-footer bg-white border-0 text-muted small d-flex align-items-center gap-2">
                        <i class="far fa-calendar"></i>
                        <?= date('d M Y', strtotime($row['created_at'])) ?>
                    </div>
                </div>

            </div>

            <!-- MODAL -->
            <div class="modal fade" id="readModal<?= $row['id'] ?>" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content border-0" style="border-radius: 16px;">

                        <!-- HEADER -->
                        <div class="modal-header px-4 py-3"
                            style="background: linear-gradient(135deg, #c1efde, #a8e6cf);">
                            <h5 class="modal-title fw-semibold text-success d-flex align-items-center gap-2">
                                <i class="fas fa-book-open"></i>
                                <?= htmlspecialchars($row['title']) ?>
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- BODY -->
                        <div class="modal-body p-0">

                            <!-- Banner -->
                            <div class="px-4 pt-4">
                                <img src="/sigma/public/uploads/<?= $row['banner'] ?>"
                                    class="img-fluid w-100 rounded shadow-sm"
                                    style="max-height: 260px; object-fit: cover;">
                            </div>

                            <!-- Content -->
                            <div class="px-4 py-4">

                                <div class="text-muted small mb-3 d-flex align-items-center gap-2">
                                    <i class="far fa-calendar"></i>
                                    <?= date('d M Y', strtotime($row['created_at'])) ?>
                                </div>

                                <div class="edu-content">
                                    <?= $row['content'] ?>
                                </div>

                            </div>

                        </div>

                        <!-- FOOTER -->
                        <div class="modal-footer px-4 py-3">
                            <button type="button" class="btn btn-secondary px-4"
                                data-bs-dismiss="modal">
                                Tutup
                            </button>
                        </div>

                    </div>
                </div>
            </div>

        <?php endforeach; ?>
    </div>

</div>