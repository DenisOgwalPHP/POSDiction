<!DOCTYPE html>
<html lang="en-US">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta name="Description" content="E-health" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Essential POS</title>
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{ asset('dist/img/Asset 4.png') }}" />
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- fullCalendar -->
    <link rel="stylesheet" href="{{ asset('plugins/fullcalendar/main.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
    <!-- CodeMirror -->
    <link rel="stylesheet" href="{{ asset('plugins/codemirror/codemirror.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/codemirror/theme/monokai.css') }}">

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
    <!-- BS Stepper -->
    <link rel="stylesheet" href="{{ asset('plugins/bs-stepper/css/bs-stepper.min.css') }}">
    <!-- dropzonejs -->
    <link rel="stylesheet" href="{{ asset('plugins/dropzone/min/dropzone.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    <style type="text/css">
        .swal2-html-container,
        .swal2-title {
            color: white !important;
        }
        </style>
        <style type="text/css">
     #loading-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent white background */
      z-index: 9999;
      display: none; /* Initially hidden */
    }
    input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type="number"] {
            -moz-appearance: textfield;
        }
    
    #loading-progress {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 200px; /* Adjust size as needed */
      height: 20px; /* Adjust size as needed */
      background-color: #ccc; /* Background color of progress bar */
      border-radius: 5px; /* Rounded corners */
    }
    
    #loading-progress .progress-bar {
      height: 100%;
      background-color: #4caf50; /* Progress bar color */
      width: 0; /* Initial width */
      border-radius: 5px; /* Rounded corners */
      transition: width 0.5s ease; /* Smooth animation */
    }
    </style>
   
    @livewireStyles
    
