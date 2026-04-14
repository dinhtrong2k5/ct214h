// let currentCategoryId = 0; // Đã khai báo ở dưới, giữ nguyên cấu trúc của bạn

// FOOD
function filterCategory(categoryId, element) {
    currentCategoryId = categoryId;

    // Remove active
    var buttons = document.getElementsByClassName("category-btn");
    for (var i = 0; i < buttons.length; i++) {
        buttons[i].classList.remove("active");
    }

    // Add active
    element.classList.add("active");

    loadFood(1);
}


//FOOD DETAIL
function openFoodDetail(foodId) {
    var modal = document.getElementById("foodModal");
    var content = document.getElementById("modal-body");

    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            content.innerHTML = xmlhttp.responseText;
            modal.style.display = "block";
        }
    };

    // SỬA: Bỏ "ajax/" vì file food_detail_ajax.php nằm cùng thư mục Food/ với trang chính
    xmlhttp.open("GET", "food_detail_ajax.php?id=" + foodId, true);
    xmlhttp.send();
}

function closeModal() {
    document.getElementById("foodModal").style.display = "none";
}


//FOOD SEARCH
function searchFood() {
    currentKeyword = document.getElementById("search-input").value;
    loadFood(1);
}


//THÊM LOCATION
function addLocation() {
    var container = document.getElementById("new-locations");

    var div = document.createElement("div");
    div.classList.add("location-item");

    div.innerHTML = `
        <input type="text" name="new_location_name[]" placeholder="Location name">
        <input type="text" name="new_location_address[]" placeholder="Address">
        <button type="button" onclick="this.parentElement.remove()">Remove</button>
        <br><br>
    `;

    container.appendChild(div);
}

//PHÂN TRANG
let currentCategoryId = 0;
let currentKeyword = "";

function loadFood(page = 1) {
    // Đảm bảo lấy đúng giá trị từ giao diện
    const searchInput = document.getElementById('search-input');
    currentKeyword = searchInput ? searchInput.value : "";
    
    const sortSelect = document.getElementById('sort-select');
    const sortValue = sortSelect ? sortSelect.value : "latest";

    // SỬA: Bỏ "ajax/" để gọi trực tiếp file fetch_food.php nằm cùng thư mục Food/
    const url = `fetch_food.php?page=${page}&category_id=${currentCategoryId}&keyword=${currentKeyword}&sort=${sortValue}`;

    fetch(url)
        .then(response => {
            if (!response.ok) throw new Error('Không thể kết nối đến fetch_food.php');
            return response.json();
        })
        .then(data => {
            // Đổ dữ liệu vào vùng chứa món ăn
            document.getElementById('food-list').innerHTML = data.food_list;
            
            // Đổ dữ liệu vào vùng chứa phân trang
            document.getElementById('pagination-container').innerHTML = data.pagination;
        })
        .catch(error => {
            console.error('Lỗi AJAX:', error);
            // Nếu lỗi, thử kiểm tra đường dẫn file trên trình duyệt
        });
}

// Tự động chạy khi trang web tải xong
window.onload = function() {
    var firstBtn = document.getElementsByClassName("category-btn")[0];
    if (firstBtn) {
        filterCategory(0, firstBtn);
    } else {
        loadFood(1);
    }
};

function openFoodDetail(id) {
    const modal = document.getElementById('foodModal');
    const modalBody = document.getElementById('modal-body');

    modal.style.display = "block";
    modalBody.innerHTML = '<div style="padding:100px; text-align:center;">Loading...</div>';

    // Link đến file xử lý AJAX (Dùng file food_detail_ajax.php bạn đã viết)
    fetch(`food_detail_ajax.php?id=${id}`)
        .then(response => response.text())
        .then(data => {
            modalBody.innerHTML = data;
        })
        .catch(err => {
            modalBody.innerHTML = "Error loading details.";
        });
}