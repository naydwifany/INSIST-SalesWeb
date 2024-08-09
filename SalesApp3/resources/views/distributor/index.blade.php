<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INSIST: Distributor</title>

    <!--Favicon Logo Web-->
    <link rel="shortcut icon" href="./assets/icon/nm.png" type="image/x-icon"/>

    <!--CSS-->
    <link rel="stylesheet" href="{{ asset('dist/CSS/distributor.css') }}">

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
                <li><a href="{{ route('distributor.index') }}" class="active">Distributor</a></li>
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
            <h1>Distributor</h1>
            <br><br>

            <!-- Distributor Details -->
            <h3>Distributor Details</h3>
            <select id="search-distributor" class="input-fieldselect">
                <option value="">Select Distributor...</option>
                @foreach($distributors as $distributor)
                    <option value="{{ $distributor->ID_Distributor }}">{{ $distributor->Distributor_Name }}</option>
                @endforeach
            </select>

            <form method="POST" id="distributor-form" class="formbox">
                @csrf
                <input type="hidden" id="distributor-id" name="distributor-id">

                <!-- Super Admin & Admin/Finance Feature -->
                @if(Auth::user()->UserPosition == 'Super Admin' || Auth::user()->UserPosition == 'Admin/Finance')
                    <div>
                        <input type="text" id="Distributor_Name" name="Distributor_Name" placeholder="Name*" class="input-field" required>
                    </div>
                    <div>
                        <input type="text" id="TaxID_Distributor" name="TaxID_Distributor" placeholder="Tax ID" class="input-field">
                    </div>
                    <div id="brand-container">
                        <div class="brand-select">
                            <select name="Brand[]" id="Brand" class="input-field select">
                                <option value="">Select Brand*</option>
                                @foreach($principals as $principal)
                                    <option value="{{ $principal->ID_Principal }}">{{ $principal->Brand }}</option>
                                @endforeach
                            </select>
                            <a type="button" class="add-brand-btn" aria-label="Add Brand">
                                <i class="fa-solid fa-circle-plus"></i>
                            </a>
                        </div>
                    </div>
                <!-- Super Admin & Admin/Finance Feature -->
                
                @else
                    <div>
                        <input type="text" id="Distributor_Name" name="Distributor_Name" placeholder="Name*" class="input-field" disabled>
                    </div>
                    <div>
                        <input type="text" id="TaxID_Distributor" name="TaxID_Distributor" placeholder="Tax ID" class="input-field" disabled>
                    </div>
                    <div id="brand-container" class="brand-select">
                        <select name="Brand" class="input-field select" disabled>
                            <option value="">Select Brand*</option>
                            @foreach($principals as $principal)
                                <option value="{{ $principal->ID_Principal }}">{{ $principal->Brand }}</option>
                            @endforeach
                        </select>
                        <a type="button" class="add-brand-btn" aria-label="Add Brand" disabled>
                            <i class="fa-solid fa-circle-plus"></i>
                        </a>
                    </div>
                @endif
                
                <div class="form-actions">
                    <!-- Super Admin & Admin/Finance Feature -->
                    @if(Auth::user()->UserPosition == 'Super Admin' || Auth::user()->UserPosition == 'Admin/Finance')
                        <button type="button" id="add-record">Add Record</button>
                        <button type="button" id="update-record">Update Record</button>
                        <button type="button" id="delete-record" class="delete">Delete Record</button>
                    <!-- Super Admin & Admin/Finance Feature -->

                    @else
                        <button id="add-record" class="hidden-button" disabled>Add Record</button>
                        <button id="update-record" class="hidden-button" disabled>Update Record</button>
                        <button id="delete-record" class="hidden-button" disabled>Delete Record</button>
                    @endif
                </div>
            </form>
            <!-- Distributor Details -->

            <br><br>

            <!-- Distributor PIC Table -->
            <h3>Distributor PIC</h3>
            
            <!-- Search Field -->
            <input type="text" id="search-input" class="search-results" placeholder="Search by Distributor Name...">

            <!-- Distributor PIC Table -->
            <table id="distributor-table">
                <thead>
                    <tr>
                        <th>Distributor</th>
                        <th>PIC Name</th>
                        <th>PIC Job Position</th>
                        <th>PIC Phone</th>
                        <th>PIC Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($distributors as $distributor)
                        @if($distributor->pics->isEmpty())
                            <tr data-id="{{ $distributor->ID_Distributor }}" data-distributor="{{ $distributor->Distributor_Name }}">
                                <td>
                                    @if(Auth::user()->UserPosition == 'Super Admin' || Auth::user()->UserPosition == 'Admin/Finance')
                                        <a href="{{ route('distributor.pic', ['id' => $distributor->ID_Distributor]) }}" class="distributor">
                                            {{ $distributor->Distributor_Name }}
                                        </a>
                                    @else
                                        {{ $distributor->Distributor_Name }}
                                    @endif
                                </td>
                                <td colspan="4">No PICs Available</td>
                            </tr>
                        @else
                            @foreach($distributor->pics as $index => $pic)
                                <tr data-id="{{ $distributor->ID_Distributor }}" data-distributor="{{ $distributor->Distributor_Name }}">
                                    @if($index == 0)
                                        <td rowspan="{{ $distributor->pics->count() }}">
                                            @if(Auth::user()->UserPosition == 'Super Admin' || Auth::user()->UserPosition == 'Admin/Finance')
                                                <a href="{{ route('distributor.pic', ['id' => $distributor->ID_Distributor]) }}" class="distributor">
                                                    {{ $distributor->Distributor_Name }}
                                                </a>
                                            @else
                                                {{ $distributor->Distributor_Name }}
                                            @endif
                                        </td>
                                    @endif
                                    <td>{{ $pic->DistPIC_Name }}</td>
                                    <td>{{ $pic->DistPIC_JobPosition }}</td>
                                    <td>{{ $pic->DistPIC_Phone }}</td>
                                    <td>{{ $pic->DistPIC_Email }}</td>
                                </tr>
                            @endforeach
                        @endif
                    @endforeach
                </tbody>
            </table>
            <p>Click the Distributor Name to edit or delete the PIC informations (Super Admin & Admin/Finance only)</p>
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
    <!--
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const brandContainer = document.getElementById('brand-container');

        brandContainer.addEventListener('click', function (event) {
            if (event.target.classList.contains('add-brand-btn') || event.target.parentElement.classList.contains('add-brand-btn')) {
                const currentSelect = event.target.closest('.brand-select').querySelector('select');
                if (currentSelect.value !== '') {
                    addBrandSelect();
                }
            }
        });

        brandContainer.addEventListener('change', function (event) {
            if (event.target.tagName === 'SELECT') {
                const selects = brandContainer.querySelectorAll('select');
                const lastSelect = selects[selects.length - 1];
                if (event.target.value === '' && event.target !== lastSelect) {
                    event.target.closest('.brand-select').remove();
                }
            }
        });

        function addBrandSelect(selectedBrandId) {
            const container = document.getElementById('brand-container');
            
            // Create new select element
            const selectDiv = document.createElement('div');
            selectDiv.className = 'brand-select';
            
            const selectElement = document.createElement('select');
            selectElement.name = 'brand[]'; // Use an array to handle multiple brands
            selectElement.className = 'form-control'; // Apply CSS class for styling
            
            // Add default option
            const defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.textContent = 'Select Brand';
            selectElement.appendChild(defaultOption);
            
            // Fetch and populate brands
            fetch('/brands')
                .then(response => response.json())
                .then(brands => {
                    brands.forEach(brand => {
                        const option = document.createElement('option');
                        option.value = brand.ID_Brand;
                        option.textContent = brand.Brand_Name;
                        if (brand.ID_Brand === selectedBrandId) {
                            option.selected = true;
                        }
                        selectElement.appendChild(option);
                    });
                    selectDiv.appendChild(selectElement);
                    container.appendChild(selectDiv);
                })
                .catch(error => console.error('Fetch brands error:', error));
        }

        document.getElementById('add-record').addEventListener('click', function () {
            const form = document.getElementById('distributor-form');
            form.action = '{{ route("distributor.store") }}';
            form.method = 'POST';
            form.submit();
            alert('The data has been created.');
        });

        document.getElementById('update-record').addEventListener('click', function () {
            const form = document.getElementById('distributor-form');
            const distributorId = document.getElementById('distributor-id').value;

            if (distributorId) {
                form.action = `/distributor/${distributorId}`;
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
            const distributorId = document.getElementById('distributor-id').value;

            if (distributorId && confirm('Are you sure you want to delete this record?')) {
                const form = document.createElement('form');
                form.action = `/distributor/${distributorId}`;
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
        
        document.getElementById('search-distributor').addEventListener('change', function () {
            const id = this.value;
            if (id) {
                fetch(`/distributor/${id}`)
                    .then(response => response.json())
                    .then(data => {
                        console.log('Received data:', data); // Debugging line

                        if (data.error) {
                            console.error('Error:', data.error);
                            return;
                        }

                        // Fill the form fields with distributor data
                        document.getElementById('distributor-id').value = data.ID_Distributor;
                        document.getElementById('Distributor_Name').value = data.Distributor_Name;
                        document.getElementById('TaxID_Distributor').value = data.TaxID_Distributor;

                        // Reset brand selects
                        const brandContainer = document.getElementById('brand-container');
                        brandContainer.innerHTML = ''; // Clear all existing brand selects

                        // Ensure principals is defined and is an array
                        if (Array.isArray(data.principals)) {
                            // Add the brand selects with values from the data
                            data.principals.forEach(brandId => {
                                addBrandSelect(brandId);
                            });
                        } else {
                            console.error('Principals data is not an array:', data.principals);
                        }
                    })
                    .catch(error => console.error('Fetch error:', error)); // Catch any fetch errors
            } else {
                // Reset form if no distributor is selected
                document.getElementById('distributor-id').value = '';
                document.getElementById('Distributor_Name').value = '';
                document.getElementById('TaxID_Distributor').value = '';

                // Reset brand selects
                document.getElementById('brand-container').innerHTML = ''; // Clear all existing brand selects
            }
        });
    });
    </script>
    -->

    <script id="principals-data" type="application/json">
    {!! json_encode($principals) !!}
    </script>

    <script>
document.addEventListener('DOMContentLoaded', function () {
    const addBrandBtn = document.querySelector('.add-brand-btn');
const brandContainer = document.getElementById('brand-container');

// Get principals data from script tag
const principalsData = JSON.parse(document.getElementById('principals-data').textContent);

addBrandBtn.addEventListener('click', function() {
    const selectElement = document.createElement('select');
    selectElement.name = 'Brand[]';
    selectElement.className = 'input-field select';

    // Create placeholder option
    const placeholderOption = document.createElement('option');
    placeholderOption.textContent = 'Select Brand';
    placeholderOption.value = '';
    selectElement.appendChild(placeholderOption);

    // Populate options from available brands
    principalsData.forEach(principal => {
        const option = document.createElement('option');
        option.value = principal.ID_Principal;
        option.textContent = principal.Brand;
        selectElement.appendChild(option);
    });

    brandContainer.appendChild(selectElement);
});

    function addBrandSelect(selectedBrandIds, allBrands) {
        const container = document.getElementById('brand-container');
        container.innerHTML = ''; // Clear existing content but keep button

        selectedBrandIds.forEach(selectedBrandId => {
            const selectDiv = document.createElement('div');
            selectDiv.className = 'brand-select';

            const selectElement = document.createElement('select');
            selectElement.name = 'Brand[]';
            selectElement.className = 'input-field select';

            // Add default option
            const defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.textContent = 'Select Brand';
            selectElement.appendChild(defaultOption);

            // Populate brands
            allBrands.forEach(brand => {
                const option = document.createElement('option');
                option.value = brand.ID_Principal;
                option.textContent = brand.Brand;
                if (selectedBrandId === brand.ID_Principal) {
                    option.selected = true;
                }
                selectElement.appendChild(option);
            });

            // Add minus icon
            const minusIcon = document.createElement('i');
            minusIcon.className = 'fa-solid fa-circle-minus';
            minusIcon.onclick = function () {
                removeBrandSelect(this);
            };

            selectDiv.appendChild(minusIcon);
            selectDiv.appendChild(selectElement);

            container.appendChild(selectDiv);
        });
    }

    // Function to add a new brand select
    function addNewBrandSelect() {
        const container = document.getElementById('brand-container');
        
        const selectDiv = document.createElement('div');
        selectDiv.className = 'brand-select';

        const minusIcon = document.createElement('i');
        minusIcon.className = 'fa-solid fa-circle-minus';
        minusIcon.onclick = function () {
            removeBrandSelect(this);
        };

        const selectElement = document.createElement('select');
        selectElement.name = 'Brand[]';
        selectElement.className = 'input-field select';

        const defaultOption = document.createElement('option');
        defaultOption.value = '';
        defaultOption.textContent = 'Select Brand*';
        selectElement.appendChild(defaultOption);

        window.allPrincipals.forEach(principal => {
            const option = document.createElement('option');
            option.value = principal.ID_Principal;
            option.textContent = principal.Brand;
            selectElement.appendChild(option);
        });
    }

    // Function to remove a brand select
    function removeBrandSelect(element) {
        const container = document.getElementById('brand-container');
        const selectDiv = element.parentElement;
        container.removeChild(selectDiv);
    }

    // Function to check if add button should be enabled or disabled
    function checkBrandsAvailability() {
        const selects = document.querySelectorAll('#brand-container .select');
        const addButton = document.querySelector('.add-brand-btn');

        let hasValidOption = false;
        selects.forEach(select => {
            if (Array.from(select.options).some(option => option.value)) {
                hasValidOption = true;
            }
        });

        addButton.disabled = !hasValidOption;
    }

    // Event listener for distributor search
    document.getElementById('search-distributor').addEventListener('change', function () {
        const id = this.value;
        if (id) {
            fetch(`/distributor/${id}`)
                .then(response => response.json())
                .then(data => {
                    console.log('Distributor Data:', data); // Log data to check structure
                    document.getElementById('distributor-id').value = data.ID_Distributor;
                    document.getElementById('Distributor_Name').value = data.Distributor_Name;
                    document.getElementById('TaxID_Distributor').value = data.TaxID_Distributor;

                    // Handle Brands
                    if (data.brands && Array.isArray(data.brands)) {
                        const brandIds = data.brands.map(brand => brand.ID_Principal);
                        addBrandSelect(brandIds, allPrincipals);
                    } else {
                        console.warn('No brands data found');
                        addBrandSelect([], allPrincipals); // Reset brand selects
                    }
                })
                .catch(error => console.error('Fetch distributor error:', error));
        } else {
            // Reset form if no distributor is selected
            document.getElementById('distributor-id').value = '';
            document.getElementById('Distributor_Name').value = '';
            document.getElementById('TaxID_Distributor').value = '';

            addBrandSelect([], []); // Reset brand selects
        }
    });

    // Fetch all principals and initialize brand selects
    fetch('/principals')
        .then(response => response.json())
        .then(data => {
            if (Array.isArray(data) && data.length) {
                window.allPrincipals = data;
                // Initialize with empty brand select
                addNewBrandSelect();
            }
        })
        .catch(error => console.error('Fetch principals error:', error));

    // Event listeners for form buttons
    document.getElementById('add-record').addEventListener('click', function () {
        const form = document.getElementById('distributor-form');
        form.action = '{{ route("distributor.store") }}';
        form.method = 'POST';
        form.submit();
        alert('The data has been created.');
    });

    document.getElementById('update-record').addEventListener('click', function () {
        const form = document.getElementById('distributor-form');
        const distributorId = document.getElementById('distributor-id').value;

        if (distributorId) {
            form.action = `/distributor/${distributorId}`;
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
        const distributorId = document.getElementById('distributor-id').value;

        if (distributorId && confirm('Are you sure you want to delete this record?')) {
            const form = document.createElement('form');
            form.action = `/distributor/${distributorId}`;
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

    // Initial checks
    checkBrandsAvailability();
    document.getElementById('brand-container').addEventListener('change', function() {
        checkBrandsAvailability();
    });
});
</script>

    <!-- Script Search Field -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('search-input');
        const distributorTable = document.getElementById('distributor-table');
        const tableRows = Array.from(distributorTable.getElementsByTagName('tr'));

        searchInput.addEventListener('input', function() {
            const searchText = searchInput.value.toLowerCase();
            const distributorRows = tableRows.reduce((acc, row) => {
                const distributor = row.getAttribute('data-distributor');
                if (!acc[distributor]) {
                    acc[distributor] = [];
                }
                acc[distributor].push(row);
                return acc;
            }, {});

            Object.keys(distributorRows).forEach(distributor => {
                const rows = distributorRows[distributor];
                const distributorNameCell = rows[0].getElementsByTagName('td')[1];

                if (distributorNameCell) {
                    const distributorName = distributorNameCell.textContent || distributorNameCell.innerText;
                    const match = distributorName.toLowerCase().indexOf(searchText) > -1;

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