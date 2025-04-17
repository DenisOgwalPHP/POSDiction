<div>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Account Update Form</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/admin/Dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Account Update Form</li>
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
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">Select Account Details</h3>

                            </div>
                            <div class="card-body">

                                <form action="" class="form-horizontal" enctype="multipart/form-data"
                                    wire:submit.prevent="UpdateAccount">

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        </div>
                                        <select class="form-control select2" style="width: 80%;" wire:model="email">
                                            <option selected="selected">Select Email</option>
                                            @foreach ($emails as $emails)
                                                <option value="{{ $emails->id }}">{{ $emails->email }}</option>
                                            @endforeach
                                        </select>
                                        @error('email')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-user"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Full Names"
                                            wire:model="name">
                                        @error('name')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-user-tag"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <select class="form-control select2" style="width: 80%;" wire:model="usertype">
                                            @foreach ($selectedAccount as $selectedAccount)
                                                <option value="{{ $selectedAccount->utype }}" selected="selected">
                                                    {{ $selectedAccount->utype }}
                                                </option>
                                            @endforeach
                                            <option>Select other User Type</option>
                                            <option value="General Manager">General Manager</option>
                                            <option value="Manager">Manager</option>
                                            <option value="Cashier">Cashier</option>
                                            <option value="Attendant">Attendant</option>
                                            <option value="Store Manager">Store Manager</option>
                                            <option value="Sales Personnel">Sales Personnel</option>
                                            <option value="Human Resource">Human Resource</option>
                                            <option value="Accounts Manager">Accounts Manager</option>
                                            <option value="Purchases and Supplies">Purchases and Supplies</option>
                                            <option value="Administrator">Administrator</option>
                                        </select>
                                        @error('usertype')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-map-marker"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <select class="form-control select" style="width: 80%;" name="branch"
                                            wire:model="branch">
                                            <option selected>Select Branch</option>
                                            @foreach ($branches as $branch)
                                            <option value="{{ $branch->id }}">
                                                {{ $branch->BranchName }}
                                            </option>
                                        @endforeach
                                        </select>
                                        @error('branch')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-block btn-warning btn-lg">Update</button>
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
                                <h3 class="card-title">Account Listing</h3>
                            </div>
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Names</th>
                                            <th>Email</th>
                                            <th>Branch</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($registeredAccounts as $registeredAccount)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $registeredAccount->name }}</td>
                                                <td>{{ $registeredAccount->email }}</td>
                                                <td>{{ $registeredAccount->userbranch->BranchName }}</td>
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
