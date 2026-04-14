
CREATE TABLE IF NOT EXISTS destination_categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE IF NOT EXISTS destinations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    destination_category_id INT,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    description TEXT,
    address VARCHAR(255),
    ticket_price DECIMAL(10, 2) DEFAULT 0,
    status TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (destination_category_id) REFERENCES destination_categories(id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS destination_images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    destination_id INT,
    image VARCHAR(255) NOT NULL,
    is_primary TINYINT(1) DEFAULT 0,
    FOREIGN KEY (destination_id) REFERENCES destinations(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    destination_id INT,
    name VARCHAR(100),
    email VARCHAR(100),
    rating INT,
    comment TEXT,
    status TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (destination_id) REFERENCES destinations(id) ON DELETE CASCADE
);

INSERT INTO destination_categories (id, name, slug) VALUES 
(1, 'Eco Tourism', 'eco-tourism'),
(2, 'Cultural', 'cultural'),
(3, 'Historical', 'historical');

INSERT INTO destinations (id, destination_category_id, name, slug, description, address, ticket_price, status) VALUES 
(1, 2, 'Cai Rang Floating Market', 'cai-rang-floating-market', 'Chợ nổi lớn nhất khu vực Đồng bằng sông Cửu Long, nơi buôn bán nhộn nhịp trên sông.', 'Cai Rang River, Can Tho', 0, 1),
(2, 3, 'Binh Thuy Ancient House', 'binh-thuy-ancient-house', 'Ngôi nhà cổ với kiến trúc kết hợp độc đáo giữa phương Đông và phương Tây.', 'Bui Huu Nghia, Binh Thuy, Can Tho', 15000, 1),
(3, 1, 'My Khanh Tourist Village', 'my-khanh-tourist-village', 'Làng du lịch sinh thái nổi tiếng với nhiều vườn trái cây và trò chơi dân gian.', 'Phong Dien, Can Tho', 50000, 1);

INSERT INTO destination_images (destination_id, image, is_primary) VALUES 
(1, '1775124407_cai-rang-floating-market.jpg', 1),
(2, '1775124257_nhaco-binhthuy.jpg', 1),
(3, '1775124249_lang-du-lich-my-khanh.jpg', 1);