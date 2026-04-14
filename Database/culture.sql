-- 1. Tạo bảng categories (Giữ nguyên tên cột của bạn)
CREATE TABLE IF NOT EXISTS culture_categories (
    culture_category_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE
);

-- 2. Tạo bảng cultures (Sửa chỗ REFERENCES để khớp với tên cột trên)
CREATE TABLE IF NOT EXISTS cultures (
    id INT AUTO_INCREMENT PRIMARY KEY,
    culture_category_id INT,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    event_date VARCHAR(255),
    location VARCHAR(255),
    content TEXT,
    status TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    -- Chỗ này phải là culture_category_id mới đúng
    FOREIGN KEY (culture_category_id) REFERENCES culture_categories(culture_category_id) ON DELETE SET NULL
);

-- 3. Tạo bảng images (Giữ nguyên)
CREATE TABLE IF NOT EXISTS culture_images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    culture_id INT,
    image VARCHAR(255) NOT NULL,
    is_primary TINYINT(1) DEFAULT 0,
    FOREIGN KEY (culture_id) REFERENCES cultures(id) ON DELETE CASCADE
);

-- 4. INSERT Categories (Phải thêm slug vì bạn để NOT NULL)
INSERT INTO culture_categories (name, slug) 
VALUES 
('Festival', 'festival'), 
('Traditional Craft Villages', 'traditional-craft-villages');

-- 5. INSERT Cultures (Giữ nguyên dữ liệu của bạn)
INSERT INTO cultures (id, culture_category_id, title, slug, event_date, location, content)
VALUES 
(1, 1, 'Binh Thuy Temple Ky Yen Festival', 'binh-thuy-temple-ky-yen-festival', '2026-05-12', 'Binh Thuy Ward, Binh Thuy District, Can Tho', 'This is the most significant cultural and religious event in Can Tho...'),
(2, 1, 'Southern Traditional Cake Festival', 'southern-traditional-cake-festival', '2026-04-10', 'Binh Thuy District Square, Can Tho City', 'An annual culinary extravaganza that attracts millions of visitors...'),
(3, 1, 'Cai Rang Floating Market Culture Festival', 'cai-rang-floating-market-culture-festival', '2026-07-09', 'Cai Rang District, Can Tho City', 'Organized to celebrate the National Intangible Cultural Heritage...'),
(4, 1, 'Chol Chnam Thmay Festival', 'chol-chnam-thmay-festival', '2026-04-14', 'Pitu Khosa Rangsay Pagoda, Ninh Kieu District', 'The traditional New Year festival of the Khmer ethnic community...'),
(5, 1, 'Ok Om Bok Festival', 'ok-om-bok-festival', '2026-11-24', 'O Mon District and Ninh Kieu Quay', 'Also known as the Moon Worshiping Festival...'),
(6, 1, 'Ninh Kieu Lantern Night', 'ninh-kieu-lantern-night', '2026-12-15', 'Ninh Kieu Wharf, Can Tho City', 'A spectacular visual event where the Ninh Kieu Wharf is illuminated...'),
(7, 1, 'Ong Pagoda Festival', 'ong-pagoda-festival', '2026-08-07', 'Hai Ba Trung Street, Ninh Kieu District', 'A cultural religious event of the Chinese-Vietnamese community...'),
(8, 1, 'Can Tho Flower Street (Tet Festival)', 'can-tho-flower-street-tet-festival', '2026-02-17', 'Hoa Binh Avenue, Ninh Kieu District', 'During the Lunar New Year (Tet), the heart of the city transforms...'),
(9, 1, 'Tan Loc Fruit Festival', 'tan-loc-fruit-festival', '2026-06-18', 'Tan Loc Islet, Thot Not District', 'Held on the Tan Loc Islet (known as the Sweet Island)...'),
(10, 1, 'Sen Dolta Festival', 'sen-dolta-festival', '2026-10-08', 'Khmer Pagodas in O Mon District', 'The Ancestor Blessing Festival of the Khmer people...'),
(11, 1, 'Phan Thanh Gian Memorial Ceremony', 'phan-thanh-gian-memorial-ceremony', '2026-08-15', 'Ba Lang, Cai Rang District', 'A solemn ceremony dedicated to Phan Thanh Gian...'),
(12, 1, 'Can Tho Tourism & Promotion Fair', 'can-tho-tourism-promotion-fair', '2026-11-02', 'Promotion Agency Exhibition Center', 'A modern festival-style trade fair that combines business...'),
(13, 1, 'Hau Giang River Music Festival', 'hau-giang-river-music-festival', '2026-09-02', 'Ninh Kieu Pedestrian Bridge Area', 'A contemporary art festival featuring laser lights...');
(24, 1, 'Tet Festival (Lunar New Year)', 'tet-festival-lunar-new-year', '2026-02-17', 'Throughout Can Tho City', 
'Tet Nguyen Dan, or simply Tet, is the most sacred and significant festival in Vietnam. In Can Tho, the heart of the Mekong Delta, Tet is celebrated with unique riverine traditions. Families gather to prepare Banh Tet, visit the floating markets filled with flowers, and decorate their homes with yellow Ochna (Hoa Mai). The festival marks the beginning of spring and is a time for reunions, ancestor worship, and wishing for a prosperous new year.');
(25, 1, 'Vu Lan Festival (Filial Piety Ceremony)', 'vu-lan-festival-filial-piety', '2026-08-27', 'Buddhist Pagodas in Can Tho City', 
'Vu Lan Festival, held on the 15th day of the 7th lunar month, is a deeply spiritual event in Vietnam dedicated to honoring parents and ancestors. In Can Tho, thousands of people visit pagodas to participate in the "Rose on the Chest" ceremony. Those whose parents are still alive wear a red rose, while those who have lost them wear a white one. The festival promotes the tradition of filial piety and includes activities like releasing lanterns and offering prayers for peace.');

