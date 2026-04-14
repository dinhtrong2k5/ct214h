<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discover Can Tho</title>

    <link rel="stylesheet" href="../css/Home/style.css">

    <!-- Noto Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>

    <?php include "../Header/header.php"; ?>

    <!-- SLIDER -->
    <section class="slider">
        <div class="slides">
            <img src="../images/Home/ben_ninh_kieu.jpg" class="slide active" alt="">
            <img src="../images/Home/cho_noi.jpg" class="slide" alt="">
            <img src="../images/Home/song_nuoc.jpg" class="slide" alt="">
            <img src="../images/Home/caucantho.jpg" class="slide" alt="">

        </div>

        <div class="slider-text">
            <span>DISCOVER</span>
            <span>CAN THO</span>
        </div>

        <button class="prev" onclick="prevSlide()">❮</button>
        <button class="next" onclick="nextSlide()">❯</button>
    </section>

    <!-- INTRO -->
    <section class="intro">
        <div class="intro-content">
            <h1>DISCOVER CAN THO</h1>
            <h2>BOUNDLESS ADVENTURES</h2>

            <p>
                Nestled in the lower reaches of the Mekong River, Can Tho lies at the very heart of the Mekong Delta.
                It shares its borders with An Giang to the North, Dong Thap and Vinh Long to the East,
                Kien Giang to the West, and Hau Giang to the South.
            </p>

            <p>
                Boasting an interlacing river system, sprawling tropical fruit orchards, and endless horizons of rice fields,
                this land is proudly dubbed "Tay Do" - the capital of the Mekong Delta.
                A journey to Can Tho offers more than just breathtaking natural scenery;
                it is an invitation to immerse yourself in the vibrant and generous lifestyle of the river-region people.
            </p>
        </div>
    </section>
    <!-- Destination -->
    <section class="featured-section">
        <div class="featured-header">
            <div class="line"></div>
            <h1>FAMOUS TOURIST ATTRACTIONS</h1>
            <div class="line"></div>
        </div>
        <p class="featured-desc">
            Uncover the hidden gems and iconic landmarks of Can Tho. From bustling floating markets to serene ancient houses, every corner tells a unique story.
        </p>
    </section>

    <section class="discovery-section">
        <div class="filter-tabs">
            <button class="tab-btn active" onclick="openTab(event, 'popular')">Popular</button>
            <button class="tab-btn" onclick="openTab(event, 'recommended')">Recommended</button>
            <button class="tab-btn" onclick="openTab(event, 'must-visit')">Must-visit</button>
        </div>

        <div class="tab-container">
            <div id="popular" class="tab-content" style="display: flex;">
                <div class="place-card">
                    <div class="image-box">
                        <img src="../images/Home/cho_noi.jpg" alt="Cai Rang">
                        <div class="../image-title">Cai Rang Market</div>
                    </div>
                    <div class="place-desc">
                        <p>The largest and most lively floating market in the Mekong Delta region.</p>
                        <a href="destination.php" class="view-details">View more</a>
                    </div>
                </div>
                <div class="place-card">
                    <div class="image-box">
                        <img src="../images/Home/ninh_kieu_quay.jpg" alt="Ninh Kieu">
                        <div class="image-title">Ninh Kieu Wharf</div>
                    </div>
                    <div class="place-desc">
                        <p>A beautiful riverfront area famous for its night market and park.</p>
                        <a href="destination.php" class="view-details">View more</a>
                    </div>
                </div>
                <div class="place-card">
                    <div class="image-box">
                        <img src="../images/Home/binh_thuy_ancient_house.jpg" alt="Binh Thuy">
                        <div class="image-title">Binh Thuy House</div>
                    </div>
                    <div class="place-desc">
                        <p>A masterpiece of French-Vietnamese architectural fusion built in 1870.</p>
                        <a href="destination.php" class="view-details">View more</a>
                    </div>
                </div>
            </div>

            <div id="recommended" class="tab-content" style="display: none;">
                <div class="place-card">
                    <div class="image-box">
                        <img src="../images/Home/con_son.jpg" alt="Con Son">
                        <div class="image-title">Con Son Islet</div>
                    </div>
                    <div class="place-desc">
                        <p>A peaceful islet offering fruit orchards, local food, and cultural experiences.</p>
                        <a href="destination.php" class="view-details">View more</a>
                    </div>
                </div>
                <div class="place-card">
                    <div class="image-box">
                        <img src="../images/Home/my_khanh.png" alt="My Khanh">
                        <div class="image-title">My Khanh Tourist Village</div>
                    </div>
                    <div class="place-desc">
                        <p>A popular eco-tourism spot with gardens, local food, and traditional games.</p>
                        <a href="destination.php" class="view-details">View more</a>
                    </div>
                </div>
                <div class="place-card">
                    <div class="image-box">
                        <img src="../images/Home/can_tho_museum.jpg" alt="Museum">
                        <div class="image-title">Can Tho Museum</div>
                    </div>
                    <div class="place-desc">
                        <p>Can Tho Museum showcases the history, culture, and heritage of the Mekong Delta.</p>
                        <a href="destination.php" class="view-details">View more</a>
                    </div>
                </div>
            </div>

            <div id="must-visit" class="tab-content" style="display: none;">
                <div class="place-card">
                    <div class="image-box">
                        <img src="../images/Home/TVTL.jpg" alt="Thien Vien Truc Lam">
                        <div class="image-title">Trúc Lâm Phương Nam Zen Monastery</div>
                    </div>
                    <div class="place-desc">
                        <p>A peaceful Buddhist temple with beautiful architecture and serene gardens.</p>
                        <a href="destination.php" class="view-details">View more</a>
                    </div>
                </div>
                <div class="place-card">
                    <div class="image-box">
                        <img src="../images/Home/vuon_co.jpg" alt="Bang Lang">
                        <div class="image-title">Bang Lang Stork Sanctuary</div>
                    </div>
                    <div class="place-desc">
                        <p>A sanctuary for white storks, ideal for nature lovers and wildlife photography.</p>
                        <a href="destination.php" class="view-details">View more</a>
                    </div>
                </div>
                <div class="place-card">
                    <div class="image-box">
                        <img src="../images/Home/ong_temple.jpg" alt="Chua ong">
                        <div class="image-title">Ong Temple (Chua Ong)</div>
                    </div>
                    <div class="place-desc">
                        <p>Ong Temple is an ancient temple with Chinese-style architecture in the city center.</p>
                        <a href="destination.php" class="view-details">View more</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="cuisine-section">
        <div class="featured-header">
            <div class="line"></div>
            <h1>LOCAL CUISINE</h1>
            <div class="line"></div>
        </div>

        <p class="featured-desc">
            Explore the rich and diverse flavors of Can Tho's traditional dishes, a true culinary journey in the heart of the Mekong Delta.
        </p>

        <div class="cuisine-grid">

            <div class="place-card food-card">
                <div class="image-box">
                    <img src="../images/Home/banh_xeo.jpg" alt="Bánh Xèo">
                    <div class="image-title">Banh Xeo</div>
                </div>
                <div class="place-desc">
                    <p>Crispy crepe filled with shrimp, pork, and bean sprouts, served with fresh herbs.</p>
                    <a href="../Food/food.php?food_id=2" class="view-details">View More</a>
                </div>
            </div>

            <div class="place-card food-card">
                <div class="image-box">
                    <img src="../images/Home/bun_rieu.jpg" alt="Bún Tôm Khô">
                    <div class="image-title">Bun Tom Kho</div>
                </div>
                <div class="place-desc">
                    <p>A flavorful soup with freshwater crab meat, tomatoes, tofu, and pork.</p>
                    <a href="../Food/food.php?food_id=9" class="view-details">View More</a>
                </div>
            </div>

            <div class="place-card food-card">
                <div class="image-box">
                    <img src="../images/Home/lau_mam.jpg" alt="Lẩu Mắm">
                    <div class="image-title">Lau Mam</div>
                </div>
                <div class="place-desc">
                    <p>A rich Hotpot made from fermented fish broth, served with diverse vegetables.</p>
                    <a href="../Food/food.php?food_id=11" class="view-details">View More</a>
                </div>
            </div>

            <div class="place-card food-card">
                <div class="image-box">
                    <img src="../images/Home/chuoi_nep_nuong.jpeg" alt="Chuối Nếp Nướng">
                    <div class="image-title">Chuoi Nep Nuong</div>
                </div>
                <div class="place-desc">
                    <p>Sweet bananas wrapped in sticky rice, grilled until golden and served with coconut milk.</p>
                    <a href="../Food/food.php?food_id=4" class="view-details">View More</a>
                </div>
            </div>

            <div class="place-card food-card">
                <div class="image-box">
                    <img src="../images/Home/nem_nuong.jpg" alt="Nem Nướng">
                    <div class="image-title">Nem Nuong Cai Rang</div>
                </div>
                <div class="place-desc">
                    <p>Grilled pork patties served with rice paper, fresh herbs, and a special dipping sauce.</p>
                    <a href="../Food/food.php?food_id=1" class="view-details">View More</a>
                </div>
            </div>

            <div class="place-card food-card">
                <div class="image-box">
                    <img src="../images/Home/banh_cong.jpg" alt="Bánh Cống">
                    <div class="image-title">Banh Cong</div>
                </div>
                <div class="place-desc">
                    <p>A crispy fried cake made from rice flour, green beans, shrimp, and minced pork.</p>
                    <a href="../Food/food.php?food_id=3" class="view-details">View More</a>
                </div>
            </div>

        </div>
    </section>
    </section>


    <!-- Festival -->
    <section class="festival-section">
        <div class="featured-header">
            <div class="line"></div>
            <h1>ANNUAL FESTIVALS</h1>
            <div class="line"></div>
        </div>
        <p class="featured-desc">Experience the unique cultural heritage and vibrant traditional celebrations of Tay Do land.</p>

        <div class="festival-slider-container">
            <button class="slider-btn prev-btn" onclick="moveFestival(-1)">❮</button>

            <div class="festival-viewport">
                <div class="festival-track" id="festivalTrack">
                    <div class="place-card festival-card">
                        <div class="image-box">
                            <img src="../images/Home/tet.jpg" alt="">
                            <div class="event-date">Jan - Feb</div>
                            <div class="image-title">Tet Festival</div>
                        </div>
                        <div class="place-desc">
                            <p>The biggest traditional celebration with flower markets and fireworks along Ninh Kieu Wharf.</p>
                            <a href="../Culture/Culture.php?id=24;" class="view-details">View More</a>
                        </div>
                    </div>
                    <div class="place-card festival-card">
                        <div class="image-box">
                            <img src="../images/Home/ky_yen.jpg" alt="">
                            <div class="event-date">April</div>
                            <div class="image-title">Ky Yen Binh Thuy</div>
                        </div>
                        <div class="place-desc">
                            <p>A unique ritual at Binh Thuy Ancient Temple to pray for peace and prosperity.</p>
                            <a href="../Culture/Culture.php?id=1" class="view-details">View More</a>
                        </div>
                    </div>
                    <div class="place-card festival-card">
                        <div class="image-box">
                            <img src="../images/Home/chol_chnam.jpg" alt="">
                            <div class="event-date">Mid-April</div>
                            <div class="image-title">Chol Chnam Thmay</div>
                        </div>
                        <div class="place-desc">
                            <p>Khmer New Year festival with vibrant traditional dances and spiritual rituals.</p>
                            <a href="../Culture/Culture.php?id=4" class="view-details">View More</a>
                        </div>
                    </div>
                    <div class="place-card festival-card">
                        <div class="image-box">
                            <img src="../images/Home/banh_nhan_gian.jpg" alt="">
                            <div class="event-date">May</div>
                            <div class="image-title">Southern Cake Festival</div>
                        </div>
                        <div class="place-desc">
                            <p>Showcasing hundreds of traditional folk cakes from the Southern region of Vietnam.</p>
                            <a href="../Culture/Culture.php?id=2" class="view-details">View More</a>
                        </div>
                    </div>
                    <div class="place-card festival-card">
                        <div class="image-box">
                            <img src="../images/Home/vu_lan.jpg" alt="">
                            <div class="event-date">August</div>
                            <div class="image-title">Vu Lan Festival</div>
                        </div>
                        <div class="place-desc">
                            <p>A significant Buddhist celebration dedicated to parents and ancestors at local pagodas.</p>
                            <a href="../Culture/Culture.php?id=25" class="view-details">View More</a>
                        </div>
                    </div>
                    <div class="place-card festival-card">
                        <div class="image-box">
                            <img src="../images/Home/hoa_dang.jpg" alt="">
                            <div class="event-date">December</div>
                            <div class="image-title">Can Tho Flower Festival</div>
                        </div>
                        <div class="place-desc">
                            <p>End of year celebration with thousands of blooming flowers across the city center.</p>
                            <a href="../Culture/Culture.php?id=6" class="view-details">View More</a>
                        </div>
                    </div>
                </div>
            </div>

            <button class="slider-btn next-btn" onclick="moveFestival(1)">❯</button>
        </div>
    </section>
    <div id="foodModal" class="modal" style="display:none; position:fixed; z-index:9999; left:0; top:0; width:100%; height:100%; background:rgba(0,0,0,0.8);">
        <div class="modal-content" style="background:#fff; margin:2% auto; width:90%; max-width:1100px; position:relative; border-radius:15px; padding:20px;">
            <span class="close-btn" onclick="closeModal()" style="position:absolute; right:20px; top:10px; font-size:40px; cursor:pointer;">&times;</span>
            <div id="modal-body"></div>
        </div>
    </div>

    <?php include "../Footer/footer.php"; ?>

    <script src="../js/homepage.js"></script>
</body>

</html>