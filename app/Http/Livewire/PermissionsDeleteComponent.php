<?php

namespace App\Http\Livewire;
use App\Models\Permissions;
use App\Models\BranchModel;
use Livewire\Component;

class PermissionsDeleteComponent extends Component
{
    public $checkboxSuccess1;
    public $checkboxSuccess2;
    public $checkboxSuccess3;
    public $checkboxSuccess4;
    public $checkboxSuccess5;
    public $checkboxSuccess6;
    public $checkboxSuccess7;
    public $checkboxSuccess8;
    public $checkboxSuccess9;
    public $checkboxSuccess10;
    public $checkboxSuccess11;
    public $checkboxSuccess12;
    public $checkboxSuccess13;
    public $checkboxSuccess14;
    public $checkboxSuccess15;
    public $checkboxSuccess16;
    public $checkboxSuccess17;
    public $checkboxSuccess18;
    public $checkboxSuccess19;
    public $usergroup;
    public $branch;
    public $branches;
    public function mount (){
        $this->branches=BranchModel::all();       
    }
    public function updatedbranch()
    {
        try {
            $actualusergroup = $this->usergroup;
            $actualbranch = $this->branch;
            $permissions = Permissions::where('UserGroup', $actualusergroup)->where('Branch',$actualbranch)->first();
            if ($permissions) {
                $this->checkboxSuccess1 = $permissions->Settings;
                $this->checkboxSuccess2 = $permissions->AccountCreation;
                $this->checkboxSuccess3 = $permissions->AccountUpdate;
                $this->checkboxSuccess4 = $permissions->AccountDelete;
                $this->checkboxSuccess5 = $permissions->Expenses;
                $this->checkboxSuccess6 = $permissions->SalesSummary;
                $this->checkboxSuccess7 = $permissions->SalesRecords;
                $this->checkboxSuccess8 = $permissions->AddPurchases;
                $this->checkboxSuccess9 = $permissions->ClientAccount;
                $this->checkboxSuccess10 = $permissions->ClearCreditors;
                $this->checkboxSuccess11 = $permissions->HumanResource;
                $this->checkboxSuccess12 = $permissions->Reports;
                $this->checkboxSuccess13 = $permissions->Prices;
                $this->checkboxSuccess14 = $permissions->MoneyTransfer;
                $this->checkboxSuccess15 = $permissions->Delete;
                $this->checkboxSuccess16 = $permissions->Update;
                $this->checkboxSuccess17 = $permissions->Records;
                $this->checkboxSuccess18 = $permissions->UserSearch;
                $this->checkboxSuccess19 = $permissions->StockBalance;
                $this->branch = $permissions->Branch;

            } else {
                $this->checkboxSuccess1 = "";
                $this->checkboxSuccess2 = "";
                $this->checkboxSuccess3 = "";
                $this->checkboxSuccess4 = "";
                $this->checkboxSuccess5 = "";
                $this->checkboxSuccess6 = "";
                $this->checkboxSuccess7 = "";
                $this->checkboxSuccess8 = "";
                $this->checkboxSuccess9 = "";
                $this->checkboxSuccess10 = "";
                $this->checkboxSuccess11 = "";
                $this->checkboxSuccess12 = "";
                $this->checkboxSuccess13 = "";
                $this->checkboxSuccess14 = "";
                $this->checkboxSuccess15 = "";
                $this->checkboxSuccess16 = "";
                $this->checkboxSuccess17 = "";
                $this->checkboxSuccess18 = "";
                $this->checkboxSuccess19 = "";
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function deletePermission()
    {
        $this->validate([
            'usergroup' => 'required',
        ]);
        try {
            $actualusergroup = $this->usergroup;
            $actualbranch = $this->branch;
            $permissions = Permissions::where('UserGroup', $actualusergroup)->where('Branch',$actualbranch)->get();
            if ($permissions->count() > 0) {
                $permissionid = $permissions[0]->id;
                $permission = Permissions::find($permissionid);
                $permission->delete();
                session()->flash('permissiondelete', 'Permission has been deleted successfully');
                return redirect()->route('Permissions-Delete');
            } else {
                session()->flash('permissiondeletefail', 'Permission has not yet been added');
                return redirect()->route('Permissions-Delete');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.permissions-delete-component')->layout('layouts.base');
    }
}