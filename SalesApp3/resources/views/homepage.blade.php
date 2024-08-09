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
                        <i class="fa-solid fa-cubes-stacked"></i>
                        <h3>Principal</h3>
                    </a>
                </div>
                <div class="box">
                    <a href="{{ route('distributor.index') }}">
                        <i class="fa-solid fa-handshake-simple"></i>
                        <h3>Distributor</h3>
                    </a>
                </div>
                <div class="box">
                    <a href="{{ route('client.index') }}">
                        <i class="fa-solid fa-hand-holding-dollar"></i>
                        <h3>Client</h3>
                    </a>
                </div>
                <div class="box">
                    <a href="{{ route('product') }}">
                        <i class="fa-solid fa-sack-dollar"></i>
                        <h3>Product</h3>
                    </a>
                </div>
                <div class="box">
                    <a href="{{ route('sales') }}">
                        <i class="fa-solid fa-money-check-dollar"></i>
                        <h3>Sales</h3>
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
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Position</th>
                    <th>User Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->NameUser }}</td>
                    <td>{{ $user->EmailUser }}</td>
                    <td>{{ $user->MobilePhoneUser }}</td>
                    <td>{{ $user->UserPosition }}</td>
                    <td>
                        <form method="POST" action="{{ route('change-status', $user->ID_User) }}" class="change-status-form">
                            @csrf
                            <button type="submit" name="status" value="Approve" class="change-status-btn approve-btn" data-user-name="{{ $user->NameUser }}" {{ $user->UserStatus == 'Approve' ? 'disabled' : '' }}>
                                Approve
                            </button>
                            <button type="submit" name="status" value="Reject" class="change-status-btn reject-btn" data-user-name="{{ $user->NameUser }}" {{ $user->UserStatus == 'Reject' ? 'disabled' : '' }}>
                                Reject
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
                    <p>To Be The Best IT Company Which Are Providing The Best Quality Solutions For Clients.</p>
                    <div class="footer-icon">
                        <a href="https://www.instagram.com/insist.official/" target="_blank" aria-label="Instagram">
                            <i class="fa-brands fa-square-instagram"></i>
                        </a>
                        <a href="https://www.linkedin.com/company/pt-inovasi-sistem-teknologi/" target="_blank" aria-label="LinkedIn">
                            <i class="fa-brands fa-linkedin"></i>
                        </a>
                    </div>
                </div>
                <div class="box">
                    <h3>Super Admin Contacts</h3>
                    <div class="contacts-flex">
                        @foreach($superAdmins as $admin)
                            <div class="contact-card">
                                <p><i class="fa-solid fa-user-tie"></i> {{ $admin->NameUser }}</p>
                                <p><i class="fa-solid fa-envelope"></i> {{ $admin->EmailUser }}</p>
                                <p><i class="fa-solid fa-phone"></i> {{ $admin->MobilePhoneUser }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer -->

    <!-- Copyright -->
    <div class="copyright">
        <p>&copy; 2024 <span>INSIST</span>. All Rights Reserved.</p>
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
                const status = this.value;
                const confirmation = confirm(`Are you sure you want to change ${userName}'s status to ${status}?`);

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