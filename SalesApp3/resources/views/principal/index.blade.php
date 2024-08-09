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
        <!-- Container -->
        <div class="container">
            <h1>Principal</h1>
            <br><br>

            <!-- Principal Details -->
            <h3>Principal Details</h3>
            <select id="search-brand" class="input-fieldselect">
                <option value="">Search Brand...</option>
                @foreach($principals as $principal)
                    <option value="{{ $principal->ID_Principal }}">{{ $principal->Brand }}</option>
                @endforeach
            </select>

            <form method="POST" id="principal-form" class="formbox">
                @csrf
                <input type="hidden" id="principal-id" name="principal-id">

                <!-- Super Admin & Admin/Finance Feature -->
                @if(in_array($userPosition, ['Super Admin', 'Admin/Finance']))
                    <div>
                        <input type="text" id="Brand" name="Brand" class="input-field" placeholder="Brand*" required>
                    </div>
                    <div>
                        <input type="text" id="PrincipalAddress" name="PrincipalAddress" class="input-field" placeholder="Principal Address*" required>
                    </div>
                @else
                    <div>
                        <input type="text" id="Brand" name="Brand" class="input-field" placeholder="Brand*" disabled>
                    </div>
                    <div>
                        <input type="text" id="PrincipalAddress" name="PrincipalAddress" class="input-field" placeholder="Principal Address*" disabled>
                    </div>
                @endif
                
                <div class="form-actions">
                    @if(in_array($userPosition, ['Super Admin', 'Admin/Finance']))
                        <button type="button" id="add-record">Add Record</button>
                        <button type="button" id="update-record">Update Record</button>
                        <button type="button" id="delete-record">Delete Record</button>
                    @else
                        <button id="add-record" class="hidden-button" disabled>Add Record</button>
                        <button id="update-record" class="hidden-button" disabled>Update Record</button>
                        <button id="delete-record" class="hidden-button" disabled>Delete Record</button>
                    @endif
                </div>
            </form>
            <!-- Super Admin & Admin/Finance Feature -->

            <br><br>

            <!-- Principal PIC Table -->
            <h3>Principal PIC</h3>

            <!-- Search Field -->
            <input type="text" id="search-input" class="search-results" placeholder="Search by Principal Name...">

            <!-- Principal PIC Table -->
            <table id="principal-table">
                <thead>
                    <tr>
                        <th>Brand</th>
                        <th>PIC Name</th>
                        <th>PIC Job Position</th>
                        <th>PIC Phone</th>
                        <th>PIC Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($principals as $principal)
                        @if($principal->pics->isEmpty())
                            <tr data-id="{{ $principal->ID_Principal }}" data-brand="{{ $principal->Brand }}">
                                <td>
                                    @if(Auth::user()->UserPosition == 'Super Admin' || Auth::user()->UserPosition == 'Admin/Finance')
                                        <a href="{{ route('principal.pic', ['id' => $principal->ID_Principal]) }}" class="brand">
                                            {{ $principal->Brand }}
                                        </a>
                                    @else
                                        {{ $principal->Brand }}
                                    @endif
                                </td>
                                <td colspan="4">No PICs Available</td>
                            </tr>
                        @else
                            @foreach($principal->pics as $index => $pic)
                                <tr data-id="{{ $principal->ID_Principal }}" data-brand="{{ $principal->Brand }}">
                                    @if($index == 0)
                                        <td rowspan="{{ $principal->pics->count() }}">
                                            @if(Auth::user()->UserPosition == 'Super Admin' || Auth::user()->UserPosition == 'Admin/Finance')
                                                <a href="{{ route('principal.pic', ['id' => $principal->ID_Principal]) }}" class="brand">
                                                    {{ $principal->Brand }}
                                                </a>
                                            @else
                                                {{ $principal->Brand }}
                                            @endif
                                        </td>
                                    @endif
                                    <td>{{ $pic->PrincipalName }}</td>
                                    <td>{{ $pic->PrincipalJobPosition }}</td>
                                    <td>{{ $pic->PrincipalPhone }}</td>
                                    <td>{{ $pic->PrincipalEmail }}</td>
                                </tr>
                            @endforeach
                        @endif
                    @endforeach
                </tbody>
            </table>
            <p>Click the Principal Name to edit or delete the PIC informations (Super Admin & Admin/Finance only)</p>
        </div>
        <!-- Container -->
    </header>


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

    <!-- Script Button Function -->
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
                alert('The data added successfully.');
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
    });
    </script>
    <!-- Script Button Function -->

    <!-- Script Search Field -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('search-input');
        const principalTable = document.getElementById('principal-table');
        const tableRows = Array.from(principalTable.getElementsByTagName('tr'));

        searchInput.addEventListener('input', function() {
            const searchText = searchInput.value.toLowerCase();
            const brandRows = tableRows.reduce((acc, row) => {
                const brand = row.getAttribute('data-brand');
                if (!acc[brand]) {
                    acc[brand] = [];
                }
                acc[brand].push(row);
                return acc;
            }, {});

            Object.keys(brandRows).forEach(brand => {
                const rows = brandRows[brand];
                const brandNameCell = rows[0].getElementsByTagName('td')[1];

                if (brandNameCell) {
                    const brandName = brandNameCell.textContent || brandNameCell.innerText;
                    const match = brandName.toLowerCase().indexOf(searchText) > -1;

                    rows.forEach(row => {
                        row.style.display = match ? '' : 'none';
                    });

                    if (match) {
                        const firstRow = rows[0];
                        const rowspan = rows.filter(row => row.style.display !== 'none').length;
                        firstRow.getElementsByTagName('td')[0].rowSpan = rowspan;
                        firstRow.getElementsByTagName('td')[1].rowSpan = rowspan;
                    }
                }
            });
        });
    });
    </script>
    <!-- Script Search Field -->

    <!-- Log Out Script -->
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