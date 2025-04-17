<div>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Assets Registry Form</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/admin/Dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Assets Registry Form</li>
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
                                <h3 class="card-title">Input Assets Details</h3>
                            </div>
                            <div class="card-body">

                                <form class="form-horizontal" wire:submit.prevent="AddAssetPurchased">
                                    @csrf
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i
                                                    class="fa fa-calendar"></i></span>
                                        </div>
                                        <select class="form-control select" name="purchaseyear"
                                            wire:model="purchaseyear">
                                            <option selected="selected">Select Year</option>
                                            @php
                                                $currentYear = date('Y');
                                            @endphp
                                            @for ($year = $currentYear - 0; $year <= $currentYear + 10; $year++)
                                                <option value="{{ $year }}"
                                                    {{ $year == $currentYear ? 'selected' : '' }}>
                                                    {{ $year }}</option>
                                            @endfor
                                        </select>
                                        @error('purchaseyear')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                  

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-shopping-cart"
                                                    aria-hidden="true"></i></span>
                                        </div>

                                        <select class="form-control select" name="ProductName"
                                            wire:model="ProductName" style="width: 85%;">
                                            <option selected="selected">Select Asset Name</option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id}}">
                                                    {{ $product->ProductName}}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('ProductName')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-check"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <input type="integer" class="form-control" name="Quantity"
                                            placeholder="Quantity" wire:model="Quantity">
                                        @error('Quantity')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-bookmark"></i></span>
                                        </div>
                                        <select class="form-control select" name="PurchaseUnit"
                                            wire:model="PurchaseUnit" style="width: 85%;">
                                            <option selected="selected">Select Asset Units</option>
                                            @foreach ($units as $unit)
                                            <option value="{{$unit->Units}}">
                                                {{$unit->Units}}
                                            </option>
                                        @endforeach
                                        </select>
                                        @error('PurchaseUnit')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-check"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <input type="integer" class="form-control" name="UnitCost"
                                            placeholder="Unit Cost" wire:model="UnitCost">
                                        @error('UnitCost')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-school"></i></span>
                                        </div>
                                        <select class="form-control select" name="Supplier"
                                            wire:model="Supplier" style="width: 85%;">
                                            <option selected="selected">Select Supplier</option>
                                            @foreach ($suppliers as $supplier)
                                                <option value="{{ $supplier->id }}">
                                                    {{ $supplier->AccountName }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('Supplier')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="input-group mb-3" wire:ignore>
                                        <label>Asset Description </label><span></span>
                                        <textarea id="Description" name="Description" wire:model="Description"></textarea>
                                        @error('Description')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <button type="submit"  name="defaultsubmit"
                                            value="defaultsubmit" class="btn btn-block btn-success btn-lg">
                                            Register Asset</button>
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
                                <h3 class="card-title">Assets Listing</h3>
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Asset Name</th>
                                            <th>Quantity</th>
                                            <th>Units</th>
                                            <th>EDIT</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($registeredItems as $registeredItem)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $registeredItem->Purchasedproduct->ProductName }}</td>
                                                <td>{{ $registeredItem->Quantity}}</td>
                                                <td>{{ $registeredItem->Units }}</td>
                                                <td><a href="{{ route('Assets-Register', ['slug' => $registeredItem->id]) }}"
                                                        class="btn btn-block btn-outline-warning"> <i
                                                            class="fa fa-edit fa-2x text-warning"></i></a></td>
                                                <td> <a href="#" class="btn btn-block btn-outline-danger"
                                                        onclick="confirm('Are you sure, You want to delete this Asset Listing') || event.stopImmediatePropagation()"
                                                        wire:click.prevent="deleteItemPurchase({{ $registeredItem->id }})">
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
                /*"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]*/
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
            $('#Description').summernote({
                Placeholder: 'Please add your Description',
                tabsize: 2,
                minHeight: 250,
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
                        @this.set('Description', contents);
                    }
                }

            })
        });
    </script>
    <!-- Page specific script -->
@endpush
