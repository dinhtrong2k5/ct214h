CREATE TABLE food_categories (
    food_category_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

CREATE TABLE foods(
	food_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    main_image VARCHAR(255) NOT NULL,
    price_min INT NOT NULL,
    price_max INT NOT NULL,
    status TINYINT DEFAULT 1,
    food_category_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY(food_category_id) REFERENCES food_categories(food_category_id)
);

CREATE TABLE food_locations (
    food_location_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR (255) NOT NULL,
    address VARCHAR(255) NOT NULL
);

CREATE TABLE food_at_location (
    food_id INT,
    food_location_id INT,
    PRIMARY KEY (food_id, food_location_id),
    FOREIGN KEY (food_id) REFERENCES foods(food_id),
    FOREIGN KEY (food_location_id) REFERENCES food_locations(food_location_id)
);

CREATE TABLE food_image (
    food_image_id INT AUTO_INCREMENT PRIMARY KEY,
    food_id INT NOT NULL,
    image VARCHAR(255) NOT NULL,
	FOREIGN KEY (food_id) REFERENCES foods(food_id)
);


-- INSERT CATEGORY
INSERT INTO food_categories(name) VALUES
('Local Specialties'),
('Noodles & Rice Dishes'),
('Hotpots & Grilled Dishes');

-- INSERT FOODS
-- LOCAL SPECIALTIES
INSERT INTO foods(name, description, main_image, price_min, price_max, food_category_id, status) VALUES
('Nem Nuong', 'Nem Nuong is a famous snack with a wonderful smoky smell. The pork sausages are grilled until golden and have a slightly sweet, savory taste. You wrap the meat in rice paper with fresh herbs and green banana slices. Dipping it into the thick, warm peanut sauce creates a perfect mix of flavors.', 'NemNuong.jpg', 40000, 100000, 1, 1),

('Banh Xeo', 'This giant yellow pancake is very thin and super crispy. Inside, you will find sweet river shrimp, pork, and crunchy bean sprouts. It has a light scent of turmeric and creamy coconut milk. You eat it by wrapping pieces in large green leaves and dipping them in sweet and sour fish sauce. Every bite is loud, crunchy, and full of fresh energy.', 'BanhXeo.jpg', 30000, 80000, 1, 1),

('Banh Cong', 'Banh Cong is a hot, deep-fried cake that is very crunchy on the outside but soft inside. It is filled with savory minced pork and creamy mung beans, topped with a whole crispy shrimp. The flavor is rich and oily, so it goes perfectly with fresh local vegetables. It is a very satisfying snack that makes you feel warm and full. A must-try for those who love crispy food.', 'BanhCong.jpg', 10000, 35000, 1, 1),

('Banh Tam Bi', 'This is a very special dish that mixes sweet and salty flavors together. The noodles are thick and chewy, covered in a rich and velvety coconut cream. On top, there is salty shredded pork skin that smells like toasted rice. It sounds unusual, but the creamy and savory taste is surprisingly delicious. It feels soft, smooth, and very unique to the Mekong Delta.', 'BanhTamBi.jpg', 20000, 30000, 1, 1),

('Pizza Hu Tieu', 'This is a creative "pizza" where the crust is made of deep-fried tapioca noodles. It is extremely crunchy and shatters like a cracker when you bite into it. On top, there are savory toppings like fried eggs, meat, and some peanuts. It has a toasted, nutty flavor that is very fun to eat as a snack. It’s a modern and clever twist on a traditional local ingredient.', 'PizzaHuTieu.jpg', 35000, 50000, 1, 1),

('Banh Tet La Cam', 'This sticky rice cake is famous for its beautiful purple color from the magenta plant. The rice is very soft, fragrant, and has a rich taste of coconut milk. Inside, you will find a delicious center of salted egg, mung beans, and fatty pork. It is a perfect balance of salty and sweet flavors in every slice. It is a hearty and colorful snack that looks like a piece of art.', 'BanhTetLaCam.jpg', 80000, 130000, 1, 1),

('Com Chay Kho Quet', 'This is a super crunchy snack made from toasted rice. You break off a piece of the golden rice crust and dip it into a thick, salty, and spicy fish sauce. The sauce has bits of crispy pork fat and tiny shrimp that taste amazing. It is a simple, rustic dish that is very addictive because of the "snap" and the bold flavor. It’s the perfect snack to share with friends while chatting.', 'ComChayKhoQuet.jpg', 30000, 120000, 1, 1);

-- NOODLES
INSERT INTO foods(name, description, main_image, price_min, price_max, food_category_id, status) VALUES
('Pho', 'Pho in Cần Thơ has a hot, sweet, and aromatic broth that smells of cinnamon and star anise. The rice noodles are silky and smooth, topped with very tender slices of beef. You can add fresh basil and a squeeze of lime to make it even more refreshing. It is a classic Vietnamese dish that feels nourishing and very comfortable. Every spoonful of the warm soup makes you feel relaxed and happy.', 'Pho.jpg', 35000, 60000, 2, 1),

('Bun Tom Kho', 'This noodle soup has a very clear and light broth made from dried shrimp. It has a natural, gentle sweetness that feels very healthy and easy to eat. The dried shrimp add a chewy texture and a deep sea-salt flavor to the bowl. Served with fresh herbs and tofu, it is a simple but comforting meal. It’s the perfect choice for a light breakfast or a quick lunch.', 'BunTomKho.jpg', 20000, 30000, 2, 1),

('Hu Tieu Kho Sa Dec', 'This dish uses special noodles that are very thick, clear, and chewy. Instead of soup, the noodles are mixed with a glossy, savory sauce that is a bit sweet. It is topped with crispy fried shallots, pork, and fresh bean sprouts for extra crunch. A small bowl of hot broth is served on the side to sip. It is a flavorful and interesting way to enjoy traditional rice noodles.', 'HuTieuKhoSaDec.jpg', 20000, 40000, 2, 1);

-- HOTPOT
INSERT INTO foods(name, description, main_image, price_min, price_max, food_category_id, status) VALUES
('Lau Mam', 'Lau Mam is the most famous hotpot in Cần Thơ with a very bold and strong aroma. The broth is salty and rich, cooked with fermented fish and many kinds of fresh seafood. What makes it special is the huge plate of wild river vegetables and flowers. It is a rustic, flavorful feast that tastes like the soul of the countryside. It’s an adventurous and unforgettable experience for your taste buds.', 'LauMam.jpg', 100000, 250000, 3, 1),

('Lau Vit Nau Chao', 'This hotpot features tender duck meat cooked in a creamy, salty fermented tofu sauce. The broth is thick, fatty, and smells wonderful with a hint of ginger. You will love the soft, buttery taro roots that melt in your mouth as you eat. It is a warm, rich, and very filling meal, best enjoyed with thin noodles. It feels like a cozy dinner that brings people together.', 'LauVitNauChao.jpg', 120000, 300000, 3, 1),

('Lau Ban', 'Lau Ban is a unique hotpot with a gentle and refreshing sour taste from the "Bần" fruit. This natural sourness makes the fresh river fish taste even sweeter and more delicious. It is a very light soup that is perfect for a hot day in the Mekong Delta. The mix of wild flowers and herbs adds a lovely crunch to every bite. It feels very rustic, clean, and healthy.', 'LauBan.jpg', 50000, 200000, 3, 1),

('Lau Cu Lao', 'This is a traditional hotpot served in an old-style pot with a burning coal chimney. The soup is very clear and has a gentle, natural sweetness from pork bones and vegetables. It is filled with simple ingredients like fish cakes, shrimp, and meat. The flavor is not too strong, making it very easy and pleasant to eat. It feels like a nostalgic meal from a traditional Vietnamese family party.', 'LauCuLao.jpg', 100000, 200000, 3, 1),

('Lau Ca Linh Bong Dien Dien', 'This hotpot is a special treat that features tiny, sweet fish and bright yellow flowers. The broth is light, sour, and very fragrant, making it very refreshing to eat. The fish are so small and soft that they melt in your mouth almost instantly. The yellow flowers add a unique, slightly bitter, and crunchy texture to the soup. It is a beautiful and delicate dish that represents the flooding season.', 'LauCaLinh.jpg', 110000, 250000, 3, 1),

('Ca Loc Nuong', 'A whole fish is grilled over charcoal until the skin is smoky and charred. Inside, the fish meat is incredibly white, moist, and naturally sweet. You wrap the soft fish in rice paper with lots of herbs and dip it into tangy tamarind sauce. The smoky smell and the fresh vegetables create a wonderful rustic experience. It is a true taste of river life in Southern Vietnam.', 'CaLocNuong.jpg', 100000, 300000, 3, 1);


-- INSERT FOOD LOCATION
INSERT INTO food_locations (name, address) VALUES
-- Nem Nuong
('Nem Nuong Hai Van', '98 De Tham Street, Can Tho'),
('Nem Nuong 91', '91 De Tham Street, Ninh Kieu District, Can Tho'),
('Nem nuong Cai Rang', 'Area 3, 3/2 Street, Can Tho'),
-- Banh Xeo
('Banh Xeo Bay Toi', '45 Hoang Quoc Viet Street, Can Tho'),
('Banh Xeo Ngoc Ngan', '74 Le Loi Street, Cai Khe Ward, Can Tho'),
('Banh Xeo Muoi Xiem', '13/3 Nguyen Chi Thanh Street, Can Tho'),
-- Banh Cong
('Banh Cong Co Ut', '86/38 Ly Tu Trong Street, Can Tho'),
('Banh Cong 292', '292 30/4 Street, Can Tho'),
('Banh Cong Tran Phu', '134/1A Tran Phu Street, Can Tho'),
-- Banh Tam Bi
('Banh Tam Tan Trao', '9 Tan Trao Street, Can Tho'),
-- Pizza Hu Tieu
('Pizza Hu Tieu Que Toi', '2 Yen Ha Road, Le Binh Ward, Cai Rang District, Can Tho'),
('Pizza Hu Tieu Sau Hoai', '476 Lo Vong Cung Street, An Binh Ward, Ninh Kieu District'),
('Lo Hu Tieu Chin Cua', '74C/14A Area 7, An Binh Ward, Ninh Kieu District'),
-- Banh Tet La Cam
('Banh Tet Huynh Thi Trong', '56 Thai Thi Nhan Street, Can Tho'),
('Banh Tet Tu Dep', '102 Hai Ba Trung Street, Ninh Kieu District, Can Tho'),
-- Com Chay Kho Quet
('Com Chay Kho Quet Di Ba', '43 Mac Thien Tich Street, Ninh Kieu District, Can Tho'),
('Com Chay Kho Quet Tran Phu', 'Lot 15, Tran Phu Night Market, Can Tho'),
('Com Chay Kho Quet Happy', 'Ngo Van So Street, Can Tho'),
-- Pho
('Pho Nga', '103 Nguyen Viet Hong Street, An Lac Ward, Ninh Kieu District'),
('Pho Vien', '195 Nguyen Trai Street, An Hoi Ward, Ninh Kieu District'),
('Pho Danh', '7 Xo Viet Nghe Tinh Street, Tan An Ward, Ninh Kieu District, Can Tho'),
-- Bun Tom Kho
('Bun tom kho cau Cai Rang', 'Nguyen Trai Street, Le Binh Ward, Cai Rang District, Can Tho'),
('Bun Tom Kho Can Tho', '150 Xo Viet Nghe Tinh Street, An Hoi Ward, Ninh Kieu District, Can Tho'),
-- Hu Tieu Kho Sa Dec
('Hu Tieu Kho Sa Dec', '91/54/15 Cach Mang Thang 8 Street, An Thoi Ward, Binh Thuy District'),
('Hu Tieu Beo Xua', '224 Dong Van Cong Street, An Thoi Ward, Binh Thuy District'),
-- Lau Mam
('Lau Mam Tran Ngoc Que', '162/18 Tran Ngoc Que Street, Can Tho'),
('Lau Mam Tran Viet Chau', '75 Tran Viet Chau Street, Can Tho'),
-- Lau Vit Nau Chao
('Vit Nau Chao Thanh Giao', 'Alley 1, 1/8 Ly Tu Trong Street, Can Tho'),
('Vit Nau Chao Kim Lien', 'Alley 1 Ly Tu Trong Street, Can Tho'),
('Vit Nau Chao Co Minh', 'Alley 1/1C Ly Tu Trong Street, Can Tho'),
-- Lau Ban
('Song Phu Sa Tourist Area', 'Lot 1, Hung Phu 1 Residential Area, Hung Phu Ward, Cai Rang District, Can Tho'),
-- Lau Cu Lao
('Nha Que Restaurant', 'Tran Binh Trong Street, An Phu Ward, Ninh Kieu District, Can Tho'),
-- Lau Ca Linh Bong Dien Dien
('Lau Mam Ma Nam', '98 Huynh Cuong Street, Ninh Kieu District, Can Tho'),
-- Ca Loc Nuong
('Man Restaurant', '184 Huynh Cuong Street, Can Tho'),
('Dong Xanh', '211 Nguyen Van Linh Street, Can Tho'),
('Quan An', '15–19–21 Tran Van Hoai Street, Ninh Kieu District, Can Tho');

-- INSERT FOOD AT LOCATION
INSERT INTO food_at_location (food_id, food_location_id) VALUES
-- Nem Nuong (food_id 1) -> locations 1, 2, 3
(1, 1), (1, 2), (1, 3),

-- Banh Xeo (food_id 2) -> locations 4, 5, 6
(2, 4), (2, 5), (2, 6),

-- Banh Cong (food_id 3) -> locations 7, 8, 9
(3, 7), (3, 8), (3, 9),

-- Banh Tam Bi (food_id 4) -> location 10
(4, 10),

-- Pizza Hu Tieu (food_id 5) -> locations 11, 12, 13
(5, 11), (5, 12), (5, 13),

-- Banh Tet La Cam (food_id 6) -> locations 14, 15
(6, 14), (6, 15),

-- Com Chay Kho Quet (food_id 7) -> locations 16, 17, 18
(7, 16), (7, 17), (7, 18),

-- Pho (food_id 8) -> locations 19, 20, 21
(8, 19), (8, 20), (8, 21),

-- Bun Tom Kho (food_id 9) -> locations 22, 23
(9, 22), (9, 23),

-- Hu Tieu Kho Sa Dec (food_id 10) -> locations 24, 25
(10, 24), (10, 25),

-- Lau Mam (food_id 11) -> locations 26, 27
(11, 26), (11, 27),

-- Lau Vit Nau Chao (food_id 12) -> locations 28, 29, 30
(12, 28), (12, 29), (12, 30),

-- Lau Ban (food_id 13) -> location 31
(13, 31),

-- Lau Cu Lao (food_id 14) -> location 32
(14, 32),

-- Lau Ca Linh Bong Dien Dien (food_id 15) -> location 33
(15, 33),

-- Ca Loc Nuong (food_id 16) -> locations 34, 35, 36
(16, 34), (16, 35), (16, 36);


-- INSERT FOOD IMAGES
INSERT INTO food_image(food_id, image) VALUES

-- 1. Nem Nuong
(1, 'NemNuong1.jpg'),
(1, 'NemNuong2.jpg'),

-- 2. Banh Xeo
(2, 'BanhXeo1.jpg'),
(2, 'BanhXeo2.jpg'),

-- 3. Banh Cong
(3, 'BanhCong1.jpg'),
(3, 'BanhCong2.jpg'),

-- 4. Banh Tam Bi
(4, 'BanhTamBi1.jpg'),
(4, 'BanhTamBi2.jpg'),

-- 5. Pizza Hu Tieu
(5, 'PizzaHuTieu1.jpg'),
(5, 'PizzaHuTieu2.jpg'),

-- 6. Banh Tet La Cam
(6, 'BanhTetLaCam1.jpg'),
(6, 'BanhTetLaCam2.jpg'),

-- 7. Com Chay Kho Quet
(7, 'ComChayKhoQuet1.jpg'),
(7, 'ComChayKhoQuet2.jpg'),

-- 8. Pho
(8, 'Pho1.jpg'),
(8, 'Pho2.jpg'),

-- 9. Bun Tom Kho
(9, 'BunTomKho1.jpg'),
(9, 'BunTomKho2.jpg'),

-- 10. Hu Tieu Kho Sa Dec
(10, 'HuTieuKhoSaDec1.jpg'),
(10, 'HuTieuKhoSaDec2.jpg'),

-- 11. Lau Mam
(11, 'LauMam1.jpg'),
(11, 'LauMam2.jpg'),

-- 12. Lau Vit Nau Chao
(12, 'LauVitNauChao1.jpg'),
(12, 'LauVitNauChao2.jpg'),

-- 13. Lau Ban
(13, 'LauBan1.jpg'),
(13, 'LauBan2.jpg'),

-- 14. Lau Cu Lao
(14, 'LauCuLao1.jpg'),
(14, 'LauCuLao2.jpg'),

-- 15. Lau Ca Linh Bong Dien Dien
(15, 'LauCaLinh1.jpg'),
(15, 'LauCaLinh2.jpg'),

-- 16. Ca Loc Nuong
(16, 'CaLocNuong1.jpg'),
(16, 'CaLocNuong2.jpg');
