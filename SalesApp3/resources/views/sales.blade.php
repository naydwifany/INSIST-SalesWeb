<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INSIST: Sales</title>

    <!--Favicon Logo Web-->
    <link rel="shortcut icon" href="./assets/icon/nm.png" type="image/x-icon"/>

    <!--CSS-->
    <link rel="stylesheet" href="{{ asset('dist/CSS/sales.css') }}">

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
                <li><a href="{{ route('product') }}">Product</a></li>
                <li><a href="{{ route('sales') }}" class="active" >Sales</a></li>
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
            <h1>Sales</h1>
            <br><br>

            <!-- Sales Details -->
            <h3>Sales Details</h3>
            <select id="search-Sales" class="input-fieldselect">
                <option value="">Select Sales...</option>
                @foreach($sales as $sale)
                    <option value="{{ $sale->ID_Sales }}">{{ $sale->Sales_Date }}</option>
                @endforeach
            </select>

            <form action="{{ route('sales.store') }}" method="POST" id="sales-form" class="formbox">
                @csrf
                <div class="form-column">
                    <input type="hidden" id="sales-id" name="sales-id">
                    <div>
                        <input type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="Sales_Date" name="Sales_Date" placeholder="Sales Date*" class="input-field" required>
                    </div>
                    <div>
                        <select id="Client_Name" name="Client_Name" class="input-field select" required>
                            <option value="" disabled selected>Select Client*</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->ID_Client }}">{{ $client->Client_Name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <select id="ClientPIC_Name" name="ClientPIC_Name" class="input-field select" required>
                            <option value="" disabled selected>Select Client PIC*</option>
                        </select>
                    </div>
                    <div>
                        <select id="NameUser" name="NameUser" class="input-field select disabled" disabled required>
                            <option value="" disabled selected>Staff in Charge</option>
                        </select>
                    </div>
                    <div>
                        <select id="Brand" name="Brand" class="input-field select" required>
                            <option value="" disabled selected>Select Brand*</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->ID_Principal }}">{{ $brand->Brand }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <select id="Distributor_Name" name="Distributor_Name" class="input-field select" required>
                            <option value="" disabled selected>Select Distributor*</option>
                        </select>
                    </div>
                    <div>
                        <select id="Product_Name" name="Product_Name" class="input-field select" required>
                            <option value="" disabled selected>Select Product*</option>
                        </select>
                    </div>
                    <div>
                        <select id="Category" name="Category" class="input-field select disabled" disabled required>
                            <option value="" disabled selected>Category</option>
                        </select>
                    </div>
                    <div>
                        <input type="number" id="Quantity" name="Quantity" placeholder="Quantity" class="input-field" required>
                    </div>
                    <div>
                        <input type="text" id="UnitPrice" name="UnitPrice" placeholder="Unit Price" class="input-field" required>
                    </div>
                    <div>
                        <input type="text" id="TotalPrice" name="TotalPrice" placeholder="Total Price" class="input-field" readonly>
                    </div>
                    <div>
                        <input type="text" id="SerialNumber" name="SerialNumber" placeholder="Serial Number" class="input-field">
                    </div>
                    <div>
                        <input type="text" id="ContractNumber" name="ContractNumber" placeholder="Contract Number" class="input-field">
                    </div>
                    <div>
                        <input type="date" onfocus="(this.type='date')" onblur="(this.type='text')" id="ExpDate" name="ExpDate" placeholder="Expiration Date" class="input-field">
                    </div>
                </div>
                <div>
                    <textarea id="SalesNotes" name="SalesNotes" placeholder="Sales Notes" class="input-field"></textarea>
                </div>

                <div class="form-actions">
                        <button type="button" id="add-record">Add Record</button>
                        <button type="button" id="update-record">Update Record</button>
                        <button type="button" id="delete-record">Delete Record</button>
                </div>
            </form>
            <!-- Sales Details -->
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
    document.addEventListener('DOMContentLoaded', function() {
        const clientSelect = document.getElementById('Client_Name');
        const clientPICSelect = document.getElementById('ClientPIC_Name');
        const nameUserSelect = document.getElementById('NameUser');
        const brandSelect = document.getElementById('Brand');
        const distributorSelect = document.getElementById('Distributor_Name');
        const productSelect = document.getElementById('Product_Name');
        const categorySelect = document.getElementById('Category');

        clientSelect.addEventListener('change', function() {
            const clientId = this.value;
            fetch(`/sales/client-pic/${clientId}`)
                .then(response => response.json())
                .then(data => {
                    console.log(data); // Cek data di console

                    // Update Client PICs dropdown
                    clientPICSelect.innerHTML = '<option value="" disabled selected>Select Client PIC*</option>';
                    if (data.clientPICS) {
                        data.clientPICS.forEach(pic => {
                            const option = document.createElement('option');
                            option.value = pic.Client_PIC_ID;
                            option.textContent = pic.ClientPIC_Name;
                            clientPICSelect.appendChild(option);
                        });
                    }

                    // Update NameUser dropdown
                    if (data.nameUser) {
                        nameUserSelect.innerHTML = `<option value="${data.nameUser.ID_User}">${data.nameUser.NameUser}</option>`;
                    } else {
                        nameUserSelect.innerHTML = '<option value="" disabled>No Staff Available</option>';
                    }
                })
                .catch(error => console.error('Error:', error));
        });

        // Fetch distributors based on selected brand
        brandSelect.addEventListener('change', function() {
            const brandId = this.value;
            fetch(`/sales/distributors/${brandId}`)
                .then(response => response.json())
                .then(data => {
                    distributorSelect.innerHTML = '<option value="" disabled selected>Select Distributor*</option>';
                    data.distributors.forEach(distributor => {
                        const option = document.createElement('option');
                        option.value = distributor.ID_Distributor;
                        option.textContent = distributor.Distributor_Name;
                        distributorSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error:', error)); // Error handling
        });

        // Fetch products based on selected brand
        brandSelect.addEventListener('change', function() {
            const brandId = this.value;
            fetch(`/sales/products/${brandId}`)
                .then(response => response.json())
                .then(data => {
                    productSelect.innerHTML = '<option value="" disabled selected>Select Product*</option>';
                    data.products.forEach(product => {
                        const option = document.createElement('option');
                        option.value = product.ID_Product;
                        option.textContent = product.Product_Name;
                        productSelect.appendChild(option);
                    });
                });
        });

        // Fetch category based on selected product
        productSelect.addEventListener('change', function() {
            const productId = this.value;
            fetch(`/sales/product-category/${productId}`)
                .then(response => response.json())
                .then(data => {
                    categorySelect.innerHTML = `<option value="${data.ID_Product}">${data.category}</option>`;
                });
        });

        // Calculate Total Price when Quantity or Unit Price changes
        document.getElementById('Quantity').addEventListener('input', calculateTotalPrice);
        document.getElementById('UnitPrice').addEventListener('input', calculateTotalPrice);

        function calculateTotalPrice() {
            const quantity = parseFloat(document.getElementById('Quantity').value) || 0;
            const unitPrice = parseFloat(document.getElementById('UnitPrice').value) || 0;
            document.getElementById('TotalPrice').value = quantity * unitPrice;
        }
    });
    </script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchSalesSelect = document.getElementById('search-Sales');
        const salesForm = document.getElementById('sales-form');
        const addRecordButton = document.getElementById('add-record');
        const updateRecordButton = document.getElementById('update-record');
        const deleteRecordButton = document.getElementById('delete-record');
        const salesIdInput = document.getElementById('sales-id');

        // Fetch sales details when an option is selected
        searchSalesSelect.addEventListener('change', function() {
            const salesId = this.value;
            if (salesId) {
                fetch(`/sales/${salesId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data) {
                            // Populate form fields with the selected sale data
                            salesIdInput.value = data.ID_Sales;
                            document.getElementById('Sales_Date').value = data.Sales_Date;
                            document.getElementById('Client_Name').value = data.Client_Name;
                            document.getElementById('ClientPIC_Name').value = data.Client_PICName;
                            document.getElementById('NameUser').value = data.NameUser;
                            document.getElementById('Brand').value = data.Brand;
                            document.getElementById('Distributor_Name').value = data.Distributor_Name;
                            document.getElementById('Product_Name').value = data.Product_Name;
                            document.getElementById('Category').value = data.Category;
                            document.getElementById('Quantity').value = data.Quantity;
                            document.getElementById('UnitPrice').value = data.UnitPrice;
                            document.getElementById('TotalPrice').value = data.TotalPrice;
                            document.getElementById('SerialNumber').value = data.SerialNumber;
                            document.getElementById('ContractNumber').value = data.ContractNumber;
                            document.getElementById('ExpDate').value = data.ExpDate;
                            document.getElementById('SalesNotes').value = data.SalesNotes;
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }
        });

        // Add record
        document.getElementById('add-record').addEventListener('click', function () {
            const form = document.getElementById('sales-form');
            if (form.checkValidity()) {
                form.submit();
            } else {
                alert('Please fill out all required fields.');
            }
        });

        // Update record
        updateRecordButton.addEventListener('click', function() {
            const salesId = salesIdInput.value;
            if (salesId) {
                const formData = new FormData(salesForm);
                fetch(`/sales/${salesId}`, {
                    method: 'PUT',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    alert('The data updated successfully.');
                })
                .catch(error => console.error('Error:', error));
            } else {
                alert("This is not a valid existing data, you can't update this data.");
            }
        });

        // Delete record
        deleteRecordButton.addEventListener('click', function() {
            const salesId = salesIdInput.value;
            if (salesId && confirm('Are you sure you want to delete this record?')) {
                fetch(`/sales/${salesId}`, {
                    method: 'DELETE'
                })
                .then(response => response.json())
                .then(data => {
                    alert('The data deleted successfully.');
                    salesForm.reset();  // Reset form after successful deletion
                })
                .catch(error => console.error('Error:', error));
            } else {
                alert("This is not a valid existing data, you can't delete this data.");
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