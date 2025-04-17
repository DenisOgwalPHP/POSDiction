<div>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Clear Clients</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/Dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Clear Clients</li>
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
                                <h3 class="card-title">Input Clearance Details</h3>
                            </div>
                            <div class="card-body">

                                <form action="" class="form-horizontal" enctype="multipart/form-data"
                                    wire:submit.prevent="ClearClient">
                                    @csrf
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-wallet"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <select class="form-control select" style="width: 80%;" name="transactiontype"
                                            wire:model="transactiontype">
                                            <option selected>Select Transaction</option>
                                            <option value="Deposit">Deposit</option>
                                            <option value="Clear Transaction">Clear Transaction</option>
                                            <option value="Clear All">Clear All</option>
                                        </select>
                                        @error('transactiontype')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-user"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <select class="form-control select" style="width: 80%;" name="clientid"
                                            wire:model="clientid">
                                            <option selected>Select Client Account</option>
                                            @foreach ($clientids as $clientid)
                                            <option value="{{ $clientid->id }}">
                                                {{ $clientid->AccountName  }}
                                            </option>
                                        @endforeach
                                        </select>
                                        @error('clientid')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-exchange-alt"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <select class="form-control select" style="width: 80%;" name="transactionid"
                                            wire:model="transactionid">
                                            <option selected>Select Transaction</option>
                                            @foreach ($transactionids as $transactionid)
                                            <option value="{{ $transactionid }}">
                                                {{ $transactionid }}
                                            </option>
                                        @endforeach
                                        </select>
                                        @error('transactionid')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-dollar-sign"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <input type="number" class="form-control" placeholder="Transaction Amount"
                                            wire:model="transactionamount">
                                        @error('transactionamount')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-dollar-sign"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <input type="number" class="form-control" placeholder="Pending Payments"
                                            wire:model="pendingpayments">
                                        @error('pendingpayments')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-dollar-sign"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <input type="number" class="form-control" placeholder="Account Balance"
                                            wire:model="accountbalance">
                                        @error('accountbalance')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-credit-card"
                                                    aria-hidden="true"></i></span>
                                        </div>
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
    
                                    <div class="form-group" wire:ignore>
                                        <label>Details</label>
                                        <textarea id="description" name="description" wire:model="description"></textarea>
                                        @error('description')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-block btn-success btn-lg">Save Transaction</button>
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
                                <h3 class="card-title">Client Clearance Transaction Listing</h3>
                            </div>
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Account</th>
                                            <th>Transaction Type</th>
                                            <th>Amount</th>
                                            <th>Acc. Balance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($registeredclearance as $registeredclear)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $registeredclear->clearedclient->AccountName }}</td>
                                                <td>{{ $registeredclear->TransationType }}</td>
                                                <td>{{ $registeredclear->Amount }}</td>
                                                <td>{{ $registeredclear->AccountBalance}}</td>
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
     <script>
        $(document).ready(function() {
            // Summernote
            $('#description').summernote({
                Placeholder: 'Please add your Description',
                tabsize: 2,
                minHeight: 150,
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
