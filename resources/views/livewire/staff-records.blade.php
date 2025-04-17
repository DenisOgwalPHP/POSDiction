<div>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Staff Records</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/admin/Dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Staff Records</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Account Records -->
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Staff Record Listing</h3>

                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Staff ID</th>
                                            <th>Staff Name</th>
                                            <th>Initials</th>
                                            <th>Gender</th>
                                            <th>DOB</th>
                                            <th>Address</th>
                                            <th>Phone Number</th>
                                            <th>Email</th>
                                            <th>Department</th>
                                            <th>Qualifications</th>
                                            <th>Designation</th>
                                            <th>Basic Salary</th>
                                            <th>Account No.</th>
                                            <th>Bank Name</th>
                                            <th>Office No.</th>
                                            @if (Auth::user()->utype == 'General Manager'|| Auth::user()->utype == 'Administrator')
                                            <th>Branch</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($registeredstaffs as $registeredstaff)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $registeredstaff->StaffID }}</td>
                                                <td>{{ $registeredstaff->StaffName }}</td>
                                                <td>{{ $registeredstaff->Initials }}</td>
                                                <td>{{ $registeredstaff->Gender }}</td>
                                                <td>{{ $registeredstaff->DOB }}</td>
                                                <td>{{ $registeredstaff->Address }}</td>
                                                <td>{{ $registeredstaff->PhoneNumber }}</td>
                                                <td>{{ $registeredstaff->Email }}</td>
                                                <td>{{ $registeredstaff->Department }}</td>
                                                <td>{{ $registeredstaff->Qualifications }}</td>
                                                <td>{{ $registeredstaff->Designation }}</td>
                                                <td>{{ $registeredstaff->BasicSalary }}</td>
                                                <td>{{ $registeredstaff->AccountNo }}</td>
                                                <td>{{ $registeredstaff->BankName }}</td>
                                                <td>{{ $registeredstaff->OfficeNo }}</td>
                                                @if (Auth::user()->utype == 'General Manager'|| Auth::user()->utype == 'Administrator')
                                                <td>{{ $registeredstaff->staffbranch->BranchName }}</td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </div>
</div>
<!-- Page specific script -->
@push('scripts')
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endpush
