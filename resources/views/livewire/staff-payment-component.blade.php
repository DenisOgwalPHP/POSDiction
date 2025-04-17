<div>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Staff Payment Form</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/admin/Dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Add Staff Payment Form</li>
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
                                <h3 class="card-title">Input Staff Payment Details</h3>
                            </div>
                            <div class="card-body">

                                <form class="form-horizontal" wire:submit.prevent="AddStaffPayment"
                                    enctype="multipart/form-data">
                                    @csrf


                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-id-card"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <select class="form-control select" name="StaffID" wire:model="StaffID"
                                            style="width: 85%;">
                                            <option selected="selected">Select Staff ID</option>
                                            @foreach ($staffids as $staffids)
                                                <option value="{{ $staffids->id }}">
                                                    {{ $staffids->StaffID }}
                                                </option>
                                            @endforeach

                                        </select>
                                        @error('StaffID')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-user"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="StaffName"
                                            placeholder="Staff Name" wire:model="StaffName">
                                        @error('StaffName')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <label>Payment Date</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-calendar-day"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <input type="date" class="form-control" name="PaymentDate"
                                            placeholder="Staff Payment Date" wire:model="PaymentDate">
                                        @error('PaymentDate')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-calendar-week"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <select class="form-control select" name="PaymentMonths"
                                            wire:model="PaymentMonths" style="width: 85%;">
                                            <option selected="selected">Select Payment Months</option>
                                            @foreach (range(1, 12) as $month)
                                                <option value="{{ $month }}">
                                                    {{ date('F', mktime(0, 0, 0, $month, 1)) }}</option>
                                            @endforeach
                                        </select>
                                        @error('PaymentMonths')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-calendar"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <select class="form-control select" name="PaymentYear" wire:model="PaymentYear"
                                            style="width: 85%;">
                                            <option selected="selected">Select Payment Year</option>
                                            @php
                                                $currentYear = date('Y');
                                            @endphp
                                            @for ($year = $currentYear - 5; $year <= $currentYear + 5; $year++)
                                                <option value="{{ $year }}"
                                                    {{ $year == $currentYear ? 'selected' : '' }}>
                                                    {{ $year }}</option>
                                            @endfor
                                        </select>
                                        @error('PaymentYear')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-money-bill"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <input type="numeric" class="form-control" name="BasicSalary"
                                            placeholder="Basic Salary" wire:model="BasicSalary">
                                        @error('BasicSalary')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-money-bill"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <input type="numeric" class="form-control" name="SalaryPaid"
                                            placeholder="Salary Paid" wire:model="SalaryPaid">
                                        @error('SalaryPaid')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                        @if (Session::has('message'))
                                            <p class="text-danger" role="alert">{{ Session::get('message') }}</p>
                                        @else
                                        @endif
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
                                    <div class="form-group" wire:ignore>
                                        <label>Payment Notes.</label>
                                        <textarea id="description" name="description" wire:model="description"></textarea>
                                        @error('description')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-block btn-success btn-lg">Add
                                            Staff Payment</button>
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
                                <h3 class="card-title">Staff Payment Listing</h3>
                            </div>
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Staff ID</th>
                                            <th>Paid Amount</th>
                                            <th>EDIT</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($registeredstaffpayment as $payment)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $payment->StaffID }}</td>
                                                <td>{{ $payment->SalaryPaid }}</td>
                                                <td>{{ $payment->staffpaymentbranch->BranchName }}</td>
                                                <td><a href="{{ route('Staff-Payment', ['slug' => $payment->id]) }}"
                                                        class="btn btn-block btn-outline-warning"> <i
                                                            class="fa fa-edit fa-2x text-warning"></i></a></td>
                                                <td> <a href="#" class="btn btn-block btn-outline-danger"
                                                        onclick="confirm('Are you sure, You want to delete this Staff Payment Listing') || event.stopImmediatePropagation()"
                                                        wire:click.prevent="deleteStaffPayment({{ $payment->id }})">
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

        document.addEventListener('livewire:load', function() {
            Livewire.hook('element.initialized', (el, component) => {
                if (el.isSameNode($refs.summernoteTextarea)) {
                    $('#description').summernote({
                        callbacks: {
                            onChange: function(contents) {
                                component.set('content', contents);
                            }
                        }
                    });

                    component.set('isInitialized', true);
                }
            });
        });

        document.addEventListener('livewire:update', function(event) {
            const {
                component,
                el
            } = event.detail;

            if (el.isSameNode($refs.summernoteTextarea) && component.get('isInitialized') === false) {
                $('#description').summernote({
                    callbacks: {
                        onChange: function(contents) {
                            component.set('content', contents);
                        }
                    }
                });

                component.set('isInitialized', true);
            }
        });
    </script>
@endpush
