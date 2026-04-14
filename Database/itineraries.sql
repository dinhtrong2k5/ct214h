
-- TẠO CẤU TRÚC BẢNG
CREATE TABLE tour_categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    menu_name VARCHAR(50) NOT NULL,      
    slug VARCHAR(50) NOT NULL,           
    section_title VARCHAR(100) NOT NULL, 
    section_desc TEXT NOT NULL           
);

CREATE TABLE tours (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT NOT NULL,            
    image_url VARCHAR(255) NOT NULL,     
    alt_text VARCHAR(50),                
    tour_name VARCHAR(100) NOT NULL,     
    FOREIGN KEY (category_id) REFERENCES tour_categories(id) ON DELETE CASCADE
);

CREATE TABLE tour_itineraries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tour_id INT NOT NULL,            
    day_number INT NOT NULL,   
    day_label VARCHAR(100) NOT NULL, 
    time_str VARCHAR(20) NOT NULL,   
    title VARCHAR(150) NOT NULL,     
    description TEXT NOT NULL,       
    activity_image VARCHAR(255),     
    icon_type VARCHAR(50),           
    sort_order INT DEFAULT 0,        
    FOREIGN KEY (tour_id) REFERENCES tours(id) ON DELETE CASCADE
);

-- CHÈN DỮ LIỆU DANH MỤC
INSERT INTO tour_categories (id, menu_name, slug, section_title, section_desc) VALUES
(1, '1 DAY TOUR', '1-day', '1 DAY ITINERARIES', 'Explore the beauty of Can Tho in a single day with our curated tours.'),
(2, '1 DAY 1 NIGHT', '1-day-1-night', '1 DAY 1 NIGHT ITINERARIES', 'Choose a theme that fits your travel style to view detailed sample tours.'),
(3, '2 DAYS 1 NIGHT', '2-day-1-night', '2 DAYS 1 NIGHT ITINERARIES', 'Immerse yourself deeper into the Mekong Delta lifestyle.'),
(4, '3 DAYS 2 NIGHTS', '3-day-2-nights', '3 DAYS 2 NIGHTS ITINERARIES', 'The ultimate journey to experience the best of Can Tho and beyond.');

-- CHÈN DỮ LIỆU TOURS (Đã sửa chuẩn đường dẫn asset/images/itinerary/)
INSERT INTO tours (category_id, image_url, alt_text, tour_name) VALUES
-- 1 DAY TOUR 
(1, 'images/itinerary/heritage_tour.jpg', 'Heritage', 'Heritage Tour'),
(1, 'images/itinerary/food_tour.jpg', 'Food', 'Food Tour'),
(1, 'images/itinerary/leisure_day.jpg', 'Leisure', 'Leisure Day'),
(1, 'images/itinerary/taste_of_culture.jpg', 'Culture', 'Taste of Culture'),

-- 1 DAY 1 NIGHT 
(2, 'images/itinerary/chill_taste.jpg', 'Chill', 'Chill & Taste'),
(2, 'images/itinerary/eco_river.jpg', 'Eco', 'Eco River Life'),
(2, 'images/itinerary/nature_glamping.jpg', 'Glamping', 'Nature Glamping'),
(2, 'images/itinerary/zen_getaway.jpg', 'Zen', 'Zen Getaway'),

-- 2 DAYS 1 NIGHT 
(3, 'images/itinerary/wild_camping.jpg', 'Camping', 'Wild Camping'),
(3, 'images/itinerary/river_orchard.jpg', 'Orchard', 'River & Orchard'),
(3, 'images/itinerary/historic_eco.jpg', 'Historic', 'Historic Eco'),
(3, 'images/itinerary/fun_food.jpg', 'Food', 'Fun & Food'),
(3, 'images/itinerary/culture_relax.jpg', 'Culture', 'Culture & Relax'),

