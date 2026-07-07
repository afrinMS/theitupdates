/**
 * Password Visibility Toggle Script
 * Handles show/hide password functionality with eye icon
 */

(function() {
  'use strict';

  // Initialize password toggle functionality
  function initPasswordToggle() {
    // Find all password toggle icons
    var toggles = document.querySelectorAll('.password-toggle');
    
    toggles.forEach(function(toggle) {
      toggle.addEventListener('click', function(e) {
        e.preventDefault();
        
        // Find the associated password input
        var passwordWrapper = toggle.closest('.password-wrapper');
        var passwordInput = passwordWrapper.querySelector('input[type="password"], input[type="text"]');
        
        if (!passwordInput) {
          return;
        }
        
        // Toggle password visibility
        if (passwordInput.type === 'password') {
          // Show password
          passwordInput.type = 'text';
          toggle.classList.remove('fa-eye');
          toggle.classList.add('fa-eye-slash');
          toggle.classList.add('visible');
        } else {
          // Hide password
          passwordInput.type = 'password';
          toggle.classList.remove('fa-eye-slash');
          toggle.classList.add('fa-eye');
          toggle.classList.remove('visible');
        }
      });
    });
  }

  // Initialize when DOM is ready
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initPasswordToggle);
  } else {
    initPasswordToggle();
  }
})();
