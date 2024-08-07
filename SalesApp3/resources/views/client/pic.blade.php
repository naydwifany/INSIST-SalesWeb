<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INSIST: Client PIC</title>

    <!--Favicon Logo Web-->
    <link rel="shortcut icon" href="./assets/icon/nm.png" type="image/x-icon"/>

    <!--CSS-->
    <link rel="stylesheet" href="{{ asset('dist/CSS/client.css') }}">

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
                <li><p>You are logged in as <b>{{ Auth::user()->UserPosition }}</b></p></li>
                <li><a href="{{ route('principal.index') }}">Principal</a></li>
                <li><a href="{{ route('distributor.index') }}">Distributor</a></li>
                <li><a href="{{ route('client.index') }}" class="active">Client</a></li>
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

    <!-- Header -->
    <header>
    <div class="container">
        <h1>Client PIC</h1>
        <br><br>
        <h3>Client Details</h3>
        <div class="client-table">
            <div class="left-column">
                <div class="row">
                    <div class="label">Name</div>
                    <div class="value">: {{ $client->Client_Name }}</div>
                </div>
                <div class="row">
                    <div class="label">Staff in Charge</div>
                    <div class="value">: {{ $client->user->NameUser }}</div>
                </div>
                <div class="row">
                    <div class="label">Address</div>
                    <div class="value">: {{ $client->Client_Address }}</div>
                </div>
                <div class="row">
                    <div class="label">Tax ID</div>
                    <div class="value">: {{ $client->TaxID_Client }}</div>
                </div>
                <div class="row">
                    <div class="label">Category</div>
                    <div class="value">: {{ $client->Category }}</div>
                </div>
            </div>
            <div class="right-column">
                <div class="row">
                    <div class="label">Bandwidth</div>
                    <div class="value">: {{ $client->Bandwidth }}</div>
                </div>
                <div class="row">
                    <div class="label">Total Endpoint</div>
                    <div class="value">: {{ $client->TotalEndpoint }}</div>
                </div>
                <div class="row">
                    <div class="label">Data Center Model</div>
                    <div class="value">: {{ $client->DataCenterModel }}</div>
                </div>
                <div class="row">
                    <div class="label">Concurrent User</div>
                    <div class="value">: {{ $client->ConcurrentUser }}</div>
                </div>
                <div class="row">
                    <div class="label">Internal Notes</div>
                    <div class="value">: {{ $client->InternalNotes }}</div>
                </div>
            </div>
        </div>
        <br><br>
        <!-- Form untuk menambah Client PIC -->
        <h3>Client PIC Details</h3>
        @if(Auth::user()->UserPosition == 'Super Admin' || Auth::user()->UserPosition == 'Admin/Finance' || Auth::user()->UserPosition == 'Sales' || Auth::user()->UserPosition == 'Manager')
        <form action="{{ route('client.pic.store', $client->ID_Client) }}" method="POST" class="formbox">
            @csrf
            <input type="text" name="ClientPIC_Name" placeholder="Name*" class="input-fieldpic" required>
            <input type="text" name="ClientPIC_JobPosition" placeholder="PIC Job Position*" class="input-fieldpic" required>
            <input type="text" name="ClientPIC_Phone" placeholder="Phone Number*" class="input-fieldpic" required>
            <input type="email" name="ClientPIC_Email" placeholder="Email" class="input-fieldpic">
            <div class="form-actions">
              button type="submit">Add Client PIC</button>
            </div>
        </form>
        @endif

        <br><br>

        <!-- Tabel untuk menampilkan daftar Client PIC -->
        <table class="pictable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Job Position</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @if(Auth::user()->UserPosition == 'Super Admin' || Auth::user()->UserPosition == 'Admin/Finance' || Auth::user()->UserPosition == 'Sales' || Auth::user()->UserPosition == 'Manager')
                    @foreach ($clientPICs as $pic)
                    <tr class="clickable-row" data-id="{{ $pic->Client_PIC_ID }}">
                        <td>{{ $pic->ClientPIC_Name }}</td>
                        <td>{{ $pic->ClientPIC_JobPosition }}</td>
                        <td>{{ $pic->ClientPIC_Phone }}</td>
                        <td>{{ $pic->ClientPIC_Email }}</td>
                        <!-- Hidden form for deleting -->
                        <form action="{{ route('client.pic.destroy', ['id' => $client->ID_Client, 'Client_PIC_ID' => $pic->Client_PIC_ID]) }}" method="POST" class="delete-form">
                            @csrf
                            @method('DELETE')
                        </form>
                    </tr>
                    @endforeach
                @elseif(Auth::user()->UserPosition == 'Technical')
                    @foreach ($clientPICs as $pic)
                    <tr data-id="{{ $pic->Client_PIC_ID }}">
                        <td>{{ $pic->ClientPIC_Name }}</td>
                        <td>{{ $pic->ClientPIC_JobPosition }}</td>
                        <td>{{ $pic->ClientPIC_Phone }}</td>
                        <td>{{ $pic->ClientPIC_Email }}</td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        <p>Click to delete the Client PIC data</p>
    </div>
    </header>
    <!-- Header -->

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
            // Handle row click for deletion
            document.querySelectorAll('tr[data-id]').forEach(row => {
                row.addEventListener('click', function () {
                    if (confirm('Are you sure you want to delete this Client PIC data?')) {
                        this.querySelector('.delete-form').submit();
                    }
                });
            });
        });
    </script>
</body>
</html>