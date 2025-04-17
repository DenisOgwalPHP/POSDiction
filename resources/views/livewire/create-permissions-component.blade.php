<div>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Permissions</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/admin/Dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Permissions</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">Define Permissions</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <div class="row">
                        <div class="col-sm-12">
                            <form wire:submit.prevent="savePermissions">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                <div class="form-group">
                                    <label>Select User Group</label>
                                    <select class="form-control select2bs4" style="width: 100%;" name="usergroup"
                                        wire:model="usergroup">
                                        <option selected>Select User Group</option>
                                        <option value="General Manager">General Manager</option>
                                        <option value="Manager">Manager</option>
                                        <option value="Cashier">Cashier</option>
                                        <option value="Attendant">Attendant</option>
                                        <option value="Store Manager">Store Manager</option>
                                        <option value="Sales Personnel">Sales Personnel</option>
                                        <option value="Human Resource">Human Resource</option>
                                        <option value="Accounts Manager">Accounts Manager</option>
                                        <option value="Purchases and Supplies">Purchases and Supplies</option>
                                        <option value="Administrator">Administrator</option>
                                    </select>
                                    @error('usergroup')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                    </div>
                                    <div class="col-md-6">
                                <div class="form-group">
                                    <label>Select Branch</label>
                                    <select class="form-control select2bs4" style="width: 100%;" name="branch"
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
                                <table class="table table-bordered table-striped">

                                    <tr style="width: 100%">
                                        <th style="width: 25%"></th>
                                        <th style="width: 25%"></th>
                                        <th style="width: 25%"></th>
                                        <th style="width: 25%"></th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="icheck-danger d-inline">
                                                <input type="checkbox" id="checkboxSuccess1"
                                                    wire:model="checkboxSuccess1">
                                                <label for="checkboxSuccess1">Settings</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="checkboxSuccess2"
                                                    wire:model="checkboxSuccess2">
                                                <label for="checkboxSuccess2">Account Creation</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="icheck-warning d-inline">
                                                <input type="checkbox" id="checkboxSuccess3"
                                                    wire:model="checkboxSuccess3">
                                                <label for="checkboxSuccess3">Account Update</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="icheck-danger d-inline">
                                                <input type="checkbox" id="checkboxSuccess4"
                                                    wire:model="checkboxSuccess4">
                                                <label for="checkboxSuccess4">Account Delete</label>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="checkboxSuccess5"
                                                    wire:model="checkboxSuccess5">
                                                <label for="checkboxSuccess5">Expenses</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="checkboxSuccess6"
                                                    wire:model="checkboxSuccess6">
                                                <label for="checkboxSuccess6">Sales Summary</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="checkboxSuccess7"
                                                    wire:model="checkboxSuccess7">
                                                <label for="checkboxSuccess7">Sales Records</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="checkboxSuccess8"
                                                    wire:model="checkboxSuccess8">
                                                <label for="checkboxSuccess8">Add Purchases</label>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="checkboxSuccess9"
                                                    wire:model="checkboxSuccess9">
                                                <label for="checkboxSuccess9">Client Account</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="checkboxSuccess10"
                                                    wire:model="checkboxSuccess10">
                                                <label for="checkboxSuccess10">Clear Creditors</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="checkboxSuccess11"
                                                    wire:model="checkboxSuccess11">
                                                <label for="checkboxSuccess11">Human Resource</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="checkboxSuccess12"
                                                    wire:model="checkboxSuccess12">
                                                <label for="checkboxSuccess12">Reports</label>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="checkboxSuccess13"
                                                    wire:model="checkboxSuccess13">
                                                <label for="checkboxSuccess13">Add Prices</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="checkboxSuccess14"
                                                    wire:model="checkboxSuccess14">
                                                <label for="checkboxSuccess14">Money Transfer</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="checkboxSuccess15"
                                                    wire:model="checkboxSuccess15">
                                                <label for="checkboxSuccess15">Delete</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="checkboxSuccess16"
                                                    wire:model="checkboxSuccess16">
                                                <label for="checkboxSuccess16">Update</label>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        
                                        <td>
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="checkboxSuccess17"
                                                    wire:model="checkboxSuccess17">
                                                <label for="checkboxSuccess17">Records</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="checkboxSuccess18"
                                                    wire:model="checkboxSuccess18">
                                                <label for="checkboxSuccess18">Search</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="checkboxSuccess19"
                                                    wire:model="checkboxSuccess19">
                                                <label for="checkboxSuccess19">Stock Balance</label>
                                            </div>
                                        </td>
                                        
                                    </tr>

                                </table>
                                <button type="submit" class="btn btn-block btn-info btn-lg">Submit</button>
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
