<div>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content mb-3">
            <div class="container-fluid">
                <h2 class="text-center display-4">Search</h2>


                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <form wire:submit.prevent="MakeSearch">
                            <div class="input-group">
                                <input type="search" wire:model="search" class="form-control form-control-lg"
                                    placeholder="Type your keywords here e.g Staff Name or ID or Designation or Initials">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-lg btn-default">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>


        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    @if ($registeredstaffs)
                        @if ($registeredstaffs->count() > 0)
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
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </div>
                        @endif
                    @endif
                </div>

                <div class="row">
                    @if ($registeredstaffpayment)
                        @if ($registeredstaffpayment->count() > 0)
                            <div class="col-md-12">
                                <!-- Account Records -->
                                <div class="card card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">Staff Payment Record Listing</h3>
                                    </div>
                                    <div class="card-body">
                                        <table id="example2" class="table table-bordered table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Staff ID</th>
                                                    <th>Staff Name</th>
                                                    <th>Payment Date</th>
                                                    <th>Paid Months</th>
                                                    <th>Payment Year</th>
                                                    <th>Basic Salary</th>
                                                    <th>Salary Paid</th>
                                                    <th>Payment Method</th>
                                                    <th>Transaction ID</th>
                                                    <th>Payment Notes</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($registeredstaffpayment as $payment)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $payment->StaffID }}</td>
                                                        <td>{{ $payment->hasstaff->StaffName }}</td>
                                                        <td>{{ $payment->PaymentDate }}</td>
                                                        <td>{{ $payment->PaymentMonths }}</td>
                                                        <td>{{ $payment->PaymentYear }}</td>
                                                        <td>{{ $payment->BasicSalary }}</td>
                                                        <td>{{ $payment->SalaryPaid }}</td>
                                                        <td>{{ $payment->PaymentMethod }}</td>
                                                        <td>{{ $payment->id }}</td>
                                                        <td>{!! $payment->PaymentNotes !!}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </div>
                        @endif
                    @endif
                </div>

              

                <div class="row">
                    @if ($registeredexpenses)
                        @if ($registeredexpenses->count() > 0)
                            <div class="col-md-12">
                                <!-- Account Records -->
                                <div class="card card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">Expense Record Listing</h3>
                                    </div>
                                    <div class="card-body">
                                        <table id="example4" class="table table-bordered table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Expense</th>
                                                    <th>Expense Category</th>
                                                    <th>Expense Date</th>
                                                    <th>Expense Cost</th>
                                                    <th>Paid Amount</th>
                                                    <th>Payment Method</th>
                                                    <th>Input By</th>
                                                    <th>Input Date</th>
                                                    <th>Record ID</th>
                                                    <th>Description</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($registeredexpenses as $registeredexpense)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $registeredexpense->Expense }}</td>
                                                        <td>{{ $registeredexpense->ExpenseCategory }}</td>
                                                        <td>{{ $registeredexpense->ExpenseDate }}</td>
                                                        <td>{{ $registeredexpense->ExpenseCost }}</td>
                                                        <td>{{ $registeredexpense->ExpensePaid }}</td>
                                                        <td>{{ $registeredexpense->PaymentMethod }}</td>
                                                        <td>{{ $registeredexpense->hasusers->name }}</td>
                                                        <td>{{ $registeredexpense->created_at }}</td>
                                                        <td>{{ $registeredexpense->id }}</td>
                                                        <td>{!! $registeredexpense->Description !!}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </div>
                        @endif
                    @endif
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
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
            $('#example3').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
            $('#example4').DataTable({
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
