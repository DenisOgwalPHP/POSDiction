<div>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Contacts</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/admin/Dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Contacts</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <!-- Timelime example  -->
                <div class="row">
                    <div class="col-md-12">
                        <!-- The time line -->
                        <div class="timeline">
                            <!-- timeline time label -->
                            <div class="time-label">
                                <span class="bg-red">Contacts</span>
                            </div>
                            <!-- /.timeline-label -->
                            <!-- timeline item -->
                            <div>
                                <i class="fas fa-envelope bg-blue"></i>
                                <div class="timeline-item">
                                    <h3 class="timeline-header"><a href="#">Contact us Via Email</a></h3>
                                    <div class="timeline-body">
                                        <strong>Inquire:</strong> {{ $contacts->email }}<br>
                                        <strong>Support Team:</strong> support@ditherug.tech
                                    </div>

                                </div>
                            </div>
                            <!-- END timeline item -->
                            <!-- timeline item -->
                            <div>
                                <i class="fas fa-phone bg-green"></i>
                                <div class="timeline-item">
                                    <h3 class="timeline-header no-border"><a href="#">Phone Contacts</a></h3>
                                    <div class="timeline-body">
                                        <strong>Call:</strong> {{ $contacts->phone }}<br>
                                        <strong>WhatsApp:</strong> {{ $contacts->phone2 }}
                                    </div>

                                </div>
                            </div>
                            <!-- END timeline item -->
                            <!-- timeline item -->
                            <div>
                                <i class="fas fa-map-marker bg-yellow"></i>
                                <div class="timeline-item">
                                    <h3 class="timeline-header"><a href="#">Address</a></h3>
                                    <div class="timeline-body">
                                        {{ $contacts->address }}
                                    </div>

                                </div>
                            </div>
                            <!-- END timeline item -->
                            <div class="time-label">
                                <span class="bg-blue">Address Map</span>
                            </div>

                            <!-- timeline item -->
                            <div>
                                <i class="fas fa-map bg-pink"></i>

                                <div class="timeline-item">
                                    <h3 class="timeline-header"><a href="#">School Address</a></h3>

                                    <div class="timeline-body">
                                        <div class="embed-responsive embed-responsive-16by9">
                                            <iframe
                                                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15958.993000527325!2d32.5629815!3d0.3395693!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x177dbb48f8668e45%3A0x79db301650a762da!2sDither%20Technologies%20(U)%20LTD!5e0!3m2!1sen!2sug!4v1688999545186!5m2!1sen!2sug"
                                                width="600" height="450" style="border:0;" allowfullscreen=""
                                                loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END timeline item -->

                            <!-- timeline time label -->
                            <div class="time-label">
                                <span class="bg-green">Photography</span>
                            </div>
                            <!-- /.timeline-label -->
                            <!-- timeline item -->
                            <div>
                                <i class="fa fa-camera bg-purple"></i>
                                <div class="timeline-item">
                                    <h3 class="timeline-header"><a href="#">Photos</a></h3>
                                    <div class="timeline-body">
                                        <img src="https://placehold.it/150x100" alt="...">
                                        <img src="https://placehold.it/150x100" alt="...">
                                        <img src="https://placehold.it/150x100" alt="...">
                                        <img src="https://placehold.it/150x100" alt="...">
                                        <img src="https://placehold.it/150x100" alt="...">
                                    </div>
                                </div>
                            </div>
                            <!-- END timeline item -->
                            <!-- timeline item -->
                            <div>
                                <i class="fas fa-video bg-maroon"></i>

                                <div class="timeline-item">
                                    <h3 class="timeline-header"><a href="#">Youtube Video</a></h3>

                                    <div class="timeline-body">
                                        <div class="embed-responsive embed-responsive-16by9">
                                            <iframe class="embed-responsive-item"
                                                src="https://www.youtube.com/embed/tMWkeBIohBs"
                                                allowfullscreen></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END timeline item -->

                        </div>
                    </div>
                    <!-- /.col -->
                </div>
            </div>
            <!-- /.timeline -->

        </section>
        <!-- /.content -->

    </div>
</div>
