<div>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Distribution Records</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/Dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Distribution Records</li>
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
                                <h3 class="card-title">Distribution Records Listing</h3>
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Record ID</th>
                                            <th>Product Name</th>
                                            <th>Model</th>
                                            <th>Origin</th>
                                            <th>Distribution Date</th>
                                            <th>Quantity</th>
                                            <th>Units</th>
                                            <th>Cost Rate</th>
                                            <th>Flow</th>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>Distributed By</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($registereddistribution as $registereddistribute)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $registereddistribute->id}}</td>
                                                <td>{{ $registereddistribute->distributedproduct->ProductName}}</td>
                                                <td>{{ $registereddistribute->distributedproduct->Weight}}</td>
                                                <td>{{ $registereddistribute->distributedproduct->Origin}}</td>
                                                <td>{{ $registereddistribute->DistributionDate}}</td>
                                                <td>{{ $registereddistribute->Quantity}}</td>
                                                <td>{{ $registereddistribute->Units}}</td>
                                                <td>{{ $registereddistribute->StockRate}}</td>
                                                <td>{{ $registereddistribute->Flow}}</td>
                                                @if($registereddistribute->BranchFrom==100)
                                                <td>Central Store</td>
                                                @else
                                                <td>{{ $registereddistribute->supplierbranch->BranchName}}</td>
                                                @endif
                                                <td>{{ $registereddistribute->receiverbranch->BranchName}}</td>
                                                <td>{{ $registereddistribute->registrar->name}}</td>
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
