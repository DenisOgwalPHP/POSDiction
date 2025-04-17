<div>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Sales Records</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/Dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Sales Records</li>
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
                                <h3 class="card-title">Sales Records Listing</h3>
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Item</th>
                                            <th>Model</th>
                                            <th>Serial No.</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Client Name</th>
                                            <th>NIN</th>
                                            <th>Phone</th>
                                            <th>District</th>
                                            <th>Village</th>
                                            <th>Sold By</th>
                                            <th>Sales Date</th>
                                            @if (Auth::user()->utype == 'General Manager' || Auth::user()->utype == 'Administrator')
                                                <th>Branch</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($registeredsales as $registeredsale)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $registeredsale->soldproduct->ProductName }}</td>
                                                <td>{{ $registeredsale->soldproduct->Weight }}</td>
                                                <td>{{ $registeredsale->salesaccount->SerialNo }}</td>
                                                <td>{{ $registeredsale->Quantity }}</td>
                                                <td>{{ $registeredsale->Price }}</td>
                                                <td>{{ $registeredsale->salesaccount->AccountName}} {{ $registeredsale->salesaccount->AccountName2}} </td>
                                                <td>{{ $registeredsale->salesaccount->TINnumber }}</td>
                                                <td>{{ $registeredsale->salesaccount->ContactNo}}</td>
                                                <td>{{ $registeredsale->salesaccount->District }}</td>
                                                <td>{{ $registeredsale->salesaccount->Village}}</td>


                                                <td>{{ $registeredsale->registrar->name }}</td>
                                                <td>{{ $registeredsale->created_at }}</td>
                                                @if (Auth::user()->utype == 'General Manager' || Auth::user()->utype == 'Administrator')
                                                    <td>{{ $registeredsale->salesbranch->BranchName }}</td>
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
