<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INSIST: Principal PIC</title>

    <!--Favicon Logo Web-->
    <link rel="shortcut icon" href="./assets/icon/nm.png" type="image/x-icon"/>

    <!--CSS-->
    <link rel="stylesheet" href="{{ asset('dist/CSS/principal.css') }}">

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
    <!-- Navbar -->
    <nav>
        <div class="navbar">
            <div class="logo">
                <h1><a href="{{ route('homepage') }}">INSIST</a></h1>
            </div>
            <ul class="menu">
                <li><p>You are logged in as {{ Auth::user()->UserPosition }}</p></li>
                <li><a href="{{ route('principal.index') }}">Back to Principal</a></li>
                <li><a href="{{ route('distributor') }}">Distributor</a></li>
                <li><a href="{{ route('client') }}">Client</a></li>
                <li><a href="{{ route('product') }}">Product</a></li>
                <li><a href="{{ route('sales') }}">Sales</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}" id="logout-form">
                        @csrf
                        <button type="button" class="logout-btn" id="logout-btn">Logout</button>
                    </form>
                </li>
                <!--Button Hamburger-->
                <button class="hamburger hamburger--spin" type="button">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </ul>
        </div>
    </nav>
    <!-- Navbar -->

    <header>
        <div class="container">
            <h1>Principal PIC</h1>
            <p>Brand: {{ $principal->Brand }}</p>
            <p>Principal Address: {{ $principal->PrincipalAddress }}</p>

            @if(auth()->user()->UserPosition == 'Super Admin' || auth()->user()->UserPosition == 'Admin/Finance')
                <form method="POST" action="{{ route('principal.pic.store', $principal->ID_Principal) }}">
                    @csrf
                    <input type="text" name="PrincipalName" placeholder="Name" required>
                    <select name="PrincipalJobPosition" required>
                        <option value="Sales">Sales</option>
                        <option value="Technical">Technical</option>
                        <option value="Other">Other</option>
                    </select>
                    <input type="text" name="PrincipalPhone" placeholder="Phone Number" required>
                    <input type="email" name="PrincipalEmail" placeholder="Email">
                    <button type="submit">Add PIC</button>
                </form>

                <table>
                    <thead>
                        <tr>
                            <th>PIC ID</th>
                            <th>Name</th>
                            <th>Job Position</th>
                            <th>Phone Number</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($principalPICs as $pic)
                            <tr>
                                <td>{{ $pic->Principal_PIC_ID }}</td>
                                <td>{{ $pic->PrincipalName }}</td>
                                <td>{{ $pic->PrincipalJobPosition }}</td>
                                <td>{{ $pic->PrincipalPhone }}</td>
                                <td>{{ $pic->PrincipalEmail }}</td>
                                <td>
                                    <form method="POST" action="{{ route('principal.pic.destroy', $principal->ID_Principal) }}">
                                        @csrf
                                        <input type="hidden" name="Principal_PIC_ID" value="{{ $pic->Principal_PIC_ID }}">
                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this Principal PIC data?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <table>
                    <thead>
                        <tr>
                            <th>PIC ID</th>
                            <th>Name</th>
                            <th>Job Position</th>
                            <th>Phone Number</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($principalPICs as $pic)
                            <tr>
                                <td>{{ $pic->Principal_PIC_ID }}</td>
                                <td>{{ $pic->PrincipalName }}</td>
                                <td>{{ $pic->PrincipalJobPosition }}</td>
                                <td>{{ $pic->PrincipalPhone }}</td>
                                <td>{{ $pic->PrincipalEmail }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </header>

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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('logout-btn').addEventListener('click', function () {
                if (confirm('Are you sure you want to log out?')) {
                    document.getElementById('logout-form').submit();
                }
            });
        });
    </script>
</body>
</html>