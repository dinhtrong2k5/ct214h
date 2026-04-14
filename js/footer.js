/**
 * 5. XỬ LÝ FORM ĐĂNG KÝ VÀ MODAL (Footer)
 */
const subscribeForm = document.getElementById('subscribeForm');
const successModal = document.getElementById('successModal');
const closeModalBtn = document.getElementById('closeModalBtn');

if (subscribeForm) {
    subscribeForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Ngăn load lại trang
        
        // Hiển thị Popup thông báo
        if (successModal) {
            successModal.style.display = 'flex';
        }

        subscribeForm.reset();
    });
}

if (closeModalBtn) {
    closeModalBtn.addEventListener('click', function() {
        successModal.style.display = 'none';
    });
}

// Đóng Popup khi click chuột ra vùng tối bên ngoài
window.addEventListener('click', function(event) {
    if (event.target === successModal) {
        successModal.style.display = 'none';
    }
});