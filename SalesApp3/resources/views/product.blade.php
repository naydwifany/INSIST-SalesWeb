<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INSIST: Product</title>

    <!--Favicon Logo Web-->
    <link rel="shortcut icon" href="./assets/icon/nm.png" type="image/x-icon"/>

    <!--CSS-->
    <link rel="stylesheet" href="{{ asset('dist/CSS/product.css') }}">

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
                <li><a href="{{ route('client.index') }}">Client</a></li>
                <li><a href="{{ route('product') }}" class="active">Product</a></li>
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
            <h1>Product</h1>
            <br><br>

            <!-- Product Details -->
            <h3>Product Details</h3>
            <select id="search-product" class="input-fieldselect">
                <option value="">Select Product...</option>
                @foreach($products as $product)
                    <option value="{{ $product->ID_Product }}">{{ $product->Product_Name }}</option>
                @endforeach
            </select>

            <form method="POST" action="{{ route('product.store') }}" id="product-form" class="formbox">
                @csrf
                <div class="form-column">
                    <input type="hidden" id="product-id" name="product-id">

                    <!-- Super Admin, Manager, and Sales only -->
                    @if(Auth::user()->UserPosition == 'Super Admin' || Auth::user()->UserPosition == 'Sales' || Auth::user()->UserPosition == 'Manager')
                        <div>
                            <input type="text" id="Product_Name" name="Product_Name" placeholder="Name*" class="input-field" required>
                        </div>
                        <div>
                            <input type="text" id="Product_Type" name="Product_Type" placeholder="Product Type" class="input-field">
                        </div>
                        <div>
                            <select id="Brand" name="Brand" class="input-field select" required>
                                <option value="" disabled selected>Select Brand*</option>
                                @foreach($principals as $principal)
                                    <option value="{{ $principal->ID_Principal }}">{{ $principal->Brand }}</option>
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
                    @endif
                </div>
                <div>
                    <textarea type="text" id="Product_Spec" name="Product_Spec" placeholder="Product Specification" class="input-field"></textarea>
                </div>

                <div class="form-actions">
                    @if(Auth::user()->UserPosition == 'Super Admin' || Auth::user()->UserPosition == 'Sales' || Auth::user()->UserPosition == 'Manager')
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
            <!-- Product Details -->

            <br><br>

            <!-- Sales Table -->
            <h3>Product & Sales Table</h3>

            <!-- Search Field -->
                <input type="text" id="search-input" class="search-results" placeholder="Search by Product Name...">
            <!-- Search Field -->
             
            <table>
                <thead>
                    <tr>
                        <th>Sales Date</th>
                        <th>Client Name</th>
                        <th>Client PIC Name</th>
                        <th>Staff in Charge</th>
                        <th>Distributor Name</th>
                        <th>Brand</th>
                        <th>Product Category</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sales as $sale)
                        <tr>
                            <td>{{ $sale->Sales_Date }}</td>
                            <td>{{ $sale->client->Client_Name }}</td>
                            <td>{{ $sale->clientPic->PrincipalName }}</td>
                            <td>{{ $sale->user->NameUser }}</td>
                            <td>{{ $sale->distributor->Distributor_Name }}</td>
                            <td>{{ $sale->brand->Brand }}</td>
                            <td>{{ $sale->Category }}</td>
                            <td>{{ $sale->Quantity }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
            const form = document.getElementById('product-form');
            const productId = document.getElementById('product-id').value;

            if (productId) {
                alert('This is not a valid existing data, you can\'t add this data.');
            } else {
                form.action = '{{ route("product.store") }}';
                form.method = 'POST';
                form.submit();
                alert('The data has been created.');
            }
        });

        document.getElementById('update-record').addEventListener('click', function () {
            const form = document.getElementById('product-form');
            const productId = document.getElementById('product-id').value;

            if (productId) {
                form.action = `/product/${productId}`;
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
            const productId = document.getElementById('product-id').value;

            if (productId && confirm('Are you sure you want to delete this record?')) {
                const form = document.createElement('form');
                form.action = `/product/${productId}`;
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

        document.getElementById('search-product').addEventListener('change', function () {
            const id = this.value;
            if (id) {
                fetch(`/product/${id}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('product-id').value = data.ID_Product;
                        document.getElementById('Product_Name').value = data.Product_Name;
                        document.getElementById('Brand').value = data.Brand;
                        document.getElementById('Product_Type').value = data.Product_Type;
                        document.getElementById('Product_Spec').value = data.Product_Spec;
                        document.getElementById('Category').value = data.Category;
                    });
            } else {
                document.getElementById('product-form').reset();
            }
        });
    });
    </script>

    <!-- Script Search Field -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search-input');
            const productTable = document.getElementById('product-table');
            const tableRows = productTable.getElementsByTagName('tr');
            
            searchInput.addEventListener('input', function() {
                const searchText = searchInput.value.toLowerCase();
                
                for (let i = 1; i < tableRows.length; i++) { // Start at 1 to skip header row
                    const row = tableRows[i];
                    const productNameCell = row.getElementsByTagName('td')[1]; // Assuming the Product Name is in the second column
                    
                    if (productNameCell) {
                        const productName = productNameCell.textContent || productNameCell.innerText;
                        
                        if (productName.toLowerCase().indexOf(searchText) > -1) {
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