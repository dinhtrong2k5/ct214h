

/**
 * 2. XỬ LÝ SLIDER ANH (Hero Section)
 */
let index = 0;
const slides = document.querySelectorAll(".slide");

function showSlide(i) {
    if (slides.length === 0) return;
    
    slides.forEach(slide => {
        slide.classList.remove("active");
    });

    slides[i].classList.add("active");
}

function nextSlide() {
    index = (index + 1) % slides.length;
    showSlide(index);
}

function prevSlide() {
    index = (index - 1 + slides.length) % slides.length;
    showSlide(index);
}

// Tự động chuyển slide mỗi 5 giây
setInterval(nextSlide, 5000);

// Hiển thị slide đầu tiên khi khởi động
if (slides.length > 0) {
    showSlide(index);
}


/**
 * 3. XỬ LÝ TABS (Phần Destination)
 */
function openTab(evt, tabName) {
    let i, tabcontent, tablinks;

    // Ẩn tất cả các nội dung tab
    tabcontent = document.getElementsByClassName("tab-content");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Xóa class active của tất cả các nút tab
    tablinks = document.getElementsByClassName("tab-btn");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].classList.remove("active");
    }

    // Hiển thị tab được chọn (sử dụng Flexbox để đồng bộ với CSS)
    const selectedTab = document.getElementById(tabName);
    if (selectedTab) {
        selectedTab.style.display = "flex";
    }
    
    // Thêm class active vào nút hiện tại
    evt.currentTarget.classList.add("active");
}


/**
 * 4. XỬ LÝ SLIDER LỄ HỘI (Festival Slider)
 */
let currentFestPos = 0;
const festivalTrack = document.getElementById('festivalTrack');

function moveFestival(direction) {
    const card = document.querySelector('.festival-card');
    if (!card || !festivalTrack) return;

    const cardWidth = card.offsetWidth + 25; // Chiều rộng thẻ + gap (25px)
    const viewportWidth = document.querySelector('.festival-viewport').offsetWidth;
    const maxScroll = festivalTrack.scrollWidth - viewportWidth;

    currentFestPos += (direction * cardWidth * -1);

    // Giới hạn trượt để không bị lố ra ngoài
    if (currentFestPos > 0) {
        currentFestPos = 0;
    }
    if (Math.abs(currentFestPos) > maxScroll) {
        currentFestPos = -maxScroll;
    }

    festivalTrack.style.transform = `translateX(${currentFestPos}px)`;
}
function openFoodDetail(id) {
    const modal = document.getElementById('foodModal');
    const modalBody = document.getElementById('modal-body');
    
    modal.style.display = "block";
    modalBody.innerHTML = "Loading...";

    // Gọi file food_detail_ajax.php bạn đã gửi
    fetch(`../Food/food_detail_ajax.php?id=${id}`)
        .then(response => response.text())
        .then(data => {
            modalBody.innerHTML = data;
        });
}

function closeModal() {
    document.getElementById('foodModal').style.display = "none";
}