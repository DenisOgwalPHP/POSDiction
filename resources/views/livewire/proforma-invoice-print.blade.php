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
                                    <h4>Proforma Invoice</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center mt-2 mb-2">
                                    <hr class="my-2"
                                        style=" border: 2px solid #1434A4;margin-top: 20px;margin-bottom: 20px; ">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 mt-2 mb-2 text-center">
                                    <p><strong>Company Name:
                                        </strong>{{ $registeredproforma['ClientCompany'] }}</p>
                                </div>
                                <div class="col-md-5 mt-2 mb-2 text-center">
                                    <p><strong>Client Name </strong>{{ $registeredproforma['ClientName'] }}</p>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-4 mt-2 mb-2 text-center">
                                    <p><strong>Email: </strong>{{ $registeredproforma['Email'] }}
                                    </p>
                                </div>
                                <div class="col-md-3 mt-2 mb-2 text-center">
                                    <p><strong>Telephone: </strong>{{ $registeredproforma['Telephone'] }}
                                    </p>
                                </div>
                                <div class="col-md-5 mt-2 mb-2 text-center">
                                    <p><strong>Location: </strong>{{ $registeredproforma['Location'] }}
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
                                        <tr>
                                            <th>No.</th>
                                            <th>Item</th>
                                            <th>Model</th>
                                            <th>Origin</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (Cart::instance('pcart')->count() > 0)
                                            @foreach (Cart::instance('pcart')->content() as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $item->options->weight }}</td>
                                                    <td>{{ $item->options->origin }}</td>
                                                    <td>{{ $item->qty }}</td>
                                                    <td>{{ $item->price * $item->qty }}</td>
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
