<div>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Return Sold Product</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/Dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Return Sold Product</li>
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
                                <h3 class="card-title">Input Returned Item Details</h3>
                            </div>
                            <div class="card-body">

                                <form action="" class="form-horizontal" enctype="multipart/form-data"
                                    wire:submit.prevent="CreateProductReturn">
                                    @csrf
                                   
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-box"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <select class="form-control select" style="width: 80%;" name="purchaseid"
                                            wire:model="purchaseid">
                                            <option selected>Select Sales ID</option>
                                            @foreach ($purchaseids as $purchaseid)
                                            <option value="{{ $purchaseid->id }}">
                                                {{ $purchaseid->id  }}
                                            </option>
                                        @endforeach
                                        </select>
                                        @error('purchaseid')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-box"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <select class="form-control select" style="width: 80%;" name="productname"
                                            wire:model="productname">
                                            <option selected>Select Item</option>
                                            @foreach ($productnames as $productname)
                                            <option value="{{$productname->ProductRefer}}">
                                                {{ $productname->soldproduct->ProductName  }}
                                            </option>
                                        @endforeach
                                        </select>
                                        @error('productname')
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
                                        <input type="number" class="form-control" placeholder="Item Price"
                                            wire:model="unitprice">
                                        @error('unitprice')
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
                                  
                                   
                                    <div class="form-group" wire:ignore>
                                        <label>Reason</label>
                                        <textarea id="description" name="description" wire:model="description"></textarea>
                                        @error('description')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-block btn-success btn-lg">Return</button>
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
                                <h3 class="card-title">Products Returned Listing</h3>
                            </div>
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Product Name</th>
                                            <th>Model</th>
                                            <th>Qty</th>
                                            <th>Units</th>
                                            <th>Branch</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($registeredreturns as $registeredreturn)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $registeredreturn->returnedproduct->ProductName }}</td>
                                                <td>{{ $registeredreturn->returnedproduct->Weight }}</td>
                                                <td>{{ $registeredreturn->Quantity }}</td>
                                                <td>{{ $registeredreturn->returnedproduct->Units }}</td>
                                                @if($registeredreturn->Branch==100)
                                                    <td>Central Store</td>
                                                @else
                                                <td>{{ $registeredreturn->returnbranch->BranchName }}</td>
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
     <script>
        $(document).ready(function() {
            // Summernote
            $('#description').summernote({
                Placeholder: 'Please add your Description',
                tabsize: 2,
                minHeight: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['fontname', 'fontsize', 'bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                callbacks: {
                    onChange: function(contents, $editable) {
                        @this.set('description', contents);
                    }
                }

            })


        });
    </script>
@endpush
