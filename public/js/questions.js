/**
 * Questions API Handler
 */

const QUESTION_API_URL = '/sigma/api/questions';

/**
 * Utility: Show message
 */
function showQuestionMessage(message, type = 'error') {
    let alertDiv = document.querySelector('#alert-container');
    
    if (!alertDiv) {
        alertDiv = document.createElement('div');
        alertDiv.id = 'alert-container';
        const container = document.querySelector('.container-fluid');
        if (container) {
            container.insertBefore(alertDiv, container.firstChild);
        }
    }
    
    alertDiv.className = `alert alert-${type === 'success' ? 'success' : 'danger'} alert-dismissible fade show`;
    alertDiv.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
}

/**
 * Utility: Loading state
 */
function setQuestionButtonLoading(button, isLoading) {
    if (isLoading) {
        button.disabled = true;
        button.dataset.originalText = button.innerHTML;
        button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
    } else {
        button.disabled = false;
        button.innerHTML = button.dataset.originalText || button.innerHTML;
    }
}

/**
 * Fetch all questions with pagination
 */
async function fetchQuestions(page = 1, limit = 10) {
    try {
        const response = await fetch(`${QUESTION_API_URL}?page=${page}&limit=${limit}`, {
            method: 'GET',
            credentials: 'same-origin'
        });
        
        const result = await response.json();
        
        if (result.success) {
            return result.data;
        } else {
            showQuestionMessage(result.message, 'error');
            return null;
        }
    } catch (error) {
        console.error('Fetch error:', error);
        showQuestionMessage('Terjadi kesalahan saat mengambil data', 'error');
        return null;
    }
}

/**
 * Fetch groups for dropdown
 */
async function fetchGroups() {
    try {
        const response = await fetch(`${QUESTION_API_URL}/groups`, {
            method: 'GET',
            credentials: 'same-origin'
        });
        
        const result = await response.json();
        
        if (result.success) {
            return result.data;
        } else {
            return [];
        }
    } catch (error) {
        console.error('Fetch groups error:', error);
        return [];
    }
}

/**
 * Create question
 */
async function createQuestion(formData) {
    const submitButton = document.querySelector('button[type="submit"]');
    setQuestionButtonLoading(submitButton, true);
    
    try {
        const response = await fetch(QUESTION_API_URL, {
            method: 'POST',
            credentials: 'same-origin',
            body: formData
        });
        
        const result = await response.json();
        
        if (result.success) {
            showQuestionMessage(result.message, 'success');
            
            setTimeout(() => {
                window.location.href = '/sigma/index.php?url=questions';
            }, 1500);
        } else {
            showQuestionMessage(result.message, 'error');
        }
    } catch (error) {
        console.error('Create error:', error);
        showQuestionMessage('Terjadi kesalahan saat menyimpan data', 'error');
    } finally {
        setQuestionButtonLoading(submitButton, false);
    }
}

/**
 * Update question
 */
async function updateQuestion(id, formData) {
    const submitButton = document.querySelector('button[type="submit"]');
    setQuestionButtonLoading(submitButton, true);
    
    try {
        const response = await fetch(`${QUESTION_API_URL}/${id}`, {
            method: 'POST',
            credentials: 'same-origin',
            body: formData
        });
        
        const result = await response.json();
        
        if (result.success) {
            showQuestionMessage(result.message, 'success');
            
            setTimeout(() => {
                window.location.href = '/sigma/index.php?url=questions';
            }, 1500);
        } else {
            showQuestionMessage(result.message, 'error');
        }
    } catch (error) {
        console.error('Update error:', error);
        showQuestionMessage('Terjadi kesalahan saat mengupdate data', 'error');
    } finally {
        setQuestionButtonLoading(submitButton, false);
    }
}

/**
 * Delete question
 */
async function deleteQuestion(id) {
    if (!confirm('Apakah Anda yakin ingin menghapus soal ini?')) {
        return;
    }
    
    try {
        const response = await fetch(`${QUESTION_API_URL}/${id}`, {
            method: 'DELETE',
            credentials: 'same-origin'
        });
        
        const result = await response.json();
        
        if (result.success) {
            showQuestionMessage(result.message, 'success');
            
            // Reload table
            loadQuestionsTable(currentPage);
        } else {
            showQuestionMessage(result.message, 'error');
        }
    } catch (error) {
        console.error('Delete error:', error);
        showQuestionMessage('Terjadi kesalahan saat menghapus data', 'error');
    }
}

// Expose deleteQuestion to global scope for inline onclick
window.deleteQuestion = deleteQuestion;

/**
 * Load and display questions table
 */
