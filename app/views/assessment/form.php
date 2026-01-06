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

<style>
    :root {
        --primary-color: #009d63;
        --bg-body: #f8fafc;
        --text-main: #1e293b;
        --card-border: #e2e8f0;
    }

    body {
        background-color: var(--bg-body);
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: var(--text-main);
    }

    /* Sticky Progress */
    .sticky-progress {
        position: sticky;
        top: 20px;
        z-index: 100;
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(12px);
        padding: 15px 20px;
        border-radius: 16px;
        border: 1px solid var(--card-border);
        box-shadow: 0 4px 20px rgba(0,0,0,0.03);
        margin-bottom: 40px;
    }

    .text-overline {
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 11px;
        font-weight: 700;
        color: #64748b;
    }

    .custom-progress-track {
        height: 6px;
        background: #e2e8f0;
        border-radius: 10px;
        overflow: hidden;
    }

    .custom-progress-fill {
        height: 100%;
        width: 0%;
        background: var(--primary-color);
        border-radius: 10px;
        transition: width 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    /* Intro Section */
    .brand-badge {
        display: inline-block;
        padding: 4px 12px;
        background: #dcfce7;
        color: #166534;
        border-radius: 100px;
        font-size: 12px;
        font-weight: 700;
    }

    /* Question Cards */
    .q-card {
        background: #ffffff;
        border-radius: 24px;
        padding: 40px;
        border: 1px solid var(--card-border);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .q-card:focus-within {
        border-color: var(--primary-color);
        box-shadow: 0 10px 30px rgba(0, 157, 99, 0.05);
    }

    .q-num {
        font-size: 14px;
        font-weight: 600;
        color: var(--primary-color);
    }

    .q-text {
        font-size: 1.25rem;
        font-weight: 700;
        line-height: 1.4;
        color: #0f172a;
    }

    /* Options Grid */
    .options-grid {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .opt-label {
        width: 100%;
        cursor: pointer;
    }

    .opt-box {
        display: flex;
        align-items: center;
        padding: 16px 20px;
        background: #fff;
        border: 1.5px solid #e2e8f0;
        border-radius: 14px;
        transition: all 0.2s ease;
    }

    .opt-indicator {
        width: 18px;
        height: 18px;
        border: 2px solid #cbd5e1;
        border-radius: 50%;
        margin-right: 15px;
        position: relative;
        transition: all 0.2s ease;
    }

    .opt-label input:checked + .opt-box {
        background: #f0fdf4;
        border-color: var(--primary-color);
    }

    .opt-label input:checked + .opt-box .opt-indicator {
        border-color: var(--primary-color);
        background: var(--primary-color);
        box-shadow: inset 0 0 0 3px #fff;
    }

    .opt-label input:checked + .opt-box .opt-text {
        color: var(--primary-color);
        font-weight: 600;
    }

    .opt-text {
        font-size: 15px;
        color: #475569;
    }

    /* Button */
    .btn-primary-custom {
        background: var(--primary-color);
        color: white;
        border: none;
        padding: 16px 40px;
        border-radius: 14px;
        font-weight: 700;
        font-size: 16px;
        transition: all 0.3s ease;
        box-shadow: 0 10px 20px rgba(0, 157, 99, 0.2);
    }

    .btn-primary-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 30px rgba(0, 157, 99, 0.3);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .q-card { padding: 25px; }
        .q-text { font-size: 1.1rem; }
    }
</style>

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