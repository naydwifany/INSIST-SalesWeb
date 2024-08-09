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
            <li><p>You are logged in as <b>{{ Auth::user()->UserPosition }}</b></p></li>
                <li><a href="{{ route('principal.index') }}" class="active">Principal</a></li>
                <li><a href="{{ route('distributor.index') }}">Distributor</a></li>
                <li><a href="{{ route('client.index') }}">Client</a></li>
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
        <h1>Principal PIC</h1>
        <br><br>
        <h3>Principal Details</h3>
        <div class="client-table">
            <div class="left-column">
                <div class="row">
                    <div class="label">Name</div>
                    <div class="value">: {{ $principal->Brand }}</div>
                </div>
                <div class="row">
                    <div class="label">Address</div>
                    <div class="value">: {{ $principal->PrincipalAddress }}</div>
                </div>
            </div>
        </div>
        <br><br>

        <!-- Form untuk menambah Principal PIC -->
        @if(Auth::user()->UserPosition == 'Super Admin' || Auth::user()->UserPosition == 'Admin/Finance')
        <form action="{{ route('principal.pic.store', $principal->ID_Principal) }}" method="POST" class="formbox">
            @csrf
            <div>
                <input type="text" name="PrincipalName" placeholder="Name*" class="input-field" required>
            </div>
            <div>
                <select name="PrincipalJobPosition" class="input-field select" required>
                    <option value="" disabled selected>Select Job Position*</option>
                    <option value="Sales">Sales</option>
                    <option value="Technical">Technical</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div>
                <input type="text" name="PrincipalPhone" placeholder="Phone Number*" class="input-field" required>
            </div>
            <div>
                <input type="email" name="PrincipalEmail" placeholder="Email" class="input-field">
            </div>
            <div>
                <input type="notes" name="Notes" placeholder="Notes" class="input-field">
            </div>
            <div class="form-actions">
                <button type="submit">Add Principal PIC</button>
            </div>
        </form>
        @endif

        <br><br>

        <!-- Tabel untuk menampilkan daftar Principal PIC -->
        <h3>Principal PIC Details</h3>
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
                @if(Auth::user()->UserPosition == 'Super Admin' || Auth::user()->UserPosition == 'Admin/Finance')
                @foreach ($principalPICs as $pic)
                <tr class="clickable-row" data-id="{{ $pic->Principal_PIC_ID }}">
                    <td>{{ $pic->PrincipalName }}</td>
                    <td>{{ $pic->PrincipalJobPosition }}</td>
                    <td>{{ $pic->PrincipalPhone }}</td>
                    <td>{{ $pic->PrincipalEmail }}</td>
                    <!-- Hidden form for deleting -->
                    <form action="{{ route('principal.pic.destroy', ['id' => $principal->ID_Principal, 'Principal_PIC_ID' => $pic->Principal_PIC_ID]) }}" method="POST" class="delete-form">
                        @csrf
                        @method('DELETE')
                    </form>
                </tr>
                @endforeach
                @else
                @foreach ($principalPICs as $pic)
                <tr data-id="{{ $pic->Principal_PIC_ID }}">
                    <td>{{ $pic->PrincipalName }}</td>
                    <td>{{ $pic->PrincipalJobPosition }}</td>
                    <td>{{ $pic->PrincipalPhone }}</td>
                    <td>{{ $pic->PrincipalEmail }}</td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
        <p>Click to delete the Principal PIC data</p>
    </div>
    </header>
    <!-- Header -->

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
                    if (confirm('Are you sure you want to delete this Principal PIC data?')) {
                        this.querySelector('.delete-form').submit();
                    }
                });
            });
        });
    </script>
</body>
</html>