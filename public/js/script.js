document.addEventListener("DOMContentLoaded", () => {
    // Fitur Auto-Close Notifikasi Flash Message dalam 4 detik
    const alerts = document.querySelectorAll(".alert-dismissible");
    alerts.forEach((alert) => {
        setTimeout(() => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 4000);
    });
});
