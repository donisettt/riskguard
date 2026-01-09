<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

<div class="assessment-wrapper">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                
                <div class="sticky-progress">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-overline">Progress Analisis</span>
                        <span class="progress-percentage"><span id="currentQuestion">0</span> / <?= count($data['questions']) ?></span>
                    </div>
                    <div class="custom-progress-track">
                        <div class="custom-progress-fill" id="progressBar"></div>
                    </div>
                </div>

                <header class="assessment-intro mb-5">
                    <div class="brand-badge mb-3">Assessment</div>
                    <h1 class="display-6 fw-bold text-dark-emphasis mb-3"><?= htmlspecialchars($data['group']['title'] ?? 'Kuesioner Analisis Risiko') ?></h1>
                    <p class="text-secondary lead-sm">
                        <?= htmlspecialchars($data['group']['description'] ?? 'Jawablah sesuai kondisi Anda dalam 12 bulan terakhir. Data Anda dienkripsi dan bersifat rahasia.') ?>
                    </p>
                </header>

                <form action="index.php?url=assessment/submit" method="POST" id="assessmentForm">
                    <input type="hidden" name="group_id" value="<?= $data['group']['id'] ?? '' ?>">
                    
                    <?php foreach ($data['questions'] as $index => $row): ?>
                        <div class="q-card mb-4" id="q-container-<?= $index + 1 ?>" data-question-idx="<?= $index + 1 ?>">
                            <div class="q-header">
                                <span class="q-num">Pertanyaan <?= $index + 1 ?></span>
                            </div>
                            
                            <h2 class="q-text mb-4"><?= $row['question'] ?></h2>

                            <div class="options-grid">
                                <?php 
                                $options = [
                                    ['val' => 0, 'label' => 'Tidak Pernah', 'icon' => 'fa-smile'],
                                    ['val' => 1, 'label' => 'Kadang-kadang', 'icon' => 'fa-meh'],
                                    ['val' => 2, 'label' => 'Sering', 'icon' => 'fa-frown'],
                                    ['val' => 3, 'label' => 'Hampir Selalu', 'icon' => 'fa-angry']
                                ];
                                foreach ($options as $opt): ?>
                                <label class="opt-label">
                                    <input type="radio" name="answers[<?= $row['id'] ?>]" value="<?= $opt['val'] ?>" required class="d-none">
                                    <div class="opt-box">
                                        <div class="opt-indicator"></div>
                                        <span class="opt-text"><?= $opt['label'] ?></span>
                                    </div>
                                </label>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <div class="submit-footer mt-5 text-center">
                        <button type="submit" class="btn-primary-custom">
                            <span>Selesaikan & Lihat Hasil</span>
                            <i class="fas fa-arrow-right ms-2"></i>
                        </button>
                        <div class="mt-3 text-muted small">
                            <i class="fas fa-shield-alt me-1"></i> Data dienkripsi secara end-to-end
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="/sigma/public/css/form.css">

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('assessmentForm');
    const radioButtons = form.querySelectorAll('input[type="radio"]');
    const progressBar = document.getElementById('progressBar');
    const currentQuestionSpan = document.getElementById('currentQuestion');
    const totalQuestions = <?= count($data['questions']) ?>;

    function updateProgress() {
        const answeredQuestions = new Set();
        radioButtons.forEach(radio => {
            if (radio.checked) answeredQuestions.add(radio.name);
        });

        const answeredCount = answeredQuestions.size;
        const percentage = (answeredCount / totalQuestions) * 100;

        progressBar.style.width = percentage + '%';
        currentQuestionSpan.textContent = answeredCount;
    }

    // Auto-scroll logic
    radioButtons.forEach(radio => {
        radio.addEventListener('change', (e) => {
            updateProgress();
            
            // Mencari container pertanyaan selanjutnya
            const currentCard = e.target.closest('.q-card');
            const nextIdx = parseInt(currentCard.dataset.questionIdx) + 1;
            const nextCard = document.getElementById('q-container-' + nextIdx);

            if (nextCard) {
                setTimeout(() => {
                    const offset = 150; // Jarak dari atas (karena ada sticky header)
                    const bodyRect = document.body.getBoundingClientRect().top;
                    const elementRect = nextCard.getBoundingClientRect().top;
                    const elementPosition = elementRect - bodyRect;
                    const offsetPosition = elementPosition - offset;

                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });
                }, 300); // delay sebentar agar user melihat animas pilihannya
            }
        });
    });
});
</script>