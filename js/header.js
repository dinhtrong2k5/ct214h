/**
 * 1. XỬ LÝ NAVBAR (Đổi màu Gradient khi cuộn)
 */
function checkScroll() {
    const navbar = document.querySelector('.navbar');
    if (navbar) {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    }
}

// Bắt sự kiện cuộn chuột
window.addEventListener('scroll', checkScroll);
// Kiểm tra ngay khi load trang (đề phòng trường hợp F5 giữa trang)
window.addEventListener('load', checkScroll);
