<div>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Balance Sheet</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/Dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Balance Sheet</li>
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
                        <div class="row">
                            <!-- left column -->

                            <div class="col-md-3">
                                <label>From Date</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-calendar-day"
                                                aria-hidden="true"></i></span>
                                    </div>
                                    <input type="date" class="form-control" name="datefrom" placeholder="Date From"
                                        wire:model="datefrom">
                                    @error('datefrom')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>To Date</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-calendar-day"
                                                aria-hidden="true"></i></span>
                                    </div>
                                    <input type="date" class="form-control" name="dateto" placeholder="Date To"
                                        wire:model="dateto">
                                    @error('dateto')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label>&nbsp;</label>
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


                            <div class="col-md-3">
                                <label>&nbsp;</label>
                                <div class="row no-print">
                                    <button id="saveReportsButtonyear" wire:click="generateBalanceSheet()"
                                        class="btn btn-block btn-warning float-left"><i class="fas fa-calendar">Generate
                                            Balance Sheet</i></button>
                                </div>
                                <div class="row mt-2" id="loadingIndicatoryear" style="display: none;">
                                    <div class="col-12 text-center">
                                        <i class="fas fa-spinner fa-spin"></i> Generating report, please wait...
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>

                </div>
            </div>
        </section>
        @if ($registeredfeescollection == 0)
        @else
            <!-- Content Wrapper. Contains page content -->
            <section class="content">
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
                                        <h4>Balance Sheet</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center mt-2 mb-2">
                                        <hr class="my-2"
                                            style=" border: 2px solid #1434A4;margin-top: 20px;margin-bottom: 20px; ">
                                    </div>
                                </div>
                                <div class="row">
                                    @if ($branchto == null)
                                        <div class="col-md-6 mt-2 mb-2 text-right pr-5">
                                            <p><strong>Date From:
                                                </strong>{{ $datefrom }}</p>
                                        </div>
                                        <div class="col-md-6 mt-2 mb-2">
                                            <p><strong>Date To: </strong>{{ $dateto }}</p>
                                        </div>
                                    @else
                                        <div class="col-md-4 mt-2 mb-2 text-right pr-5">
                                            <p><strong>Date From:
                                                </strong>{{ $datefrom }}</p>
                                        </div>
                                        <div class="col-md-4 mt-2 text-center mb-2">
                                            <p><strong>Date To: </strong>{{ $dateto }}</p>
                                        </div>
                                        <div class="col-md-4 mt-2 mb-2">
                                            <p><strong>Branch: </strong>{{ $branchlabel }}</p>
                                        </div>
                                    @endif
                                </div>


                                <div class="row">
                                    <div class="col-md-12 text-center mb-2">
                                        <hr style=" border: 1px solid #1434A4;margin-top: 1px;margin-bottom: 20px; ">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mt-2 mb-2 ml-5 ">
                                        <h4><strong><u>Assets</u>
                                            </strong></h4>
                                    </div>
                                </div>
                                <div class="col-md-11 mt-2 mb-2 ml-5 mr-5">
                                    <hr style=" border: 1px solid #1434A4;margin-top: 1px;margin-bottom: 10px;  ">
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mt-2 mb-2 ml-5 ">
                                        Equipment
                                    </div>
                                    <div class="col-md-3 mt-2 mb-2 ml-5 text-right ">
                                        {{ $registeredequipment }}
                                    </div>
                                </div>
                                @foreach ($paymentmethods as $accounts)
                                    <div class="row">
                                        <div class="col-md-4 mt-2 mb-2 ml-5 ">
                                            <p>{{ $accounts->PaymentMethod }}</p>
                                        </div>
                                        <div class="col-md-3 mt-2 mb-2 ml-5 text-right ">
                                            <p>{{ $accounts->total_balance }}</p>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="row">
                                    <div class="col-md-4 mt-2 mb-2 ml-5 ">
                                        Stock
                                    </div>
                                    <div class="col-md-3 mt-2 mb-2 ml-5 text-right ">
                                        {{ $invetory }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mt-2 mb-2 ml-5 ">
                                        Accounts Receivable
                                    </div>
                                    <div class="col-md-3 mt-2 mb-2 ml-5 text-right ">
                                        {{ $accountsreceivable }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mt-2 mb-2 ml-5 ">
                                        Supplier Account Balance
                                    </div>
                                    <div class="col-md-3 mt-2 mb-2 ml-5 text-right ">
                                        {{ $registeredsupplieraccounts }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-7 mt-2 mb-2 ml-5 ">
                                        <h5><strong>Total Assets
                                            </strong></h5>
                                    </div>
                                    <div class="col-md-4 mt-2 mb-2 text-right ">
                                        <hr style=" border: 1px solid #1434A4;margin-top: 1px;margin-bottom: 10px; ">
                                        <h5><strong>{{$registeredsupplieraccounts+ $accountsreceivable + $invetory + $registeredequipment + $paymentmethods->sum('total_balance') }}</strong>
                                        </h5>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-11 mt-2 mb-2 ml-5 mr-5">
                                        <hr style=" border: 1px solid #1434A4;margin-top: 1px;margin-bottom: 10px;  ">
                                        <h4><strong><u>Total Equity & Liabilities</u>
                                            </strong></h4>
                                            <hr style=" border: 1px solid #1434A4;margin-top: 1px;margin-bottom: 10px;  ">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-11 mt-2 mb-2 ml-5 mr-5">
                                        <h5><strong><u>Liabilities</u>
                                        </strong></h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mt-2 mb-2 ml-5 ">
                                        Accounts Payable
                                    </div>
                                    <div class="col-md-3 mt-2 mb-2 ml-5 text-right ">
                                        {{ $registeredaccountspayable }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mt-2 mb-2 ml-5 ">
                                        Client Account Balance
                                    </div>
                                    <div class="col-md-3 mt-2 mb-2 ml-5 text-right ">
                                        {{ $registeredclientaccounts }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mt-2 mb-2 ml-5 ">
                                        <h5><strong>Total Liability
                                            </strong></h5>
                                    </div>
                                    <div class="col-md-3 mt-2 mb-2 ml-5 text-right ">
                                        <hr style=" border: 1px solid #1434A4;margin-top: 1px;margin-bottom: 10px; ">
                                        <h5><strong>{{ $registeredclientaccounts +$registeredaccountspayable }}</strong>
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-11 mt-2 mb-2 ml-5 mr-5">
                                        <h5><strong><u>Equity</u>
                                        </strong></h5>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mt-2 mb-2 ml-5 ">
                                        Capital
                                    </div>
                                    <div class="col-md-3 mt-2 mb-2 ml-5 text-right ">
                                        {{ $registeredcapital }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mt-2 mb-2 ml-5 ">
                                        Retained Earnings
                                    </div>
                                    <div class="col-md-3 mt-2 mb-2 ml-5 text-right ">
                                        {{ $carriedforwards }}
                                    </div>
                                </div>
                               
                                <div class="row">
                                    <div class="col-md-4 mt-2 mb-2 ml-5 ">
                                        Net Income
                                    </div>
                                    <div class="col-md-3 mt-2 mb-2 ml-5 text-right ">
                                        {{ ($registeredotherincomes + $registeredfeescollection)-($registereddevidends+$registeredexpenses + $registeredsalary+$registereddiscounts) }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mt-2 mb-2 ml-5 ">
                                        <h5><strong>Total Equity
                                            </strong></h5>
                                    </div>
                                    <div class="col-md-3 mt-2 mb-2 ml-5 text-right ">
                                        <hr style=" border: 1px solid #1434A4;margin-top: 1px;margin-bottom: 10px; ">
                                        <h5><strong>{{ ($registeredcapital +$carriedforwards+$registeredotherincomes + $registeredfeescollection)-($registereddevidends+$registeredexpenses + $registeredsalary+$registereddiscounts) }}</strong>
                                        </h5>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-7 mt-2 mb-2 ml-5 ">
                                        <h5><strong>Total Liability + Equity
                                            </strong></h5>
                                    </div>
                                    <div class="col-md-4 mt-2 mb-2 text-right ">
                                        <hr style=" border: 1px solid #1434A4;margin-top: 1px;margin-bottom: 10px; ">
                                        <h5><strong>{{ ($registeredclientaccounts +$registeredaccountspayable+$registeredcapital +$carriedforwards+$registeredotherincomes + $registeredfeescollection)-($registereddevidends+$registeredexpenses + $registeredsalary+$registereddiscounts) }}</strong>
                                        </h5>

                                    </div>
                                </div>
                               
                               
                              
                               
                            </div>
                            <!-- /.invoice -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        @endif
    </div>
</div>
<!-- Page specific script -->
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let saveReportsButton = document.getElementById('saveReportsButtonyear');
            let loadingIndicator = document.getElementById('loadingIndicatoryear');

            saveReportsButton.addEventListener('click', function() {
                loadingIndicator.style.display = 'block';
                saveReportsButton.disabled = true;
            });

            Livewire.on('reportGenerated', () => {
                loadingIndicator.style.display = 'none';
                saveReportsButton.disabled = false;
            });
        });
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
