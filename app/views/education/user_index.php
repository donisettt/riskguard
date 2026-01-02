<div class="mb-4">
    <h3><i class="fas fa-graduation-cap" style="color: #009d63;"></i> Pusat Edukasi</h3>
    <p class="text-muted">Pelajari bahaya dan dampak psikologis dari perjudian online.</p>
</div>

<div class="row g-4">
    <?php foreach ($data['articles'] as $row): ?>
        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0" style="transition: transform 0.3s ease, box-shadow 0.3s ease;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 8px 20px rgba(0,157,99,0.15)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='';">
                <img src="/sigma/public/uploads/<?= $row['banner'] ?>"
                    class="card-img-top"
                    alt="<?= htmlspecialchars($row['title']) ?>"
                    style="height: 200px; object-fit: cover;">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title fw-bold text-dark"><?= htmlspecialchars($row['title']) ?></h5>
                    <p class="card-text text-muted small flex-grow-1">
                        <?= substr(strip_tags($row['content']), 0, 100) ?>...
                    </p>
                    <button class="btn btn-sm w-100 mt-2"
                        style="background-color: #009d63; border-color: #009d63; color: white;"
                        data-bs-toggle="modal"
                        data-bs-target="#readModal<?= $row['id'] ?>">
                        <i class="fas fa-book-reader"></i> Baca Selengkapnya
                    </button>
                </div>
                <div class="card-footer bg-white border-0 text-muted small">
                    <i class="far fa-calendar"></i> <?= date('d M Y', strtotime($row['created_at'])) ?>
                </div>
            </div>
        </div>

        <div class="modal fade" id="readModal<?= $row['id'] ?>" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #c1efde; border-bottom: 3px solid #009d63;">
                        <h5 class="modal-title fw-bold" style="color: #009d63;">
                            <i class="fas fa-book-open"></i> <?= htmlspecialchars($row['title']) ?>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <img src="/sigma/public/uploads/<?= $row['banner'] ?>"
                            class="img-fluid w-100 rounded mb-4 shadow-sm"
                            style="max-height: 400px; object-fit: cover;">
                        <div style="white-space: pre-line; line-height: 1.8; color: #333;">
                            <?= $row['content'] ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>