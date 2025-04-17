<div>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create Proforma Invoice</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/Dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Create Proforma Invoice</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <!-- DIRECT CHAT -->
                        <div class="card direct-chat direct-chat-warning">
                            <div class="card-header">
                                <h3 class="card-title">Click Products to Select</h3>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body" wire:ignore>
                                <div class="direct-chat-messages" id="scroller" style="height: 600px !important;">
                                    <table id="example1" class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Item</th>
                                                <th>Origin</th>
                                                <th>Model</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($stocksforsale as $stock)
                                                <tr
                                                    wire:click.prevent="handleButtonClicks({{ $stock->ProductRefer }},'{{ $stock->Purchasedproduct->ProductName }}',{{ $stock->ProductValue }},{{ $stock->StockRate }},{{ $stock->id }},'{{ $stock->Weight }}','{{ $stock->Origin}}')">
                                                    <td>{{ $stock->Purchasedproduct->ProductName }}</td>
                                                    <td>{{ $stock->Origin }}</td>
                                                    <td>{{ $stock->Weight }}</td>
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
                                <h3 class="card-title">Selected Items</h3>
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
                                        @if (Cart::instance('pcart')->count() > 0)
                                            @foreach (Cart::instance('pcart')->content() as $item)
                                                <tr>
                                                    <td>{{ $item->id }}</td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $item->qty }}</td> 
                                                    <td>{{ $item->price * $item->qty }}</td>
                                                    <td class="action" data-title="Remove">
                                                        <a href="#"
                                                            wire:click.prevent="destroyitem('{{ $item->rowId }}')">
                                                            <i class="fa fa-times" aria-hidden="true"
                                                                style="color:red"></i>
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
                                @if (Cart::instance('pcart')->content()->count() > 1)
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
                    </div>
                    <!-- /.col -->

                    <div class="col-md-4">
                        <!-- DIRECT CHAT -->
                        <div class="card direct-chat direct-chat-warning">
                            <div class="card-header">
                                <h3 class="card-title">Client Details</h3>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">
                                <form wire:submit.prevent="AddProforma">
                                    @csrf
                                    <div class="input-group mb-1 p-2">
                                        <div class="row" style="width:100%;">
                                            <div class="col-md-4"><label>Client Company</label></div>
                                            <div class="col-md-8"><input type="text" class="form-control"
                                                    placeholder="Client Company" wire:model="clientcompany">
                                                @error('clientcompany')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group mb-1 p-2">
                                        <div class="row" style="width:100%;">
                                            <div class="col-md-4"><label>Client Name</label></div>
                                            <div class="col-md-8"><input type="text" class="form-control"
                                                    placeholder="Client Name" wire:model="clientname">
                                                @error('clientname')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group mb-1 p-2">
                                        <div class="row" style="width:100%;">
                                            <div class="col-md-4"><label>Telephone No.</label></div>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" placeholder="Telephone No."
                                                    wire:model="telephoneno">
                                                @error('telephoneno')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group mb-1 p-2">
                                        <div class="row" style="width:100%;">
                                            <div class="col-md-4"><label>Location</label></div>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" placeholder="Location"
                                                    wire:model="location">
                                                @error('location')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group mb-1 p-2">
                                        <div class="row" style="width:100%;">
                                            <div class="col-md-4"><label>Email</label></div>
                                            <div class="col-md-8">
                                                <input type="email" class="form-control" placeholder="clientemail"
                                                    wire:model="clientemail">
                                                @error('clientemail')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                   
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-block btn-success btn-lg">Generate Invoice</button>
                            </div>
                            </form>
                            <!-- /.card-footer-->
                        </div>
                        <!--/.direct-chat -->
                    </div>
                </div>
                <!-- /.row -->
            </div>
        </section>
    </div>
</div>
<!-- Page specific script -->
@push('scripts')
<script>
    document.addEventListener('livewire:load', function () {
        Livewire.on('invoiceGenerated', function (data) {
            var baseUrl = window.location.origin + "/Proforma-Print?";
            var url = baseUrl + "invoiceId=" + data.invoiceId;
            window.open(url, '_blank');
        });
    });
</script>

    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "searching": true,
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