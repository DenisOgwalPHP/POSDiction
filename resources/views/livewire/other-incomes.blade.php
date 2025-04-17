<div>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Other Income Form</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/Dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Add Other Income Form</li>
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
                                <h3 class="card-title">Input Other Income Details</h3>
                            </div>
                            <div class="card-body">

                                <form class="form-horizontal" wire:submit.prevent="AddOtherIncome"
                                    enctype="multipart/form-data">
                                    @csrf
                                                                      
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-file-invoice"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="paidfor"
                                            placeholder="Paid For" wire:model="paidfor">
                                        @error('paidfor')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-money-bill"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <input type="number" class="form-control" name="IncomePaid"
                                            placeholder="Income Paid Amount" wire:model="IncomePaid">
                                        @error('IncomePaid')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-credit-card"></i></span>
                                        </div>
                                        <select class="form-control select" name="PaymentMethod"
                                            wire:model="PaymentMethod" style="width: 85%;">
                                            <option selected="selected">Select Payment Method</option>
                                            @foreach ($sellpaymentmethods as $sellpaymentmethod)
                                            <option value="{{ $sellpaymentmethod->id }}">
                                                {{ $sellpaymentmethod->PaymentMethod }}</option>
                                        @endforeach
                                        </select>
                                        @error('PaymentMethod')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-project-diagram"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <select class="form-control select" style="width: 80%;" name="branch"
                                            wire:model="branch">
                                            <option selected>Select Branch</option>
                                            <option value="100">Central Store</option>
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

                                    <div class="form-group" wire:ignore>
                                        <label>Description.</label>
                                        <textarea id="description" name="description" wire:model="description"></textarea>
                                        @error('description')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-block btn-success btn-lg">Add
                                            Other Income</button>
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
                                <h3 class="card-title">Other Income Listing</h3>
                            </div>
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Paid For</th>
                                            <th>Income Paid</th>
                                            <th>EDIT</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($registeredotherincomes as $registeredotherincome)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $registeredotherincome->PaidFor }}</td>
                                                <td>{{ $registeredotherincome->IncomePaid}}</td>
                                                <td><a href="{{ route('Other-Incomes', ['slug' => $registeredotherincome->id]) }}"
                                                        class="btn btn-block btn-outline-warning"> <i
                                                            class="fa fa-edit fa-2x text-warning"></i></a></td>
                                                <td> <a href="#" class="btn btn-block btn-outline-danger"
                                                        onclick="confirm('Are you sure, You want to delete this Other Income Listing') || event.stopImmediatePropagation()"
                                                        wire:click.prevent="deleteIncome({{ $registeredotherincome->id }})">
                                                        <i class="fa fa-times fa-2x text-danger"></i></a>
                                                </td>
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
                minHeight: 250,
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
