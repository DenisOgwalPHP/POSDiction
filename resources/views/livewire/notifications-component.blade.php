<div>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Notification Form</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/admin/Dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Add Notification Form</li>
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
                                <h3 class="card-title">Input Notification Details</h3>
                            </div>
                            <div class="card-body">

                                <form class="form-horizontal" wire:submit.prevent="AddNotification">
                                    @csrf
                                    <div class="row">
                                    <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-user"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <select class="form-control select" name="PostedFor" wire:model="PostedFor"
                                            style="width: 80%;">
                                            <option selected="selected">Select Notification Target</option>
                                            <option value="All">All</option>
                                            <option value="Customers">Customers</option>
                                            <option value="Suppliers">Suppliers</option>
                                            <option value="Staff">Staff</option>
                                        </select>
                                        @error('PostedFor')
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

                                    <div class="form-group" wire:ignore>
                                        <label>Notification Details</label>
                                        <textarea id="description" name="description" wire:model="description"></textarea>
                                        @error('description')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-block btn-success btn-lg">Add
                                            Notification</button>
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
                                <h3 class="card-title">Notification Listing</h3>
                            </div>
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Notification</th>
                                            <th>Branch</th>
                                            <th>EDIT</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($registerednotifications as $registerednotification)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{!! Str::limit(strip_tags($registerednotification->Description), 30, '...') !!}</td>
                                                <td>{{$registerednotification->notificationbranch->BranchName}}</td>
                                                <td><a href="{{ route('Notification', ['slug' => $registerednotification->id]) }}"
                                                        class="btn btn-block btn-outline-warning"> <i
                                                            class="fa fa-edit fa-2x text-warning"></i></a></td>
                                                <td> <a href="#" class="btn btn-block btn-outline-danger"
                                                        onclick="confirm('Are you sure, You want to delete this Notification Listing') || event.stopImmediatePropagation()"
                                                        wire:click.prevent="deleteNotification({{ $registerednotification->id }})">
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

            // CodeMirror
            CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
                mode: "htmlmixed",
                theme: "monokai"
            });
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
