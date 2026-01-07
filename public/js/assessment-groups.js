/**
 * Assessment Group API Handler
 */

const ASSESSMENT_GROUP_API_URL = '/sigma/api/assessment-groups';

/**
 * Utility: Show message
 */
function showGroupMessage(message, type = 'error') {
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
function setGroupButtonLoading(button, isLoading) {
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
 * Fetch all assessment groups with pagination
 */
async function fetchAssessmentGroups(page = 1, limit = 10) {
    try {
        const response = await fetch(`${ASSESSMENT_GROUP_API_URL}?page=${page}&limit=${limit}`, {
            method: 'GET',
            credentials: 'same-origin'
        });
        
        const result = await response.json();
        
        if (result.success) {
            return result.data;
        } else {
            showGroupMessage(result.message, 'error');
            return null;
        }
    } catch (error) {
        console.error('Fetch error:', error);
        showGroupMessage('Terjadi kesalahan saat mengambil data', 'error');
        return null;
    }
}

/**
 * Create assessment group
 */
async function createAssessmentGroup(formData) {
    const submitButton = document.querySelector('button[type="submit"]');
    setGroupButtonLoading(submitButton, true);
    
    try {
        const response = await fetch(ASSESSMENT_GROUP_API_URL, {
            method: 'POST',
            credentials: 'same-origin',
            body: formData
        });
        
        const result = await response.json();
        
        if (result.success) {
            showGroupMessage(result.message, 'success');
            
            setTimeout(() => {
                window.location.href = '/sigma/index.php?url=assessment-groups';
            }, 1500);
        } else {
            showGroupMessage(result.message, 'error');
        }
    } catch (error) {
        console.error('Create error:', error);
        showGroupMessage('Terjadi kesalahan saat menyimpan data', 'error');
    } finally {
        setGroupButtonLoading(submitButton, false);
    }
}

/**
 * Update assessment group
 */
async function updateAssessmentGroup(id, formData) {
    const submitButton = document.querySelector('button[type="submit"]');
    setGroupButtonLoading(submitButton, true);
    
    try {
        const response = await fetch(`${ASSESSMENT_GROUP_API_URL}/${id}`, {
            method: 'POST',
            credentials: 'same-origin',
            body: formData
        });
        
        const result = await response.json();
        
        if (result.success) {
            showGroupMessage(result.message, 'success');
            
            setTimeout(() => {
                window.location.href = '/sigma/index.php?url=assessment-groups';
            }, 1500);
        } else {
            showGroupMessage(result.message, 'error');
        }
    } catch (error) {
        console.error('Update error:', error);
        showGroupMessage('Terjadi kesalahan saat mengupdate data', 'error');
    } finally {
        setGroupButtonLoading(submitButton, false);
    }
}

/**
 * Delete assessment group
 */
async function deleteAssessmentGroup(id) {
    if (!confirm('Apakah Anda yakin ingin menghapus grup assessment ini?')) {
        return;
    }
    
    try {
        const response = await fetch(`${ASSESSMENT_GROUP_API_URL}/${id}`, {
            method: 'DELETE',
            credentials: 'same-origin'
        });
        
        const result = await response.json();
        
        if (result.success) {
            showGroupMessage(result.message, 'success');
            
            // Reload table
            loadAssessmentGroupsTable(currentPage);
        } else {
            showGroupMessage(result.message, 'error');
        }
    } catch (error) {
        console.error('Delete error:', error);
        showGroupMessage('Terjadi kesalahan saat menghapus data', 'error');
    }
}

// Expose deleteAssessmentGroup to global scope for inline onclick
window.deleteAssessmentGroup = deleteAssessmentGroup;

/**
 * Load and display assessment groups table
 */
let currentPage = 1;
async function loadAssessmentGroupsTable(page = 1) {
    const tableBody = document.querySelector('#groups-table tbody');
    const paginationContainer = document.querySelector('#pagination-container');
    
    if (!tableBody) return;
    
    currentPage = page;
    tableBody.innerHTML = '<tr><td colspan="5" class="text-center">Loading...</td></tr>';
    
    const data = await fetchAssessmentGroups(page, 10);
    
    if (!data || data.groups.length === 0) {
        tableBody.innerHTML = '<tr><td colspan="5" class="text-center">Tidak ada data</td></tr>';
        if (paginationContainer) paginationContainer.innerHTML = '';
        return;
    }
    
    // Render table
    tableBody.innerHTML = '';
    data.groups.forEach((group, index) => {
        const offset = (data.pagination.current_page - 1) * data.pagination.limit;
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${offset + index + 1}</td>
            <td>${escapeHtml(group.title)}</td>
            <td>${escapeHtml(group.description || '-')}</td>
            <td class="text-center">
                <span class="badge bg-info">${group.total_questions || 0}</span>
            </td>
            <td>
                <a href="/sigma/index.php?url=assessment-groups/edit/${group.id}" class="btn btn-sm btn-warning">
                    <i class="fas fa-edit"></i>
                </a>
                <button onclick="deleteAssessmentGroup(${group.id})" class="btn btn-sm btn-danger">
                    <i class="fas fa-trash"></i>
                </button>
            </td>
        `;
        tableBody.appendChild(row);
    });
    
    // Render pagination
    if (paginationContainer) {
        renderPagination(data.pagination, paginationContainer);
    }
}

/**
 * Render pagination
 */
function renderPagination(pagination, container) {
    if (pagination.total_pages <= 1) {
        container.innerHTML = '';
        return;
    }
    
    let html = '<nav><ul class="pagination justify-content-center">';
    
    // Previous button
    html += `<li class="page-item ${pagination.current_page === 1 ? 'disabled' : ''}">
        <a class="page-link" href="#" onclick="loadAssessmentGroupsTable(${pagination.current_page - 1}); return false;">Previous</a>
    </li>`;
    
    // Page numbers
    for (let i = 1; i <= pagination.total_pages; i++) {
        if (i === 1 || i === pagination.total_pages || (i >= pagination.current_page - 2 && i <= pagination.current_page + 2)) {
            html += `<li class="page-item ${i === pagination.current_page ? 'active' : ''}">
                <a class="page-link" href="#" onclick="loadAssessmentGroupsTable(${i}); return false;">${i}</a>
            </li>`;
        } else if (i === pagination.current_page - 3 || i === pagination.current_page + 3) {
            html += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
        }
    }
    
    // Next button
    html += `<li class="page-item ${pagination.current_page === pagination.total_pages ? 'disabled' : ''}">
        <a class="page-link" href="#" onclick="loadAssessmentGroupsTable(${pagination.current_page + 1}); return false;">Next</a>
    </li>`;
    
    html += '</ul></nav>';
    container.innerHTML = html;
}

/**
 * Handle form submission
 */
function handleGroupFormSubmit(event) {
    event.preventDefault();
    
    const form = event.target;
    const formData = new FormData(form);
    
    const groupId = form.dataset.editId || form.dataset.groupId || null;
    
    if (groupId) {
        updateAssessmentGroup(groupId, formData);
    } else {
        createAssessmentGroup(formData);
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
    
    // Assessment groups list page
    if (currentUrl === 'assessment-groups' && document.querySelector('#groups-table')) {
        const page = urlParams.get('page') ? parseInt(urlParams.get('page')) : 1;
        loadAssessmentGroupsTable(page);
    }
    
    // Create/Edit form
    const form = document.querySelector('form[data-group-form]');
    
    if (form) {
        form.addEventListener('submit', handleGroupFormSubmit);
    }
});
