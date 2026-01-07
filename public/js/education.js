/**
 * Education API Handler
 */

const EDUCATION_API_URL = '/sigma/api/education';

/**
 * Utility: Show message
 */
function showMessage(message, type = 'error') {
    let alertDiv = document.querySelector('.alert');
    
    if (!alertDiv) {
        alertDiv = document.createElement('div');
        const container = document.querySelector('.container') || document.querySelector('.content-wrapper');
        if (container) {
            container.insertBefore(alertDiv, container.firstChild);
        }
    }
    
    alertDiv.className = `alert alert-${type === 'success' ? 'success' : 'danger'}`;
    alertDiv.textContent = message;
    alertDiv.style.display = 'block';
    
    setTimeout(() => {
        alertDiv.style.display = 'none';
    }, 5000);
}

/**
 * Utility: Loading state
 */
function setButtonLoading(button, isLoading) {
    if (isLoading) {
        button.disabled = true;
        button.dataset.originalText = button.textContent;
        button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
    } else {
        button.disabled = false;
        button.innerHTML = button.dataset.originalText || button.textContent;
    }
}

/**
 * Fetch all articles
 */
async function fetchArticles() {
    try {
        const response = await fetch(EDUCATION_API_URL, {
            method: 'GET',
            credentials: 'same-origin'
        });
        
        const result = await response.json();
        
        if (result.success) {
            return result.data.articles;
        } else {
            showMessage(result.message, 'error');
            return [];
        }
    } catch (error) {
        console.error('Fetch error:', error);
        showMessage('Terjadi kesalahan saat mengambil data', 'error');
        return [];
    }
}

/**
 * Fetch single article
 */
async function fetchArticle(id) {
    try {
        const response = await fetch(`${EDUCATION_API_URL}/${id}`, {
            method: 'GET',
            credentials: 'same-origin'
        });
        
        const result = await response.json();
        
        if (result.success) {
            return result.data;
        } else {
            showMessage(result.message, 'error');
            return null;
        }
    } catch (error) {
        console.error('Fetch error:', error);
        showMessage('Terjadi kesalahan saat mengambil data', 'error');
        return null;
    }
}

/**
 * Create article
 */
async function createArticle(formData) {
    const submitButton = document.querySelector('button[type="submit"]');
    setButtonLoading(submitButton, true);
    
    try {
        const response = await fetch(EDUCATION_API_URL, {
            method: 'POST',
            credentials: 'same-origin',
            body: formData // FormData with file upload
        });
        
        const result = await response.json();
        
        if (result.success) {
            showMessage(result.message, 'success');
            
            setTimeout(() => {
                window.location.href = '/sigma/index.php?url=education';
            }, 1500);
        } else {
            showMessage(result.message, 'error');
        }
    } catch (error) {
        console.error('Create error:', error);
        showMessage('Terjadi kesalahan saat menyimpan data', 'error');
    } finally {
        setButtonLoading(submitButton, false);
    }
}

/**
 * Update article
 */
async function updateArticle(id, formData) {
    const submitButton = document.querySelector('button[type="submit"]');
    setButtonLoading(submitButton, true);
    
    try {
        const response = await fetch(`${EDUCATION_API_URL}/${id}`, {
            method: 'POST', // Use POST with FormData
            credentials: 'same-origin',
            body: formData
        });
        
        const result = await response.json();
        
        if (result.success) {
            showMessage(result.message, 'success');
            
            setTimeout(() => {
                window.location.href = '/sigma/index.php?url=education';
            }, 1500);
        } else {
            showMessage(result.message, 'error');
        }
    } catch (error) {
        console.error('Update error:', error);
        showMessage('Terjadi kesalahan saat mengupdate data', 'error');
    } finally {
        setButtonLoading(submitButton, false);
    }
}

/**
 * Delete article
 */
async function deleteArticle(id) {
    if (!confirm('Apakah Anda yakin ingin menghapus artikel ini?')) {
        return;
    }
    
    try {
        const response = await fetch(`${EDUCATION_API_URL}/${id}`, {
            method: 'DELETE',
            credentials: 'same-origin'
        });
        
        const result = await response.json();
        
        if (result.success) {
            showMessage(result.message, 'success');
            
            // Reload table instead of full page reload
            loadArticlesTable();
        } else {
            showMessage(result.message, 'error');
        }
    } catch (error) {
        console.error('Delete error:', error);
        showMessage('Terjadi kesalahan saat menghapus data', 'error');
    }
}

