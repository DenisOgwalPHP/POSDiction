<div>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">ESSENTIAL POS DASHBOARD ({{ Auth::user()->userbranch->BranchName }})</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->

                <!-- Info boxes -->
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-calendar-times"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Expired Products</span>
                                <span class="info-box-number">
                                    {{ $expiringproduct->count() }}
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-box"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Products in Stock</span>
                                <span class="info-box-number">
                                    {{ $stocksforsale->count() }}
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-warning elevation-1"><i
                                    class="fas fa-shopping-cart"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Cart Items</span>
                                <span class="info-box-number">
                                    {{ Cart::instance('cart')->content()->count() }}
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->

                    <!-- fix for small devices only -->
                    <div class="clearfix hidden-md-up"></div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->



            <div class="row">
                <div class="col-md-3">
                    <!-- DIRECT CHAT -->
                    <div class="card direct-chat direct-chat-warning">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="card-title">Click Products to Select</h3>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control text-center" placeholder="barcode"
                                        wire:model="barcode">
                                </div>
                            </div>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body" wire:ignore>
                            <div class="direct-chat-messages" id="scroller" style="height: 600px !important;">
                                <table id="example1" class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th>Model</th>
                                            <th>Stock</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($stocksforsale as $stock)
                                            <tr
                                                wire:click.prevent="handleButtonClick({{ $stock->ProductRefer }},'{{ $stock->Purchasedproduct->ProductName }}',{{ $stock->ProductValue }},{{ $stock->StockRate }},{{ $stock->id }})">
                                                <td>{{ $stock->Purchasedproduct->ProductName }}</td>
                                                <td>{{ $stock->Weight }}</td>
                                                <td>{{ $stock->ItemBalance }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">

                        </div>
                        <!-- /.card-footer-->
                    </div>
                    <!--/.direct-chat -->
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                    <!-- DIRECT CHAT -->
                    <div class="card direct-chat direct-chat-warning">
                        <div class="card-header">
                            <h3 class="card-title">Registered Clients</h3>
                        </div>
                         <div class="card-body"  wire:ignore>
                            <table id="example3" class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Client</th>
                                        <th>NIN</th>
                                        <th>Phone</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($currentcustomers as $currentcustomer)
                                            <tr
                                                wire:click.prevent="handleButtonClick2({{ $currentcustomer->id }},'{{ $currentcustomer->AccountName}} {{ $currentcustomer->AccountName2}}','{{ $currentcustomer->TINnumber }}','{{ $currentcustomer->ContactNo }}')">
                                                <td>{{ $currentcustomer->AccountName }} {{$currentcustomer->AccountName2}}</td>
                                                <td>{{ $currentcustomer->TINnumber }}</td>
                                                <td>{{ $currentcustomer->ContactNo }}</td>
                                            </tr>
                                        @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <!-- DIRECT CHAT -->
                    <div class="card direct-chat direct-chat-warning">
                        <div class="card-header">
                            <h3 class="card-title">Selected Item</h3>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Item ID</th>
                                        <th>Item</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (Cart::instance('cart')->count() > 0)
                                        @foreach (Cart::instance('cart')->content() as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>
                                                    <input style="width:40px" type="number"
                                                        wire:change="updateQuantity('{{ $item->rowId }}', $event.target.value)"
                                                        value="{{ $item->qty }}"
                                                        aria-label="Quantity for {{ $item->name }}">
                                                </td>
                                                <td>{{ $item->price * $item->qty }}</td>
                                                <td class="action" data-title="Remove">
                                                    <a href="#"
                                                        wire:click.prevent="destroyitem('{{ $item->rowId }}')">
                                                        <i class="fa fa-times" aria-hidden="true" style="color:red"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5">Your Selection is empty.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        <!-- /.card-body -->
                        <div class="card-footer">
                            @if (Cart::instance('cart')->content()->count() > 1)
                                <button wire:click.prevent="destroyitems()"
                                    class="btn btn-block btn-danger btn-sm">Clear All</button>
                            @endif
                        </div>
                        <!-- /.card-footer-->
                        @if (Session::has('itemlessmessage'))
                            <div class="alert alert-danger" role="alert" id="session-message">
                                {{ Session::get('itemlessmessage') }}
                            </div>
                        @endif
                    </div>
                    <!--/.direct-chat -->

                    @if (Session::has('sellcantcontinue'))
                        <div class="alert alert-danger" role="alert" id="session-message">
                            {{ Session::get('sellcantcontinue') }}
                        </div>
                    @endif
                <div class="card direct-chat direct-chat-warning">
                        <div class="card-header">
                            <h3 class="card-title">Selected Client</h3>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example4" class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Client</th>
                                        <th>NIN</th>
                                        <th>Phone</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (Cart::instance('clientcart')->count() > 0)
                                        @foreach (Cart::instance('clientcart')->content() as $items)
                                            <tr>
                                                <td>{{ $items->name }}</td>
                                                <td>{{ $items->options->nin }}</td>
                                                <td>{{ $items->options->phone}}</td>
                                                <td class="action" data-title="Remove">
                                                    <a href="#"
                                                        wire:click.prevent="destroyitem2('{{ $items->rowId }}')">
                                                        <i class="fa fa-times" aria-hidden="true" style="color:red"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5">Your Client Selection is empty.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        <!-- /.card-body -->
                        <div class="card-footer">
                            @if (Cart::instance('cart')->content()->count() > 1)
                                <button wire:click.prevent="destroyitems()"
                                    class="btn btn-block btn-danger btn-sm">Clear All</button>
                            @endif
                        </div>
                        <!-- /.card-footer-->
                        @if (Session::has('itemlessmessage'))
                            <div class="alert alert-danger" role="alert" id="session-message">
                                {{ Session::get('itemlessmessage') }}
                            </div>
                        @endif
                    </div>

                    <div class="card direct-chat direct-chat-warning">
                        <div class="card-header">
                            <h3 class="card-title">Clear Bill</h3>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <form wire:submit.prevent="AddSale">
                                @csrf
                               <div class="row">
                                <div class="input-group mb-1 p-2 col-md-6">
                                    <div class="row" style="width:100%;">
                                        <div class="col-md-4"><label>Cash</label></div>
                                        <div class="col-md-8"><input type="number" class="form-control"
                                                placeholder="Cash" wire:model="sellcash"
                                                @if ($this->sellcashDisabled) disabled @endif>
                                            @error('sellcash')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group mb-1 p-2 col-md-6">
                                    <div class="row" style="width:100%;">
                                        <div class="col-md-4"><label>Balance</label></div>
                                        <div class="col-md-8">
                                            <input type="number" class="form-control" placeholder="Balance"
                                                wire:model="sellbalance">
                                            @error('sellbalance')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                               </div>
                               <div class="row">
                                <div class="input-group mb-1 p-2 col-md-6">
                                    <div class="row" style="width:100%;">
                                        <div class="col-md-4"><label>Due payment</label></div>
                                        <div class="col-md-8">
                                            <input type="number" class="form-control" placeholder="Due payment"
                                                wire:model="sellduepayment">
                                            @error('sellduepayment')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group mb-1 p-2 col-md-6">
                                    <div class="row" style="width:100%;">
                                        <div class="col-md-4"><label>Total Amount</label></div>
                                        <div class="col-md-8">
                                            <input type="number" class="form-control" placeholder="Total Amount"
                                                wire:model="selltotalamount">
                                            @error('selltotalamount')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                               </div>
                                <div class="input-group mb-1 p-2">
                                    <div class="row" style="width:100%;">
                                        <div class="col-md-4"><label>Product Serial No.</label></div>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" placeholder="Serial No."
                                                wire:model="SerialNo">
                                            @error('SerialNo')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group mb-1 p-2">
                                    <div class="row" style="width:100%;">
                                        <div class="col-md-4"><label>Payment Method</label></div>
                                        <div class="col-md-8">

                                            <select class="form-control select" name="sellpaymentmethod"
                                                wire:model="sellpaymentmethod">
                                                <option selected>Select Payment Method</option>
                                                @foreach ($sellpaymentmethods as $sellpaymentmethod)
                                                    <option value="{{ $sellpaymentmethod->id }}">
                                                        {{ $sellpaymentmethod->PaymentMethod }}</option>
                                                @endforeach
                                            </select>
                                            @error('sellpaymentmethod')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-block btn-success btn-lg">Save Sell</button>
                        </div>
                        </form>
                        <!-- /.card-footer-->
                    </div>

                </div>
                <!-- /.col -->

                
            </div>
            <!-- /.row -->



        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
</div>
</div>
@push('scripts')
    <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('receiptgenerated', function(data) {
                location.reload();
            });
        });
    </script>

        <script>
document.addEventListener('sale-error', event => {
    alert(event.detail.message); // Or use a toast notification
});
</script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "info": false,
                "searching": false,
                "paging": false,
            });
            $('#example2').DataTable({
                "paging": false,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": false,
                "autoWidth": false,
                "responsive": true,
            });
             $('#example3').DataTable({
                "paging": false,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": false,
                "autoWidth": false,
                "responsive": true,
            });

             $('#example4').DataTable({
                "paging": false,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": false,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
    <script>
        const scrollingElement = document.getElementById("scroller");
        Livewire.on('scrollToLastItem', () => {
            scrollingElement.scrollTo(0, scrollingElement.scrollHeight);
        });
    </script>
@endpush
