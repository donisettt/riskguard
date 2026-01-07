/**
 * Respondent API Handler
 */

const RESPONDENT_API_URL = '/sigma/api/respondent';

/**
 * Utility: Show message
 */
function showRespondentMessage(message, type = 'error') {
    let alertDiv = document.querySelector('.alert');
    
    if (!alertDiv) {
        alertDiv = document.createElement('div');
        const container = document.querySelector('.container-fluid');
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
 * Fetch all respondents
 */
async function fetchRespondents() {
    try {
        const response = await fetch(RESPONDENT_API_URL, {
            method: 'GET',
            credentials: 'same-origin'
        });
        
        const result = await response.json();
        
        if (result.success) {
            return result.data.respondents;
        } else {
            showRespondentMessage(result.message, 'error');
            return [];
        }
    } catch (error) {
        console.error('Fetch error:', error);
        showRespondentMessage('Terjadi kesalahan saat mengambil data', 'error');
        return [];
    }
}

/**
 * Fetch respondent detail
 */
async function fetchRespondentDetail(userId) {
    try {
        const response = await fetch(`${RESPONDENT_API_URL}/${userId}`, {
            method: 'GET',
            credentials: 'same-origin'
        });
        
        const result = await response.json();
        
        if (result.success) {
            return result.data;
        } else {
            showRespondentMessage(result.message, 'error');
            return null;
        }
    } catch (error) {
        console.error('Fetch error:', error);
        showRespondentMessage('Terjadi kesalahan saat mengambil data', 'error');
        return null;
    }
}

/**
 * Load and display respondents table
 */
async function loadRespondentsTable() {
    const tableBody = document.querySelector('#respondents-table tbody');
    if (!tableBody) return;
    
    tableBody.innerHTML = '<tr><td colspan="5" class="text-center">Loading...</td></tr>';
    
    const respondents = await fetchRespondents();
    
    if (respondents.length === 0) {
        tableBody.innerHTML = `
            <tr>
                <td colspan="5" class="text-center py-5 text-muted">
                    <i class="fas fa-users-slash fa-2x mb-2"></i>
                    <div>Belum ada responden</div>
                </td>
            </tr>`;
        return;
    }
    
    tableBody.innerHTML = '';
    respondents.forEach((row, index) => {
        const tr = document.createElement('tr');
        
        let riskBadge = '';
        if (row.last_risk) {
            let bg = 'secondary';
            if (row.last_risk === 'Rendah') bg = 'success';
            if (row.last_risk === 'Sedang') bg = 'warning';
            if (row.last_risk === 'Tinggi' || row.last_risk === 'Bahaya') bg = 'danger';
            
            riskBadge = `<span class="badge rounded-pill bg-${bg} px-3 py-2">${row.last_risk}</span>`;
        } else {
            riskBadge = '<span class="badge bg-light text-dark border px-3 py-2">Belum Mengerjakan</span>';
        }
        
        let actionButton = '';
        if (row.last_risk) {
            actionButton = `
                <a href="index.php?url=respondent/detail/${row.id}" class="btn btn-sm btn-info text-white">
                    <i class="fas fa-eye me-1"></i> Lihat Jawaban
                </a>`;
        } else {
            actionButton = '<button class="btn btn-sm btn-secondary" disabled>No Data</button>';
        }
        
        tr.innerHTML = `
            <td class="ps-4 fw-semibold">${index + 1}</td>
            <td>
                <div class="fw-semibold">${escapeHtml(row.name)}</div>
                <small class="text-muted">User ID: ${row.id}</small>
            </td>
            <td>${escapeHtml(row.email)}</td>
            <td>${riskBadge}</td>
            <td class="pe-4">${actionButton}</td>
        `;
        
        tableBody.appendChild(tr);
    });
}

/**
 * Load and display respondent detail
 */
async function loadRespondentDetail(userId) {
    const summaryCard = document.querySelector('#summary-card');
    const answersTable = document.querySelector('#answers-table tbody');
    
    if (!summaryCard || !answersTable) return;
    
    summaryCard.innerHTML = '<div class="text-center py-5"><i class="fas fa-spinner fa-spin fa-2x"></i></div>';
    answersTable.innerHTML = '<tr><td colspan="3" class="text-center">Loading...</td></tr>';
    
    const data = await fetchRespondentDetail(userId);
    
    if (!data || !data.result_header) {
        summaryCard.innerHTML = '<div class="text-muted text-center py-4">Data tidak ditemukan.</div>';
        answersTable.innerHTML = '<tr><td colspan="3" class="text-center">User ini belum mengisi kuesioner.</td></tr>';
        return;
    }
    
    // Render summary
    const risk = data.result_header.risk_level;
    let badge = 'secondary';
    if (risk === 'Rendah') badge = 'success';
    if (risk === 'Sedang') badge = 'warning';
    if (risk === 'Tinggi' || risk === 'Bahaya') badge = 'danger';
    
    const date = new Date(data.result_header.created_at);
    const formattedDate = date.toLocaleDateString('id-ID', { 
        year: 'numeric', month: 'short', day: 'numeric', 
        hour: '2-digit', minute: '2-digit' 
    });
    
    summaryCard.innerHTML = `
        <h1 class="fw-bold display-5 mb-0">${parseFloat(data.result_header.total_score).toFixed(2)}</h1>
        <small class="text-muted">Total Skor</small>
        <hr class="my-4">
        <div class="mb-3">
            <span class="fw-semibold me-2">Status:</span>
            <span class="badge rounded-pill bg-${badge} px-3 py-2">${risk}</span>
        </div>
        <small class="text-muted d-block">
            Tanggal Tes<br>${formattedDate}
        </small>
    `;
    
    // Render answers
    if (!data.answers || data.answers.length === 0) {
        answersTable.innerHTML = '<tr><td colspan="3" class="text-center">Tidak ada data jawaban.</td></tr>';
        return;
    }
    
    answersTable.innerHTML = '';
    data.answers.forEach(ans => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td>${escapeHtml(ans.question)}</td>
            <td class="text-center">
                <span class="badge bg-light text-dark border px-3 py-2">${ans.answer_value}</span>
            </td>
            <td class="text-center fw-semibold">${parseFloat(ans.weight).toFixed(2)}</td>
        `;
        answersTable.appendChild(tr);
    });
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
    
    // Respondent list page
    if (currentPage === 'respondent' && document.querySelector('#respondents-table')) {
        loadRespondentsTable();
    }
    
    // Respondent detail page
    if (currentPage.startsWith('respondent/detail/')) {
        const userId = currentPage.split('/').pop();
        if (userId && document.querySelector('#summary-card')) {
            loadRespondentDetail(userId);
        }
    }
});
