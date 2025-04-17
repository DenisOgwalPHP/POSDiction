<div>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Staff Attendance</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/admin/Dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Staff Attendance</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">Define Staff</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <div class="row">
                        <div class="col-sm-12">
                            <form wire:submit.prevent="submitstafflist">
                                @csrf
                                <div class="row">
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
                        </form>
                    </div>
                </div>
                <div class="row">&nbsp;</div>

                <div class="row">
                    <div class="col-md-12">
                        <form wire:submit.prevent="saveAttendance">
                            @csrf
                            <div class="row">
                                <table class="table table-bordered table-striped">
                                    <tr style="width: 100%">
                                        <th style="width: 15%">Department</th>
                                        <th style="width: 15%">Staff ID</th>
                                        <th style="width: 15%">Staff Name</th>

                                    </tr>
                                  
                                        @foreach ($registeredstaff as $staff)
                                            <tr>
                                                <td>
                                                    {{ $staff->Department}} 
                                                </td>
                                                <td>
                                                    {{ $staff->StaffID }} 
                                                </td>
                                                <td>
                                                    {{ $staff->StaffName }}
                                                </td>
                                                <td style="text-align: center;">
                                                    <div class="icheck-success d-inline">
                                                        <input type="checkbox"
                                                            wire:model="selectedStaff.{{$staff->id }}"
                                                            id="{{$staff->id }}" name='{{ $staff->id }}'
                                                            style="display: inline-block; horizontal-align: middle;">
                                                        <label for="{{ $staff->id }}"></label>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                </table>
                                <button type="submit" class="btn btn-block btn-info btn-lg">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
    </div>
    <!-- /.card -->
    </section>
    <!-- /.content -->
</div>
</div>
