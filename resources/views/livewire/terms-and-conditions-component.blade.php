<div>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Terms And Conditions Details Editor </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/admin/Dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Terms And Conditions Editors</li>
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
                                Terms And Conditions Details
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <form class="form-horizontal" enctype="multipart/form-data"
                                wire:submit.prevent="saveTermsAndConditions">
                                @csrf
                                <div class="form-group" wire:ignore>
                                    <textarea id="description" name="description" wire:model="description"></textarea>
                                    @error('description')
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
        $(document).ready(function() {
            // Summernote
            $('#description').summernote({
                Placeholder: 'Please add your Terms and Conditions',
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
