
document.querySelector('form').addEventListener('submit', function(e) {
    const password = document.getElementById('password').value;
    const terms = document.getElementById('terms').checked;
    
    if (password.length < 8) {
        e.preventDefault();
        alert('Password harus minimal 8 karakter!');
        return false;
    }
    
    if (!terms) {
        e.preventDefault();
        alert('Anda harus menyetujui Syarat & Ketentuan!');
        return false;
    }
});

function togglePassword() {
    const passwordInput = document.getElementById('password');
    const toggleIcon = document.querySelector('.password-toggle i');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
    }
}

// Password strength indicator
document.getElementById('password').addEventListener('input', function(e) {
    const password = e.target.value;
    const strengthBar = document.getElementById('strengthBar');
    let strength = 0;
    
    if (password.length >= 8) strength += 25;
    if (password.match(/[a-z]/)) strength += 25;
    if (password.match(/[A-Z]/)) strength += 25;
    if (password.match(/[0-9]/)) strength += 25;
    
    strengthBar.style.width = strength + '%';
    strengthBar.style.backgroundColor = 
        strength <= 25 ? '#ff4444' :
        strength <= 50 ? '#ffbb33' :
        strength <= 75 ? '#00C851' :
        '#007E33';
});
