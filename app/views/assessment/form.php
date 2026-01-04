<div class="assessment-container">
    <div class="row justify-content-center">
        <div class="col-md-11 col-lg-10">
            <!-- Progress Indicator -->
            <div class="assessment-progress-bar mb-4">
                <div class="progress-info">
                    <span class="progress-label">Progress Assessment</span>
                    <span class="progress-count"><span id="currentQuestion">0</span> / <?= count($data['questions']) ?></span>
                </div>
                <div class="progress-track">
                    <div class="progress-fill" id="progressBar" style="width: 0%"></div>
                </div>
            </div>

            <!-- Assessment Header Card -->
            <div class="assessment-header-card mb-4">
                <div class="d-flex align-items-start gap-3 mb-3">
                    <a href="index.php?url=assessment" class="btn btn-light btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
                <div class="assessment-icon">
                    <i class="fas fa-clipboard-check"></i>
                </div>
                <div class="assessment-header-content">
                    <h3 class="assessment-title"><?= htmlspecialchars($data['group']['title'] ?? 'Kuesioner Analisis Risiko') ?></h3>
                    <p class="assessment-subtitle"><?= htmlspecialchars($data['group']['description'] ?? 'Jawablah dengan jujur sesuai kondisi Anda dalam 12 bulan terakhir. Semua jawaban bersifat rahasia dan hanya untuk kepentingan analisis pribadi.') ?></p>
                </div>
            </div>

            <!-- Questions Form -->
            <form action="index.php?url=assessment/submit" method="POST" id="assessmentForm">
                <input type="hidden" name="group_id" value="<?= $data['group']['id'] ?? '' ?>">
                <?php foreach ($data['questions'] as $index => $row): ?>
                    <div class="question-card" data-question="<?= $index + 1 ?>">
                        <div class="question-number">
                            <span>Pertanyaan <?= $index + 1 ?></span>
                            <span class="question-badge">dari <?= count($data['questions']) ?></span>
                        </div>

                        <h5 class="question-text"><?= $row['question'] ?></h5>

                        <div class="answer-options">
                            <label class="option-card">
                                <input type="radio" name="answers[<?= $row['id'] ?>]" value="0" required>
                                <div class="option-content">
                                    <div class="option-icon">
                                        <i class="fas fa-times-circle"></i>
                                    </div>
                                    <div class="option-details">
                                        <span class="option-label">Tidak Pernah</span>
                                        <span class="option-score">Skor: 0</span>
                                    </div>
                                    <div class="option-check">
                                        <i class="fas fa-check"></i>
                                    </div>
                                </div>
                            </label>

                            <label class="option-card">
                                <input type="radio" name="answers[<?= $row['id'] ?>]" value="1">
                                <div class="option-content">
                                    <div class="option-icon">
                                        <i class="fas fa-circle"></i>
                                    </div>
                                    <div class="option-details">
                                        <span class="option-label">Kadang-kadang</span>
                                        <span class="option-score">Skor: 1</span>
                                    </div>
                                    <div class="option-check">
                                        <i class="fas fa-check"></i>
                                    </div>
                                </div>
                            </label>

                            <label class="option-card">
                                <input type="radio" name="answers[<?= $row['id'] ?>]" value="2">
                                <div class="option-content">
                                    <div class="option-icon">
                                        <i class="fas fa-exclamation-circle"></i>
                                    </div>
                                    <div class="option-details">
                                        <span class="option-label">Sering</span>
                                        <span class="option-score">Skor: 2</span>
                                    </div>
                                    <div class="option-check">
                                        <i class="fas fa-check"></i>
                                    </div>
                                </div>
                            </label>

                            <label class="option-card">
                                <input type="radio" name="answers[<?= $row['id'] ?>]" value="3">
                                <div class="option-content">
                                    <div class="option-icon">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </div>
                                    <div class="option-details">
                                        <span class="option-label">Hampir Selalu</span>
                                        <span class="option-score">Skor: 3</span>
                                    </div>
                                    <div class="option-check">
                                        <i class="fas fa-check"></i>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                <?php endforeach; ?>

                <!-- Submit Button -->
                <div class="assessment-submit-section">
                    <button type="submit" class="btn-assessment-submit">
                        <i class="fas fa-chart-pie me-2"></i>
                        Lihat Hasil Analisis Saya
                        <i class="fas fa-arrow-right ms-2"></i>
                    </button>
                    <p class="submit-note">
                        <i class="fas fa-lock me-2"></i>Data Anda aman dan terlindungi
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    /* Assessment Container */
    .assessment-container {
        padding: 40px 0;
    }

    /* Progress Bar */
    .assessment-progress-bar {
        background: #ffffff;
        border-radius: 16px;
        padding: 20px 24px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .progress-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
    }

    .progress-label {
        font-size: 14px;
        font-weight: 600;
        color: #374151;
    }

    .progress-count {
        font-size: 14px;
        font-weight: 700;
        color: #009d63;
    }

    .progress-track {
        height: 8px;
        background: #e5e7eb;
        border-radius: 10px;
        overflow: hidden;
    }

    .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, #009d63 0%, #10b981 100%);
        border-radius: 10px;
        transition: width 0.3s ease;
    }

    /* Header Card */
    .assessment-header-card {
        background: linear-gradient(135deg, #009d63 0%, #047857 100%);
        border-radius: 20px;
        padding: 32px;
        display: flex;
        align-items: center;
        gap: 24px;
        box-shadow: 0 4px 12px rgba(0, 157, 99, 0.25);
    }

    .assessment-icon {
        width: 80px;
        height: 80px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        backdrop-filter: blur(10px);
    }

    .assessment-icon i {
        font-size: 36px;
        color: #ffffff;
    }

    .assessment-header-content {
        flex: 1;
    }

    .assessment-title {
        font-size: 26px;
        font-weight: 700;
        color: #ffffff;
        margin-bottom: 8px;
    }

    .assessment-subtitle {
        font-size: 15px;
        color: rgba(255, 255, 255, 0.95);
        margin-bottom: 0;
        line-height: 1.6;
    }

    /* Question Card */
    .question-card {
        background: #ffffff;
        border-radius: 20px;
        padding: 32px;
        margin-bottom: 24px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
        border: 2px solid transparent;
        transition: all 0.3s ease;
    }

    .question-card:hover {
        border-color: #009d63;
        box-shadow: 0 4px 20px rgba(0, 157, 99, 0.15);
    }

    .question-number {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 16px;
    }

    .question-number span:first-child {
        font-size: 13px;
        font-weight: 700;
        color: #009d63;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .question-badge {
        font-size: 12px;
        color: #6b7280;
        background: #f3f4f6;
        padding: 4px 12px;
        border-radius: 20px;
    }

    .question-text {
        font-size: 18px;
        font-weight: 600;
        color: #1f2937;
        line-height: 1.6;
        margin-bottom: 24px;
    }

    /* Answer Options */
    .answer-options {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 16px;
    }

    .option-card {
        position: relative;
        cursor: pointer;
        margin-bottom: 0;
    }

    .option-card input[type="radio"] {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }

    .option-content {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 18px 20px;
        background: #f9fafb;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .option-card:hover .option-content {
        border-color: #009d63;
        background: #f0fdf4;
        transform: translateY(-2px);
    }

    .option-card input:checked~.option-content {
        background: #ecfdf5;
        border-color: #009d63;
        box-shadow: 0 4px 12px rgba(0, 157, 99, 0.2);
    }

    .option-icon {
        width: 44px;
        height: 44px;
        background: #ffffff;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        transition: all 0.3s ease;
    }

    .option-icon i {
        font-size: 20px;
        color: #9ca3af;
    }

    .option-card:hover .option-icon i {
        color: #009d63;
    }

    .option-card input:checked~.option-content .option-icon {
        background: #009d63;
    }

    .option-card input:checked~.option-content .option-icon i {
        color: #ffffff;
    }

    .option-details {
        flex: 1;
    }

    .option-label {
        display: block;
        font-size: 15px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 2px;
    }

    .option-score {
        display: block;
        font-size: 12px;
        color: #6b7280;
    }

    .option-check {
        width: 28px;
        height: 28px;
        background: #e5e7eb;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        opacity: 0;
        transition: all 0.3s ease;
    }

    .option-check i {
        font-size: 14px;
        color: #ffffff;
    }

    .option-card input:checked~.option-content .option-check {
        opacity: 1;
        background: #009d63;
    }

    /* Submit Section */
    .assessment-submit-section {
        background: #ffffff;
        border-radius: 20px;
        padding: 32px;
        text-align: center;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
        margin-top: 32px;
    }

    .btn-assessment-submit {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 18px 48px;
        background: linear-gradient(135deg, #009d63 0%, #047857 100%);
        color: #ffffff;
        font-size: 16px;
        font-weight: 700;
        border: none;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(0, 157, 99, 0.3);
    }

    .btn-assessment-submit:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0, 157, 99, 0.4);
    }

    .btn-assessment-submit:active {
        transform: translateY(-1px);
    }

    .submit-note {
        margin-top: 16px;
        margin-bottom: 0;
        font-size: 13px;
        color: #6b7280;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .assessment-container {
            padding: 20px 0;
        }

        .assessment-header-card {
            padding: 28px 24px;
        }

        .assessment-icon {
            width: 70px;
            height: 70px;
        }

        .assessment-icon i {
            font-size: 32px;
        }

        .assessment-title {
            font-size: 22px;
        }

        .assessment-subtitle {
            font-size: 14px;
        }

        .question-card {
            padding: 24px 20px;
        }

        .question-text {
            font-size: 16px;
        }

        .answer-options {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .assessment-container {
            padding: 16px 0;
        }

        .assessment-progress-bar {
            padding: 16px 20px;
            border-radius: 12px;
        }

        .progress-label,
        .progress-count {
            font-size: 13px;
        }

        .assessment-header-card {
            flex-direction: column;
            text-align: center;
            padding: 24px 20px;
            border-radius: 16px;
        }

        .assessment-icon {
            width: 64px;
            height: 64px;
        }

        .assessment-icon i {
            font-size: 28px;
        }

        .assessment-title {
            font-size: 20px;
        }

        .assessment-subtitle {
            font-size: 13px;
        }

        .question-card {
            padding: 20px 16px;
            border-radius: 16px;
            margin-bottom: 20px;
        }

        .question-card:hover {
            transform: none;
        }

        .question-number {
            flex-wrap: wrap;
            gap: 8px;
        }

        .question-number span:first-child {
            font-size: 12px;
        }

        .question-badge {
            font-size: 11px;
            padding: 3px 10px;
        }

        .question-text {
            font-size: 15px;
            margin-bottom: 20px;
        }

        .answer-options {
            gap: 12px;
        }

        .option-content {
            padding: 14px 16px;
            gap: 12px;
        }

        .option-card:hover .option-content {
            transform: none;
        }

        .option-icon {
            width: 40px;
            height: 40px;
        }

        .option-icon i {
            font-size: 18px;
        }

        .option-label {
            font-size: 14px;
        }

        .option-score {
            font-size: 11px;
        }

        .option-check {
            width: 24px;
            height: 24px;
        }

        .option-check i {
            font-size: 12px;
        }

        .assessment-submit-section {
            padding: 24px 20px;
            border-radius: 16px;
            margin-top: 24px;
        }

        .btn-assessment-submit {
            width: 100%;
            padding: 16px 24px;
            font-size: 15px;
        }

        .btn-assessment-submit:hover {
            transform: translateY(-2px);
        }

        .submit-note {
            font-size: 12px;
        }
    }

    @media (max-width: 480px) {
        .assessment-container {
            padding: 12px 0;
        }

        .assessment-progress-bar {
            padding: 14px 16px;
        }

        .assessment-header-card {
            padding: 20px 16px;
        }

        .assessment-title {
            font-size: 18px;
        }

        .question-card {
            padding: 18px 14px;
        }

        .question-text {
            font-size: 14px;
        }

        .option-content {
            padding: 12px 14px;
        }

        .option-icon {
            width: 36px;
            height: 36px;
        }

        .option-icon i {
            font-size: 16px;
        }

        .option-label {
            font-size: 13px;
        }

        .btn-assessment-submit {
            padding: 14px 20px;
            font-size: 14px;
        }
    }
</style>

<script>
    // Progress Tracking
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('assessmentForm');
        const radioButtons = form.querySelectorAll('input[type="radio"]');
        const progressBar = document.getElementById('progressBar');
        const currentQuestionSpan = document.getElementById('currentQuestion');
        const totalQuestions = <?= count($data['questions']) ?>;

        function updateProgress() {
            const answeredQuestions = new Set();
            radioButtons.forEach(radio => {
                if (radio.checked) {
                    const questionName = radio.name;
                    answeredQuestions.add(questionName);
                }
            });

            const answered = answeredQuestions.size;
            const percentage = (answered / totalQuestions) * 100;

            progressBar.style.width = percentage + '%';
            currentQuestionSpan.textContent = answered;
        }

        radioButtons.forEach(radio => {
            radio.addEventListener('change', updateProgress);
        });
    });
</script>