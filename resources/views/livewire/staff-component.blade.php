<div>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Staff Form</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/admin/Dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Add Staff Form</li>
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
                                <h3 class="card-title">Input Staff Details</h3>
                            </div>
                            <div class="card-body">

                                <form class="form-horizontal" wire:submit.prevent="AddStaff"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">

                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-id-card"
                                                            aria-hidden="true"></i></span>
                                                </div>
                                                <input type="text" class="form-control" name="StaffID"
                                                    placeholder="Staff ID" wire:model="StaffID">
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
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-user"
                                                            aria-hidden="true"></i></span>
                                                </div>
                                                <input type="text" class="form-control" name="StaffInitial"
                                                    placeholder="Staff Initials" wire:model="StaffInitial">
                                                @error('StaffInitial')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-venus"></i></span>
                                                </div>
                                                <select class="form-control select" name="Gender" wire:model="Gender"
                                                    style="width: 80%;">
                                                    <option selected="selected">Select Staff Gender</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>

                                                @error('Gender')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        @php
                                            if ($newImage) {
                                                $temporaryFileName = pathinfo($this->newImage->getRealPath(), PATHINFO_BASENAME);
                                            }
                                        @endphp

                                        <div class="col-md-6">
                                            <!-- Profile Image -->
                                            <div class="card card-primary card-outline">
                                                <div class="text-center">
                                                    @if ($StaffProfilePic)
                                                        <img src="{{ asset('assets/StaffProfilePics/' . $StaffProfilePic) }}"
                                                            class="profile-user-img img-fluid img-circle"
                                                            alt="User Image"> 
                                                    @elseif ($newImage)
                                                        <img src="{{ asset('assets/livewire-tmp/' . $temporaryFileName) }}"
                                                            class="profile-user-img img-fluid img-circle"
                                                            alt="User Image">
                                                    @else
                                                        <img src="{{ asset('dist/img/avatar5.png') }}"
                                                            class="profile-user-img img-fluid img-circle"
                                                            alt="User Image">
                                                    @endif
                                                    <p class="text-muted text-center">Staff Profile Picture</p>
                                                    <input type="file" class="btn btn-primary btn-block"
                                                        wire:model="newImage">
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                            @error('newImage')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                            <!-- /.card -->
                                        </div>
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-map"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="Residence"
                                            placeholder="Residence Address" wire:model="Residence">
                                        @error('Residence')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-phone"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="Contact"
                                            placeholder="Contact No." wire:model="Contact">
                                        @error('Contact')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-envelope"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <input type="email" class="form-control" name="EmailAddress"
                                            placeholder="EmailAddress" wire:model="EmailAddress">
                                        @error('EmailAddress')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <label>Date of Birth</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-calendar"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <input type="date" class="form-control" name="DOB"
                                            placeholder="Date of Birth" wire:model="DOB">
                                        @error('DOB')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-puzzle-piece"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="Department"
                                            placeholder="Department" wire:model="Department">
                                        @error('Department')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-graduation-cap"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="Qualifications"
                                            placeholder="Qualifications" wire:model="Qualifications">
                                        @error('Qualifications')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-briefcase"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="Designation"
                                            placeholder="Designation" wire:model="Designation">
                                        @error('Designation')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="row">
                                    <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-layer-group"></i></span>
                                        </div>
                                        <select class="form-control select" name="StaffType" wire:model="StaffType"
                                            style="width: 80%;">
                                            <option selected="selected">Select Staff Type</option>
                                            <option value="Sales Staff">Sales Staff</option>
                                            <option value="Administration Staff">Administration Staff</option>
                                        </select>

                                        @error('StaffType')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-map-marker"
                                                        aria-hidden="true"></i></span>
                                            </div>
                                            <select class="form-control select" style="width: 80%;" name="branch"
                                                wire:model="branch">
                                                <option selected>Select Branch</option>
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
                                    </div>
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-money-bill"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <input type="number" class="form-control" name="BasicSalary"
                                            placeholder="Basic Salary" wire:model="BasicSalary">
                                        @error('BasicSalary')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-file-invoice"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="AccountNo"
                                            placeholder="Account No." wire:model="AccountNo">
                                        @error('AccountNo')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-piggy-bank"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="BankName"
                                            placeholder="Bank Name" wire:model="BankName">
                                        @error('BankName')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-building"
                                                            aria-hidden="true"></i></span>
                                                </div>
                                                <input type="text" class="form-control" name="OfficeNo"
                                                    placeholder="Office No." wire:model="OfficeNo">
                                                @error('OfficeNo')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-user"
                                                            aria-hidden="true"></i></span>
                                                </div>
                                                <select class="form-control select2" style="width: 80%;"
                                                    wire:model="UserID" name="UserID">
                                                    <option selected="selected">Select Staff Login Account Link
                                                    </option>
                                                    @foreach ($emails as $emails)
                                                        <option value="{{ $emails->id }}">{{ $emails->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('UserID')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-block btn-success btn-lg">Add
                                            Staff</button>
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
                                <h3 class="card-title">Staff Listing</h3>
                            </div>
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Staff ID</th>
                                            <th>Staff Name</th>
                                            <th>Branch</th>
                                            <th>EDIT</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($registeredstaffs as $registeredstaff)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $registeredstaff->StaffID }}</td>
                                                <td>{{ $registeredstaff->StaffName }}</td>
                                                <td>{{$registeredstaff->staffbranch->BranchName}}</td>
                                                <td><a href="{{ route('Create-Staff', ['slug' => $registeredstaff->id]) }}"
                                                        class="btn btn-block btn-outline-warning"> <i
                                                            class="fa fa-edit fa-2x text-warning"></i></a></td>
                                                <td> <a href="#" class="btn btn-block btn-outline-danger"
                                                        onclick="confirm('Are you sure, You want to delete this Staff Listing') || event.stopImmediatePropagation()"
                                                        wire:click.prevent="deleteStaff({{ $registeredstaff->id }})">
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
                "editable": true,
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
