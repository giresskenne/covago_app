// Open Notification Modal
function openNotificationModal(title, message, loginLink = null, registerLink = null, showOkButton = true) {
    document.getElementById('notificationTitle').innerText = title;
    document.getElementById('notificationMessage').innerText = message;

    const loginButton = document.getElementById('loginButton');
    const registerButton = document.getElementById('registerButton');
    const okButton = document.querySelector('.btn-success');

    // Handle login button
    if (loginLink) {
        loginButton.href = loginLink;
        loginButton.style.display = 'inline-block';
    } else {
        loginButton.style.display = 'none';
    }

    // Handle register button
    if (registerLink) {
        registerButton.href = registerLink;
        registerButton.style.display = 'inline-block';
    } else {
        registerButton.style.display = 'none';
    }

    // Handle OK button visibility
    if (showOkButton) {
        okButton.style.display = 'inline-block';
    } else {
        okButton.style.display = 'none';
    }

    // Show the modal
    document.getElementById('notificationModal').style.display = 'flex';
}

// Close Notification Modal
function closeNotificationModal() {
    document.getElementById('notificationModal').style.display = 'none';
}
