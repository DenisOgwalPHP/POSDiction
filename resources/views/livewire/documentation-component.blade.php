<div>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Documentation Details Editor </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/admin/Dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Documentation Form</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title">
                                Documentation Details
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <form class="form-horizontal" enctype="multipart/form-data"
                                wire:submit.prevent="saveDocumentation">
                                @csrf
                                <div class="form-group" wire:ignore>
                                    <label for="exampleInputFile">Dashboard Documentation</label>
                                    <textarea id="description" name="description" wire:model="description"></textarea>
                                    @error('description')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group" wire:ignore>
                                    <label for="exampleInputFile">Dashboard Documentation Attachment</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" wire:model="attachment">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                    </div>
                                    @error('attachment')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group" wire:ignore>
                                    <label for="exampleInputFile">App Documentation</label>
                                    <textarea id="description1" name="description1" wire:model="description1"></textarea>
                                    @error('description1')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group" wire:ignore>
                                    <label for="exampleInputFile">App Documentation Attachment</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="exampleInputFile"
                                                wire:model="attachment1">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                    </div>
                                    @error('attachment1')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-block btn-success btn-lg">Save</button>
                                </div>
                            </form>
                        </div>


                    </div>
                </div>
                <!-- /.col-->
            </div>
        </section>
    </div>
</div>
<!-- Page specific script -->
@push('scripts')
    <script>
        $(function() {
            // Summernote
            $('#description').summernote({
                Placeholder: 'Please add your Dashboard Documentation',
                tabsize: 2,
                minHeight: 150,
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
            $('#description1').summernote({
                Placeholder: 'Please add your App Documentation',
                tabsize: 2,
                minHeight: 150,
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
                        @this.set('description1', contents);
                    }
                }

            })

            // CodeMirror
            CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
                mode: "htmlmixed",
                theme: "monokai"
            });
        })

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
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
@endpush