// Expose deleteArticle to global scope for inline onclick
window.deleteArticle = deleteArticle;

/**
 * Handle form submission (create/edit)
 */
function handleFormSubmit(event) {
    event.preventDefault();
    
    const form = event.target;
    const formData = new FormData(form);
    
    // Check if it's create or update
    const articleId = form.dataset.editId || form.dataset.articleId || null;
    
    if (articleId) {
        updateArticle(articleId, formData);
    } else {
        createArticle(formData);
    }
}

/**
 * Load and display articles in admin table
 */
async function loadArticlesTable() {
    const tableBody = document.querySelector('#articles-table tbody');
    if (!tableBody) return;
    
    tableBody.innerHTML = '<tr><td colspan="5" class="text-center">Loading...</td></tr>';
    
    const articles = await fetchArticles();
    
    if (articles.length === 0) {
        tableBody.innerHTML = '<tr><td colspan="5" class="text-center">Tidak ada data</td></tr>';
        return;
    }
    
    tableBody.innerHTML = '';
    articles.forEach((article, index) => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${index + 1}</td>
            <td>${escapeHtml(article.title)}</td>
            <td><img src="/sigma/public/uploads/${article.banner}" alt="Banner" style="max-width: 100px;"></td>
            <td>${new Date(article.created_at).toLocaleDateString('id-ID')}</td>
            <td>
                <a href="/sigma/index.php?url=education/edit/${article.id}" class="btn btn-sm btn-warning">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <button onclick="deleteArticle(${article.id})" class="btn btn-sm btn-danger">
                    <i class="fas fa-trash"></i> Hapus
                </button>
            </td>
        `;
        tableBody.appendChild(row);
    });
}

/**
 * Load and display articles in user grid
 */
async function loadArticlesGrid() {
    const grid = document.querySelector('#articles-grid');
    if (!grid) return;
    
    grid.innerHTML = '<div class="col-12 text-center">Loading...</div>';
    
    const articles = await fetchArticles();
    
    if (articles.length === 0) {
        grid.innerHTML = '<div class="col-12 text-center">Tidak ada artikel</div>';
        return;
    }
    
    grid.innerHTML = '';
    articles.forEach(article => {
        const col = document.createElement('div');
        col.className = 'col-md-4 mb-4';
        col.innerHTML = `
            <div class="card h-100">
                <img src="/sigma/public/uploads/${article.banner}" class="card-img-top" alt="${escapeHtml(article.title)}">
                <div class="card-body">
                    <h5 class="card-title">${escapeHtml(article.title)}</h5>
                    <p class="card-text">${escapeHtml(article.content.substring(0, 100))}...</p>
                    <small class="text-muted">${new Date(article.created_at).toLocaleDateString('id-ID')}</small>
                </div>
            </div>
        `;
        grid.appendChild(col);
    });
}

/**
 * Load article for editing
 */
async function loadArticleForEdit(id) {
    const article = await fetchArticle(id);
    
    if (!article) return;
    
    const form = document.querySelector('form[data-education-form]');
    if (!form) return;
    
    form.dataset.articleId = id;
    
    // Set form values
    document.querySelector('#title').value = article.title;
    document.querySelector('#content').value = article.content;
    document.querySelector('#old_banner').value = article.banner;
    
    // Show current banner
    const currentBanner = document.querySelector('#current-banner');
    if (currentBanner) {
        currentBanner.src = '/sigma/public/uploads/' + article.banner;
    }
}

/**
 * Escape HTML
 */
function escapeHtml(text) {
    const map = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    };
    return text.replace(/[&<>"']/g, m => map[m]);
}

/**
 * Initialize
 */
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const currentPage = urlParams.get('url') || '';
    
    // Admin list page (education or education/manage)
    if ((currentPage === 'education' || currentPage.startsWith('education/manage')) && document.querySelector('#articles-table')) {
        loadArticlesTable();
    }
    
    // User grid page
    if (currentPage === 'education' && document.querySelector('#articles-grid')) {
        loadArticlesGrid();
    }
    
    // Create/Edit form
    const form = document.querySelector('form[data-education-form]');
    
    if (form) {
        form.addEventListener('submit', handleFormSubmit);
        
        // Note: Edit form data already loaded by PHP controller
        // No need to fetch again via JavaScript
    }
});