</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="{{ asset('dist/img/Asset 6.png') }}" alt="Essential POS"
                height="100" width="100">
        </div>
        <!-- Header -->
        @livewire('header-component')
        <!-- Header End-->

        {{ $slot }}

        <!-- Footer -->
        @livewire('footer-component')
        <!-- Footer End-->

    </div>
    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('plugins/fullcalendar/main.js') }}"></script>

    <!-- bs-custom-file-input -->
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>

    <!-- PAGE PLUGINS -->
    <!-- jQuery Mapael -->
    <script src="{{ asset('plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
    <script src="{{ asset('plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>

    <!-- DataTables  & Plugins -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <!-- Summernote -->
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- CodeMirror -->
    <script src="{{ asset('plugins/codemirror/codemirror.js') }}"></script>
    <script src="{{ asset('plugins/codemirror/mode/css/css.js') }}"></script>
    <script src="{{ asset('plugins/codemirror/mode/xml/xml.js') }}"></script>
    <script src="{{ asset('plugins/codemirror/mode/htmlmixed/htmlmixed.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- date-range-picker -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="{{ asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
    <!-- InputMask -->
    <script src="{{ asset('plugins/inputmask/jquery.inputmask.min.js') }}"></script>
    <!-- bootstrap color picker -->
    <script src="{{ asset('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Bootstrap Switch -->
    <script src="{{ asset('plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
    <!-- BS-Stepper -->
    <script src="{{ asset('plugins/bs-stepper/js/bs-stepper.min.js') }}"></script>
    <!-- dropzonejs -->
    <script src="{{ asset('plugins/dropzone/min/dropzone.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- Toastr -->
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
    <script>
        var Toast1 = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            background: 'rgb(243,153,31)',
            timer: 5000
        });
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            color: '#000000',
            background: 'rgb(52, 152, 219)',
            timer: 5000,
            customClass: {
                title: 'swal2-title'
            }
        });
        var Toast2 = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            background: 'rgb(220,53,69)',
            timer: 5000
            
        });
        @if (Session::has('patsuc'))
            Toast1.fire('Success', 'Patient Personal Information Updated successfully', 'success');
        @endif
        @if (Session::has('accountcreate'))
            Toast.fire('Success', 'Account has been created Successfully', 'success');
        @endif
        @if (Session::has('accountdelete'))
            Toast2.fire('Success', 'Account has been created Successfully', 'success');
        @endif
        @if (Session::has('accountupdate'))
            Toast1.fire('Success', 'Account has been Updated Successfully', 'success');
        @endif
        @if (Session::has('createcontact'))
            Toast.fire('Success', 'Settings saved successfully', 'success');
        @endif
        @if (Session::has('createpermission'))
            Toast.fire('Success', 'Permissions saved successfully', 'success');
        @endif
        @if (Session::has('createdocumentation'))
            Toast.fire('Success', 'Documentation saved successfully', 'success');
        @endif
        @if (Session::has('createfaq'))
            Toast.fire('Success', 'FAQs saved successfully', 'success');
        @endif
        @if (Session::has('permissiondelete'))
            Toast2.fire('Success', 'Permission has been deleted successfully', 'success');
        @endif
        @if (Session::has('permissiondeletefail'))
            Toast.fire('Success', 'Permission has not yet been added', 'error');
        @endif
        @if (Session::has('createprivacypolicy'))
            Toast.fire('Success', 'Privacy Policy saved successfully', 'success');
        @endif
        @if (Session::has('createtandcs'))
            Toast.fire('Success', 'Terms and Conditions saved successfully', 'success');
        @endif
        @if (Session::has('eventcreate'))
            Toast.fire('Success', 'Event has been posted Successfully', 'success');
        @endif
        @if (Session::has('addblog'))
            Toast.fire('Success', 'Blog has been created Successfully', 'success');
        @endif
        @if (Session::has('deleteblog'))
            Toast2.fire('Success', 'Blog has been deleted successfully', 'success');
        @endif
        @if (Session::has('editblogs'))
            Toast1.fire('Success', 'Blog has been Edited Successfully', 'success');
        @endif
        @if (Session::has('Notification'))
            Toast.fire('Success', 'Notification has been deleted successfully', 'success');
        @endif
        @if (Session::has('searchcase'))
            Toast.fire('Success', 'Product Information Displayed successfully', 'success');
        @endif
        @if (Session::has('searchstaff'))
            Toast.fire('Success', 'Staff Information Displayed successfully', 'success');
        @endif
        @if (Session::has('staffregister'))
            Toast.fire('Success', 'Staff saved successfully', 'success');
        @endif
        @if (Session::has('staffdelete'))
            Toast2.fire('Success', 'Staff has been deleted successfully', 'success');
        @endif
        @if (Session::has('staffpaymentregister'))
            Toast.fire('Success', 'Staff Payment saved successfully', 'success');
        @endif
        @if (Session::has('staffpaymentdelete'))
            Toast2.fire('Success', 'Staff Payment has been deleted successfully', 'success');
        @endif
        @if (Session::has('attendancecreate'))
            Toast.fire('Success', 'Attendance saved successfully', 'success');
        @endif
        @if (Session::has('patusrupdate'))
            Toast.fire('Success', 'User Account has been updated successfully', 'success');
        @endif
        @if (Session::has('expensecategoryregister'))
            Toast.fire('Success', 'Expense Category successfully Registered', 'success');
        @endif
        @if (Session::has('branchregister'))
            Toast.fire('Success', 'Branch successfully Registered', 'success');
        @endif
        @if (Session::has('unitregister'))
            Toast.fire('Success', 'Unit successfully Registered', 'success');
        @endif
       
        @if (Session::has('productcreate'))
            Toast.fire('Success', 'Product has been Added Successfully', 'success');
        @endif
        @if (Session::has('distributioncreate'))
            Toast.fire('Success', 'Distribution Made Successfully', 'success');
        @endif
        @if (Session::has('returncreate'))
            Toast.fire('Success', 'Return Made Successfully', 'success');
        @endif
        @if (Session::has('purchasecreate'))
            Toast.fire('Success', 'Product has been Added Successfully', 'success');
        @endif
        @if (Session::has('expensecategorydelete'))
            Toast2.fire('Success', 'Expense Category Deleted', 'success');
        @endif
        @if (Session::has('branchdelete'))
            Toast2.fire('Success', 'Branch Deleted', 'success');
        @endif
        @if (Session::has('unitdelete'))
            Toast2.fire('Success', 'Unit Deleted', 'success');
        @endif
        @if (Session::has('addnotification'))
            Toast.fire('Success', 'Notification saved successfully', 'success');
        @endif
        @if (Session::has('nexttermdelete'))
            Toast2.fire('Success', 'Next Term has been deleted successfully', 'success');
        @endif
        @if (Session::has('supplieraccountregister'))
            Toast.fire('Success', 'Supplier Account saved successfully', 'success');
        @endif
        @if (Session::has('supplieraccountdelete'))
            Toast2.fire('Success', 'Supplier Account has been deleted successfully', 'success');
        @endif
        @if (Session::has('smsaccountregister'))
            Toast.fire('Success', 'SMS Account saved successfully', 'success');
        @endif
        @if (Session::has('smsaccountdelete'))
            Toast2.fire('Success', 'SMS Account has been deleted successfully', 'success');
        @endif

        @if (Session::has('smsregister'))
            Toast.fire('Success', 'Message saved successfully', 'success');
        @endif
        @if (Session::has('messagedelete'))
            Toast2.fire('Success', 'Message has been deleted successfully', 'success');
        @endif
        @if (Session::has('itempurchase'))
            Toast.fire('Success', 'Item Purchase saved successfully', 'success');
        @endif
        @if (Session::has('purchaseitemdelete'))
            Toast2.fire('Success', 'Item Purchase has been deleted successfully', 'success');
        @endif

        @if (Session::has('productregister'))
            Toast.fire('Success', 'Item saved successfully', 'success');
        @endif
        @if (Session::has('productdelete'))
            Toast2.fire('Success', 'Item has been deleted successfully', 'success');
        @endif

        @if (Session::has('itemusage'))
            Toast.fire('Success', 'Item Usage saved successfully', 'success');
        @endif
        @if (Session::has('usageitemdelete'))
            Toast2.fire('Success', 'Item Usage has been deleted successfully', 'success');
        @endif

        @if (Session::has('clientaccountregister'))
            Toast.fire('Success', 'Client Account saved successfully', 'success');
        @endif
        @if (Session::has('clientaccountdelete'))
            Toast2.fire('Success', 'Client Account has been deleted successfully', 'success');
        @endif

        @if (Session::has('methodregister'))
            Toast.fire('Success', 'Payment Method saved successfully', 'success');
        @endif
        @if (Session::has('methoddelete'))
            Toast2.fire('Success', 'Payment Method has been deleted successfully', 'success');
        @endif

        @if (Session::has('sellitems'))
            Toast.fire('Success', 'Sale has been Added Successfully', 'success');
        @endif

        @if (Session::has('clearclient'))
            Toast.fire('Success', 'Client Account Transaction Successfully', 'success');
        @endif
        @if (Session::has('clearsupplier'))
            Toast.fire('Success', 'Supplier Account Transaction Successfully', 'success');
        @endif

        @if (Session::has('damageremoved'))
            Toast.fire('Success', 'Damage Removed Successfully', 'success');
        @endif
        @if (Session::has('incomeregister'))
            Toast.fire('Success', 'Other Income Payment saved successfully', 'success');
        @endif
        @if (Session::has('incomedelete'))
            Toast2.fire('Success', 'Other Income has been deleted successfully', 'success');
        @endif
        @if (Session::has('proformageneration'))
            Toast.fire('Success', 'Invoice generated Successfully', 'success');
        @endif
        @if (Session::has('percentageregister'))
            Toast.fire('Success', 'Price Percentage saved successfully', 'success');
        @endif
        @if (Session::has('percentagedelete'))
            Toast2.fire('Success', 'Price Percentage has been deleted successfully', 'success');
        @endif
        @if (Session::has('productdelete'))
            Toast2.fire('Success', 'Product has been deleted successfully', 'success');
        @endif
        @if (Session::has('capitalsave'))
            Toast.fire('Success', 'Capital saved successfully', 'success');
        @endif
        @if (Session::has('capitaldelete'))
            Toast2.fire('Success', 'Capital has been deleted successfully', 'success');
        @endif
        @if (Session::has('moneytransfersave'))
            Toast.fire('Success', 'Money Transfer saved successfully', 'success');
        @endif
        @if (Session::has('moneytransferdelete'))
            Toast2.fire('Success', 'Money Transfer has been deleted successfully', 'success');
        @endif
        @if (Session::has('devidendssave'))
            Toast.fire('Success', 'Devidends saved successfully', 'success');
        @endif
        @if (Session::has('devidendsdelete'))
            Toast2.fire('Success', 'Devidends have been deleted successfully', 'success');
        @endif
    </script>
    @livewireScripts
    @stack('scripts')
</body>

</html>
