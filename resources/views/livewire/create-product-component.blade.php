<div>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create Product</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/Dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Create Product</li>
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
                                <h3 class="card-title">Input Product</h3>
                            </div>
                            <div class="card-body">

                                <form action="" class="form-horizontal" enctype="multipart/form-data"
                                    wire:submit.prevent="CreateProduct">
                                    @csrf
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-box"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Product Name"
                                            wire:model="productname">
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

                                   

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-dollar-sign"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <input type="number" class="form-control" placeholder="Product Cost"
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
                                            <span class="input-group-text"><i class="fa fa-barcode"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Barcode"
                                            wire:model="barcode">
                                        @error('barcode')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-block btn-success btn-lg">Create Product </button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>

                    <!-- Right Column -->
                    <div class="col-md-6" wire:ignore>
                        <!-- Account Records -->
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Product Listing</h3>
                            </div>
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Product Name</th>
                                            <th>Origin</th>
                                            <th>Model</th>
                                            <th>EDIT</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($registeredproducts as $registeredproduct)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $registeredproduct->ProductName }}</td>
                                                <td>{{ $registeredproduct->Origin }}</td>
                                                <td>{{ $registeredproduct->Weight }}</td>
                                                <td><a href="{{ route('Create-Product', ['slug' => $registeredproduct->id]) }}"
                                                    class="btn btn-block btn-outline-warning"> <i
                                                        class="fa fa-edit fa-2x text-warning"></i></a></td>
                                            <td> <a href="#" class="btn btn-block btn-outline-danger"
                                                    onclick="confirm('Are you sure, You want to delete this Product Listing') || event.stopImmediatePropagation()"
                                                    wire:click.prevent="deleteProduct({{ $registeredproduct->id }})">
                                                    <i class="fa fa-times fa-2x text-danger"></i></a>
                                            </td>
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
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endpush