INSERT INTO culture_images (culture_id, image, is_primary)
VALUES 
(1, 'images/Culture/binh-thuy-temple-1.jpg', 1), (1, 'images/Culture/binh-thuy-temple-2.jpg', 0), (1, 'images/Culture/binh-thuy-temple-3.jpg', 0),
(2, 'images/Culture/southern-cake-1.jpg', 1), (2, 'images/Culture/southern-cake-2.jpg', 0), (2, 'images/Culture/southern-cake-3.jpg', 0),
(3, 'images/Culture/cai-rang-market-1.jpg', 1), (3, 'images/Culture/cai-rang-market-2.jpg', 0), (3, 'images/Culture/cai-rang-market-3.jpg', 0),
(4, 'images/Culture/chol-chnam-thmay-1.jpg', 1), (4, 'images/Culture/chol-chnam-thmay-2.jpg', 0), (4, 'images/Culture/chol-chnam-thmay-3.jpg', 0),
(5, 'images/Culture/ok-om-bok-1.jpg', 1), (5, 'images/Culture/ok-om-bok-2.jpg', 0), (5, 'images/Culture/ok-om-bok-3.jpg', 0),
(6, 'images/Culture/lantern-night-1.jpg', 1), (6, 'images/Culture/lantern-night-2.jpg', 0), (6, 'images/Culture/lantern-night-3.jpg', 0),
(7, 'images/Culture/ong-pagoda-1.jpg', 1), (7, 'images/Culture/ong-pagoda-2.jpg', 0), (7, 'images/Culture/ong-pagoda-3.jpg', 0),
(8, 'images/Culture/flower-street-1.jpg', 1), (8, 'images/Culture/flower-street-2.jpg', 0), (8, 'images/Culture/flower-street-3.jpg', 0),
(9, 'images/Culture/fruit-festival-1.jpg', 1), (9, 'images/Culture/fruit-festival-2.jpg', 0), (9, 'images/Culture/fruit-festival-3.jpg', 0),
(10, 'images/Culture/sen-dolta-1.jpg', 1), (10, 'images/Culture/sen-dolta-2.jpg', 0), (10, 'images/Culture/sen-dolta-3.jpg', 0),
(11, 'images/Culture/phan-thanh-gian-1.jpg', 1), (11, 'images/Culture/phan-thanh-gian-2.jpg', 0), (11, 'images/Culture/phan-thanh-gian-3.jpg', 0),
(12, 'images/Culture/trade-fair-1.jpg', 1), (12, 'images/Culture/trade-fair-2.jpg', 0), (12, 'images/Culture/trade-fair-3.jpg', 0),
(13, 'images/Culture/water-music-1.jpg', 1), (13, 'images/Culture/water-music-2.jpg', 0), (13, 'images/Culture/water-music-3.jpg', 0);
(24, 'images/Culture/tet1.jpg', 1), (24, 'images/Culture/tet2.jpg', 0),  (24, 'images/Culture/tet3.jpg', 0);   
(25, 'images/Culture/vu-lan1.jpg', 1), (25, 'images/Culture/vu-lan2.jpg', 0), (25, 'images/Culture/vu-lan3.jpg', 0); 

