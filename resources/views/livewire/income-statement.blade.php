<div>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Income Statement</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/Dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Income Statement</li>
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
                                    <button id="saveReportsButtonyear" wire:click="generateIncomeStatement()"
                                        class="btn btn-block btn-warning float-left"><i class="fas fa-calendar">Generate
                                            Income Statement</i></button>
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
                                        <h4>Income Statement</h4>
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
                                        <h4><strong><u>Turnover</u>
                                            </strong></h4>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mt-2 mb-2 ml-5 ">
                                        Total Sales
                                    </div>
                                    <div class="col-md-3 mt-2 mb-2 ml-5 text-right ">
                                        {{ $registeredsales }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mt-2 mb-2 ml-5 ">
                                        <p>Other Incomes</p>
                                    </div>
                                    <div class="col-md-3 mt-2 mb-2 ml-5 text-right ">
                                        <p>{{ $registeredotherincomes }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mt-2 mb-2 ml-5 ">
                                        <h6><strong>Total Turnover
                                            </strong></h6>
                                    </div>
                                    <div class="col-md-4 mt-2 mb-2 ml-5 text-right ">
                                        <h6><strong>{{ $registeredsales + $registeredotherincomes }}</strong>
                                        </h6>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mt-2 mb-2 ml-5 ">
                                        <h4><strong><u>Cost Of Sales</u>
                                            </strong></h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mt-2 mb-2 ml-5 ">
                                        <p>Total Salary</p>
                                    </div>
                                    <div class="col-md-3 mt-2 mb-2 ml-5 text-right ">
                                        {{ $registeredsalary }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mt-2 mb-2 ml-5 ">
                                        <p>Purchase Cost</p>
                                    </div>
                                    <div class="col-md-3 mt-2 mb-2 ml-5 text-right ">
                                        {{ $registeredpurchases }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mt-2 mb-2 ml-5 ">
                                        <p>Sales Discount</p>
                                    </div>
                                    <div class="col-md-3 mt-2 mb-2 ml-5 text-right ">
                                        {{ $registereddiscounts }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mt-2 mb-2 ml-5 ">
                                        <h6><strong>Total Cost Of Sales
                                            </strong></h6>
                                    </div>
                                    <div class="col-md-4 mt-2 mb-2 ml-5 text-right ">
                                        <h6><strong>{{ $registeredpurchases + $registeredsalary + $registereddiscounts }}</strong>
                                        </h6>
                                        <hr
                                            style=" border: 1px solid #1434A4;margin-top: 1px;margin-bottom: 10px; margin-left:80%; ">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mt-2 mb-2 ml-5 ">
                                        <h5><strong>Gross Profit
                                            </strong></h5>
                                    </div>

                                    <div class="col-md-4 mt-2 mb-2 ml-5 text-right ">
                                        <h5><strong>{{ $registeredsales + $registeredotherincomes - ($registeredpurchases + $registeredsalary + $registereddiscounts) }}</strong>
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mt-2 mb-2 ml-5 ">
                                        <h4><strong><u>Operating Costs</u>
                                            </strong></h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mt-2 mb-2 ml-5 ">
                                        <p>Expenses</p>
                                    </div>
                                    <div class="col-md-3 mt-2 mb-2 ml-5 text-right ">
                                        {{ $registeredexpenses }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mt-2 mb-2 ml-5 ">
                                        <h5><strong>Profit
                                            </strong></h5>
                                    </div>
                                    <div class="col-md-4 mt-2 mb-2 ml-5 text-right ">
                                        <hr
                                            style=" border: 1px solid #1434A4;margin-top: 1px;margin-bottom: 10px; margin-left:80%; ">
                                        <h5><strong>{{ $registeredsales + $registeredotherincomes - ($registeredpurchases + $registeredsalary + $registeredexpenses + $registereddiscounts) }}</strong>
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
