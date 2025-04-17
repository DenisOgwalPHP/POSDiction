<div>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Register Client Account Details Form</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/Dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Register Client Account Details Form</li>
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
                                <h3 class="card-title">Input Client Account Details</h3>
                            </div>
                            <div class="card-body">

                                <form class="form-horizontal" wire:submit.prevent="AddClientAccount">
                                    @csrf
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="AccountName"
                                    wire:model="AccountName" placeholder="Given Name" />
                                        @error('AccountName')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                     <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="AccountName2"
                                    wire:model="AccountName2" placeholder="Surname" />
                                        @error('AccountName2')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-box"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <select class="form-control select" style="width: 80%;" name="Gender"
                                            wire:model="Gender">
                                            <option selected>Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                        @error('Gender')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>


                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="ContactNo"
                                            wire:model="ContactNo" placeholder="Phone 1" />
                                        @error('ContactNo')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                      <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="ContactNo2"
                                            wire:model="ContactNo2" placeholder="Phone 2" />
                                        @error('ContactNo2')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-map"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="Village"
                                            wire:model="Village" placeholder="Village" />
                                        @error('Village')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-map"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="District"
                                            wire:model="District" placeholder="District" />
                                        @error('District')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-map"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="Location"
                                            wire:model="Location" placeholder="Address" />
                                        @error('Location')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="NIN_Number"
                                            wire:model="NIN_Number" placeholder="NIN Number" /> 
                                    </div> 
                                     @error('NIN_Number')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror                                   
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-block btn-success btn-lg">
                                            Register Client Account Details</button>
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
                                <h3 class="card-title">Client Account Listing</h3>
                            </div>
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>Account Name</th>
                                            <th>Contact No.</th>
                                            <th>NIN</th>
                                            <th>EDIT</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($registeredClient as $registeredCli)
                                            <tr>
                                                <td>{{ $registeredCli->AccountName }} {{ $registeredCli->AccountName2 }}</td>
                                                <td>{{ $registeredCli->ContactNo }}</td>
                                                <td>{{ $registeredCli->TINnumber }}</td>
                                                <td><a href="{{ route('Client-Account', ['slug' => $registeredCli->id]) }}"
                                                        class="btn btn-block btn-outline-warning"> <i
                                                            class="fa fa-edit fa-2x text-warning"></i></a></td>
                                                <td> <a href="#" class="btn btn-block btn-outline-danger"
                                                        onclick="confirm('Are you sure, You want to delete this Client Account Listing') || event.stopImmediatePropagation()"
                                                        wire:click.prevent="deleteClientAccount({{ $registeredCli->id }})">
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

    <!-- Page specific script -->
    <script>
        $(document).ready(function() {
            // Summernote
            $('#Description').summernote({
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
                        @this.set('Description', contents);
                    }
                }

            })
        });
    </script>
@endpush
