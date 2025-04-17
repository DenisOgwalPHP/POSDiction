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
                                    placeholder="Type your keywords here e.g Product Name or Model or Origin">
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
                    @if ($registeredproduct)
                        @if ($registeredproduct->count() > 0)
                            <div class="col-md-12">
                                <!-- Account Records -->
                                <div class="card card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">Product Record Listing</h3>
                                    </div>
                                    <div class="card-body">
                                        <table id="example1" class="table table-bordered table-hover table-striped">
                                            <thead>
                                                <tr>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Product Name</th>
                                                    <th>Origin</th>
                                                    <th>Model</th>
                                                    <th>Units</th>
                                                    <th>Cost Price</th>
                                                    <th>Selling Price</th>
                                                    <th>Manufacturer</th>
                                                </tr>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($registeredproduct as $registeredproduct)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $registeredproduct->ProductName }}</td>
                                                        <td>{{ $registeredproduct->Origin }}</td>
                                                        <td>{{ $registeredproduct->Weight }}</td>
                                                        <td>{{ $registeredproduct->Units }}</td>
                                                        <td>{{ $registeredproduct->PurchaseCost  }}</td>
                                                        <td>{{ $registeredproduct->SellingPrice }}</td>
                                                        <td>{{ $registeredproduct->Manufacturer }}</td>
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
                    @if ($registeredsales)
                        @if ($registeredsales->count() > 0)
                            <div class="col-md-12">
                                <!-- Account Records -->
                                <div class="card card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">Product Sales Record Listing</h3>

                                    </div>
                                    <div class="card-body">
                                        <table id="example2" class="table table-bordered table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Item</th>
                                                    <th>Model</th>
                                                    <th>Origin</th>
                                                    <th>Quantity</th>
                                                    <th>Price</th>
                                                    <th>Sold By</th>
                                                    <th>Sales Date</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($registeredsales as $registeredsale)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $registeredsale->soldproduct->ProductName}}</td>
                                                    <td>{{ $registeredsale->soldproduct->Weight }}</td>
                                                    <td>{{ $registeredsale->soldproduct->Origin}}</td>
                                                    <td>{{ $registeredsale->Quantity }}</td>
                                                    <td>{{ $registeredsale->Price }}</td>
                                                    <td>{{$registeredsale->registrar->name}}</td>
                                                    <td>{{ $registeredsale->created_at }}</td>
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
                    @if ($registeredpurchases)
                        @if ($registeredpurchases->count() > 0)
                            <div class="col-md-12">
                                <!-- Account Records -->
                                <div class="card card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">Product Purchases Record Listing</h3>
                                    </div>
                                    <div class="card-body">
                                        <table id="example3" class="table table-bordered table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Record ID</th>
                                                    <th>Product Name</th>
                                                    <th>Model</th>
                                                    <th>Origin</th>
                                                    <th>Purchase Date</th>
                                                    <th>Quantity</th>
                                                    <th>Units</th>
                                                    <th>Cost Rate</th>
                                                    <th>Total Cost</th>
                                                    <th>Invoice No.</th>
                                                    <th>Quantity Left</th>
                                                    <th>Manufacture Date</th>
                                                    <th>Expiry Date</th>
                                                    <th>Purchase By</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($registeredpurchases as $registeredpurchase)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $registeredpurchase->id}}</td>
                                                <td>{{ $registeredpurchase->Purchasedproduct->ProductName}}</td>
                                                <td>{{ $registeredpurchase->Purchasedproduct->Weight}}</td>
                                                <td>{{ $registeredpurchase->Purchasedproduct->Origin}}</td>
                                                <td>{{ $registeredpurchase->PurchaseDate}}</td>
                                                <td>{{ $registeredpurchase->Quantity}}</td>
                                                <td>{{ $registeredpurchase->Units}}</td>
                                                <td>{{ $registeredpurchase->UnitCost}}</td>
                                                <td>{{ $registeredpurchase->TotalCost}}</td>
                                                <td>{{ $registeredpurchase->InvoiceNo}}</td>
                                                <td>{{ $registeredpurchase->QuantityLeft}}</td>
                                                <td>{{ $registeredpurchase->ManufactureDate}}</td>
                                                <td>{{ $registeredpurchase->ExpiryDate}}</td>
                                                <td>{{ $registeredpurchase->registrar->name}}</td>
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
                    @if ($registeredsupplies)
                        @if ($registeredsupplies->count() > 0)
                            <div class="col-md-12">
                                <!-- Account Records -->
                                <div class="card card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">Supplier Clearance Records Listing</h3>
                                    </div>
                                    <div class="card-body">
                                        <table id="example4" class="table table-bordered table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Product Name</th>
                                                    <th>Model</th>
                                                    <th>Origin</th>
                                                    <th>Purchase ID</th>
                                                    <th>Amount</th>
                                                    <th>Supplier</th>
                                                    <th>Clearance</th>
                                                    <th>ClearanceID</th>
                                                    <th>Clearance By</th>
                                                    <th>Entry Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($registeredsupplies as $registeredsupply)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $registeredsupply->Purchasedproduct->ProductName}}</td>
                                                    <td>{{ $registeredsupply->Purchasedproduct->Weight}}</td>
                                                    <td>{{ $registeredsupply->Purchasedproduct->Origin}}</td>
                                                    <td>{{ $registeredsupply->PurchaseID}}</td>
                                                    <td>{{ $registeredsupply->Amount}}</td>
                                                    <td>{{ $registeredsupply->productsupplier->AccountName}}</td>
                                                    <td>{{$registeredsupply->Clearance}}</td>
                                                    <td>{{$registeredsupply->ClearanceID}}</td>
                                                    <td>{{$registeredsupply->registrar->name}}</td>
                                                    <td>{{$registeredsupply->created_at}}</td>
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
                    @if ($registeredbranch)
                        @if ($registeredbranch->count() > 0)
                            <div class="col-md-12">
                                <!-- Account Records -->
                                <div class="card card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">Branch Records Listing</h3>
                                    </div>
                                    <div class="card-body">
                                        <table id="example5" class="table table-bordered table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Product</th>
                                                    <th>Model</th>
                                                    <th>Origin</th>
                                                    <th>Item Balance</th>
                                                    <th>Cost Price</th>
                                                    <th>Selling Price</th>
                                                    <th>Stock Cost Value</th>
                                                    <th>Stock Sale Value</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($registeredbranch as $registeredbranch)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $registeredbranch->Purchasedproduct->ProductName}}</td>
                                                        <td>{{ $registeredbranch->Purchasedproduct->Weight }}</td>
                                                        <td>{{ $registeredbranch->Purchasedproduct->Origin}}</td>
                                                        <td>{{ $registeredbranch->ItemBalance }}</td>
                                                        <td>{{ $registeredbranch->StockRate }}</td>
                                                        <td>{{ $registeredbranch->ProductValue}}</td>
                                                        <td>{{ $registeredbranch->StockRate * $registeredbranch->ItemBalance}}</td>
                                                        <td>{{ $registeredbranch->ProductValue * $registeredbranch->ItemBalance}}</td>
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
                    @if ($registeredstore)
                        @if ($registeredstore->count() > 0)
                            <div class="col-md-12">
                                <!-- Account Records -->
                                <div class="card card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">Main Store Record Listing</h3>
                                    </div>
                                    <div class="card-body">
                                        <table id="example6" class="table table-bordered table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Product</th>
                                                    <th>Model</th>
                                                    <th>Origin</th>
                                                    <th>Item Balance</th>
                                                    <th>Cost Price</th>
                                                    <th>Selling Price</th>
                                                    <th>Stock Cost Value</th>
                                                    <th>Stock Sale Value</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($registeredstore as $registeredstore)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $registeredstore->Purchasedproduct->ProductName}}</td>
                                                        <td>{{ $registeredstore->Purchasedproduct->Weight }}</td>
                                                        <td>{{ $registeredstore->Purchasedproduct->Origin}}</td>
                                                        <td>{{ $registeredstore->ItemBalance }}</td>
                                                        <td>{{ $registeredstore->StockRate }}</td>
                                                        <td>{{ $registeredstore->ProductValue}}</td>
                                                        <td>{{ $registeredstore->StockRate * $registeredstore->ItemBalance}}</td>
                                                        <td>{{ $registeredstore->ProductValue * $registeredstore->ItemBalance}}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
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
            $('#example5').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
            $('#example6').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });

            $('#example7').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
            $('#example8').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
            $('#example9').DataTable({
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
