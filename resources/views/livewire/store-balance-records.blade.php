<div>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Store Stock Records</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/Dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Stock Records</li>
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
                        <!-- Account Records -->
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Stock Records Listing</h3>
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-hover table-striped">
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
                                        @foreach ($registeredstorebalance as $registeredstorebalance)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $registeredstorebalance->Purchasedproduct->ProductName}}</td>
                                                <td>{{ $registeredstorebalance->Purchasedproduct->Weight }}</td>
                                                <td>{{ $registeredstorebalance->Purchasedproduct->Origin}}</td>
                                                <td>{{ $registeredstorebalance->ItemBalance }}</td>
                                                <td>{{ $registeredstorebalance->StockRate }}</td>
                                                <td>{{ $registeredstorebalance->ProductValue}}</td>
                                                <td>{{ $registeredstorebalance->StockRate * $registeredstorebalance->ItemBalance}}</td>
                                                <td>{{ $registeredstorebalance->ProductValue * $registeredstorebalance->ItemBalance}}</td>
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
