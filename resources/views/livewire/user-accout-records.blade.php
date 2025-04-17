<div>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>User Account Records</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/admin/Dashboard">Home</a></li>
                            <li class="breadcrumb-item active">User Account Records</li>
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
                    <!-- Right Column -->
                    <div class="col-md-12">
                        <!-- Account Records -->
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">User Account Record Listing</h3>

                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Names</th>
                                            <th>Email</th>
                                            <th>Creation Date</th>
                                            <th>Verification Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($registeredAccounts as $registeredAccount)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $registeredAccount->name }}</td>
                                                <td>{{ $registeredAccount->email }}</td>
                                                <td>{{ $registeredAccount->created_at }}</td>
                                                @if ($registeredAccount->email_verified_at == null)
                                                    <td><a href="#" class="btn btn-block btn-success btn-lg"
                                                            onclick="confirm('Are you sure, You want to verify this Account') || event.stopImmediatePropagation()"
                                                            wire:click.prevent="UpdateAccout({{ $registeredAccount->id }})">
                                                            Verify</a></td>
                                                @else
                                                    <td>{{ 'Verified' }}</td>
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
@endpush