-- 3 DAYS 2 NIGHTS 
(4, 'images/itinerary/soul_heritage.jpg', 'Soul', 'Soul & Heritage'),
(4, 'images/itinerary/mekong_explorer.jpg', 'Mekong', 'Mekong Explorer'),
(4, 'images/itinerary/premium_escape.jpg', 'Premium', 'Premium Escape'),
(4, 'images/itinerary/eco_adventure.jpg', 'Adventure', 'Eco Adventure');
-- ==========================================
-- DỮ LIỆU CHO CÁC TOUR 1 NGÀY (DAY 1)
-- ==========================================
INSERT INTO tour_itineraries (tour_id, day_number, day_label, time_str, title, description, activity_image, icon_type, sort_order) VALUES
(1, 1, 'DAY 1', '08:00 AM', 'Binh Thuy Ancient House', 'Visit the historic Binh Thuy Ancient House, famous for its unique blend of French and Vietnamese architecture.', 'asset/images/itinerary/binhthuy.jpg', 'sun', 1),
(1, 1, 'DAY 1', '11:00 AM', 'Can Tho Museum', 'Explore the history and culture of the Mekong Delta through fascinating exhibits and artifacts.', 'asset/images/itinerary/museum.jpg', 'sun', 2),
(1, 1, 'DAY 1', '12:30 PM', 'Local Lunch', 'Enjoy a traditional lunch with signature dishes like Braised Snakehead Fish and Sour Soup.', 'asset/images/itinerary/local_lunch.jpg', 'afternoon', 3),
(1, 1, 'DAY 1', '03:00 PM', 'Ong Pagoda', 'Discover the vibrant colors and intricate designs of this centuries-old Chinese temple.', 'asset/images/itinerary/ong_pagoda.jpg', 'afternoon', 4),

(2, 1, 'DAY 1', '07:00 AM', 'Breakfast at Cai Rang', 'Start your day with a hot bowl of rice noodle soup directly from a floating boat.', 'asset/images/itinerary/cairang_food.jpg', 'sunrise', 1),
(2, 1, 'DAY 1', '10:30 AM', 'Traditional Cake Village', 'Watch locals make traditional cakes and taste the famous Banh Tet La Cam.', 'asset/images/itinerary/banhtet.jpg', 'sun', 2),
(2, 1, 'DAY 1', '01:00 PM', 'Banh Xeo Feast', 'Savor the crispy and giant Vietnamese sizzling pancake (Banh Xeo) filled with shrimp and pork.', 'asset/images/itinerary/banhxeo.jpg', 'afternoon', 3),
(2, 1, 'DAY 1', '04:00 PM', 'Cocoa Farm Visit', 'Visit Muoi Cuong Cocoa Farm, learn the chocolate-making process, and enjoy a fresh cocoa drink.', 'asset/images/itinerary/cocoa.jpg', 'afternoon', 4),

(3, 1, 'DAY 1', '08:30 AM', 'Boat to Con Son Islet', 'Take a relaxing boat ride to Con Son Islet, a peaceful eco-tourism community.', 'asset/images/itinerary/conson_boat.jpg', 'sun', 1),
(3, 1, 'DAY 1', '10:00 AM', 'Flying Snakehead Fish', 'Witness the unique and entertaining flying snakehead fish farm.', 'asset/images/itinerary/flying_fish.jpg', 'sun', 2),
(3, 1, 'DAY 1', '12:30 PM', 'Home-cooked Meal', 'Have a leisurely lunch in a local garden, enjoying fresh vegetables and river fish.', 'asset/images/itinerary/conson_lunch.jpg', 'afternoon', 3),
(3, 1, 'DAY 1', '03:30 PM', 'Fruit Picking', 'Stroll through lush orchards, pick seasonal fruits, and relax in hammocks.', 'asset/images/itinerary/orchard.jpg', 'afternoon', 4),

(4, 1, 'DAY 1', '08:00 AM', 'Truc Lam Zen Monastery', 'Find your inner peace at the largest Zen monastery in the Mekong Delta.', 'asset/images/itinerary/truclam.jpg', 'sun', 1),
(4, 1, 'DAY 1', '10:30 AM', 'My Khanh Tourist Village', 'Experience Southern culture with traditional houses, folk games, and local music (Don Ca Tai Tu).', 'asset/images/itinerary/mykhanh.jpg', 'sun', 2),
(4, 1, 'DAY 1', '12:30 PM', 'Cultural Lunch', 'Dine in a vintage Southern house setting with authentic countryside recipes.', 'asset/images/itinerary/vintage_lunch.jpg', 'afternoon', 3),
(4, 1, 'DAY 1', '03:00 PM', 'Rice Noodle Factory', 'Visit a local family business to see how colorful rice noodles (Hu Tieu) are made.', 'asset/images/itinerary/noodle_factory.jpg', 'afternoon', 4),

