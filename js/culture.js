// Đợi trang load xong hoàn toàn
document.addEventListener('DOMContentLoaded', function() {
    
    // 1. Hiệu ứng Fade-in khi cuộn chuột cho các bài viết Culture
    const posts = document.querySelectorAll('.culture-post');
    
    const observerOptions = {
        threshold: 0.2
    };

    const postObserver = new IntersectionObserver(function(entries, observer) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    posts.forEach(post => {
        // Thiết lập trạng thái ban đầu cho animation
        post.style.opacity = '0';
        post.style.transform = 'translateY(30px)';
        post.style.transition = 'all 0.8s ease-out';
        postObserver.observe(post);
    });

    // 2. Xử lý Search nhanh đơn giản
    const searchInput = document.querySelector('.search-bar-mini input');
    if (searchInput) {
        searchInput.addEventListener('keyup', function(e) {
            let term = e.target.value.toLowerCase();
            let cultureItems = document.querySelectorAll('.culture-post');

            cultureItems.forEach(item => {
                let title = item.querySelector('.post-name').textContent.toLowerCase();
                if (title.indexOf(term) != -1) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    }
});

document.addEventListener("DOMContentLoaded", function() {
    // Lấy ID từ PHP truyền sang JS
    const targetId = <?php echo $festival_id; ?>;

    if (targetId > 0) {
        // Nếu con dùng Modal để hiện chi tiết lễ hội:
        if (typeof openFestivalDetail === "function") {
            openFestivalDetail(targetId);
        } 
        // Hoặc nếu con muốn cuộn trang xuống đúng vị trí lễ hội đó:
        else {
            const element = document.getElementById('festival-' + targetId);
            if (element) {
                element.scrollIntoView({ behavior: 'smooth' });
            }
        }
    }
});
