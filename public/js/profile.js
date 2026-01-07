/**
 * Profile API Handler
 */

const PROFILE_API_URL = '/sigma/api/profile';

/**
 * Utility: Show message
 */
function showProfileMessage(message, type = 'error') {
    let alertDiv = document.querySelector('#alert-container');
    
    if (!alertDiv) {
        alertDiv = document.createElement('div');
        alertDiv.id = 'alert-container';
        const container = document.querySelector('.container-fluid');
        if (container) {
            container.insertBefore(alertDiv, container.firstChild);
        }
    }
    
    const alertClass = type === 'success' ? 'alert-success-custom' : 'alert-danger-custom';
    const icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';
    
    alertDiv.className = `alert-custom ${alertClass} mb-4`;
    alertDiv.innerHTML = `
        <i class="fas ${icon} me-2"></i>${message}
    `;
    
    // Scroll to top
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

/**
 * Utility: Loading state
 */
function setProfileButtonLoading(button, isLoading) {
    if (isLoading) {
        button.disabled = true;
        button.dataset.originalText = button.innerHTML;
        button.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memproses...';
    } else {
        button.disabled = false;
        button.innerHTML = button.dataset.originalText || button.innerHTML;
    }
}

/**
 * Update profile (name & email)
 */
async function updateProfile(formData) {
    const submitButton = document.querySelector('#form-profile button[type="submit"]');
    setProfileButtonLoading(submitButton, true);
    
    try {
        const response = await fetch(`${PROFILE_API_URL}/update`, {
            method: 'POST',
            credentials: 'same-origin',
            body: formData
        });
        
        const result = await response.json();
        
        if (result.success) {
            showProfileMessage(result.message, 'success');
            
            // Update navbar name if changed
            const newName = formData.get('name');
            const navbarName = document.querySelector('.navbar .dropdown-toggle');
            if (navbarName && newName) {
                navbarName.innerHTML = `<i class="fas fa-user-circle me-2"></i>${newName}`;
            }
        } else {
            showProfileMessage(result.message, 'error');
        }
    } catch (error) {
        console.error('Update profile error:', error);
        showProfileMessage('Terjadi kesalahan saat mengupdate profil', 'error');
    } finally {
        setProfileButtonLoading(submitButton, false);
    }
}

/**
 * Change password
 */
async function changePassword(formData) {
    const submitButton = document.querySelector('#form-password button[type="submit"]');
    setProfileButtonLoading(submitButton, true);
    
    try {
        const response = await fetch(`${PROFILE_API_URL}/change-password`, {
            method: 'POST',
            credentials: 'same-origin',
            body: formData
        });
        
        const result = await response.json();
        
        if (result.success) {
            showProfileMessage(result.message, 'success');
            
            // Reset form on success
            document.querySelector('#form-password').reset();
        } else {
            showProfileMessage(result.message, 'error');
        }
    } catch (error) {
        console.error('Change password error:', error);
        showProfileMessage('Terjadi kesalahan saat mengubah password', 'error');
    } finally {
        setProfileButtonLoading(submitButton, false);
    }
}

/**
 * Handle profile form submission
 */
function handleProfileFormSubmit(event) {
    event.preventDefault();
    
    const form = event.target;
    const formData = new FormData(form);
    
    updateProfile(formData);
}

/**
 * Handle password form submission
 */
function handlePasswordFormSubmit(event) {
    event.preventDefault();
    
    const form = event.target;
    const formData = new FormData(form);
    
    // Validate password match on client side
    const newPassword = formData.get('new_password');
    const confirmPassword = formData.get('confirm_password');
    
    if (newPassword !== confirmPassword) {
        showProfileMessage('Konfirmasi password baru tidak cocok', 'error');
        return;
    }
    
    if (newPassword.length < 6) {
        showProfileMessage('Password minimal 6 karakter', 'error');
        return;
    }
    
    changePassword(formData);
}

/**
 * Initialize
 */
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const currentUrl = urlParams.get('url') || '';
    
    // Profile page
    if (currentUrl === 'profile') {
        // Profile update form
        const profileForm = document.querySelector('#form-profile');
        if (profileForm) {
            profileForm.addEventListener('submit', handleProfileFormSubmit);
        }
        
        // Password change form
        const passwordForm = document.querySelector('#form-password');
        if (passwordForm) {
            passwordForm.addEventListener('submit', handlePasswordFormSubmit);
        }
    }
});
