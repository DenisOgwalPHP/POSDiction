<div id="content">
    <div class="wrapper" id="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <section class="invoice">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <!-- Main content -->
                        <div class="invoice p-3 mb-3">
                            <!-- title row -->
                            <div class="row">
                                <div class="col-md-12">
                                    <img src="{{ asset('dist/img/logo.jpg') }}" style="width: 100%;height:200px;">
                                </div>

                                <!-- /.col -->
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center mt-2 mb-2">
                                    <h4>Tax Invoice</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center mt-2 mb-2">
                                    <hr class="my-2"
                                        style=" border: 2px solid #1434A4;margin-top: 20px;margin-bottom: 20px; ">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 mt-2 mb-2 text-center">
                                    <p><strong>Client Name Name:
                                        </strong>{{ $registeredsale[0]['salesaccount']['AccountName'] }}</p>
                                </div>
                                <div class="col-md-3 mt-2 mb-2 text-center">
                                    <p><strong>Contact No.:
                                        </strong>{{ $registeredsale[0]['salesaccount']['ContactNo'] }}</p>
                                </div>

                                <div class="col-md-4 mt-2 mb-2 text-center">
                                    <p><strong>TIN No.: </strong>{{ $registeredsale[0]['salesaccount']['TINnumber'] }}
                                    </p>
                                </div>

                            </div>



                            <div class="row">
                                <div class="col-md-12 text-center mt-2 mb-2">
                                    <hr class="my-2"
                                        style=" border: 2px solid #1434A4;margin-top: 20px;margin-bottom: 20px; ">
                                </div>
                            </div>


                            <div class="card-body">
                                <table class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <th>Item No.</th>
                                        <th>Item Name</th>
                                        <th>Model</th>
                                        <th>Origin</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                    </thead>
                                    <tbody>
                                        @if ($registeredsale->count() > 0)
                                            @foreach ($registeredsale as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->soldproduct->ProductName }}</td>
                                                    <td>{{ $item->soldproduct->Weight }}</td>
                                                    <td>{{ $item->soldproduct->Origin }}</td>
                                                    <td>{{ $item->Quantity }}</td>
                                                    <td>{{ $item->Price * $item->Quantity }}</td>
                                                </tr>
                                            @endforeach

                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            <!-- /.row -->

                            <!-- this row will not appear when printing -->

                        </div>
                        <!-- /.invoice -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
</div>

<!-- Page specific script -->
@push('scripts')
    <script>
        /*'use strict';*/
        window.addEventListener("load", window.print());
    </script>
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
