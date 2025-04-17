<div>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Boarding Attendance Records</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/admin/Dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Boarding Attendance Records</li>
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
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select class="form-control select" name="StudentHouse" wire:model="StudentHouse">
                                        <option selected="selected">Select Student House</option>
                                        @foreach ($classes as $classe)
                                            <option value="{{ $classe->House }}">
                                                {{ $classe->House }}
                                            </option>
                                        @endforeach

                                    </select>
                                    @error('StudentClass')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select class="form-control select" name="StudentYear" wire:model="StudentYear">
                                        <option selected="selected">Select Year</option>
                                        @php
                                            $currentYear = date('Y');
                                        @endphp
                                        @for ($year = $currentYear - 0; $year <= $currentYear + 10; $year++)
                                            <option value="{{ $year }}"
                                                {{ $year == $currentYear ? 'selected' : '' }}>
                                                {{ $year }}</option>
                                        @endfor
                                    </select>
                                    @error('StudentYear')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select class="form-control select" name="StudentTerm" wire:model="StudentTerm">
                                        <option selected="selected">Select Study Term</option>
                                        <option value="1st">1st</option>
                                        <option value="2nd">2nd</option>
                                        <option value="3rd">3rd</option>
                                    </select>
                                    @error('StudentTerm')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- Account Records -->
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Boarding Attendance Record Listing</h3>
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Student Number</th>
                                            <th>LIN</th>
                                            <th>Student Name</th>
                                            <th>Year</th>
                                            <th>Term</th>
                                            <th>Presence</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($registeredAttendance as $Attendance)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $Attendance->StudentRefferID }}</td>
                                                <td>{{ $Attendance->hasstudents->LIN }}</td>
                                                <td>{{ $Attendance->hasstudents->StudentName }}</td>
                                                <td>{{ $Attendance->Year }}</td>
                                                <td>{{ $Attendance->Term }}</td>
                                                <td>{{ $Attendance->attendance_count }}</td>
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
@endpush
