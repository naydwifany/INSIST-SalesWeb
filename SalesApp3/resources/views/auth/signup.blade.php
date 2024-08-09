<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INSIST: Sign Up</title>

    <!--Favicon Logo Web-->
    <link rel="shortcut icon" href="./assets/icon/nm.png" type="image/x-icon"/>

    <!--CSS-->
    <link rel="stylesheet" href="./dist/CSS/signup.css"/>

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

<body id="signup-page">
    <!--Header-->
    <header>
        <div class="container">
            <!--Navbar-->
            <div class="navbar">
                <div class="logo">
                    <style>
                        h1{cursor: pointer;}
                    </style>
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
                    <button class="login-btn" onclick="window.location.href = 'login';">Login</button>
                   
                    <!--Button Hamburger-->
                    <button class="hamburger hamburger--spin" type="button">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>

            <!--Form Box-->
            <div class="container-formbox">
                <h1>
                    Sign Up
                </h1>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="input-box">
                    <form method="POST" action="{{ route('signup.submit') }}">
                        @csrf

                        <div>
                            <label for="NameUser">Name</label>
                            <input type="text" id="NameUser" name="NameUser" value="{{ old('NameUser') }}" class="input-field" placeholder="Albert Einstein" required>
                            <i class="bx bx-lock-alt"></i>
                        </div>

                        <div>
                            <label for="EmailUser">Email</label>
                            <input type="email" id="EmailUser" name="EmailUser" value="{{ old('EmailUser') }}" class="input-field" placeholder="xxxx@insist.co.id" required>
                            <i class="bx bx-lock-alt"></i>
                        </div>

                        <div>
                            <label for="MobilePhoneUser">Mobile Phone</label>
                            <input type="text" id="MobilePhoneUser" name="MobilePhoneUser" value="{{ old('MobilePhoneUser') }}" class="input-field" placeholder="08xxxxxxxxxx" required>
                            <i class="bx bx-lock-alt"></i>
                        </div>

                        <div>
                            <label for="SecurityQuestion">Security Question</label>
                            <input type="text" id="SecurityQuestion" name="SecurityQuestion" value="{{ old('SecurityQuestion') }}" class="input-field" placeholder="What is your favorite pet?" required>
                            <i class="bx bx-lock-alt"></i>
                        </div>

                        <div>
                            <label for="Answer">Answer</label>
                            <input type="text" id="Answer" name="Answer" value="{{ old('Answer') }}" class="input-field" placeholder="Cat" required>
                            <i class="bx bx-lock-alt"></i>
                        </div>

                        <div>
                            <label for="Password">Password</label>
                            <input type="password" id="Password" name="Password" class="input-field" required>
                            <i class="bx bx-lock-alt"></i>
                        </div>

                        <div>
                            <label for="Password_confirmation">Confirmation Password</label>
                            <input type="password" id="Password_confirmation" name="Password_confirmation" class="input-field" required>
                            <i class="bx bx-lock-alt"></i>
                        </div>

                        <div>
                            <label for="UserPosition">Job Position</label>
                            <select id="UserPosition" name="UserPosition" class="input-field select" required>
                                @foreach ($userPositions as $position)
                                    <option value="{{ $position }}">{{ $position }}</option>
                                @endforeach
                            </select>
                            <label>Please make sure that you are choosing the right Job Position.</label>
                            <i class="bx bx-lock-alt"></i>
                            <br><br>
                        </div>

                        <button type="submit">Create Account</button>
                    </form>                 
                </div>
            </div>
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
    
</body>
</html>