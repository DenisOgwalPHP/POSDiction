<div>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Devidends Withdraw</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/Dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Devidends Withdraw</li>
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
                                <h3 class="card-title">Input Devidends Details</h3>
                            </div>
                            <div class="card-body">

                                <form action="" class="form-horizontal" enctype="multipart/form-data"
                                    wire:submit.prevent="AddDevidends">
                                    @csrf

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-coins"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <input type="number" class="form-control" placeholder="Amount Paid"
                                            wire:model="amountwithdrawn">
                                        @error('amountwithdrawn')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>


                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <select class="form-control select" style="width: 80%;" name="accountto"
                                            wire:model="accountto">
                                            <option selected>Select Account Issued To</option>
                                            @foreach ($paymentaccounts as $paymentaccount)
                                                <option value="{{ $paymentaccount->id }}">
                                                    {{ $paymentaccount->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('accountto')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-credit-card"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <select class="form-control select" style="width: 80%;" name="paymentmethod"
                                            wire:model="paymentmethod">
                                            <option selected>Select Payment Method</option>
                                            @foreach ($paymentmethods as $paymentmethod)
                                                <option value="{{ $paymentmethod->id }}">
                                                    {{ $paymentmethod->PaymentMethod }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('paymentmethod')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group" wire:ignore>
                                        <label>Reason.</label>
                                        <textarea id="description" name="description" wire:model="description"></textarea>
                                        @error('description')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <button type="submit"
                                            class="btn btn-block btn-success btn-lg">Issue</button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>

                    <!-- Right Column -->
                    <div class="col-md-6">
                        <!-- Account Records -->
                        <div class="card card-info" wire:ignore>
                            <div class="card-header">
                                <h3 class="card-title">Devidends Listing</h3>
                            </div>
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Amount</th>
                                            <th>Issued To</th>
                                            <th>Issued By</th>
                                            @if (Auth::user()->utype == 'General Manager' || Auth::user()->utype == 'Administrator')
                                                <th>Branch</th>
                                            @endif
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($registereddevidends as $registereddevidend)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $registereddevidend->Amount }}</td>
                                                <td>{{ $registereddevidend->payedto->name }}</td>
                                                <td>{{ $registereddevidend->hasusers->name}}</td>
                                                @if (Auth::user()->utype == 'General Manager' || Auth::user()->utype == 'Administrator')
                                                    <td>{{ $registereddevidend->withdrawbranch->BranchName }}</td>
                                                @endif
                                                <td><a href="{{ route('Devidends', ['slug' => $registereddevidend->id]) }}"
                                                        class="btn btn-block btn-outline-warning"> <i
                                                            class="fa fa-edit fa-2x text-warning"></i></a></td>
                                                <td> <a href="#" class="btn btn-block btn-outline-danger"
                                                        onclick="confirm('Are you sure, You want to delete this Devidend Listing') || event.stopImmediatePropagation()"
                                                        wire:click.prevent="deleteDevidend({{ $registereddevidend->id }})">
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