(5, 1, 'DAY 1', '06:30 AM', 'Floating Market & Breakfast', 'Explore the vibrant Cai Rang Floating Market. Enjoy a hot bowl of Hu Tieu right on a boat.', 'asset/images/itinerary/hutieu.jpg', 'sunrise', 1),
(5, 1, 'DAY 1', '12:00 PM', 'Resort Check-in & Lunch', 'Arrive at a luxury riverside resort. Savor a premium Southern Vietnamese set menu for lunch.', 'asset/images/itinerary/banhxeo.jpg', 'sun', 2),
(5, 1, 'DAY 1', '03:00 PM', 'Spa & Relax', 'Unwind with a signature herbal spa treatment or chill by the infinity pool overlooking the Mekong River.', 'asset/images/itinerary/spa.jpg', 'afternoon', 3),
(5, 1, 'DAY 1', '07:00 PM', 'Dinner Cruise & Market', 'Enjoy a romantic dinner on the Can Tho River Cruise, followed by a walk around Ninh Kieu Night Market.', 'asset/images/itinerary/dinner.jpg', 'moon', 4);

-- ==========================================
-- DỮ LIỆU CHO CÁC TOUR 1 NGÀY 1 ĐÊM 
-- ==========================================
INSERT INTO tour_itineraries (tour_id, day_number, day_label, time_str, title, description, activity_image, icon_type, sort_order) VALUES
(6, 1, 'DAY 1', '02:00 PM', 'Canal Exploration', 'Paddle through narrow, green canals shaded by water coconut trees.', 'asset/images/itinerary/canal.jpg', 'afternoon', 1),
(6, 1, 'DAY 1', '06:00 PM', 'Homestay Check-in', 'Arrive at a charming riverside homestay and meet your host family.', 'asset/images/itinerary/homestay.jpg', 'moon', 2),
(6, 1, 'DAY 1', '07:30 PM', 'Cooking & Dinner', 'Join the host in preparing dinner, then enjoy the meal while listening to river sounds.', 'asset/images/itinerary/cooking.jpg', 'moon', 3),
(6, 2, 'DAY 2', '06:00 AM', 'Sunrise Coffee', 'Wake up early for a peaceful morning coffee watching the river wake up.', 'asset/images/itinerary/morning_coffee.jpg', 'sunrise', 4),

(7, 1, 'DAY 1', '03:00 PM', 'Camp Arrival', 'Settle into your luxury glamping tent surrounded by nature.', 'asset/images/itinerary/glamping_tent.jpg', 'afternoon', 1),
(7, 1, 'DAY 1', '05:00 PM', 'Sunset SUP Boarding', 'Enjoy stand-up paddleboarding on the quiet river as the sun sets.', 'asset/images/itinerary/sup.jpg', 'afternoon', 2),
(7, 1, 'DAY 1', '07:00 PM', 'BBQ & Campfire', 'Feast on a delicious outdoor BBQ, followed by acoustic music around the campfire.', 'asset/images/itinerary/campfire.jpg', 'moon', 3),
(7, 2, 'DAY 2', '07:30 AM', 'Nature Breakfast', 'Enjoy a fresh, healthy breakfast outside your tent before checking out.', 'asset/images/itinerary/camp_breakfast.jpg', 'sunrise', 4),

(8, 1, 'DAY 1', '02:00 PM', 'Retreat Check-in', 'Arrive at a secluded eco-retreat designed for ultimate relaxation.', 'asset/images/itinerary/retreat.jpg', 'afternoon', 1),
(8, 1, 'DAY 1', '04:00 PM', 'Meditation Session', 'Join a guided mindfulness meditation session in the garden.', 'asset/images/itinerary/meditation.jpg', 'afternoon', 2),
(8, 1, 'DAY 1', '06:30 PM', 'Plant-based Dinner', 'Nourish your body with a gourmet, organic plant-based dinner.', 'asset/images/itinerary/vegan_dinner.jpg', 'moon', 3),
(8, 2, 'DAY 2', '06:30 AM', 'Morning Yoga', 'Start your day with a rejuvenating yoga session overlooking the lotus pond.', 'asset/images/itinerary/yoga.jpg', 'sunrise', 4);

-- ==========================================
-- DỮ LIỆU CHO CÁC TOUR 2 NGÀY 1 ĐÊM 
-- ==========================================
INSERT INTO tour_itineraries (tour_id, day_number, day_label, time_str, title, description, activity_image, icon_type, sort_order) VALUES
(9, 1, 'DAY 1', '01:00 PM', 'Jungle Trekking', 'Hike through a small local forest reserve to reach the wild campsite.', 'asset/images/itinerary/trekking.jpg', 'afternoon', 1),
(9, 1, 'DAY 1', '05:00 PM', 'Set up Camp', 'Learn how to pitch a tent and start a fire using basic survival skills.', 'asset/images/itinerary/setup_camp.jpg', 'afternoon', 2),
(9, 1, 'DAY 1', '07:30 PM', 'Survival Dinner', 'Cook dinner over the open fire and enjoy stargazing.', 'asset/images/itinerary/wild_dinner.jpg', 'moon', 3),
(9, 2, 'DAY 2', '08:00 AM', 'Pack up & Return', 'Have a quick coffee, pack up leaving no trace, and trek back to the city.', 'asset/images/itinerary/packup.jpg', 'sun', 4),

