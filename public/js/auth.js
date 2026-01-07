/**
 * Auth API Handler
 * Menangani komunikasi dengan API untuk authentication
 */

// Base API URL
const API_BASE_URL = '/sigma/index.php?url=api/auth';

/**
 * Utility function untuk menampilkan alert/message
 */
function showMessage(message, type = 'error') {
    // Cari atau buat element untuk menampilkan message
    let alertDiv = document.querySelector('.alert');
    
    if (!alertDiv) {
        alertDiv = document.createElement('div');
        const form = document.querySelector('form');
        form.parentNode.insertBefore(alertDiv, form);
    }
    
    alertDiv.className = `alert alert-${type === 'success' ? 'success' : 'danger'}`;
    alertDiv.textContent = message;
    alertDiv.style.display = 'block';
    
    // Auto hide after 5 seconds
    setTimeout(() => {
        alertDiv.style.display = 'none';
    }, 5000);
}

/**
 * Utility function untuk loading state
 */
function setButtonLoading(button, isLoading) {
    if (isLoading) {
        button.disabled = true;
        button.dataset.originalText = button.textContent;
        button.textContent = 'Memproses...';
    } else {
        button.disabled = false;
        button.textContent = button.dataset.originalText || button.textContent;
    }
}

/**
 * Handle Login Form Submission
 */
async function handleLogin(event) {
    event.preventDefault();
    
    const form = event.target;
    const submitButton = form.querySelector('button[type="submit"]');
    const email = form.querySelector('#email').value;
    const password = form.querySelector('#password').value;
    
    // Validasi client-side
    if (!email || !password) {
        showMessage('Email dan password harus diisi', 'error');
        return;
    }
    
    setButtonLoading(submitButton, true);
    
    try {
        // Call Login API
        const response = await fetch(`${API_BASE_URL}/login`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                email: email,
                password: password
            })
        });
        
        const result = await response.json();
        
        if (result.success) {
            // Login berhasil, simpan data ke session via backend
            const sessionResponse = await fetch('/sigma/index.php?url=auth/handleLoginSuccess', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    user: result.data.user,
                    token: result.data.token
                })
            });
            
            const sessionResult = await sessionResponse.json();
            
            if (sessionResult.success) {
                // Redirect ke dashboard
                window.location.href = sessionResult.redirect;
            } else {
                showMessage('Gagal membuat session', 'error');
            }
        } else {
            // Login gagal
            showMessage(result.message, 'error');
        }
    } catch (error) {
        console.error('Login error:', error);
        showMessage('Terjadi kesalahan saat login. Silakan coba lagi.', 'error');
    } finally {
        setButtonLoading(submitButton, false);
    }
}

/**
 * Handle Register Form Submission
 */
async function handleRegister(event) {
    event.preventDefault();
    
    const form = event.target;
    const submitButton = form.querySelector('button[type="submit"]');
    const name = form.querySelector('#name').value;
    const email = form.querySelector('#email').value;
    const password = form.querySelector('#password').value;
    
    // Validasi client-side
    if (!name || !email || !password) {
        showMessage('Semua field harus diisi', 'error');
        return;
    }
    
    if (password.length < 6) {
        showMessage('Password minimal 6 karakter', 'error');
        return;
    }
    
    setButtonLoading(submitButton, true);
    
    try {
        // Call Register API
        const response = await fetch(`${API_BASE_URL}/register`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                name: name,
                email: email,
                password: password
            })
        });
        
        const result = await response.json();
        
        if (result.success) {
            // Registrasi berhasil
            showMessage('Registrasi berhasil! Silakan login.', 'success');
            
            // Redirect ke halaman login setelah 2 detik
            setTimeout(() => {
                window.location.href = '/sigma/index.php?url=login';
            }, 2000);
        } else {
            // Registrasi gagal
            showMessage(result.message, 'error');
        }
    } catch (error) {
        console.error('Register error:', error);
        showMessage('Terjadi kesalahan saat registrasi. Silakan coba lagi.', 'error');
    } finally {
        setButtonLoading(submitButton, false);
    }
}

/**
 * Initialize auth handlers when DOM is ready
 */
document.addEventListener('DOMContentLoaded', function() {
    // Detect page by checking URL query string
    const urlParams = new URLSearchParams(window.location.search);
    const currentPage = urlParams.get('url') || '';
    
    // Login form
    const loginForm = document.querySelector('form[action=""]');
    if (loginForm && currentPage === 'login') {
        console.log('Attaching login handler');
        loginForm.addEventListener('submit', handleLogin);
    }
    
    // Register form
    const registerForm = document.querySelector('form[action=""]');
    if (registerForm && currentPage === 'register') {
        console.log('Attaching register handler');
        registerForm.addEventListener('submit', handleRegister);
    }
});
