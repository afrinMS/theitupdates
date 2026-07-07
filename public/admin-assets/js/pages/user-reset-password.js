(function() {
    'use strict';

    document.addEventListener('DOMContentLoaded', function() {
        const resetForm = document.getElementById('reset-form');
        const resetSubmit = document.getElementById('reset-submit');
        const resetAlert = document.getElementById('reset-alert');

        if (!resetForm) return;

        resetForm.addEventListener('submit', function(e) {
            e.preventDefault();

            // Clear previous errors
            document.querySelectorAll('[id$="-error"]').forEach(el => {
                el.style.display = 'none';
            });
            resetAlert.classList.add('d-none');

            // Get form data
            const token = document.querySelector('input[name="token"]').value;
            const newPassword = document.getElementById('reset-password').value;
            const confirmPassword = document.getElementById('reset-confirm-password').value;
            const csrfField = document.querySelector('[name="' + CSRF_FIELD + '"]');

            // Validate form
            if (!newPassword) {
                showError('reset-password', 'Password is required');
                return;
            }

            if (newPassword.length < 8) {
                showError('reset-password', 'Password must be at least 8 characters long');
                return;
            }

            if (!confirmPassword) {
                showError('reset-confirm-password', 'Confirm password is required');
                return;
            }

            if (newPassword !== confirmPassword) {
                showError('reset-confirm-password', 'Passwords do not match');
                return;
            }

            // Disable submit button
            resetSubmit.disabled = true;
            resetSubmit.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Resetting...';

            // Prepare form data
            const formData = new FormData();
            formData.append('token', token);
            formData.append('new_password', newPassword);
            formData.append('confirm_password', confirmPassword);
            formData.append(CSRF_FIELD, csrfField.value);

            // Send AJAX request
            fetch('reset-password-submit', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                resetSubmit.disabled = false;
                resetSubmit.innerHTML = 'Reset Password';

                // Update CSRF token if provided
                if (data.csrf) {
                    csrfField.value = data.csrf;
                }

                if (data.success) {
                    // Show success alert
                    showAlert('alert-success', data.message || 'Password reset successfully');
                    
                    // Clear form
                    resetForm.reset();
                    
                    // Redirect to login after 2 seconds
                    setTimeout(function() {
                        window.location.href = 'login';
                    }, 2000);
                } else {
                    // Show error alert
                    if (data.errors) {
                        // Display field-specific errors
                        Object.keys(data.errors).forEach(field => {
                            const errorDiv = document.getElementById('reset-' + field.replace('_', '-') + '-error');
                            if (errorDiv) {
                                errorDiv.textContent = data.errors[field];
                                errorDiv.style.display = 'block';
                            }
                        });
                    }
                    
                    if (data.message) {
                        showAlert('alert-danger', data.message);
                    }
                }
            })
            .catch(error => {
                resetSubmit.disabled = false;
                resetSubmit.innerHTML = 'Reset Password';
                console.error('Error:', error);
                showAlert('alert-danger', 'An error occurred. Please try again.');
            });
        });

        function showError(fieldId, message) {
            const errorDiv = document.getElementById(fieldId + '-error');
            if (errorDiv) {
                errorDiv.textContent = message;
                errorDiv.style.display = 'block';
            }
        }

        function showAlert(alertClass, message) {
            resetAlert.textContent = message;
            resetAlert.className = 'user-auth-alert alert ' + alertClass;
            resetAlert.classList.remove('d-none');
            resetAlert.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }
    });
})();