-- 1. Tạo bảng categories (Giữ nguyên tên cột của bạn)
CREATE TABLE IF NOT EXISTS culture_categories (
    culture_category_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE
);

-- 2. Tạo bảng cultures (Sửa chỗ REFERENCES để khớp với tên cột trên)
CREATE TABLE IF NOT EXISTS cultures (
    id INT AUTO_INCREMENT PRIMARY KEY,
    culture_category_id INT,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    event_date VARCHAR(255),
    location VARCHAR(255),
    content TEXT,
    status TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    -- Chỗ này phải là culture_category_id mới đúng
    FOREIGN KEY (culture_category_id) REFERENCES culture_categories(culture_category_id) ON DELETE SET NULL
);

-- 3. Tạo bảng images (Giữ nguyên)
CREATE TABLE IF NOT EXISTS culture_images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    culture_id INT,
    image VARCHAR(255) NOT NULL,
    is_primary TINYINT(1) DEFAULT 0,
    FOREIGN KEY (culture_id) REFERENCES cultures(id) ON DELETE CASCADE
);

-- 4. INSERT Categories (Phải thêm slug vì bạn để NOT NULL)
INSERT INTO culture_categories (name, slug) 
VALUES 
('Festival', 'festival'), 
('Traditional Craft Villages', 'traditional-craft-villages');

-- 5. INSERT Cultures (Giữ nguyên dữ liệu của bạn)
INSERT INTO cultures (id, culture_category_id, title, slug, event_date, location, content)
VALUES 
(1, 1, 'Binh Thuy Temple Ky Yen Festival', 'binh-thuy-temple-ky-yen-festival', '2026-05-12', 'Binh Thuy Ward, Binh Thuy District, Can Tho', 'This is the most significant cultural and religious event in Can Tho...'),
(2, 1, 'Southern Traditional Cake Festival', 'southern-traditional-cake-festival', '2026-04-10', 'Binh Thuy District Square, Can Tho City', 'An annual culinary extravaganza that attracts millions of visitors...'),
(3, 1, 'Cai Rang Floating Market Culture Festival', 'cai-rang-floating-market-culture-festival', '2026-07-09', 'Cai Rang District, Can Tho City', 'Organized to celebrate the National Intangible Cultural Heritage...'),
(4, 1, 'Chol Chnam Thmay Festival', 'chol-chnam-thmay-festival', '2026-04-14', 'Pitu Khosa Rangsay Pagoda, Ninh Kieu District', 'The traditional New Year festival of the Khmer ethnic community...'),
(5, 1, 'Ok Om Bok Festival', 'ok-om-bok-festival', '2026-11-24', 'O Mon District and Ninh Kieu Quay', 'Also known as the Moon Worshiping Festival...'),
(6, 1, 'Ninh Kieu Lantern Night', 'ninh-kieu-lantern-night', '2026-12-15', 'Ninh Kieu Wharf, Can Tho City', 'A spectacular visual event where the Ninh Kieu Wharf is illuminated...'),
(7, 1, 'Ong Pagoda Festival', 'ong-pagoda-festival', '2026-08-07', 'Hai Ba Trung Street, Ninh Kieu District', 'A cultural religious event of the Chinese-Vietnamese community...'),
(8, 1, 'Can Tho Flower Street (Tet Festival)', 'can-tho-flower-street-tet-festival', '2026-02-17', 'Hoa Binh Avenue, Ninh Kieu District', 'During the Lunar New Year (Tet), the heart of the city transforms...'),
(9, 1, 'Tan Loc Fruit Festival', 'tan-loc-fruit-festival', '2026-06-18', 'Tan Loc Islet, Thot Not District', 'Held on the Tan Loc Islet (known as the Sweet Island)...'),
(10, 1, 'Sen Dolta Festival', 'sen-dolta-festival', '2026-10-08', 'Khmer Pagodas in O Mon District', 'The Ancestor Blessing Festival of the Khmer people...'),
(11, 1, 'Phan Thanh Gian Memorial Ceremony', 'phan-thanh-gian-memorial-ceremony', '2026-08-15', 'Ba Lang, Cai Rang District', 'A solemn ceremony dedicated to Phan Thanh Gian...'),
(12, 1, 'Can Tho Tourism & Promotion Fair', 'can-tho-tourism-promotion-fair', '2026-11-02', 'Promotion Agency Exhibition Center', 'A modern festival-style trade fair that combines business...'),
(13, 1, 'Hau Giang River Music Festival', 'hau-giang-river-music-festival', '2026-09-02', 'Ninh Kieu Pedestrian Bridge Area', 'A contemporary art festival featuring laser lights...');
(24, 1, 'Tet Festival (Lunar New Year)', 'tet-festival-lunar-new-year', '2026-02-17', 'Throughout Can Tho City', 
'Tet Nguyen Dan, or simply Tet, is the most sacred and significant festival in Vietnam. In Can Tho, the heart of the Mekong Delta, Tet is celebrated with unique riverine traditions. Families gather to prepare Banh Tet, visit the floating markets filled with flowers, and decorate their homes with yellow Ochna (Hoa Mai). The festival marks the beginning of spring and is a time for reunions, ancestor worship, and wishing for a prosperous new year.');
(25, 1, 'Vu Lan Festival (Filial Piety Ceremony)', 'vu-lan-festival-filial-piety', '2026-08-27', 'Buddhist Pagodas in Can Tho City', 
'Vu Lan Festival, held on the 15th day of the 7th lunar month, is a deeply spiritual event in Vietnam dedicated to honoring parents and ancestors. In Can Tho, thousands of people visit pagodas to participate in the "Rose on the Chest" ceremony. Those whose parents are still alive wear a red rose, while those who have lost them wear a white one. The festival promotes the tradition of filial piety and includes activities like releasing lanterns and offering prayers for peace.');

