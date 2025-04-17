<?php

use App\Http\Controllers\ProfileController;
use App\Http\Livewire\AccountCreateComponent;
use App\Http\Livewire\AccountDeleteComponent;
use App\Http\Livewire\AccountUpdateComponent;
use App\Http\Livewire\AssetNamesComponent;
use App\Http\Livewire\AssetsBalanceComponent;
use App\Http\Livewire\AssetsDamageComponent;
use App\Http\Livewire\AssetsRegisterComponent;
use App\Http\Livewire\AttendanceComponent;
use App\Http\Livewire\BalanceSheet;
use App\Http\Livewire\BlogEditComponent;
use App\Http\Livewire\BranchBalanceRecords;
use App\Http\Livewire\CalendarComponent;
use App\Http\Livewire\CapitalComponent;
use App\Http\Livewire\ClearClientAccounts;
use App\Http\Livewire\ClearSuppliersAccounts;
use App\Http\Livewire\ClientAccountComponent;
use App\Http\Livewire\ClientAccountTransactions;
use App\Http\Livewire\ClientRecords;
use App\Http\Livewire\ContactPageComponent;
use App\Http\Livewire\ContactSettingCreateComponent;
use App\Http\Livewire\CreateBlogComponent;
use App\Http\Livewire\CreateBranchComponent;
use App\Http\Livewire\CreatePermissionsComponent;
use App\Http\Livewire\CreateProductComponent;
use App\Http\Livewire\CreateUnitsComponent;
use App\Http\Livewire\Damages;
use App\Http\Livewire\DamagesRecords;
use App\Http\Livewire\DashboardComponent;
use App\Http\Livewire\DashboardDocumentationComponent;
use App\Http\Livewire\DashboardFAQsComponent;
use App\Http\Livewire\DevidendsComponent;
use App\Http\Livewire\DistributeComponent;
use App\Http\Livewire\DistributionRecords;
use App\Http\Livewire\DocumentationComponent;
use App\Http\Livewire\EnhancedSearch;
use App\Http\Livewire\ExpenseCategoryComponent;
use App\Http\Livewire\ExpenseRecords;
use App\Http\Livewire\ExpensesComponent;
use App\Http\Livewire\FAQCreateComponent;
use App\Http\Livewire\IncomeStatement;
use App\Http\Livewire\MoneyTransferComponent;
use App\Http\Livewire\NotificationsComponent;
use App\Http\Livewire\OtherIncomes;
use App\Http\Livewire\OtherIncomesRecordComponent;
use App\Http\Livewire\PaymentMethodComponent;
use App\Http\Livewire\PaymentsRecordsComponent;
use App\Http\Livewire\PermissionsDeleteComponent;
use App\Http\Livewire\PriceSettingPercentage;
use App\Http\Livewire\PrivacyPolicyComponent;
use App\Http\Livewire\ProformaInvoice;
use App\Http\Livewire\ProformaInvoicePrint;
use App\Http\Livewire\PurchasesComponent;
use App\Http\Livewire\PurchasesRecords;
use App\Http\Livewire\ReturnToSupplierComponent;
use App\Http\Livewire\ReturnToSupplierRecords;
use App\Http\Livewire\SalesRecordComponent;
use App\Http\Livewire\Salesreturn;
use App\Http\Livewire\SalesreturnsRecords;
use App\Http\Livewire\SimpleSearch;
use App\Http\Livewire\StaffComponent;
use App\Http\Livewire\StaffPaymentComponent;
use App\Http\Livewire\StaffPaymentRecords;
use App\Http\Livewire\StaffRecords;
use App\Http\Livewire\StaffSearch;
use App\Http\Livewire\StoreBalanceRecords;
use App\Http\Livewire\SupplierAccountComponent;
use App\Http\Livewire\SupplierAccountTransactionsRecords;
use App\Http\Livewire\SupplierPurchaseRecords;
use App\Http\Livewire\TaxInvoiceComponent;
use App\Http\Livewire\TaxInvoicePrint;
use App\Http\Livewire\TermsAndConditionsComponent;
use App\Http\Livewire\TrialBalance;
use App\Http\Livewire\UpdateUserProfile;
use App\Http\Livewire\UserAccoutRecords;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
|WebRoutes
|--------------------------------------------------------------------------
|
|Hereiswhereyoucanregisterwebroutesforyourapplication.These
|routesareloadedbytheRouteServiceProviderandallofthemwill
|beassignedtothe"web"middlewaregroup.Makesomethinggreat!
|
*/

