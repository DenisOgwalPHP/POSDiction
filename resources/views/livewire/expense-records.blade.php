<div>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Expense</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/Dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Expense Records</li>
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
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Selection By Date</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>From Date</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-calendar-day"
                                                        aria-hidden="true"></i></span>
                                            </div>
                                            <input type="date" class="form-control" name="datefrom"
                                                placeholder="Date From" wire:model="datefrom">
                                            @error('datefrom')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>To Date</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-calendar-day"
                                                        aria-hidden="true"></i></span>
                                            </div>
                                            <input type="date" class="form-control" name="dateto"
                                                placeholder="Date To" wire:model="dateto">
                                            @error('dateto')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Account Records -->
                        <div class="card card-info" wire:ignore>
                            <div class="card-header">
                                <h3 class="card-title">Expense Record Listing</h3>
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-hover table-striped">
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
                                            @if (Auth::user()->utype == 'General Manager' || Auth::user()->utype == 'Administrator')
                                                <th>Branch</th>
                                            @endif
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
                                                @if (Auth::user()->utype == 'General Manager' || Auth::user()->utype == 'Administrator')
                                                    <td>{{ $registeredexpense->expensesbranch->BranchName }}</td>
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
