<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INSIST: Homepage</title>

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

<body>
    <nav>
        <div class="navbar">
            <div class="logo">
                <h1>INSIST</h1>
            </div>
            <ul class="menu">
                @if($user->UserPosition == 'Super Admin')
                <li>
                    <a href="#users-permission">Users Permission</a>
                </li>
                @endif
                
                <li>
                    <form method="POST" action="{{ route('logout') }}" id="logout-form">
                        @csrf
                        <button type="button" class="logout-btn" id="logout-btn">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>
    
    <div class="container">
        <h1>Hello, {{ $user->NameUser }}</h1>
        <div class="services">
            <div class="service-box">
                <div class="box">
                    <a href="{{ route('principal.index') }}">
                        <i class="fa-solid fa-house"></i>
                        <h3>Principal</h3>
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eaque recusandae ad asperiores beatae, atque quo!</p>
                    </a>
                </div>
                <div class="box">
                    <a href="{{ route('distributor') }}">
                        <i class="fa-solid fa-handshake-simple"></i>
                        <h3>Distributor</h3>
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eaque recusandae ad asperiores beatae, atque quo!</p>
                    </a>
                </div>
                <div class="box">
                    <a href="{{ route('client') }}">
                        <i class="fa-solid fa-hand-holding-dollar"></i>
                        <h3>Client</h3>
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eaque recusandae ad asperiores beatae, atque quo!</p>
                    </a>
                </div>
                <div class="box">
                    <a href="{{ route('sales') }}">
                        <i class="fa-solid fa-hand-holding-dollar"></i>
                        <h3>Sales</h3>
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eaque recusandae ad asperiores beatae, atque quo!</p>
                    </a>
                </div>
            </div>
        </div>
        
        @if($user->UserPosition == 'Super Admin')
        <div id="users-permission">
            <h2>Users Permission</h2>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->NameUser }}</td>
                        <td>{{ $user->UserPosition }}</td>
                        <td>
                            <form method="POST" action="{{ route('change-status', $user->ID_User) }}" class="change-status-form">
                                @csrf
                                <button type="submit" class="change-status-btn" data-user-name="{{ $user->NameUser }}">
                                    {{ $user->UserStatus == 'Reject' ? 'Reject' : 'Approve' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
    
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

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Change User Status JS -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const changeStatusButtons = document.querySelectorAll('.change-status-btn');

            changeStatusButtons.forEach(button => {
                button.addEventListener('click', function (event) {
                    const userName = this.getAttribute('data-user-name');
                    const confirmation = confirm(`Are you sure, you want to change ${userName}'s status?`);

                    if (!confirmation) {
                        event.preventDefault();
                    }
                });
            });
        });
    </script>

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
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('logout-btn').addEventListener('click', function () {
                if (confirm('Are you sure you want to log out?')) {
                    document.getElementById('logout-form').submit();
                }
            });
        });
    </script>

    <!--AOS Motion-->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
    
</body>
</html>