let currentPage = 1;
async function loadQuestionsTable(page = 1) {
    const tableBody = document.querySelector('#questions-table tbody');
    const paginationContainer = document.querySelector('#pagination-container');
    
    if (!tableBody) return;
    
    currentPage = page;
    tableBody.innerHTML = '<tr><td colspan="5" class="text-center">Loading...</td></tr>';
    
    const data = await fetchQuestions(page, 10);
    
    if (!data || data.questions.length === 0) {
        tableBody.innerHTML = '<tr><td colspan="5" class="text-center">Tidak ada data</td></tr>';
        if (paginationContainer) paginationContainer.innerHTML = '';
        return;
    }
    
    // Render table
    tableBody.innerHTML = '';
    data.questions.forEach((question, index) => {
        const offset = (data.pagination.current_page - 1) * data.pagination.limit;
        const row = document.createElement('tr');
        
        let groupBadge = '';
        if (question.group_title) {
            groupBadge = `<span class="badge bg-primary">${escapeHtml(question.group_title)}</span>`;
        } else {
            groupBadge = '<span class="text-muted small">Tidak ada grup</span>';
        }
        
        row.innerHTML = `
            <td class="ps-4 fw-semibold">${offset + index + 1}</td>
            <td>${escapeHtml(question.question)}</td>
            <td>${groupBadge}</td>
            <td class="text-center">
                <span class="badge rounded-pill bg-info text-dark px-3 py-2">
                    ${parseFloat(question.weight).toFixed(2)}
                </span>
            </td>
            <td class="text-center pe-4">
                <div class="d-flex justify-content-center gap-2">
                    <a href="/sigma/index.php?url=questions/edit/${question.id}" class="btn btn-sm btn-warning text-white">
                        <i class="fas fa-edit"></i>
                    </a>
                    <button onclick="deleteQuestion(${question.id})" class="btn btn-sm btn-danger">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </td>
        `;
        tableBody.appendChild(row);
    });
    
    // Render pagination
    if (paginationContainer) {
        renderQuestionPagination(data.pagination, paginationContainer);
    }
}

/**
 * Render pagination
 */
function renderQuestionPagination(pagination, container) {
    if (pagination.total_pages <= 1) {
        container.innerHTML = '';
        return;
    }
    
    let html = '<nav><ul class="pagination justify-content-center">';
    
    // Previous button
    html += `<li class="page-item ${pagination.current_page === 1 ? 'disabled' : ''}">
        <a class="page-link" href="#" onclick="loadQuestionsTable(${pagination.current_page - 1}); return false;">Previous</a>
    </li>`;
    
    // Page numbers
    for (let i = 1; i <= pagination.total_pages; i++) {
        if (i === 1 || i === pagination.total_pages || (i >= pagination.current_page - 2 && i <= pagination.current_page + 2)) {
            html += `<li class="page-item ${i === pagination.current_page ? 'active' : ''}">
                <a class="page-link" href="#" onclick="loadQuestionsTable(${i}); return false;">${i}</a>
            </li>`;
        } else if (i === pagination.current_page - 3 || i === pagination.current_page + 3) {
            html += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
        }
    }
    
    // Next button
    html += `<li class="page-item ${pagination.current_page === pagination.total_pages ? 'disabled' : ''}">
        <a class="page-link" href="#" onclick="loadQuestionsTable(${pagination.current_page + 1}); return false;">Next</a>
    </li>`;
    
    html += '</ul></nav>';
    container.innerHTML = html;
}

/**
 * Load groups into dropdown
 */
async function loadGroupsDropdown() {
    const groupSelect = document.querySelector('select[name="group_id"]');
    if (!groupSelect) return;
    
    const groups = await fetchGroups();
    
    // Clear existing options except the first one
    groupSelect.innerHTML = '<option value="">-- Pilih Grup (Opsional) --</option>';
    
    groups.forEach(group => {
        const option = document.createElement('option');
        option.value = group.id;
        option.textContent = group.title;
        
        // If editing, check if this group was selected
        if (groupSelect.dataset.selectedGroup && groupSelect.dataset.selectedGroup == group.id) {
            option.selected = true;
        }
        
        groupSelect.appendChild(option);
    });
}

/**
 * Handle form submission
 */
function handleQuestionFormSubmit(event) {
    event.preventDefault();
    
    const form = event.target;
    const formData = new FormData(form);
    
    const questionId = form.dataset.editId || form.dataset.questionId || null;
    
    if (questionId) {
        updateQuestion(questionId, formData);
    } else {
        createQuestion(formData);
    }
}

/**
 * Escape HTML
 */
function escapeHtml(text) {
    if (!text) return '';
    const map = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    };
    return String(text).replace(/[&<>"']/g, m => map[m]);
}

/**
 * Initialize
 */
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const currentUrl = urlParams.get('url') || '';
    
    // Questions list page
    if (currentUrl === 'questions' && document.querySelector('#questions-table')) {
        const page = urlParams.get('page') ? parseInt(urlParams.get('page')) : 1;
        loadQuestionsTable(page);
    }
    
    // Create/Edit form
    const form = document.querySelector('form[data-question-form]');
    
    if (form) {
        form.addEventListener('submit', handleQuestionFormSubmit);
        
        // Load groups for dropdown on create/edit pages
        if (currentUrl.startsWith('questions/create') || currentUrl.startsWith('questions/edit')) {
            loadGroupsDropdown();
        }
    }
});
