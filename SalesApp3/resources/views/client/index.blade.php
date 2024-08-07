<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INSIST: Client</title>

    <!--Favicon Logo Web-->
    <link rel="shortcut icon" href="./assets/icon/nm.png" type="image/x-icon"/>

    <!--CSS-->
    <link rel="stylesheet" href="{{ asset('dist/CSS/client.css') }}">

    <!--Jonsuh Hamburger-->
    <link rel="stylesheet" href="{{ asset('dist/CSS/hamburgers.css') }}">

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
        <!-- Container -->
        <div class="container">
            <h1>Client</h1>
            <br><br>

            <!-- Client Details -->
            <h3>Client Details</h3>
            <select id="search-client" class="input-fieldselect">
                <option value="">Select Client...</option>
                @foreach($clients as $client)
                    <option value="{{ $client->ID_Client }}">{{ $client->Client_Name }}</option>
                @endforeach
            </select>

            <form method="POST" action="{{ route('client.store') }}" id="client-form" class="formbox">
                @csrf
                <div class="form-column">
                    <input type="hidden" id="client-id" name="client-id">

                    <!-- Super Admin, Manager, Admin/Finance, and Sales only -->
                    @if(Auth::user()->UserPosition == 'Super Admin' || Auth::user()->UserPosition == 'Admin/Finance' || Auth::user()->UserPosition == 'Sales' || Auth::user()->UserPosition == 'Manager')
                        <div>
                            <input type="text" id="Client_Name" name="Client_Name" placeholder="Name*" class="input-field" required>
                        </div>
                        <div>
                            <input type="text" id="Client_Address" name="Client_Address" placeholder="Address*" class="input-field" required>
                        </div>
                        <div>
                            <select id="NameUser" name="NameUser" class="input-field select" required>
                                <option value="" disabled selected>Select Staff in Charge*</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->ID_User }}">{{ $user->NameUser }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <select id="Category" name="Category" class="input-field select">
                            <option value="" disabled selected>Select Category*</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category }}">{{ $category }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <input type="text" id="Client_TaxID" name="Client_TaxID" placeholder="Tax ID" class="input-field">
                        </div>
                        <div>
                            <input type="text" id="Bandwidth" name="Bandwidth" placeholder="Bandwidth" class="input-field">
                        </div>
                        <div>
                            <input type="text" id="TotalEndpoint" name="TotalEndpoint" placeholder="Total Endpoint" class="input-field">
                        </div>
                        <div>
                            <input type="text" id="DataCenterModel" name="DataCenterModel" placeholder="Data Center Model" class="input-field">
                        </div>
                        <div>
                            <input type="text" id="ConcurrentUser" name="ConcurrentUser" placeholder="Concurrent User" class="input-field">
                        </div>
                        <div>
                            <input type="text" id="InternalNotes" name="InternalNotes" placeholder="Internal Notes" class="input-field">
                        </div>
                    <!-- Super Admin, Manager, Admin/Finance, and Sales only -->

                    @else
                        <div>
                            <input type="text" id="Client_Name" name="Client_Name" placeholder="Name*" class="input-field" disabled>
                        </div>
                        <div>
                            <input type="text" id="Client_Address" name="Client_Address" placeholder="Address**" class="input-field" disabled>
                        </div>
                        <div>
                            <select id="NameUser" name="NameUser" class="input-field select" disabled>
                                <option value="" disabled>Select Staff in Charge*</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->ID_User }}">{{ $user->NameUser }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <select id="Category" name="Category" class="input-field select" disabled>
                            <option value="" disabled>Select Category*</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category }}">{{ $category }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <input type="text" id="Client_TaxID" name="Client_TaxID" placeholder="Tax ID" class="input-field" disabled>
                        </div>
                        <div>
                            <input type="text" id="Bandwidth" name="Bandwidth" placeholder="Bandwidth" class="input-field" disabled>
                        </div>
                        <div>
                            <input type="text" id="TotalEndpoint" name="TotalEndpoint" placeholder="Total Endpoint" class="input-field" disabled>
                        </div>
                        <div>
                            <input type="text" id="DataCenterModel" name="DataCenterModel" placeholder="Data Center Model" class="input-field" disabled>
                        </div>
                        <div>
                            <input type="text" id="ConcurrentUser" name="ConcurrentUser" placeholder="Concurrent User" class="input-field" disabled>
                        </div>
                        <div>
                            <input type="text" id="InternalNotes" name="InternalNotes" placeholder="Internal Notes" class="input-field" disabled>
                        </div>
                    @endif
                </div>

                <div class="form-actions">
                    <!-- Super Admin, Manager, Admin/Finance, and Sales only -->
                    @if(Auth::user()->UserPosition == 'Super Admin' || Auth::user()->UserPosition == 'Admin/Finance' || Auth::user()->UserPosition == 'Sales' || Auth::user()->UserPosition == 'Manager')
                        <button type="button" id="add-record">Add Record</button>
                        <button type="button" id="update-record">Update Record</button>
                        <button type="button" id="delete-record">Delete Record</button>
                    <!-- Super Admin, Manager, Admin/Finance, and Sales only -->
                    
                    @else
                        <button id="add-record" class="hidden-button" disabled>Add Record</button>
                        <button id="update-record" class="hidden-button" disabled>Update Record</button>
                        <button id="delete-record" class="hidden-button" disabled>Delete Record</button>
                    @endif
                </div>
            </form>
            <!-- Client Details -->

            <br><br>

            <!-- Client PIC Table -->
            <h3>Client PIC</h3>

            <!-- Search Field -->
            <input type="text" id="search-input" class="search-results" placeholder="Search by Client Name...">

            <table id="client-table">
                <thead>
                    <tr>
                        <th>Client</th>
                        <th>PIC Name</th>
                        <th>PIC Job Position</th>
                        <th>PIC Phone</th>
                        <th>PIC Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clients as $client)
                        @if($client->pics->isEmpty())
                            <tr data-id="{{ $client->ID_Client }}">
                                <td>
                                @if(Auth::user()->UserPosition == 'Super Admin' || Auth::user()->UserPosition == 'Admin/Finance' || Auth::user()->UserPosition == 'Sales' || Auth::user()->UserPosition == 'Manager')
                                        <a href="{{ route('client.pic', ['id' => $client->ID_Client]) }}" class="client">
                                            {{ $client->Client_Name }}
                                        </a>
                                    @else
                                        {{ $client->Client_Name }}
                                    @endif
                                </td>
                                <td colspan="4">No PICs Available</td>
                            </tr>
                        @else
                            @foreach($client->pics as $index => $pic)
                                <tr data-id="{{ $client->ID_Client }}">
                                    @if($index == 0)
                                        <td rowspan="{{ $client->pics->count() }}">
                                            @if(Auth::user()->UserPosition == 'Super Admin' || Auth::user()->UserPosition == 'Admin/Finance' || Auth::user()->UserPosition == 'Sales' || Auth::user()->UserPosition == 'Manager')
                                                <a href="{{ route('client.pic', ['id' => $client->ID_Client]) }}" class="client">
                                                    {{ $client->Client_Name }}
                                                </a>
                                            @else
                                                {{ $client->Client_Name }}
                                            @endif
                                        </td>
                                    @endif
                                    <td>{{ $pic->ClientPIC_Name }}</td>
                                    <td>{{ $pic->ClientPIC_JobPosition }}</td>
                                    <td>{{ $pic->ClientPIC_Phone }}</td>
                                    <td>{{ $pic->ClientPIC_Email }}</td>
                                </tr>
                            @endforeach
                        @endif
                    @endforeach
                </tbody>
            </table>
            <p>Click the Client Name to edit or delete the PIC informations (Super Admin, Manager, Admin/Finance, and Sales only)</p>
            <!-- Client Table -->
        </div>
        <!-- Container -->
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

    <!-- Script Button Functions -->
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('add-record').addEventListener('click', function () {
            const form = document.getElementById('client-form');
            const clientId = document.getElementById('client-id').value;

            if (clientId) {
                alert('This is not a valid existing data, you can\'t add this data.');
            } else {
                form.action = '{{ route("client.store") }}';
                form.method = 'POST';
                form.submit();
                alert('The data has been created.');
            }
        });

        document.getElementById('update-record').addEventListener('click', function () {
            const form = document.getElementById('client-form');
            const clientId = document.getElementById('client-id').value;

            if (clientId) {
                form.action = `/client/${clientId}`;
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
            const clientId = document.getElementById('client-id').value;

            if (clientId && confirm('Are you sure you want to delete this record?')) {
                const form = document.createElement('form');
                form.action = `/client/${clientId}`;
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

        document.getElementById('search-client').addEventListener('change', function () {
            const id = this.value;
            if (id) {
                fetch(`/client/${id}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('client-id').value = data.ID_Client;
                        document.getElementById('Client_Name').value = data.Client_Name;
                        document.getElementById('Client_Address').value = data.Client_Address;
                        document.getElementById('NameUser').value = data.NameUser;
                        document.getElementById('Category').value = data.Category;
                        document.getElementById('Bandwidth').value = data.Bandwidth;
                        document.getElementById('TotalEndpoint').value = data.TotalEndpoint;
                        document.getElementById('DataCenterModel').value = data.DataCenterModel;
                        document.getElementById('ConcurrentUser').value = data.ConcurrentUser;
                        document.getElementById('InternalNotes').value = data.InternalNotes;
                    });
            } else {
                document.getElementById('client-form').reset();
            }
        });
    });
    </script>

    <!-- Script Search Field -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search-input');
            const clientTable = document.getElementById('client-table');
            const tableRows = clientTable.getElementsByTagName('tr');
            
            searchInput.addEventListener('input', function() {
                const searchText = searchInput.value.toLowerCase();
                
                for (let i = 1; i < tableRows.length; i++) { // Start at 1 to skip header row
                    const row = tableRows[i];
                    const clientNameCell = row.getElementsByTagName('td')[1]; // Assuming the Client Name is in the second column
                    
                    if (clientNameCell) {
                        const clientName = clientNameCell.textContent || clientNameCell.innerText;
                        
                        if (clientName.toLowerCase().indexOf(searchText) > -1) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    }
                }
            });
        });
    </script>


    <!-- Script Log Out -->
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