(10, 1, 'DAY 1', '09:00 AM', 'Phong Dien Market', 'Visit the lesser-known but incredibly authentic Phong Dien floating market.', 'asset/images/itinerary/phongdien.jpg', 'sun', 1),
(10, 1, 'DAY 1', '02:00 PM', 'Cycling the Village', 'Rent a bicycle and ride along the concrete paths connecting fruit orchards.', 'asset/images/itinerary/cycling.jpg', 'afternoon', 2),
(10, 1, 'DAY 1', '06:00 PM', 'Bungalow Stay', 'Check into a cozy wooden bungalow right above a fish pond.', 'asset/images/itinerary/bungalow.jpg', 'moon', 3),
(10, 2, 'DAY 2', '09:00 AM', 'Fruit Harvesting', 'Join the farmers in harvesting seasonal fruits like rambutan or mango.', 'asset/images/itinerary/harvest.jpg', 'sun', 4),

(11, 1, 'DAY 1', '09:00 AM', 'Museum & Temples', 'Explore Can Tho\'s rich history in the morning.', 'asset/images/itinerary/history.jpg', 'sun', 1),
(11, 1, 'DAY 1', '02:00 PM', 'Eco Farm Tour', 'Learn about sustainable agriculture at a local eco-farm.', 'asset/images/itinerary/ecofarm.jpg', 'afternoon', 2),
(11, 2, 'DAY 2', '08:00 AM', 'Traditional Crafts', 'Participate in a workshop making bamboo baskets with local artisans.', 'asset/images/itinerary/bamboo.jpg', 'sun', 3),

(12, 1, 'DAY 1', '10:00 AM', 'Street Food Safari', 'Taste the best street food Can Tho has to offer in the bustling local markets.', 'asset/images/itinerary/streetfood.jpg', 'sun', 1),
(12, 1, 'DAY 1', '03:00 PM', 'Mud Catching Fish', 'Get dirty and have fun catching fish by hand in a traditional mud pond.', 'asset/images/itinerary/mudfish.jpg', 'afternoon', 2),
(12, 2, 'DAY 2', '09:00 AM', 'Cooking Class', 'Learn to cook the fish you caught yesterday with local countryside chefs.', 'asset/images/itinerary/cookingclass.jpg', 'sun', 3),

(13, 1, 'DAY 1', '10:00 AM', 'Don Ca Tai Tu Music', 'Enjoy recognized intangible cultural heritage music in a fruit garden.', 'asset/images/itinerary/music.jpg', 'sun', 1),
(13, 1, 'DAY 1', '04:00 PM', 'Sunset Cruise', 'A relaxing cruise on the Hau river with tropical cocktails and fresh fruits.', 'asset/images/itinerary/cruise.jpg', 'afternoon', 2),
(13, 2, 'DAY 2', '09:00 AM', 'Spa Morning', 'A full morning dedicated to traditional herbal spa treatments.', 'asset/images/itinerary/spa_morning.jpg', 'sun', 3);

-- ==========================================
-- DỮ LIỆU CHO CÁC TOUR 3 NGÀY 2 ĐÊM 
-- ==========================================
INSERT INTO tour_itineraries (tour_id, day_number, day_label, time_str, title, description, activity_image, icon_type, sort_order) VALUES
(14, 1, 'DAY 1', '02:00 PM', 'Hotel Check-in & Rest', 'Arrive in Can Tho, check into a heritage-style hotel and rest.', 'asset/images/itinerary/hotel_checkin.jpg', 'afternoon', 1),
(14, 1, 'DAY 1', '04:00 PM', 'Can Tho City Tour', 'Explore the main historical sights of Can Tho including the old market and riverside.', 'asset/images/itinerary/citytour.jpg', 'afternoon', 2),
(14, 2, 'DAY 2', '06:00 AM', 'Cai Rang Floating Market', 'Wake up early to experience the vibrant river culture at the famous floating market.', 'asset/images/itinerary/villages.jpg', 'sunrise', 3),
(14, 2, 'DAY 2', '02:00 PM', 'Traditional Craft Villages', 'Visit local artisan families making rice noodles and weaving mats.', 'asset/images/itinerary/craft_village.jpg', 'sun', 4),
(14, 3, 'DAY 3', '09:00 AM', 'Zen Monastery', 'Begin your last day with a peaceful visit to the grand Truc Lam Zen Monastery.', 'asset/images/itinerary/truclam_end.jpg', 'sun', 5),
(14, 3, 'DAY 3', '12:00 PM', 'Farewell Lunch', 'Enjoy a final Southern Vietnamese meal before heading home.', 'asset/images/itinerary/farewell_lunch.jpg', 'sun', 6),

