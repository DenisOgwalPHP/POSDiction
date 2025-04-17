<div>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ $branch}} Stock Records</h1>
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

                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Selection By Branch</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-project-diagram"
                                                        aria-hidden="true"></i></span>
                                            </div>
                                            <select class="form-control select" style="width: 80%;" name="branchto"
                                                wire:model="branchto">
                                                <option selected>Select Branch</option>
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
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <!-- Account Records -->
                        <div class="card card-info" wire:ignore>
                            <div class="card-header">
                                <h3 class="card-title">Stock Records Listing</h3>
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Product</th>
                                            <th>weight</th>
                                            <th>Origin</th>
                                            <th>Item Balance</th>
                                            <th>Cost Price</th>
                                            <th>Selling Price</th>
                                            <th>Stock Cost Value</th>
                                            <th>Stock Sale Value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($registeredbranchbalance as $registeredbranchbalance)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $registeredbranchbalance->Purchasedproduct->ProductName}}</td>
                                                <td>{{ $registeredbranchbalance->Purchasedproduct->Weight }}</td>
                                                <td>{{ $registeredbranchbalance->Purchasedproduct->Origin}}</td>
                                                <td>{{ $registeredbranchbalance->ItemBalance }}</td>
                                                <td>{{ $registeredbranchbalance->StockRate }}</td>
                                                <td>{{ $registeredbranchbalance->ProductValue}}</td>
                                                <td>{{ $registeredbranchbalance->StockRate * $registeredbranchbalance->ItemBalance}}</td>
                                                <td>{{ $registeredbranchbalance->ProductValue * $registeredbranchbalance->ItemBalance}}</td>
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
