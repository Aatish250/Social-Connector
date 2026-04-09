function log_user_in(email, password) {
    fetch('php/login_process.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `email=${encodeURIComponent(email)}&password=${encodeURIComponent(password)}`
    })
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                showToast(data.message, data.status, data.timmer || 2);
                // Redirect or handle login success
                setTimeout(() => {
                    window.location.href = 'profile.php';
                }, 1000);
                window.location.href = 'profile.php'; // Change to your destination page
            } else {
                showToast(data.message, data.status, data.timmer || 4);
                // Show login error
            }
        })
        .catch(error => {
            console.error('Login error:', error);
            showToast('Login failed, please try again.', 0, 4);
        });
}