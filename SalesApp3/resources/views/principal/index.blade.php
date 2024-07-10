<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INSIST: Principal</title>

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
        <!-- Container -->
        <div class="container">
            <h1>Principal</h1>

            @if(in_array($userPosition, ['Super Admin', 'Admin/Finance']))
            <select id="search-brand" class="input-field select">
                <option value="">Search Brand...</option>
                @foreach($principals as $principal)
                    <option value="{{ $principal->ID_Principal }}">{{ $principal->Brand }}</option>
                @endforeach
            </select>
            <form method="POST" id="principal-form" class="formbox">
                @csrf
                <input type="hidden" id="principal-id" name="principal-id">
                <div>
                    <input type="text" id="Brand" name="Brand" class="input-field" placeholder="Brand">
                </div>
                <div>
                    <input type="text" id="PrincipalAddress" name="PrincipalAddress" class="input-field" placeholder="Principal Address">
                </div>
                <button type="button" id="add-record">Add Record</button>
                <button type="button" id="update-record">Update Record</button>
                <button type="button" id="delete-record">Delete Record</button>
            </form>
            @endif

            <br><br>
            <br><br>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Brand</th>
                        <th>Principal Name</th>
                        <th>Job Position</th>
                        <th>Phone</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($principals as $principal)
                    <tr data-id="{{ $principal->ID_Principal }}">
                        <td>{{ $principal->ID_Principal }}</td>
                        <td><a href="{{ route('principal.pic', $principal->Brand) }}">{{ $principal->Brand }}</a></td>
                        <td>
                            @foreach($principal->pics as $pic)
                                {{ $pic->PrincipalName }},
                            @endforeach
                        </td>
                        <td>
                            @foreach($principal->pics as $pic)
                                {{ $pic->PrincipalJobPosition }},
                            @endforeach
                        </td>
                        <td>
                            @foreach($principal->pics as $pic)
                                {{ $pic->PrincipalPhone }},
                            @endforeach
                        </td>
                        <td>
                            @foreach($principal->pics as $pic)
                                {{ $pic->PrincipalEmail }},
                            @endforeach
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- Container -->
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

    <!-- Button Function -->
        <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('add-record').addEventListener('click', function () {
                const form = document.getElementById('principal-form');
                const principalId = document.getElementById('principal-id').value;

                if (principalId) {
                    alert('This is not a valid existing data, you can\'t add this data.');
                } else {
                    form.action = '{{ route("principal.store") }}';
                    form.method = 'POST';
                    form.submit();
                    alert('The data has been created.');
                }
            });

            document.getElementById('update-record').addEventListener('click', function () {
                const form = document.getElementById('principal-form');
                const principalId = document.getElementById('principal-id').value;

                if (principalId) {
                    form.action = `/principal/${principalId}`;
                    form.method = 'POST';
                    form.appendChild(document.createElement('input')).setAttribute('name', '_method');
                    form.lastChild.value = 'PUT';
                    form.submit();
                    alert('The data updated successfully.');
                } else {
                    alert('This is not a valid existing data, you can\'t update this data.');
                }
            });

            document.getElementById('delete-record').addEventListener('click', function () {
                const principalId = document.getElementById('principal-id').value;

                if (principalId && confirm('Are you sure you want to delete this record?')) {
                    const form = document.createElement('form');
                    form.action = `/principal/${principalId}`;
                    form.method = 'POST';
                    form.appendChild(document.createElement('input')).setAttribute('name', '_method');
                    form.lastChild.value = 'DELETE';
                    form.appendChild(document.createElement('input')).setAttribute('name', '_token');
                    form.lastChild.value = '{{ csrf_token() }}';
                    document.body.appendChild(form);
                    form.submit();
                } else {
                    alert('This is not a valid existing data, you can\'t delete this data.');
                }
            });

            document.getElementById('search-brand').addEventListener('change', function () {
                const id = this.value;

                if (id) {
                    fetch(`/principal/${id}`)
                        .then(response => response.json())
                        .then(data => {
                            document.getElementById('principal-id').value = data.ID_Principal;
                            document.getElementById('Brand').value = data.Brand;
                            document.getElementById('PrincipalAddress').value = data.PrincipalAddress;
                        });
                } else {
                    document.getElementById('principal-form').reset();
                }
            });
            document.getElementById('logout-btn').addEventListener('click', function () {
                if (confirm('Are you sure you want to log out?')) {
                    document.getElementById('logout-form').submit();
                }
            });
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
</body>
</html>