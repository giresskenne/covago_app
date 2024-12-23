// notification_modal.js

// Open Notification Modal
function openNotificationModal(title, message) {
    document.getElementById('notificationTitle').innerText = title;
    document.getElementById('notificationMessage').innerText = message;
    document.getElementById('notificationModal').style.display = 'flex';
}

// Close Notification Modal
function closeNotificationModal() {
    document.getElementById('notificationModal').style.display = 'none';
}
