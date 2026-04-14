<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discover Can Tho Footer</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="footer.js" href="Footer.js">
</head>

<body>

    <footer class="site-footer">
        <div class="footer-container">

            <div class="brand-col">
                <div class="footer-logo">
                    <img src="../images/logo.png" alt="Discover Can Tho Logo">
                </div>
                <p class="footer-desc">
                    "This website promotes tourism in Can Tho, providing information about tourist attractions, cuisine, and travel experiences in Can Tho."
                </p>
                <div class="social-icons">
                    <a href="#" class="fb"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="ig"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="yt"><i class="fab fa-youtube"></i></a>
                </div>
            </div>

            <div class="footer-right-group">
                <div class="footer-col">
                    <h4>EXPLORE</h4>
                    <ul>
                        <li><a href="#">Destinations</a></li>
                        <li><a href="#">Eat & Drink</a></li>
                        <li><a href="#">Experiences</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4>QUICK LINKS</h4>
                    <ul>
                        <li><a href="#">About us</a></li>
                        <li><a href="#">Contact us</a></li>
                    </ul>
                </div>

                <div class="contact-col">
                    <h4>CONTACT INFO</h4>
                    <ul class="contact-list">
                        <li><i class="fas fa-map-marker-alt"></i> 3/2, Xuan Khanh, Ninh Kieu, Can Tho</li>
                        <li><i class="fas fa-envelope"></i> trib2307067@student.ctu.edu.vn</li>
                        <li><i class="fas fa-phone-alt"></i> 0869178443</li>
                    </ul>

                    <h4 style="margin-top: 25px;">READY TO DISCOVER CAN THO?</h4>

                    <form class="subscribe-form" id="subscribeForm" action="#">
                        <input type="email" placeholder="Your email address" required>
                        <button type="submit">Subscribe</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© 2026 Welcome to Can Tho. All rights reserved.</p>
        </div>
    </footer>

    <div id="successModal" class="modal-overlay">
        <div class="modal-content">
            <i class="fas fa-check-circle modal-icon"></i>
            <h3>Thank You!</h3>
            <p>You have successfully subscribed to our newsletter.</p>
            <button id="closeModalBtn" class="close-btn">Close</button>
        </div>

    </div>

    <script src="../js/footer.js"></script>
</body>

</html>