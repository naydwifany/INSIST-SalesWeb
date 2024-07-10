<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INSIST: Login</title>

    <!--Favicon Logo Web-->
    <link rel="shortcut icon" href="./assets/icon/nm.png" type="image/x-icon"/>

    <!--CSS-->
    <link rel="stylesheet" href="./dist/CSS/login.css"/>

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
</head>

<body id="login-page">
    <!--Header-->
    <header>
        <div class="container">
            <!--Navbar-->
            <div class="navbar">
                <div class="logo">
                    <h1>INSIST</h1>
                </div>
                <ul class="menu">
                    <h1>INSIST</h1>
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
                    <button class="signup-btn" onclick="window.location.href = 'signup';">Sign Up</button>
                   
                    <!--Button Hamburger-->
                    <button class="hamburger hamburger--spin" type="button">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                      </button>
                </div>
            </div>
            <!--Header-->

            <!--Form Box-->
            <div class="container-formbox">
                <h1>
                    Login
                </h1>
                <div class="input-box">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('login.submit') }}">
                        @csrf
                        <div>
                            <input type="email" id="EmailUser" name="EmailUser" value="{{ old('EmailUser') }}" class="input-field" placeholder="Email" required>
                            <i class="bx bx-user"></i>
                        </div>
                        <div>
                            <input type="password" id="Password" name="Password" class="input-field" placeholder="Password" required>
                            <i class="bx bx-lock-alt"></i>
                        </div>
                        <div class="two-col" id="UserPositionLabel" name="UserPosition"></div>
                        <div class="two-col">
                            <div class="one">
                                <input type="checkbox" id="login-check">
                                <label for="login-check"> Remember Me</label>
                            </div>
                            <div class="two">
                                <label><a href="{{ route('forgot-password') }}">Forgot password?</a></label>
                            </div>
                        </div>                    
                        <button type="submit">Login</button>
                    </form>
                </div>
            </div>
            <!--Form Box-->
        </div>
    </header>
    <!--Header-->

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-box">
                <div class="box">
                    <h2>INSIST</h2>
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
        <p>&copy; 2024 <span>INSIST.</span> All Rights Reserved.</p>
    </div>
    <!-- Copyright -->

  
    <!--JS Home Page-->
    <script src="./dist/JavaScript/javascript.js"></script>

    <script>
        document.getElementById('EmailUser').addEventListener('input', function () {
            const email = this.value;
            if (email.endsWith('@insist.co.id')) {
                fetch(`/get-user-position?email=${email}`)
                    .then(response => response.json())
                    .then(data => {
                        const userPositionLabel = document.getElementById('UserPositionLabel');
                        if (data.position) {
                            userPositionLabel.innerText = `User Position: ${data.position}`;
                        } else {
                            userPositionLabel.innerText = 'User Position: Not Found';
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching user position:', error);
                    });
            } else {
                document.getElementById('UserPositionLabel').innerText = 'User Position:';
            }
        });
    </script>

    
</body>
</html>