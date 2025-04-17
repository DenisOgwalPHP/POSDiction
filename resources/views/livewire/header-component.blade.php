<div>
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-dark">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="/Dashboard" class="nav-link">Home</a>
            </li>
           
             <li class="nav-item d-none d-sm-inline-block">
                <a href="/Client-Account" class="nav-link">Client Account</a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Navbar Search -->
            <li class="nav-item">
                <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                    <i class="fas fa-search"></i>
                </a>
                <div class="navbar-search-block">
                    <form class="form-inline" wire:submit.prevent="MakeSearch">
                        <div class="input-group input-group-sm">
                            <input class="form-control form-control-navbar" type="search" wire:model.lazy="search"
                                placeholder="Search product" aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-navbar" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                                <button class="btn btn-navbar" type="submit" data-widget="navbar-search">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>

            <!-- Messages Dropdown Menu -->
            @livewire('not-header-refresh')
            <!-- Notifications Dropdown Menu -->
            @livewire('note-header-refresh')
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="/Dashboard" class="brand-link">
            <img src="{{ asset('dist/img/Asset 6.png') }}" alt="Essential Logo"
                class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Essential POS</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    @auth
                        @if (Auth::user()->profile_photo_path == null)
                            <img src="{{ asset('dist/img/avatar5.png') }}" class="img-circle elevation-2" alt="User Image">
                        @else
                            <img src="{{ asset('assets/ProfilePics/' . Auth::user()->profile_photo_path) }}"
                                class="img-circle elevation-2" alt="User Image">
                        @endauth
                    @endif
                </div>
                <div class="info">
                    <a href="#" class="d-block">
                        @if (Route::has('login'))
                            @auth
                                {{ Auth::user()->name }}
                            @endauth
                        @else
                            {{ 'Guest' }}
                        @endif
                    </a>
                </div>
            </div>

            <!-- SidebarSearch Form -->
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                        aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    @php
                        $current_page = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
                        $current_page = basename($current_page);
                    @endphp

                    <li class="nav-item {{ $current_page == 'Dashboard' ? 'menu-open' : '' }}">
                        <a href="/" class="nav-link {{ $current_page == 'Dashboard' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/Dashboard"
                                    class="nav-link  {{ $current_page == 'Dashboard' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-circle text-warning"></i>
                                    <p>Home</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                    class="nav-link">
                                    <i class="nav-icon fas fa-circle text-danger"></i>
                                    <p>Logout</p>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                    @if ($accesssetting->contains('Settings', 1) || Auth::user()->utype == 'Administrator')
                        <li
                            class="nav-item {{ $current_page == 'Assets-names' || $current_page == 'Price-Percentage' || $current_page == 'Payment-Method' || $current_page == 'Units' || $current_page == 'Branch' || $current_page == 'Notification' || $current_page == 'Expense-Category' || $current_page == 'Permissions-Delete' || $current_page == 'Permissions' || $current_page == 'Documentation' || $current_page == 'Terms-and-Conditions' || $current_page == 'Privacy-Policy' || $current_page == 'saveFaqs' || $current_page == 'Contact-Settings' ? 'menu-open' : '' }}">
                            <a href="#"
                                class="nav-link {{ $current_page == 'Assets-names' || $current_page == 'Price-Percentage' || $current_page == 'Payment-Method' || $current_page == 'Units' || $current_page == 'Branch' || $current_page == 'Notification' || $current_page == 'Expense-Category' || $current_page == 'Permissions-Delete' || $current_page == 'Permissions' || $current_page == 'Documentation' || $current_page == 'Terms-and-Conditions' || $current_page == 'Privacy-Policy' || $current_page == 'saveFaqs' || $current_page == 'Contact-Settings' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Settings
                                    <i class="fas fa-angle-left right"></i>
                                    <span class="badge badge-danger right">Add</span>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li
                                    class="nav-item {{ $current_page == 'Permissions-Delete' || $current_page == 'Permissions' ? 'menu-open' : '' }}">
                                    <a href="#"
                                        class="nav-link {{ $current_page == 'Permissions-Delete' || $current_page == 'Permissions' ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-circle text-info"></i>
                                        <p>Permissions
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="/Permissions"
                                                class="nav-link {{ $current_page == 'Permissions' ? 'active' : '' }}">
                                                <i class="far fa-circle nav-icon text-info"></i>
                                                <p>Create New</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="/Permissions-Delete"
                                                class="nav-link {{ $current_page == 'Permissions-Delete' ? 'active' : '' }}">
                                                <i class="far fa-circle nav-icon text-danger"></i>
                                                <p>Delete</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('Branch') }}"
                                        class="nav-link {{ $current_page == 'Branch' ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-circle text-info"></i>
                                        <p>Branch</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('Units') }}"
                                        class="nav-link {{ $current_page == 'Units' ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-circle text-info"></i>
                                        <p>Units</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('Payment-Method') }}"
                                        class="nav-link {{ $current_page == 'Payment-Method' ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-circle text-info"></i>
                                        <p>Payment Method</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('Price-Percentage') }}"
                                        class="nav-link {{ $current_page == 'Price-Percentage' ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-circle text-info"></i>
                                        <p>Price Percentage</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('Expense-Category') }}"
                                        class="nav-link {{ $current_page == 'Expense-Category' ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-circle text-info"></i>
                                        <p>Expense Category</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('Assets-names') }}"
                                        class="nav-link {{ $current_page == 'Assets-names' ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-circle text-info"></i>
                                        <p>Asset Items</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('Contact-Settings') }}"
                                        class="nav-link {{ $current_page == 'Contact-Settings' ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-circle text-info"></i>
                                        <p>Contacts</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('Notification') }}"
                                        class="nav-link {{ $current_page == 'Notification' ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-circle text-info"></i>
                                        <p>Notifications</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/saveFaqs"
                                        class="nav-link {{ $current_page == 'saveFaqs' ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-circle text-info"></i>
                                        <p>FAQs</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="/Privacy-Policy"
                                        class="nav-link {{ $current_page == 'Privacy-Policy' ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-circle text-info"></i>
                                        <p>Privacy Policy</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="/Terms-and-Conditions"
                                        class="nav-link {{ $current_page == 'Terms-and-Conditions' ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-circle text-info"></i>
                                        <p>Terms & Conditions</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="/Documentation"
                                        class="nav-link {{ $current_page == 'Documentation' ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-circle text-info"></i>
                                        <p>Documentation </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    <li
                        class="nav-item {{ $current_page == 'Devidends' ||$current_page == 'Money-Transfer' ||$current_page == 'Capital' ||$current_page == 'Assets-Balance' ||$current_page == 'Damaged-Assets-Register' ||$current_page == 'Assets-Register' ||$current_page == 'Clear-Supplier-Account' ||$current_page == 'Tax-Invoice' ||$current_page == 'Proforma-Invoice' ||$current_page == 'Damages' ||$current_page == 'Sales-Return' ||$current_page == 'Clear-Client-Accounts' ||$current_page == 'Other-Incomes' ||$current_page == 'Dashboard' ||$current_page == 'Client-Account' ||$current_page == 'Create-Product' ||$current_page == 'Return-To-Supplier' ||$current_page == 'Distribute' ||$current_page == 'Add-Purchases' ||$current_page == 'Supplier-Account' ||$current_page == 'Staff-Attendance' ||$current_page == 'Expense-Entry' ||$current_page == 'Staff-Payment' ||$current_page == 'Create-Staff' ||$current_page == 'Account-Delete' ||$current_page == 'Account-update' ||$current_page == 'Account-Creation'? 'menu-open': '' }}">
                        <a href="#"
                            class="nav-link {{ $current_page == 'Devidends' ||$current_page == 'Money-Transfer' ||$current_page == 'Capital' ||$current_page == 'Assets-Balance' ||$current_page == 'Damaged-Assets-Register' ||$current_page == 'Assets-Register' ||$current_page == 'Clear-Supplier-Account' ||$current_page == 'Tax-Invoice' ||$current_page == 'Proforma-Invoice' ||$current_page == 'Damages' ||$current_page == 'Sales-Return' ||$current_page == 'Clear-Client-Accounts' ||$current_page == 'Other-Incomes' ||$current_page == 'Dashboard' ||$current_page == 'Client-Account' ||$current_page == 'Create-Product' ||$current_page == 'Return-To-Supplier' ||$current_page == 'Distribute' ||$current_page == 'Add-Purchases' ||$current_page == 'Supplier-Account' ||$current_page == 'Staff-Attendance' ||$current_page == 'Expense-Entry' ||$current_page == 'Staff-Payment' ||$current_page == 'Create-Staff' ||$current_page == 'Account-Delete' ||$current_page == 'Account-update' ||$current_page == 'Account-Creation'? 'active': '' }}">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>
                                Forms
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if (
                                $accesssetting->contains('AccountUpdate', 1) ||
                                    $accesssetting->contains('AccountCreation', 1) ||
                                    $accesssetting->contains('AccountDelete', 1))
                                <li
                                    class="nav-item {{ $current_page == 'Account-update' || $current_page == 'Account-Delete' || $current_page == 'Account-Creation' ? 'menu-open' : '' }}">
                                    <a href="#"
                                        class="nav-link {{ $current_page == 'Account-update' || $current_page == 'Account-Delete' || $current_page == 'Account-Creation' ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-circle text-info"></i>
                                        <p>Account Creation
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        @if ($accesssetting->contains('AccountCreation', 1))
                                            <li class="nav-item">
                                                <a href="{{ route('Account-Creation') }}"
                                                    class="nav-link {{ $current_page == 'Account-Creation' ? 'active' : '' }}">
                                                    <i class="far fa-circle nav-icon text-info"></i>
                                                    <p>Create New</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if ($accesssetting->contains('AccountUpdate', 1))
                                            <li class="nav-item">
                                                <a href="{{ route('Account-Update') }}"
                                                    class="nav-link {{ $current_page == 'Account-update' ? 'active' : '' }}">
                                                    <i class="far fa-circle nav-icon text-warning"></i>
                                                    <p>Update</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if ($accesssetting->contains('AccountDelete', 1))
                                            <li class="nav-item">
                                                <a href="{{ route('Account-Delete') }}"
                                                    class="nav-link {{ $current_page == 'Account-Delete' ? 'active' : '' }}">
                                                    <i class="far fa-circle nav-icon text-danger"></i>
                                                    <p>Delete</p>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </li>
                            @endif
                            @if ($accesssetting->contains('HumanResource', 1))
                                <li
                                    class="nav-item {{ $current_page == 'Staff-Attendance' || $current_page == 'Create-Staff' || $current_page == 'Staff-Payment' ? 'menu-open' : '' }}">
                                    <a href="#"
                                        class="nav-link {{ $current_page == 'Staff-Attendance' || $current_page == 'Create-Staff' || $current_page == 'Staff-Payment' ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-circle text-info"></i>
                                        <p>Staff
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        @if ($accesssetting->contains('HumanResource', 1))
                                            <li class="nav-item">
                                                <a href="{{ route('Create-Staff') }}"
                                                    class="nav-link {{ $current_page == 'Create-Staff' ? 'active' : '' }}">
                                                    <i class="far fa-circle nav-icon text-info"></i>
                                                    <p>Staff Registration</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{ route('Staff-Payment') }}"
                                                    class="nav-link {{ $current_page == 'Staff-Payment' ? 'active' : '' }}">
                                                    <i class="far fa-circle nav-icon text-info"></i>
                                                    <p>Staff Payment</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{ route('Staff-Attendance') }}"
                                                    class="nav-link {{ $current_page == 'Staff-Attendance' ? 'active' : '' }}">
                                                    <i class="far fa-circle nav-icon text-info"></i>
                                                    <p>Staff Attendance</p>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </li>
                            @endif

                            @if ($accesssetting->contains('AddPurchases', 1) || $accesssetting->contains('ClearCreditors', 1))
                                <li
                                    class="nav-item {{ $current_page == 'Clear-Supplier-Account' || $current_page == 'Create-Product' || $current_page == 'Add-Purchases' || $current_page == 'Distribute' || $current_page == 'Return-To-Supplier' || $current_page == 'Supplier-Account' ? 'menu-open' : '' }}">
                                    <a href="#"
                                        class="nav-link {{ $current_page == 'Clear-Supplier-Account' || $current_page == 'Create-Product' || $current_page == 'Add-Purchases' || $current_page == 'Distribute' || $current_page == 'Return-To-Supplier' || $current_page == 'Supplier-Account' ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-circle text-info"></i>
                                        <p>Store
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        @if ($accesssetting->contains('ClearCreditors', 1))
                                            <li class="nav-item">
                                                <a href="{{ route('Supplier-Account') }}"
                                                    class="nav-link {{ $current_page == 'Supplier-Account' ? 'active' : '' }}">
                                                    <i class="far fa-circle nav-icon text-info"></i>
                                                    <p>Supplier Account</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if ($accesssetting->contains('AddPurchases', 1))
                                            <li class="nav-item">
                                                <a href="{{ route('Create-Product') }}"
                                                    class="nav-link {{ $current_page == 'Create-Product' ? 'active' : '' }}">
                                                    <i class="far fa-circle nav-icon text-info"></i>
                                                    <p>Create Product</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{ route('Add-Purchases') }}"
                                                    class="nav-link {{ $current_page == 'Add-Purchases' ? 'active' : '' }}">
                                                    <i class="far fa-circle nav-icon text-info"></i>
                                                    <p>Purchase</p>
                                                </a>
                                            </li>

                                            <li class="nav-item">
                                                <a href="{{ route('Distribute') }}"
                                                    class="nav-link {{ $current_page == 'Distribute' ? 'active' : '' }}">
                                                    <i class="far fa-circle nav-icon text-info"></i>
                                                    <p>Distribute</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{ route('Return-To-Supplier') }}"
                                                    class="nav-link {{ $current_page == 'Return-To-Supplier' ? 'active' : '' }}">
                                                    <i class="far fa-circle nav-icon text-info"></i>
                                                    <p>Return</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{ route('Clear-Supplier-Account') }}"
                                                    class="nav-link {{ $current_page == 'Clear-Supplier-Account' ? 'active' : '' }}">
                                                    <i class="far fa-circle nav-icon text-info"></i>
                                                    <p>Clear Supplier Account</p>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </li>
                            @endif

                            @if (
                                $accesssetting->contains('ClientAccount', 1) ||
                                    $accesssetting->contains('SalesSummary', 1) ||
                                    $accesssetting->contains('SalesRecords', 1) ||
                                    $accesssetting->contains('AddPurchases', 1))
                                <li
                                    class="nav-item {{ $current_page == 'Tax-Invoice' || $current_page == 'Clear-Client-Accounts' || $current_page == 'Other-Incomes' || $current_page == 'Dashboard' || $current_page == 'Proforma-Invoice' || $current_page == 'Damages' || $current_page == 'Sales-Return' || $current_page == 'Client-Account' ? 'menu-open' : '' }}">
                                    <a href="#"
                                        class="nav-link {{ $current_page == 'Tax-Invoice' || $current_page == 'Clear-Client-Accounts' || $current_page == 'Other-Incomes' || $current_page == 'Dashboard' || $current_page == 'Proforma-Invoice' || $current_page == 'Damages' || $current_page == 'Sales-Return' || $current_page == 'Client-Account' ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-circle text-info"></i>
                                        <p>Business
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        @if ($accesssetting->contains('ClientAccount', 1))
                                            <li class="nav-item">
                                                <a href="{{ route('Client-Account') }}"
                                                    class="nav-link {{ $current_page == 'Client-Account' ? 'active' : '' }}">
                                                    <i class="far fa-circle nav-icon text-info"></i>
                                                    <p>Client Account</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if ($accesssetting->contains('SalesRecords', 1))
                                            <li class="nav-item">
                                                <a href="{{ route('Sales-Return') }}"
                                                    class="nav-link {{ $current_page == 'Sales-Return' ? 'active' : '' }}">
                                                    <i class="far fa-circle nav-icon text-info"></i>
                                                    <p>Sales Return</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if ($accesssetting->contains('ClientAccount', 1))
                                            <li class="nav-item">
                                                <a href="{{ route('Clear-Client-Accounts') }}"
                                                    class="nav-link {{ $current_page == 'Clear-Client-Accounts' ? 'active' : '' }}">
                                                    <i class="far fa-circle nav-icon text-info"></i>
                                                    <p>Clear Client Accounts</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if ($accesssetting->contains('AddPurchases', 1))
                                            <li class="nav-item">
                                                <a href="{{ route('Damages') }}"
                                                    class="nav-link {{ $current_page == 'Damages' ? 'active' : '' }}">
                                                    <i class="far fa-circle nav-icon text-info"></i>
                                                    <p>Damages</p>
                                                </a>
                                            </li>
                                        @endif
                                        <li class="nav-item">
                                            <a href="{{ route('Tax-Invoice') }}"
                                                class="nav-link {{ $current_page == 'Tax-Invoice' ? 'active' : '' }}">
                                                <i class="far fa-circle nav-icon text-info"></i>
                                                <p>Tax Invoice</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('Proforma-Invoice') }}"
                                                class="nav-link {{ $current_page == 'Proforma-Invoice' ? 'active' : '' }}">
                                                <i class="far fa-circle nav-icon text-info"></i>
                                                <p>Proforma Invoice</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                            @if ($accesssetting->contains('Expenses', 1))
                                <li class="nav-item">
                                    <a href="{{ route('Other-Incomes') }}"
                                        class="nav-link {{ $current_page == 'Other-Incomes' ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-circle text-info"></i>
                                        <p>Other Incomes</p>
                                    </a>
                                </li>
                            @endif
                            @if ($accesssetting->contains('Expenses', 1))
                                <li class="nav-item">
                                    <a href="{{ route('Expense-Entry') }}"
                                        class="nav-link {{ $current_page == 'Expense-Entry' ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-circle text-info"></i>
                                        <p>Expenses</p>
                                    </a>
                                </li>
                            @endif
                            @if ($accesssetting->contains('AddPurchases', 1))
                                <li
                                    class="nav-item {{ $current_page == 'Assets-Balance' || $current_page == 'Damaged-Assets-Register' || $current_page == 'Assets-Register' ? 'menu-open' : '' }}">
                                    <a href="#"
                                        class="nav-link {{ $current_page == 'Assets-Balance' || $current_page == 'Damaged-Assets-Register' || $current_page == 'Assets-Register' ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-circle text-info"></i>
                                        <p>Assets
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ route('Assets-Register') }}"
                                                class="nav-link {{ $current_page == 'Assets-Register' ? 'active' : '' }}">
                                                <i class="far fa-circle nav-icon text-info"></i>
                                                <p>Assets Register</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('Damaged-Assets-Register') }}"
                                                class="nav-link {{ $current_page == 'Damaged-Assets-Register' ? 'active' : '' }}">
                                                <i class="far fa-circle nav-icon text-info"></i>
                                                <p>Damaged Asset</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('Assets-Balance') }}"
                                                class="nav-link {{ $current_page == 'Assets-Balance' ? 'active' : '' }}">
                                                <i class="far fa-circle nav-icon text-info"></i>
                                                <p>Asset Numbers</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                            @if ($accesssetting->contains('MoneyTransfer', 1))
                                <li class="nav-item">
                                    <a href="{{ route('Capital') }}"
                                        class="nav-link {{ $current_page == 'Capital' ? 'active' : '' }}">
                                        <i class="fas fa-circle nav-icon text-info"></i>
                                        <p>Capital</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('Money-Transfer') }}"
                                        class="nav-link {{ $current_page == 'Money-Transfer' ? 'active' : '' }}">
                                        <i class="fas fa-circle nav-icon text-info"></i>
                                        <p>Money Transfer</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('Devidends') }}"
                                        class="nav-link {{ $current_page == 'Devidends' ? 'active' : '' }}">
                                        <i class="fas fa-circle nav-icon text-info"></i>
                                        <p>Devidends</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>

                    @if (
                        $accesssetting->contains('Records', 1) ||
                            $accesssetting->contains('SalesRecords', 1) ||
                            $accesssetting->contains('StockBalance', 1))
                        <li
                            class="nav-item {{ $current_page == 'Branch-Balance-Records' || $current_page == 'Store-Balance-Records' || $current_page == 'Damages-Records' || $current_page == 'Client-Account-Transactions-Records' || $current_page == 'Sales-Returns-Records' || $current_page == 'Supplier-Account-Transaction-Records' || $current_page == 'Purchase-From-Supplier-Records' || $current_page == 'Returned-To-Supplier-Records' || $current_page == 'Distribution-Records' || $current_page == 'Purchases-Records' || $current_page == 'Payment-Records' || $current_page == 'Sales-Records' || $current_page == 'Client-Records'|| $current_page == 'Other-Incomes-Records' || $current_page == 'Expense-Records' || $current_page == 'Staff-Payment-Records' || $current_page == 'Staff-Records' || $current_page == 'User-Account-Records' ? 'menu-open' : '' }}">
                            <a href="#"
                                class="nav-link {{ $current_page == 'Branch-Balance-Records' || $current_page == 'Store-Balance-Records' || $current_page == 'Damages-Records' || $current_page == 'Client-Account-Transactions-Records' || $current_page == 'Sales-Returns-Records' || $current_page == 'Supplier-Account-Transaction-Records' || $current_page == 'Purchase-From-Supplier-Records' || $current_page == 'Returned-To-Supplier-Records' || $current_page == 'Distribution-Records' || $current_page == 'Purchases-Records' || $current_page == 'Payment-Records' || $current_page == 'Sales-Records'|| $current_page == 'Client-Records' || $current_page == 'Other-Incomes-Records' || $current_page == 'Expense-Records' || $current_page == 'Staff-Records' || $current_page == 'Student-Payment-Records' || $current_page == 'User-Account-Records' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-table"></i>
                                <p>
                                    Records
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @if ($accesssetting->contains('AccountCreation', 1))
                                    <li class="nav-item">
                                        <a href="{{ route('User-Account-Records') }}"
                                            class="nav-link {{ $current_page == 'User-Account-Records' ? 'active' : '' }}">
                                            <i class="nav-icon fas fa-circle text-info"></i>
                                            <p>Account
                                            </p>
                                        </a>
                                    </li>
                                @endif
                                @if ($accesssetting->contains('Records', 1))
                                    <li class="nav-item">
                                        <a href="{{ route('Staff-Records') }}"
                                            class="nav-link  {{ $current_page == 'Staff-Records' ? 'active' : '' }}">
                                            <i class="nav-icon fas fa-circle text-info"></i>
                                            <p>
                                                Staff
                                            </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('Staff-Payment-Records') }}"
                                            class="nav-link  {{ $current_page == 'Staff-Payment-Records' ? 'active' : '' }}">
                                            <i class="nav-icon fas fa-circle text-info"></i>
                                            <p>
                                                Staff Payment
                                            </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('Expense-Records') }}"
                                            class="nav-link  {{ $current_page == 'Expense-Records' ? 'active' : '' }}">
                                            <i class="nav-icon fas fa-circle text-info"></i>
                                            <p>
                                                Expense Records
                                            </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('Other-Incomes-Records') }}"
                                            class="nav-link  {{ $current_page == 'Other-Incomes-Records' ? 'active' : '' }}">
                                            <i class="nav-icon fas fa-circle text-info"></i>
                                            <p>
                                                Other Incomes Records
                                            </p>
                                        </a>
                                    </li>
                                @endif
                                @if ($accesssetting->contains('SalesRecords', 1))
                                    <li class="nav-item">
                                        <a href="{{ route('Sales-Records') }}"
                                            class="nav-link  {{ $current_page == 'Sales-Records' ? 'active' : '' }}">
                                            <i class="nav-icon fas fa-circle text-info"></i>
                                            <p>
                                                Sales Records
                                            </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('Client-Records') }}"
                                            class="nav-link  {{ $current_page == 'Client-Records' ? 'active' : '' }}">
                                            <i class="nav-icon fas fa-circle text-info"></i>
                                            <p>
                                                Clients Records
                                            </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('Payment-Records') }}"
                                            class="nav-link  {{ $current_page == 'Payment-Records' ? 'active' : '' }}">
                                            <i class="nav-icon fas fa-circle text-info"></i>
                                            <p>
                                                Payment Records
                                            </p>
                                        </a>
                                    </li>
                                @endif
                                <li class="nav-item">
                                    <a href="{{ route('Purchases-Records') }}"
                                        class="nav-link  {{ $current_page == 'Purchases-Records' ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-circle text-info"></i>
                                        <p>
                                            Purchases Records
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('Distribution-Records') }}"
                                        class="nav-link  {{ $current_page == 'Distribution-Records' ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-circle text-info"></i>
                                        <p>
                                            Distribution Records
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('Returned-To-Supplier-Records') }}"
                                        class="nav-link  {{ $current_page == 'Returned-To-Supplier-Records' ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-circle text-info"></i>
                                        <p>
                                            Returns To Supplier
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('Purchase-From-Supplier-Records') }}"
                                        class="nav-link  {{ $current_page == 'Purchase-From-Supplier-Records' ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-circle text-info"></i>
                                        <p>
                                            Supplies Clearance
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('Supplier-Account-Transaction-Records') }}"
                                        class="nav-link  {{ $current_page == 'Supplier-Account-Transaction-Records' ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-circle text-info"></i>
                                        <p>
                                            Supplier Transactions
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('Sales-Returns-Records') }}"
                                        class="nav-link  {{ $current_page == 'Sales-Returns-Records' ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-circle text-info"></i>
                                        <p>
                                            Sales Returns
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('Client-Account-Transactions-Records') }}"
                                        class="nav-link  {{ $current_page == 'Client-Account-Transactions-Records' ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-circle text-info"></i>
                                        <p>
                                            Client Transactions
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('Damages-Records') }}"
                                        class="nav-link  {{ $current_page == 'Damages-Records' ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-circle text-info"></i>
                                        <p>
                                            Damages Records
                                        </p>
                                    </a>
                                </li>
                                @if ($accesssetting->contains('StockBalance', 1))
                                    <li class="nav-item">
                                        <a href="{{ route('Branch-Balance-Records') }}"
                                            class="nav-link  {{ $current_page == 'Branch-Balance-Records' ? 'active' : '' }}">
                                            <i class="nav-icon fas fa-circle text-info"></i>
                                            <p>
                                                Branch Stock
                                            </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('Store-Balance-Records') }}"
                                            class="nav-link  {{ $current_page == 'Store-Balance-Records' ? 'active' : '' }}">
                                            <i class="nav-icon fas fa-circle text-info"></i>
                                            <p>
                                                Store Stock
                                            </p>
                                        </a>
                                    </li>
                                @endif

                            </ul>
                        </li>
                    @endif

                    @if ($accesssetting->contains('Reports', 1))
                        <li
                            class="nav-item {{$current_page == 'Balance-Sheet'|| $current_page == 'Trial-balance' || $current_page == 'Income-Statement' ? 'menu-open' : '' }}">
                            <a href="#"
                                class="nav-link {{$current_page == 'Balance-Sheet'|| $current_page == 'Trial-balance' || $current_page == 'Income-Statement' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>Reports<i class="fas fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">

                                <li class="nav-item">
                                    <a href="{{ route('Income-Statement') }}"
                                        class="nav-link  {{ $current_page == 'Income-Statement' ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-circle text-info"></i>
                                        <p>
                                            Income Statement
                                        </p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('Trial-balance') }}"
                                        class="nav-link  {{ $current_page == 'Trial-balance' ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-circle text-info"></i>
                                        <p>
                                            Trial Balance
                                        </p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('Balance-Sheet') }}"
                                        class="nav-link  {{ $current_page == 'Balance-Sheet' ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-circle text-info"></i>
                                        <p>
                                            Balance Sheet
                                        </p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                    @endif





                    @if ($accesssetting->contains('Analysis', 1))
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>
                                    Analysis
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="pages/charts/chartjs.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Enrollment
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="far fa-dot-circle nav-icon text-info"></i>
                                                <p>Users</p>
                                            </a>
                                        </li>

                                    </ul>
                                </li>

                            </ul>
                        </li>
                    @endif

                    <li class="nav-header">Others</li>
                    <li class="nav-item">
                        <a href="/Calendar-Component"
                            class="nav-link {{ $current_page == 'Calendar-Component' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-calendar-alt"></i>
                            <p>
                                Events
                                <span class="badge badge-info right">{{ $eventcount }}</span>
                            </p>
                        </a>
                    </li>
                    <li
                        class="nav-item {{ $current_page == 'Create-Blog' || $current_page == 'Profile-Update' ? 'menu-open' : '' }}">
                        <a href="#"
                            class="nav-link {{ $current_page == 'Create-Blog' || $current_page == 'Profile-Update' ? 'active' : '' }}">
                            <i class="nav-icon far fa-plus-square"></i>
                            <p>
                                Extras
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/profile"
                                    class="nav-link {{ $current_page == 'profile' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Profile</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/Profile-Update"
                                    class="nav-link {{ $current_page == 'Profile-Update' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Profile Picture</p>
                                </a>
                            </li>
                            @if ($accesssetting->contains('Settings', 1))
                                <li class="nav-item">
                                    <a href="/Create-Blog"
                                        class="nav-link {{ $current_page == 'Create-Blog' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Create Blog</p>
                                    </a>
                                </li>
                            @endif
                        </ul>

                    </li>
                    <li
                        class="nav-item {{ $current_page == 'Staff-Search' || $current_page == 'Enhanced-Search' || $current_page == 'Simple-Search' ? 'menu-open' : '' }}">
                        <a href="#"
                            class="nav-link {{ $current_page == 'Staff-Search' || $current_page == 'Enhanced-Search' || $current_page == 'Simple-Search' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-search"></i>
                            <p>
                                Search
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/Simple-Search"
                                    class="nav-link {{ $current_page == 'Simple-Search' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Search Product</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/Staff-Search"
                                    class="nav-link {{ $current_page == 'Staff-Search' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Search Staff</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <li class="nav-header">MISCELLANEOUS</li>

                    <li class="nav-item">
                        <a href="Dashboard-Documentation"
                            class="nav-link {{ $current_page == 'Dashboard-Documentation' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-file"></i>
                            <p>Documentation</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/FAQs" class="nav-link {{ $current_page == 'FAQs' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-question-circle"></i>
                            <p>FAQ</p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