INSERT INTO culture_images (culture_id, image, is_primary)
VALUES 
(1, 'images/Culture/binh-thuy-temple-1.jpg', 1), (1, 'images/Culture/binh-thuy-temple-2.jpg', 0), (1, 'images/Culture/binh-thuy-temple-3.jpg', 0),
(2, 'images/Culture/southern-cake-1.jpg', 1), (2, 'images/Culture/southern-cake-2.jpg', 0), (2, 'images/Culture/southern-cake-3.jpg', 0),
(3, 'images/Culture/cai-rang-market-1.jpg', 1), (3, 'images/Culture/cai-rang-market-2.jpg', 0), (3, 'images/Culture/cai-rang-market-3.jpg', 0),
(4, 'images/Culture/chol-chnam-thmay-1.jpg', 1), (4, 'images/Culture/chol-chnam-thmay-2.jpg', 0), (4, 'images/Culture/chol-chnam-thmay-3.jpg', 0),
(5, 'images/Culture/ok-om-bok-1.jpg', 1), (5, 'images/Culture/ok-om-bok-2.jpg', 0), (5, 'images/Culture/ok-om-bok-3.jpg', 0),
(6, 'images/Culture/lantern-night-1.jpg', 1), (6, 'images/Culture/lantern-night-2.jpg', 0), (6, 'images/Culture/lantern-night-3.jpg', 0),
(7, 'images/Culture/ong-pagoda-1.jpg', 1), (7, 'images/Culture/ong-pagoda-2.jpg', 0), (7, 'images/Culture/ong-pagoda-3.jpg', 0),
(8, 'images/Culture/flower-street-1.jpg', 1), (8, 'images/Culture/flower-street-2.jpg', 0), (8, 'images/Culture/flower-street-3.jpg', 0),
(9, 'images/Culture/fruit-festival-1.jpg', 1), (9, 'images/Culture/fruit-festival-2.jpg', 0), (9, 'images/Culture/fruit-festival-3.jpg', 0),
(10, 'images/Culture/sen-dolta-1.jpg', 1), (10, 'images/Culture/sen-dolta-2.jpg', 0), (10, 'images/Culture/sen-dolta-3.jpg', 0),
(11, 'images/Culture/phan-thanh-gian-1.jpg', 1), (11, 'images/Culture/phan-thanh-gian-2.jpg', 0), (11, 'images/Culture/phan-thanh-gian-3.jpg', 0),
(12, 'images/Culture/trade-fair-1.jpg', 1), (12, 'images/Culture/trade-fair-2.jpg', 0), (12, 'images/Culture/trade-fair-3.jpg', 0),
(13, 'images/Culture/water-music-1.jpg', 1), (13, 'images/Culture/water-music-2.jpg', 0), (13, 'images/Culture/water-music-3.jpg', 0);
(24, 'images/Culture/tet1.jpg', 1), (24, 'images/Culture/tet2.jpg', 0),  (24, 'images/Culture/tet3.jpg', 0);   
(25, 'images/Culture/vu-lan1.jpg', 1), (25, 'images/Culture/vu-lan2.jpg', 0), (25, 'images/Culture/vu-lan3.jpg', 0); 

