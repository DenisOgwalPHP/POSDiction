<div>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Generate Tax Invoice</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/Dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Generate Tax Invoice</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-box"
                                    aria-hidden="true"></i></span>
                        </div>
                        <select class="form-control select" style="width: 80%;" name="purchaseidd"
                            wire:model="purchaseidd">
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

                   

                    <div class="col-md-12">
                        <!-- DIRECT CHAT -->
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Selected Items</h3>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sales No.</th>
                                            <th>Item</th>
                                            <th>Model</th>
                                            <th>Origin</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                            <th>Buyer</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($selectedsales->count() > 0)
                                            @foreach ($selectedsales as $item)
                                                <tr>
                                                    <td>{{ $item->id }}</td>
                                                    <td>{{ $item->soldproduct->ProductName }}</td>
                                                    <td>{{ $item->soldproduct->Weight }}</td>
                                                    <td>{{ $item->soldproduct->Origin }}</td>
                                                    <td>{{ $item->Quantity }}</td> 
                                                    <td>{{ $item->Price * $item->Quantity }}</td>
                                                    <td>{{ $item->salesaccount->AccountName }}</td>
                                                   
                                                </tr>
                                            @endforeach
                                        
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            <!-- /.card-body -->
                            <div class="card-footer text-center">
                                @if ($selectedsales->count() > 0)
                                <a href="{{ route('Tax-Invoice-Print', ['salesid' => $purchaseidd]) }}"
                                    rel="noopener" target="_blank" class="btn btn-success "><i
                                        class="fas fa-print"></i> Print Tax Invoice</a>
                                    
                                @endif
                            </div>
                           
                        </div>
                        <!--/.direct-chat -->
                    </div>
                    <!-- /.col -->
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
                "autoWidth": true,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging":false,
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