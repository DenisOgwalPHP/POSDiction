<div>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Blog Form</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/admin/Dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Edit Blog Form</li>
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
                                <h3 class="card-title">Edit Blog Details</h3>
                            </div>
                            <div class="card-body">

                                <form class="form-horizontal" enctype="multipart/form-data"
                                    wire:submit.prevent="updateBlog">
                                    @csrf
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-blog"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <input type="text" name="name" id="name" placeholder="Blog Name"
                                            class="form-control" wire:model="name" wire:keyup="generateslug">
                                        @error('name')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-blog"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <input type="text" name="slug" id="slug" placeholder="Blog Slug"
                                            class="form-control" wire:model="slug">
                                        @error('slug')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-file-image"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <input type="file" class="form-control" id="newImage" name="newImage"
                                            wire:model="newImage">

                                        {{-- }} @error('image')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror --}}
                                    </div>
                                    <div class="input-group mb-3">
                                        @if ($newImage)
                                            <img src="{{ $newImage->temporaryUrl() }}" width="120" alt="">
                                        @else
                                            <img src="{{ asset('assets/blogs') }}/{{ $image }}" width="120"
                                                alt="">
                                        @endif
                                    </div>



                                    <div class="form-group" wire:ignore>
                                        <label>Blog Description</label>
                                        <textarea id="description" name="description" wire:model="description"></textarea>
                                        @error('description')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-block btn-success btn-lg">Edit
                                            Blog</button>
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
                                <h3 class="card-title">Blogs Listing</h3>
                            </div>
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Blog ID</th>
                                            <th>Blog Title</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($registeredBlogs as $registeredBlogs)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $registeredBlogs->id }}</td>
                                                <td>{{ $registeredBlogs->name }}</td>
                                                <td>
                                                    <a class="btn btn-block btn-outline-warning"
                                                        href="{{ route('editblog', ['blog_slug' => $registeredBlogs->slug]) }}"><i
                                                            class="fa fa-edit fa-2x"></i></a>
                                                </td>
                                                <td>

                                                    <a href="#" class="btn btn-block btn-outline-danger"
                                                        onclick="confirm('Are you sure, You want to delete this Blog') || event.stopImmediatePropagation()"
                                                        wire:click.prevent="deleteBlog({{ $registeredBlogs->id }})">
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
                Placeholder: 'Please add your Privacy Policy',
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
