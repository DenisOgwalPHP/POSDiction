<div>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Contact Setting Form</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/admin/Dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Contact Setting Form</li>
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
                    <div class="col-md-12">

                        <!-- Input addon -->
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Contact Setting Details</h3>
                            </div>
                            <div class="card-body">
                              
                                <form action="" class="form-horizontal" enctype="multipart/form-data"
                                    wire:submit.prevent="saveSettings">
                                    <div class="input-group mb-3">
                                        <div class="input-group col-md-6">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-envelope"
                                                        aria-hidden="true"></i></span>
                                            </div>
                                            <input type="email" class="form-control" placeholder="Email"
                                                wire:model="email">
                                            @error('email')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class=" input-group col-md-6">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="phone"
                                                wire:model="phone">
                                            @error('phone')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class=" input-group col-md-6">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Phone 2"
                                                wire:model="phone2">
                                            @error('phone2')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class=" input-group col-md-6">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-map-marker"></i></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Address"
                                                wire:model="address">
                                            @error('address')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class=" input-group col-md-6">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fab fa-twitter"
                                                        aria-hidden="true"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Twitter"
                                                wire:model="twitter">
                                            @error('twitter')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class=" input-group col-md-6">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fab fa-facebook"
                                                        aria-hidden="true"></i></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Facebook"
                                                wire:model="facebook">
                                            @error('facebook')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class=" input-group col-md-6">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fab fa-instagram"
                                                        aria-hidden="true"></i></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Instagram"
                                                wire:model="instagram">
                                            @error('instagram')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class=" input-group col-md-6">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fab fa-youtube"
                                                        aria-hidden="true"></i></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Youtube"
                                                wire:model="youtube">
                                            @error('youtube')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class=" input-group col-md-6">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fab fa-linkedin"></i></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="LinkedIns"
                                                wire:model="linkedIn">
                                            @error('linkedIn')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class=" input-group col-md-6">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-map-marker"></i></span>
                                            </div>
                                                <select class="form-control select2bs4" style="width: 90%;" name="branch"
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
                                    <div class="input-group">
                                        <button type="submit" class="btn btn-block btn-success">Save</button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>

                </div>
            </div>
        </section>

    </div>
</div>