(15, 1, 'DAY 1', '09:00 AM', 'Can Tho Highlights', 'Discover the heart of the Mekong Delta with a guided walking tour.', 'asset/images/itinerary/highlights.jpg', 'sun', 1),
(15, 1, 'DAY 1', '04:00 PM', 'Sunset Walk', 'Stroll along the Ninh Kieu Wharf as the sun sets over the Hau River.', 'asset/images/itinerary/sunset_walk.jpg', 'afternoon', 2),
(15, 2, 'DAY 2', '08:00 AM', 'Tra Su Mangrove Forest', 'Take a day trip to the stunning Tra Su cajuput forest in An Giang province.', 'asset/images/itinerary/trasu.jpg', 'sun', 3),
(15, 2, 'DAY 2', '05:00 PM', 'Chau Doc Border Visit', 'Briefly explore the multicultural border town of Chau Doc before returning.', 'asset/images/itinerary/chaudoc.jpg', 'afternoon', 4),
(15, 3, 'DAY 3', '08:00 AM', 'Local Life Experience', 'Spend the morning as a local farmer in a Can Tho fruit orchard.', 'asset/images/itinerary/farmer.jpg', 'sun', 5),
(15, 3, 'DAY 3', '01:00 PM', 'Return to City', 'Pack your bags and prepare for departure with unforgettable memories.', 'asset/images/itinerary/return.jpg', 'sun', 6),

(16, 1, 'DAY 1', '02:00 PM', 'Azerai Resort Check-in', 'Arrive at the most luxurious resort in Can Tho, located on its own private islet.', 'asset/images/itinerary/azerai.jpg', 'afternoon', 1),
(16, 1, 'DAY 1', '07:00 PM', 'Fine Dining Dinner', 'Experience a gourmet fusion dinner at the resort’s premium restaurant.', 'asset/images/itinerary/finedining.jpg', 'moon', 2),
(16, 2, 'DAY 2', '10:00 AM', 'Private Yacht Tour', 'Explore the Mekong river on a private luxury yacht with champagne and canapés.', 'asset/images/itinerary/yacht.jpg', 'sun', 3),
(16, 2, 'DAY 2', '04:00 PM', 'Spa Treatment', 'Indulge in a 90-minute signature massage at the luxury spa.', 'asset/images/itinerary/luxury_spa.jpg', 'afternoon', 4),
(16, 3, 'DAY 3', '11:00 AM', 'Farewell Brunch', 'Enjoy a premium, late-morning brunch before your private transfer departs.', 'asset/images/itinerary/brunch.jpg', 'sun', 5),

(17, 1, 'DAY 1', '09:00 AM', 'Bike the Delta', 'A 20km cycling trip through deep countryside roads and wooden bridges.', 'asset/images/itinerary/bike.jpg', 'sun', 1),
(17, 1, 'DAY 1', '03:00 PM', 'Eco Farm Stay', 'Check into a sustainable farm stay and learn about organic farming.', 'asset/images/itinerary/ecofarmstay.jpg', 'afternoon', 2),
(17, 2, 'DAY 2', '08:00 AM', 'Kayak Expedition', 'Kayak through small, untouched canals to spot local bird species and wildlife.', 'asset/images/itinerary/kayak.jpg', 'sun', 3),
(17, 2, 'DAY 2', '06:00 PM', 'Night Safari', 'Take a boat ride in the dark to observe fireflies and nocturnal river life.', 'asset/images/itinerary/nightsafari.jpg', 'moon', 4),
(17, 3, 'DAY 3', '09:00 AM', 'Tree Planting', 'Contribute to the environment by planting a tree at the eco-farm before leaving.', 'asset/images/itinerary/planting.jpg', 'sun', 5);