Route::get('/',function(){
return view('auth.login');
});
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    return 'Cache cleared successfully!';
});
Route::get('/dashboard',function(){
return view('dashboard');
})->middleware(['auth','verified'])->name('dashboard');

Route::middleware(['auth','verified'])->group(function(){

//Forms
Route::get('/Dashboard',DashboardComponent::class)->middleware('auth','verified')->name('Dashboard');
Route::get('/Expense-Category',ExpenseCategoryComponent::class)->name('Expense-Category');
Route::get('/Create-Staff',StaffComponent::class)->name('Create-Staff');
Route::get('/Staff-Payment',StaffPaymentComponent::class)->name('Staff-Payment');
Route::get('/Expense-Entry',ExpensesComponent::class)->name('Expense-Entry');
Route::get('/Notification',NotificationsComponent::class)->name('Notification');
Route::get('/Supplier-Account',SupplierAccountComponent::class)->name('Supplier-Account');
Route::get('/Branch',CreateBranchComponent::class)->name('Branch');
Route::get('/Units',CreateUnitsComponent::class)->name('Units');
Route::get('/Staff-Attendance',AttendanceComponent::class)->name('Staff-Attendance');
Route::get('/Create-Product',CreateProductComponent::class)->name('Create-Product');
Route::get('/Price-Percentage',PriceSettingPercentage::class)->name('Price-Percentage');
Route::get('/Add-Purchases',PurchasesComponent::class)->name('Add-Purchases');
Route::get('/Distribute',DistributeComponent::class)->name('Distribute');
Route::get('/Return-To-Supplier',ReturnToSupplierComponent::class)->name('Return-To-Supplier');
Route::get('/Payment-Method',PaymentMethodComponent::class)->name('Payment-Method');
Route::get('/Client-Account',ClientAccountComponent::class)->name('Client-Account');
Route::get('/Sales-Return',Salesreturn::class)->name('Sales-Return');
Route::get('/Damages',Damages::class)->name('Damages');
Route::get('/Proforma-Invoice',ProformaInvoice::class)->name('Proforma-Invoice');
Route::get('/Other-Incomes',OtherIncomes::class)->name('Other-Incomes');
Route::get('/Clear-Client-Accounts',ClearClientAccounts::class)->name('Clear-Client-Accounts');
Route::get('/Proforma-Print',ProformaInvoicePrint::class)->name('Proforma-Print');
Route::get('/Tax-Invoice',TaxInvoiceComponent::class)->name('Tax-Invoice');
Route::get('/Tax-Invoice-Print',TaxInvoicePrint::class)->name('Tax-Invoice-Print');
Route::get('/Clear-Supplier-Account',ClearSuppliersAccounts::class)->name('Clear-Supplier-Account');
Route::get('/Assets-Register',AssetsRegisterComponent::class)->name('Assets-Register');
Route::get('/Damaged-Assets-Register',AssetsDamageComponent::class)->name('Damaged-Assets-Register');
Route::get('/Assets-Balance',AssetsBalanceComponent::class)->name('Assets-Balance');
Route::get('/Assets-names',AssetNamesComponent::class)->name('Assets-names');
Route::get('/Capital',CapitalComponent::class)->name('Capital');
Route::get('/Money-Transfer',MoneyTransferComponent::class)->name('Money-Transfer');
Route::get('/Devidends',DevidendsComponent::class)->name('Devidends');
//Records
Route::get('/User-Account-Records',UserAccoutRecords::class)->name('User-Account-Records');
Route::get('/Staff-Records',StaffRecords::class)->name('Staff-Records');
Route::get('/Staff-Payment-Records',StaffPaymentRecords::class)->name('Staff-Payment-Records');
Route::get('/Expense-Records',ExpenseRecords::class)->name('Expense-Records');
Route::get('/Other-Incomes-Records',OtherIncomesRecordComponent::class)->name('Other-Incomes-Records');
Route::get('/Sales-Records',SalesRecordComponent::class)->name('Sales-Records');
Route::get('/Client-Records',ClientRecords::class)->name('Client-Records');
Route::get('/Payment-Records',PaymentsRecordsComponent::class)->name('Payment-Records');
Route::get('/Purchases-Records',PurchasesRecords::class)->name('Purchases-Records');
Route::get('/Distribution-Records',DistributionRecords::class)->name('Distribution-Records');
Route::get('/Returned-To-Supplier-Records',ReturnToSupplierRecords::class)->name('Returned-To-Supplier-Records');
Route::get('/Purchase-From-Supplier-Records',SupplierPurchaseRecords::class)->name('Purchase-From-Supplier-Records');
Route::get('/Supplier-Account-Transaction-Records',SupplierAccountTransactionsRecords::class)->name('Supplier-Account-Transaction-Records');
Route::get('/Sales-Returns-Records',SalesreturnsRecords::class)->name('Sales-Returns-Records');
Route::get('/Client-Account-Transactions-Records',ClientAccountTransactions::class)->name('Client-Account-Transactions-Records');
Route::get('/Damages-Records',DamagesRecords::class)->name('Damages-Records');
Route::get('/Branch-Balance-Records',BranchBalanceRecords::class)->name('Branch-Balance-Records');
Route::get('/Store-Balance-Records',StoreBalanceRecords::class)->name('Store-Balance-Records');
//Reports
Route::get('/Income-Statement',IncomeStatement::class)->name('Income-Statement');
Route::get('/Trial-balance',TrialBalance::class)->name('Trial-balance');
Route::get('/Balance-Sheet',BalanceSheet::class)->name('Balance-Sheet');

Route::get('/Account-Creation',AccountCreateComponent::class)->name('Account-Creation');
Route::get('/Account-update',AccountUpdateComponent::class)->name('Account-Update');
Route::get('/Account-Delete',AccountDeleteComponent::class)->name('Account-Delete');
Route::get('/Contact-Page', ContactPageComponent::class)->name('Contact-Page');
Route::get('/Calendar-Component', CalendarComponent::class)->name('Calendar-Component');
Route::get('/Dashboard-Documentation', DashboardDocumentationComponent::class)->name('Dashboard-Documentation');
Route::get('/FAQs', DashboardFAQsComponent::class)->name('FAQs');
Route::get('/Profile-Update', UpdateUserProfile::class)->name('Profile-Update');
Route::get('/Create-Blog', CreateBlogComponent::class)->name('Create-Blog');
Route::get('/blogs-edit/{blog_slug}', BlogEditComponent::class)->name('editblog');
Route::get('/Contact-Settings',ContactSettingCreateComponent::class)->name('Contact-Settings');
Route::get('/saveFaqs',FAQCreateComponent::class)->name('saveFaqs');
Route::get('/Privacy-Policy',PrivacyPolicyComponent::class)->name('Privacy-Policy');
Route::get('/Terms-and-Conditions',TermsAndConditionsComponent::class)->name('Terms-and-Conditions');
Route::get('/Documentation',DocumentationComponent::class)->name('Documentation');
Route::get('/Permissions',CreatePermissionsComponent::class)->name('Permissions');
Route::get('/Permissions-Delete',PermissionsDeleteComponent::class)->name('Permissions-Delete');
Route::get('/Notification',NotificationsComponent::class)->name('Notification');
Route::get('/Simple-Search',SimpleSearch::class)->name('Simple-Search');
Route::get('/Staff-Search',StaffSearch::class)->name('Staff-Search');
Route::get('/Enhanced-Search',EnhancedSearch::class)->name('Enhanced-Search');


Route::get('/profile',[ProfileController::class,'edit'])->name('profile.edit');
Route::patch('/profile',[ProfileController::class,'update'])->name('profile.update');
Route::delete('/profile',[ProfileController::class,'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';