-- ==========================================================
-- CHÈN DỮ LIỆU LÀNG NGHỀ (CULTURES) - DÙNG CHO CATEGORY ID 2
-- ==========================================================

INSERT INTO cultures (id, culture_category_id, title, slug, event_date, location, content) VALUES 
(14, 2, 'Thuan Hung Rice Paper Village', 'thuan-hung-rice-paper-village', NULL, 'Thuan Hung Ward, Thot Not District, Can Tho City', 
'With a history spanning over a century, Thuan Hung is famous for its thin, crispy, and fragrant rice papers. Visitors can witness the meticulous process of grinding rice, steaming cakes, and drying them on bamboo mats under the sun. The village is most vibrant during the months leading up to the Lunar New Year, producing various types of cakes like salty, sweet, and coconut-flavored rice papers.'),

(15, 2, 'Thom Rom Net Weaving Village', 'thom-rom-net-weaving-village', NULL, 'Trung Kien Ward, Thot Not District, Can Tho City', 
'Known as the largest fishing net production hub in the Mekong Delta, this village reflects the deep connection between locals and the river life. Thousands of households engage in weaving nets of all sizes, from small hand-nets to massive industrial ones. The craft has evolved from manual weaving to using modern machinery, yet the skill in choosing materials and finishing the products remains a traditional secret.'),

(16, 2, 'Ba Bo Flower Village', 'ba-bo-flower-village-tradition', NULL, 'An Khanh Ward, Ninh Kieu District, Can Tho City', 
'A colorful destination that supplies millions of flowers to the Southern region, especially during the Spring festival. The village specializes in growing marigolds, roses, sunflowers, and many exotic tropical flowers. It is not only a production site but also a popular eco-tourism spot where visitors can learn about horticultural techniques.'),

(17, 2, 'Can Tho Conical Hat Weaving Village', 'can-tho-conical-hat-weaving-village', NULL, 'Thoi Tu Area, Thoi Lai District, Can Tho City', 
'The Non La (conical hat) is an iconic symbol of Vietnamese women, and the artisans in Can Tho have kept this craft alive for generations. The process involves selecting young palm leaves, drying them, and meticulously stitching them onto bamboo frames. Each hat represents the elegance, patience, and skill of the rural Southern craftswomen.'),

(18, 2, 'Dinh Yen Mat Weaving Village', 'dinh-yen-mat-weaving-village', NULL, 'Luu Huu Phuoc Street Area, Can Tho City', 
'Although many modern mats exist, the traditional hand-woven sedge mats of this region remain highly valued for their durability and natural cooling properties. The village is famous for its historical Ghost Market where mats were traded at night. Today, the vibrant colors of dyed sedge create a picturesque scene.'),

(19, 2, 'Ba Lang Forging Village', 'ba-lang-forging-village', NULL, 'Ba Lang Ward, Cai Rang District, Can Tho City', 
'One of the oldest blacksmithing villages in the Mekong Delta, Ba Lang is renowned for producing high-quality agricultural tools like sickles, knives, and axes. The artisans use traditional fire-tempering techniques to ensure the metal reaches the perfect hardness, a skill passed down for generations.'),

