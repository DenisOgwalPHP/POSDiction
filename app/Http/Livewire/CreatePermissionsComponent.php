<?php

namespace App\Http\Livewire;
use App\Models\Permissions;
use App\Models\BranchModel;
use Livewire\Component;

class CreatePermissionsComponent extends Component
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
  public function updatedbranch()
  {
    try {
      $actualusergroup = $this->usergroup;
      $actualbranch = $this->branch;
      $permissions = Permissions::where('UserGroup', $actualusergroup)->where('Branch',$actualbranch)->first();
      if ($permissions) {
        //dd($this->checkboxSuccess1);
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
      dd($e->getMessage());
      return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }
  }
public function mount (){
    $this->branches=BranchModel::all();       
}
  public function savePermissions()
  {
    $this->validate([
      'usergroup' => 'required',
      'branch' => 'required',
    ]);
    try {
      $actualusergroup = $this->usergroup;
      $actualbranch = $this->branch;
      $permission = Permissions::where('UserGroup', $actualusergroup)->where('Branch',$actualbranch)->firstOrNew();
      $permission->UserGroup = $this->usergroup;
      $permission->Settings= ($this->checkboxSuccess1 == 0) ? null : $this->checkboxSuccess1;
      $permission->AccountCreation=($this->checkboxSuccess2 == 0) ? null : $this->checkboxSuccess2;
      $permission->AccountUpdate=($this->checkboxSuccess3 == 0) ? null : $this->checkboxSuccess3;
      $permission->AccountDelete=($this->checkboxSuccess4 == 0) ? null : $this->checkboxSuccess4;
      $permission->Expenses=($this->checkboxSuccess5 == 0) ? null : $this->checkboxSuccess5;
      $permission->SalesSummary=($this->checkboxSuccess6 == 0) ? null : $this->checkboxSuccess6;
      $permission->SalesRecords=($this->checkboxSuccess7 == 0) ? null : $this->checkboxSuccess7;
      $permission->AddPurchases=($this->checkboxSuccess8 == 0) ? null : $this->checkboxSuccess8;
      $permission->ClientAccount=($this->checkboxSuccess9 == 0) ? null : $this->checkboxSuccess9;
      $permission->ClearCreditors=($this->checkboxSuccess10 == 0) ? null : $this->checkboxSuccess10;
      $permission->HumanResource=($this->checkboxSuccess11 == 0) ? null : $this->checkboxSuccess11;
      $permission->Reports=($this->checkboxSuccess12 == 0) ? null : $this->checkboxSuccess12;
      $permission->Prices=($this->checkboxSuccess13 == 0) ? null : $this->checkboxSuccess13;
      $permission->MoneyTransfer=($this->checkboxSuccess14 == 0) ? null : $this->checkboxSuccess14;
      $permission->Delete=($this->checkboxSuccess15 == 0) ? null : $this->checkboxSuccess15;
      $permission->Update=($this->checkboxSuccess16 == 0) ? null : $this->checkboxSuccess16;
      $permission->Records=($this->checkboxSuccess17 == 0) ? null : $this->checkboxSuccess17;
      $permission->UserSearch=($this->checkboxSuccess18 == 0) ? null : $this->checkboxSuccess18;
      $permission->StockBalance=($this->checkboxSuccess19 == 0) ? null : $this->checkboxSuccess19;
      $permission->Branch=$this->branch;
      $permission->save();
      session()->flash('createpermission', 'Permissions saved successfully');
      return redirect()->route('Permissions');
    } catch (\Exception $e) {
      dd($e->getMessage());
      return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }

  }
  public function render()
  {
    return view('livewire.create-permissions-component')->layout('layouts.base');
  }
}