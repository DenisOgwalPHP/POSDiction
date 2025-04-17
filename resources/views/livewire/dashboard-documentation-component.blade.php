<div>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Dashboard User Documentation</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/admin/Dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard Documentation</li>
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
                        <div class="card card-info">
                            <div class="card-header">
                            </div>
                            <div class="card-body">
                                <!-- Account Records -->
                                @foreach ($dashboarddocumentation as $dashboarddocumentation)
                                    {!! $dashboarddocumentation->Description !!}

                            </div>
                            <div class="card-footer">
                                <a href="{{ asset('assets/Documentation') }}/{{ $dashboarddocumentation->Attachment }}"
                                    target="_blank">Download</a> Attachment for offline access of this
                                Documentation
                                <a href="{{ asset('assets/Documentation') }}/{{ $dashboarddocumentation->Attachment }}"
                                    target="_blank" class="btn btn-primary">Download Attachment</a>
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
</div>
