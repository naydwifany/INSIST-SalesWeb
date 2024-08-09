<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grandeviera</title>

    <!--Favicon Logo Web-->
    <link rel="shortcut icon" href="./assets/icon/nm.png" type="image/x-icon"/>

    <!--CSS-->
    <link rel="stylesheet" href="./dist/CSS/homepage.css"/>

    <!--Jonsuh Hamburger-->
    <link rel="stylesheet" href="./dist/CSS/hamburgers.css"/>

    <!--Font Poppins-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>

    <!--Font Awsome CDN-->
    <link 
        rel="stylesheet" 
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" 
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" 
        crossorigin="anonymous" 
        referrerpolicy="no-referrer" 
    />

    <!--Link Swiper's CSS-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!--AOS Motion-->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>

<body id="home">
    <!--Header-->
    <header>
        <div class="container">
            <!--Navbar-->
            <div class="navbar">
                <div class="logo">
                    <h1>Grandeviera</h1>
                </div>
                <ul class="menu">
                    <h1>Grandeviera</h1>
                    <h3>Overview</h3>
                    <li>
                        <i class="fa-solid fa-house"></i>
                        <a href="g-homepage.html">Home</a>
                    </li>                    
                    <li>
                        <i class="fa-solid fa-address-card"></i>
                        <a href="g-homepage.html#about">About Us</a>
                    </li>
                    <li>
                        <i class="fa-solid fa-gear"></i>
                        <a href="g-homepage.html#services">Services</a>
                    </li>
                    <li>
                        <i class="fa-solid fa-house-circle-check"></i>
                        <a href="c-ourhouse.html">Our House</a>
                    </li>
                    <li>
                        <i class="fa-solid fa-thumbs-up"></i>
                        <a href="c-ouragent.html">Our Agent</a>
                    </li>
                </ul>
                <div class="login">
                    <button class="login-btn" onclick="window.location.href = 'g-login.html';">Login</button>
                   
                    <!--Button Hamburger-->
                    <button class="hamburger hamburger--spin" type="button">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>

            <!--Hero-->
            <div class="hero">
                <h1>
                    Find Your Dream <br/>
                    House with Us
                </h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis animipincs oscadaid ihcmscv cih quae suscipit ex assumenda deserunt quia!</p>
                <div class="btn-hero">
                    <a href="#our-house">Find Your House</a>
                </div>
            </div>
        </div>
    </header>
    <!--Header-->

    <!--Our House-->
    <div class="our-house" id="our-house">
        <div class="container">
            <h1 data-aos="fade-up" data-aos-duration="1000">Most View</h1>
            <p data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            <!-- Swiper -->
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="./assets/images/house-1.jpg" alt="house-img"/>
                        <div class="house desc">
                            <p>Ujung Berung Street, Bandung City, West Java</p>
                            <h2>Villa Home 1</h2>
                            <h4>Rp 500.000.000</h4>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <img src="./assets/images/house-2.jpg" alt="house-img"/>
                        <div class="house desc">
                            <p>Ujung Berung Street, Bandung City, West Java</p>
                            <h2>Villa Home 2</h2>
                            <h4>Rp 500.000.000</h4>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <img src="./assets/images/house-3.jpg" alt="house-img"/>
                        <div class="house desc">
                            <p>Ujung Berung Street, Bandung City, West Java</p>
                            <h2>Villa Home 3</h2>
                            <h4>Rp 500.000.000</h4>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <img src="./assets/images/house-4.jpg" alt="house-img"/>
                        <div class="house desc">
                            <p>Ujung Berung Street, Bandung City, West Java</p>
                            <h2>Villa Home 4</h2>
                            <h4>Rp 500.000.000</h4>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <img src="./assets/images/house-5.jpg" alt="house-img"/>
                        <div class="house desc">
                            <p>Ujung Berung Street, Bandung City, West Java</p>
                            <h2>Villa Home 5</h2>
                            <h4>Rp 500.000.000</h4>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>  
            <div class="btn-our-house">
                <button onclick="window.location.href = 'c-ourhouse.html';">View All House</button>
            </div>            
        </div>
    </div>
    <!--Our House-->

    <!--About Us-->
    <div class="about" id="about">
        <div class="container">
          <div class="about-box">
            <div class="box">
              <img src="./assets/images/about-img.jpg" alt="about-img" />
            </div>
            <div class="box">
                <h1 data-aos="fade-up" data-aos-duration="1000">
                    Find Your Dream <br />
                    House with Us
                </h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum est ratione ipsum veritatis. Maxime maiores obcaecati animi in minima molestias.</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque quia nemo beatae accusamus consectetur quaerat!</p>
            </div>
          </div>
        </div>
    </div>
    <!--About Us-->

    <!-- Services -->
    <div class="services" id="services">
        <div class="container">
            <h1 data-aos="fade-up" data-aos-duration="1000">Our Work in 3 Steps</h1>
            <p data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">Lorem ipsum dolor sit, amet consectetur adipisicing.</p>
            <div class="service-box">
                <div class="box" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
                    <i class="fa-solid fa-house"></i>
                    <h3>Research Phase</h3>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eaque recusandae ad asperiores beatae, atque quo!</p>
                </div>
                <div class="box" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="500">
                    <i class="fa-solid fa-handshake-simple"></i>
                    <h3>Make A Deal</h3>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eaque recusandae ad asperiores beatae, atque quo!</p>
                </div>
                <div class="box" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="700">
                    <i class="fa-solid fa-hand-holding-dollar"></i>
                    <h3>Determine The Prices</h3>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eaque recusandae ad asperiores beatae, atque quo!</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Services -->

    <!-- Recover App -->
    <div class="recover">
        <div class="container">
            <div class="recover-box">
                <div class="box">
                    <h1>We Are Also Available in The Apps</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio, neque?</p>
                    
                    <div>
                        <img src="./assets/images/playstore.png" alt="playstore logo" />
                        <img src="./assets/images/ios-app.png" alt="ios-app logo" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Recover App -->

    <!-- Our Agent -->
    <div class="ouragent" id="ouragent">
        <div class="container">
            <h1 data-aos="fade-up" data-aos-duration="1000">
                Find <br />
                Our Agent
            </h1>
            <p data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000">Lorem ipsum dolor sit, amet consectetur adipisicing elit.</p>
            <div class="ouragent-box">
                <div class="box">
                    <p>
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laborum at ratione quam deleniti voluptas alias blanditiis placeat culpa debitis! Omnis excepturi rem necessitatibus fugit sapiente recusandae sed voluptate doloremque
                        dolorem.
                    </p>
                    <div class="people">
                        <img src="./assets/images/people-1.jpg" alt="ouragent-people" />
                        <div class="people-desc">
                            <h3>People 1</h3>
                            <p>UI UX Designer</p>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <p>
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laborum at ratione quam deleniti voluptas alias blanditiis placeat culpa debitis! Omnis excepturi rem necessitatibus fugit sapiente recusandae sed voluptate doloremque
                        dolorem.
                    </p>
                    <div class="people">
                        <img src="./assets/images/people-2.jpg" alt="ouragent-people" />
                        <div class="people-desc">
                            <h3>People 2</h3>
                            <p>UI UX Designer</p>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <p>
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laborum at ratione quam deleniti voluptas alias blanditiis placeat culpa debitis! Omnis excepturi rem necessitatibus fugit sapiente recusandae sed voluptate doloremque
                        dolorem.
                    </p>
                    <div class="people">
                        <img src="./assets/images/people-1.jpg" alt="ouragent-people" />
                        <div class="people-desc">
                            <h3>People 1</h3>
                            <p>UI UX Designer</p>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <p>
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laborum at ratione quam deleniti voluptas alias blanditiis placeat culpa debitis! Omnis excepturi rem necessitatibus fugit sapiente recusandae sed voluptate doloremque
                        dolorem.
                    </p>
                    <div class="people">
                        <img src="./assets/images/people-2.jpg" alt="ouragent-people" />
                        <div class="people-desc">
                            <h3>People 2</h3>
                            <p>UI UX Designer</p>
                        </div>
                    </div>
                </div>                
                <div class="box">
                    <p>
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laborum at ratione quam deleniti voluptas alias blanditiis placeat culpa debitis! Omnis excepturi rem necessitatibus fugit sapiente recusandae sed voluptate doloremque
                        dolorem.
                    </p>
                    <div class="people">
                        <img src="./assets/images/people-3.jpg" alt="ouragent-people" />
                        <div class="people-desc">
                            <h3>People 3</h3>
                            <p>UI UX Designer</p>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <p>
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laborum at ratione quam deleniti voluptas alias blanditiis placeat culpa debitis! Omnis excepturi rem necessitatibus fugit sapiente recusandae sed voluptate doloremque
                        dolorem.
                    </p>
                    <div class="people">
                        <img src="./assets/images/people-1.jpg" alt="ouragent-people" />
                        <div class="people-desc">
                            <h3>People 4</h3>
                            <p>UI UX Designer</p>
                        </div>
                    </div>
                </div>                
            </div>
  
            <div class="load-more">
                <button class="load-more-btn">Load More <i class="fa-solid fa-arrow-down"></i></button>
            </div>
        </div>
    </div>
    <!-- Our Agent -->

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-box">
                <div class="box">
                    <h2>Grandeviera</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing.</p>
                <div class="footer-icon">
                    <i class="fa-brands fa-square-facebook"></i>
                    <i class="fa-brands fa-square-x-twitter"></i>
                    <i class="fa-brands fa-square-reddit"></i>
                    <i class="fa-brands fa-square-instagram"></i>
                    <i class="fa-brands fa-linkedin"></i>
                </div>
                </div>
                <div class="box">
                    <h3>Menu</h3>
                    <a href="g-homepage.html">Home</a>
                    <a href="g-homepage.html#about">About Us</a> 
                    <a href="g-homepage.html#services">Services</a>
                    <a href="c-ourhouse.html">Our House</a>
                    <a href="c-ouragent.html">Our Agent</a>
                </div>
                <div class="box">
                    <h3>Company</h3>
                    <a href="#">Blog</a>
                    <a href="#">Our Apps</a>
                    <a href="#">Brochure</a>
                </div>
                <div class="box">
                    <h3>Contact Us</h3>
                    <p><i class="fa-solid fa-envelope"></i> grandeviera@gmail.com</p>
                    <p><i class="fa-solid fa-phone"></i> (021) - 1234 - 5678</p>
                    <p><i class="fa-solid fa-location-dot"></i> Golf Hill Arcadia, Riverside, Jakarta</p>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer -->

    <!-- Copyright -->
    <div class="copyright">
        <p>&copy; 2024 <span>Grandeviera.</span> All Rights Reserved.</p>
    </div>
    <!-- Copyright -->


    <!--JS Home Page-->
    <script src="./dist/JavaScript/javascript.js"></script>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 1,
            spaceBetween: 10,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                535: {
                slidesPerView: 2,
                spaceBetween: 40,
                },
                1024: {
                slidesPerView: 3,
                spaceBetween: 50,
                },
            },
        });
    </script> 
    
    <!--AOS Motion-->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
    
</body>
</html>