(20, 2, 'Phong Dien Bamboo Basket Weaving', 'phong-dien-bamboo-basket-weaving', NULL, 'Phong Dien District, Can Tho City', 
'Utilizing the abundant bamboo resources, artisans in Phong Dien create various household items like baskets, trays, and sieves. In recent years, the village has expanded into making bamboo souvenirs and decorative items for resorts, blending tradition with modern design.'),

(21, 2, 'Long Tuyen Wood Carving Village', 'long-tuyen-wood-carving-village', NULL, 'Binh Thuy District, Can Tho City', 
'Located in the historic Long Tuyen land, this village is home to talented woodworkers who specialize in traditional furniture and religious altars. The intricate carvings often depict dragons, phoenixes, and scenes from folklore, requiring immense concentration and deep spiritual understanding.'),

(22, 2, 'Can Tho Hu Tieu Rice Noodle Making', 'can-tho-hu-tieu-rice-noodle-making', NULL, 'An Binh Ward, Ninh Kieu District, Can Tho City', 
'Hu Tieu is a staple dish of the South, and the traditional workshops in Can Tho still use manual methods to create the perfect chewy texture. Many workshops now offer Hu Tieu Pizza - a creative twist that attracts many international and local tourists.'),

(23, 2, 'Thoi Nhat Bronze Casting Village', 'thoi-nhat-bronze-casting-village', NULL, 'An Khanh Ward, Ninh Kieu District, Can Tho City', 
'A small but prestigious craft village specializing in bronze items like incense burners, bells, and statues. Thoi Nhat bronze products are known for their glossy finish and intricate patterns, often ordered for pagodas and traditional ancestral houses across the Mekong Delta.');


-- ==========================================================
-- CHÈN DỮ LIỆU HÌNH ẢNH (CULTURE_IMAGES)
-- ==========================================================

INSERT INTO culture_images (culture_id, image, is_primary) VALUES 
-- Thuan Hung Rice Paper
(14, 'images/Culture/thuan-hung-rice-paper-1.jpg', 1), (14, 'images/Culture/thuan-hung-rice-paper-2.jpg', 0), (14, 'images/Culture/thuan-hung-rice-paper-3.jpg', 0),
-- Thom Rom Net
(15, 'images/Culture/thom-rom-net-1.jpg', 1), (15, 'images/Culture/thom-rom-net-2.jpg', 0), (15, 'images/Culture/thom-rom-net-3.jpg', 0),
-- Ba Bo Flower
(16, 'images/Culture/ba-bo-flower-1.jpg', 1), (16, 'images/Culture/ba-bo-flower-2.jpg', 0), (16, 'images/Culture/ba-bo-flower-3.jpg', 0),
-- Conical Hat
(17, 'images/Culture/conical-hat-1.jpg', 1), (17, 'images/Culture/conical-hat-2.jpg', 0), (17, 'images/Culture/conical-hat-3.jpg', 0),
-- Dinh Yen Mat
(18, 'images/Culture/dinh-yen-mat-1.jpg', 1), (18, 'images/Culture/dinh-yen-mat-2.jpg', 0), (18, 'images/Culture/dinh-yen-mat-3.jpg', 0),
-- Ba Lang Forging
(19, 'images/Culture/ba-lang-forging-1.jpg', 1), (19, 'images/Culture/ba-lang-forging-2.jpg', 0), (19, 'images/Culture/ba-lang-forging-3.jpg', 0),
-- Phong Dien Bamboo
(20, 'images/Culture/bamboo-basket-1.jpg', 1), (20, 'images/Culture/bamboo-basket-2.jpg', 0), (20, 'images/Culture/bamboo-basket-3.jpg', 0),
-- Long Tuyen Wood
(21, 'images/Culture/wood-carving-1.jpg', 1), (21, 'images/Culture/wood-carving-2.jpg', 0), (21, 'images/Culture/wood-carving-3.jpg', 0),
-- Hu Tieu Making
(22, 'images/Culture/hu-tieu-making-1.jpg', 1), (22, 'images/Culture/hu-tieu-making-2.jpg', 0), (22, 'images/Culture/hu-tieu-making-3.jpg', 0),
-- Bronze Casting
(23, 'images/Culture/bronze-casting-1.jpg', 1), (23, 'images/Culture/bronze-casting-2.jpg', 0), (23, 'images/Culture/bronze-casting-3.jpg', 0);