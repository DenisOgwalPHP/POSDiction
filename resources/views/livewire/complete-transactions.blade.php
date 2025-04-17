<div>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Patient Payment Complete Transaction Records</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/admin/Dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Patient Payment Complete Transaction Records</li>
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
                                <h3 class="card-title">Patient Payment Complete Transaction Records</h3>

                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Payment ID</th>
                                            <th>Patient</th>
                                            <th>Currency</th>
                                            <th>Amount</th>
                                            <th>Payment Method</th>
                                            <th>Payment Reference</th>
                                            <th>Phone</th>
                                            <th>Delivery / Pickup Area</th>
                                            <th>Delivery / Pickup Date</th>
                                            <th>Delivery / Pickup Time</th>
                                            <th>Payment Date</th>
                                            <th>Notes</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($registeredpayments as $registeredpayment)
                                            <tr data-widget="expandable-table" aria-expanded="false">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $registeredpayment->PaymentID }}</td>
                                                <td>{{ $registeredpayment->patients['name'] }}</td>
                                                <td>{{ $registeredpayment->Currency }}</td>
                                                <td>{{ $registeredpayment->Amount }}</td>
                                                <td>{{ $registeredpayment->PaymentMethod }}</td>
                                                <td>{{ $registeredpayment->PaymentReference }}</td>
                                                <td>{{ $registeredpayment->Phone }}</td>
                                                <td>{{ $registeredpayment->DeliveryArea }}</td>
                                                <td>{{ $registeredpayment->PickupDate }}</td>
                                                <td>{{ $registeredpayment->PickupTime }}</td>
                                                <td>{{ $registeredpayment->created_at }}</td>
                                                <td>{!! Str::limit($registeredpayment->Notes, 25, '.....') !!}</td>
                                            </tr>
                                        @endforeach

                                    </tbody>

                                    <tfoot>

                                    </tfoot>
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
