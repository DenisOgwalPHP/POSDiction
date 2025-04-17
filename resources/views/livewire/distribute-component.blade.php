<div>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Distribute Product</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/Dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Add Distribution</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-6">

                        <!-- Input addon -->
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Input Distribution Details</h3>
                            </div>
                            <div class="card-body">

                                <form action="" class="form-horizontal" enctype="multipart/form-data"
                                    wire:submit.prevent="CreateDistribution">
                                    @csrf
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-box"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <select class="form-control select" style="width: 80%;" name="productname"
                                            wire:model="productname">
                                            <option selected>Select Product</option>
                                            @foreach ($productnames as $productname)
                                                <option value="{{ $productname->id }}">
                                                    {{ $productname->ProductName }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('productname')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-industry"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Manufacturer"
                                            wire:model="manufacturer">
                                        @error('manufacturer')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <label>Distribution Date</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                        </div>
                                        <input type="date" class="form-control" placeholder="Distribution Date"
                                            wire:model="distributiondate">
                                        @error('distributiondate')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>


                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-th-list"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <input type="number" class="form-control" placeholder="Quantity"
                                            wire:model="quantity">
                                        @error('quantity')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                  
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-dollar-sign"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <input type="number" class="form-control" placeholder="Products Cost"
                                            wire:model="unitcost">
                                        @error('unitcost')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-coins"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <input type="number" class="form-control" placeholder="Selling Price"
                                            wire:model="sellingprice">
                                        @error('sellingprice')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-globe"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Origin"
                                            wire:model="origin">
                                        @error('origin')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-weight"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Model"
                                            wire:model="weight">
                                        @error('weight')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-project-diagram"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <select class="form-control select" style="width: 80%;" name="branchfrom"
                                            wire:model="branchfrom">
                                            <option selected>Select From Branch</option>
                                            <option value="100">Central Store</option>
                                            @foreach ($branches as $branch)
                                                <option value="{{ $branch->id }}">
                                                    {{ $branch->BranchName }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('branchfrom')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-project-diagram"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <select class="form-control select" style="width: 80%;" name="branchto"
                                            wire:model="branchto">
                                            <option selected>Select To Branch</option>
                                            @foreach ($branches as $branch)
                                                <option value="{{ $branch->id }}">
                                                    {{ $branch->BranchName }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('branchto')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <button type="submit"
                                            class="btn btn-block btn-success btn-lg">Distribute</button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>

                    <!-- Right Column -->
                    <div class="col-md-6">
                        <!-- Account Records -->
                        <div class="card card-info" wire:ignore>
                            <div class="card-header">
                                <h3 class="card-title">Products Distribution Listing</h3>
                            </div>
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Product Name</th>
                                            <th>Origin</th>
                                            <th>Model</th>
                                            <th>Qty</th>
                                            <th>Units</th>
                                            <th>To Branch</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($registereddistributions as $registereddistribution)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $registereddistribution->distributedproduct->ProductName }}</td>
                                                <td>{{ $registereddistribution->distributedproduct->Origin }}</td>
                                                <td>{{ $registereddistribution->distributedproduct->Weight }}</td>
                                                <td>{{ $registereddistribution->Quantity }}</td>
                                                <td>{{ $registereddistribution->Units }}</td>
                                                <td>{{ $registereddistribution->Branch }}</td>
                                            </tr>
                                        @endforeach

                                    </tbody>


                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        @if (Session::has('distributefailuremessage'))
                            <div class="alert alert-danger" role="alert" id="session-message">
                                {{ Session::get('distributefailuremessage') }}
                            </div>
                        @endif
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
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endpush
