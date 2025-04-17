<div>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Expense Form</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/Dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Add Expense Form</li>
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
                                <h3 class="card-title">Input Expense Details</h3>
                            </div>
                            <div class="card-body">

                                <form class="form-horizontal" wire:submit.prevent="AddExpense"
                                    enctype="multipart/form-data">
                                    @csrf
                                                                      
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-file-invoice"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="ExpenseName"
                                            placeholder="Expense Name" wire:model="ExpenseName">
                                        @error('ExpenseName')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-list"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <select class="form-control select" name="ExpenseCategory"
                                            wire:model="ExpenseCategory" style="width: 85%;">
                                            <option selected="selected">Select Expense Category</option>
                                            @foreach ($expensecategorys as $category)
                                                <option value="{{ $category->CategoryName }}">
                                                    {{ $category->CategoryName }}
                                                </option>
                                            @endforeach

                                        </select>
                                        @error('ExpenseCategory')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <label>Expense Date</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-calendar-day"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <input type="date" class="form-control" name="ExpenseDate"
                                            placeholder="Expense Date" wire:model="ExpenseDate">
                                        @error('ExpenseDate')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-wallet"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <input type="number" class="form-control" name="ExpenseCost"
                                            placeholder="Expense Cost" wire:model="ExpenseCost">
                                        @error('ExpenseCost')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-money-bill"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <input type="number" class="form-control" name="ExpensePaid"
                                            placeholder="Expense Paid Amount" wire:model="ExpensePaid">
                                        @error('ExpensePaid')
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
                                            Expense</button>
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
                                <h3 class="card-title">Expenses Listing</h3>
                            </div>
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Expense</th>
                                            <th>Expense Cost</th>
                                            <th>Paid Amount</th>
                                            <th>EDIT</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($registeredexpenses as $registeredexpense)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $registeredexpense->Expense }}</td>
                                                <td>{{ $registeredexpense->ExpenseCost }}</td>
                                                <td>{{ $registeredexpense->ExpensePaid }}</td>
                                                <td><a href="{{ route('Expense-Entry', ['slug' => $registeredexpense->id]) }}"
                                                        class="btn btn-block btn-outline-warning"> <i
                                                            class="fa fa-edit fa-2x text-warning"></i></a></td>
                                                <td> <a href="#" class="btn btn-block btn-outline-danger"
                                                        onclick="confirm('Are you sure, You want to delete this Expense Listing') || event.stopImmediatePropagation()"
                                                        wire:click.prevent="deleteExpense({{ $registeredexpense->id }})">
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
                "searching": false,
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
